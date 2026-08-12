<?php

namespace App\Mail;

use App\Mail\Concerns\HasUniqueEmailReference;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewDeforestationStoryPublished extends Mailable
{
    use HasUniqueEmailReference, Queueable, SerializesModels;

    public function __construct(public array $mailData) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Deforestory Baru / New Deforestory: '.$this->mailData['titleId'],
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
