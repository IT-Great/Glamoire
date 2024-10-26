<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactUsResponseMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;
    public $response;

    public function __construct($contact, $response)
    {
        $this->contact = $contact;
        $this->response = $response;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Response to Your Question - ' . config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'admin.contactus.contact-response', // Pastikan path view ini benar
            with: [
                'contact' => $this->contact,
                'response' => $this->response
            ]
        );
    }
}
