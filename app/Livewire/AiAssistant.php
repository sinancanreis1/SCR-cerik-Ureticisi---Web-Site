<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\GeminiAiService;
use Exception;

class AiAssistant extends Component
{
    public string $prompt = '';
    public array $messages = []; // Stores the chat history
    public bool $isGenerating = false;
    public ?string $errorMessage = null;

    public function generate()
    {
        $this->validate([
            'prompt' => 'required|string|min:2',
        ]);

        $this->isGenerating = true;
        $this->errorMessage = null;

        // Add user message to history
        $userText = $this->prompt;
        $this->messages[] = [
            'role' => 'user',
            'parts' => [['text' => $userText]]
        ];

        // Clear input early
        $this->prompt = '';

        try {
            $service = new GeminiAiService();
            // Send full conversation history
            $response = $service->sendChat($this->messages);
            
            // Add AI response to history
            $this->messages[] = [
                'role' => 'model',
                'parts' => [['text' => $response]],
                'html' => \Illuminate\Support\Str::markdown($response) // Pre-parse markdown for UI
            ];
            
        } catch (Exception $e) {
            $this->errorMessage = $e->getMessage();
            // Optional: remove the last user message if it failed, or keep it. Let's keep it so they can see what failed.
        }

        $this->isGenerating = false;
    }

    public function clear()
    {
        $this->prompt = '';
        $this->messages = [];
        $this->errorMessage = null;
    }

    public function render()
    {
        return view('livewire.ai-assistant');
    }
}
