<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class GeminiAiService
{
    protected string $apiKey;
    protected string $model;
    protected string $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/';

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY', '');
        // Using 'gemini-flash-latest' to automatically map to the newest available stable flash model (e.g. 3.x)
        $this->model = 'gemini-flash-latest';
    }

    /**
     * Send a conversation history to Gemini API and get the text response.
     *
     * @param array $messages Array of message objects [['role' => 'user|model', 'parts' => [['text' => '...']]]]
     * @return string
     * @throws Exception
     */
    public function sendChat(array $messages): string
    {
        if (empty($this->apiKey)) {
            throw new Exception('GEMINI_API_KEY tanımlanmamış. Lütfen .env dosyanızı kontrol edin.');
        }

        $url = $this->baseUrl . $this->model . ':generateContent?key=' . $this->apiKey;

        // Ensure roles are alternating and correct for Gemini
        // We will just pass the messages directly as they should be formatted correctly by the caller

        // Strip out any custom UI keys (like 'html') before sending to Gemini
        $cleanMessages = array_map(function ($msg) {
            return [
                'role' => $msg['role'],
                'parts' => $msg['parts']
            ];
        }, $messages);

        $payload = [
            'contents' => $cleanMessages,
            'systemInstruction' => [
                'parts' => [
                    ['text' => "Sen Sinan Can REİS'in sitesindeki yapay zeka asistanısın.\nEğer kullanıcı senden resim, görsel veya fotoğraf oluşturmanı, çizmeni isterse, markdown formatında şu URL'yi kullanarak resim oluşturabilirsin:\n![Resim Açıklaması](https://image.pollinations.ai/prompt/Ingilizce_Detayli_Gorsel_Aciklamasi?width=800&height=600&nologo=true)\nURL içindeki prompt kısmı kesinlikle İNGİLİZCE olmalı ve kelimeler arası boşluklar alt çizgi (_) veya %20 ile ayrılmalıdır.\nÖrneğin kullanıcı 'kırmızı bir araba resmi' isterse yanıtında sadece şunu döndürebilirsin:\n![Kırmızı Araba](https://image.pollinations.ai/prompt/a_red_car_driving_on_a_scenic_road?width=800&height=600&nologo=true)\nAsla 'Ben sadece metin yapay zekasıyım, resim çizemem' deme."]
                ]
            ],
            'generationConfig' => [
                'temperature' => 0.7,
                'topK' => 40,
                'topP' => 0.95,
                'maxOutputTokens' => 8192,
            ]
        ];

        $response = Http::withoutVerifying()->withHeaders([
            'Content-Type' => 'application/json',
        ])->post($url, $payload);

        if ($response->failed()) {
            $errorMsg = $response->json('error.message') ?? $response->body();
            // If it still fails, try falling back to the latest pro model
            if (str_contains($errorMsg, 'is not found') || str_contains($errorMsg, 'not supported') || str_contains($errorMsg, 'no longer available')) {
                $fallbackUrl = $this->baseUrl . 'gemini-pro-latest:generateContent?key=' . $this->apiKey;
                $response = Http::withoutVerifying()->withHeaders([
                    'Content-Type' => 'application/json',
                ])->post($fallbackUrl, $payload);
                if ($response->failed()) {
                    $errorMsg = $response->json('error.message') ?? $response->body();
                    throw new Exception('Gemini API Hatası (Fallback): ' . $errorMsg);
                }
            } else {
                throw new Exception('Gemini API Hatası: ' . $errorMsg);
            }
        }

        $data = $response->json();
        
        if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
            return $data['candidates'][0]['content']['parts'][0]['text'];
        }

        throw new Exception('Gemini API beklenmeyen bir yanıt döndürdü.');
    }
}
