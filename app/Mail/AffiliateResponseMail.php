<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AffiliateResponseMail extends Mailable
{
    use Queueable, SerializesModels;

    public $partner;
    public $response;

    /**
     * Create a new message instance.
     */
    public function __construct($partner, $response)
    {
        $this->partner = $partner;
        $this->response = $response;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Affiliate Response Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin.affiliate.response', // Pastikan path view ini benar
            with: [
                'partner' => $this->partner,
                'response' => $this->response
            ]
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
