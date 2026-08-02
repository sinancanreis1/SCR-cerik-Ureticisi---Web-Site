<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
$messages = [['role' => 'user', 'parts' => [['text' => 'Bana bir kedi resmi çiz']]]];
$service = new \App\Services\GeminiAiService();
try {
    echo $service->sendChat($messages);
} catch (\Exception $e) {
    echo 'ERROR: ' . $e->getMessage();
}
