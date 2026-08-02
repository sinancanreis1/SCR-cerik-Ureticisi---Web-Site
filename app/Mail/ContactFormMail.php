<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Yeni İletişim Formu Mesajı: ' . ($this->data['subject'] ?? 'Genel Soru'),
            replyTo: [
                new \Illuminate\Mail\Mailables\Address($this->data['email'], $this->data['name']),
            ],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            htmlString: '<h3>Yeni İletişim Formu Mesajı</h3>'
                . '<p><strong>Ad Soyad:</strong> ' . htmlspecialchars($this->data['name']) . '</p>'
                . '<p><strong>E-Posta:</strong> ' . htmlspecialchars($this->data['email']) . '</p>'
                . '<p><strong>Konu:</strong> ' . htmlspecialchars($this->data['subject']) . '</p>'
                . '<p><strong>Mesaj:</strong><br>' . nl2br(htmlspecialchars($this->data['message'])) . '</p>'
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
