<?php

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LeadNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Lead $lead) {}

    public function envelope(): Envelope
    {
        $service = $this->lead->servicePage->getTranslation('title', 'en', true);

        return (new Envelope(subject: "New lead — {$service}"))
            ->to(env('MAIL_FROM_ADDRESS'))
            ->from(env('MAIL_FROM_ADDRESS'));
    }

    public function content(): Content
    {
        return new Content(view: 'mail.lead-notification');
    }

    public function attachments(): array
    {
        return [];
    }
}
