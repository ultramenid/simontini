<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StoryCommentReplyNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $mailData) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Balasan baru untuk komentar Anda / New reply to your comment',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.story-comment-reply-notification',
            with: $this->mailData,
        );
    }
}
