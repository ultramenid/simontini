<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewDeforestationStoryPublished extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $mailData) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: ($this->mailData['locale'] === 'en' ? 'New Deforestory: ' : 'Deforestory baru: ')
                .$this->mailData['title'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-deforestation-story',
            with: $this->mailData,
        );
    }
}
