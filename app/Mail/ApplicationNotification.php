<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ApplicationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $mailBag;

    /**
     * Create a new message instance.
     */
    public function __construct($mailBag)
    
    {
        
        $this->mailBag=$mailBag;//wohi OPPs wala data a kr is mn chla jay y is classs ki field ya instance bna dy ga

        // Log::info('Email sent to ' .$mailBag['companyData']->companyemail);

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Applicant',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'Emails.email ',
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
