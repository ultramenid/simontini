<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DeforestationStoryUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $mailData) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pembaruan Story / Story Update: '.$this->mailData['titleId'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.deforestation-story-update',
            with: $this->mailData,
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
