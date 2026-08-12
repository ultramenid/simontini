<?php

namespace App\Mail;

use App\Mail\Concerns\HasUniqueEmailReference;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DeforestationSubscriptionConfirmed extends Mailable
{
    use HasUniqueEmailReference, Queueable, SerializesModels;

    public function __construct(public array $mailData) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->mailData['subject'] ?? ($this->mailData['locale'] === 'en'
                ? 'Your SIMONTINI Deforestory subscription is active'
                : 'Langganan Deforestory SIMONTINI Anda aktif'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.deforestation-subscription-confirmed',
            with: $this->mailData,
        );
    }
}
