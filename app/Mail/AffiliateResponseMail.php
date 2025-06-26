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
            subject: 'Affiliate Response Mail - ' . config('app.name'),
        );
    }

    /**
     * Build the message with additional configurations.
     */
    public function build()
    {
        return $this->from('no-reply@yourdomain.com', config('app.name'))
            ->replyTo('no-reply@yourdomain.com', 'Do Not Reply')
            ->view('admin.affiliate.response')
            ->with([
                'whatsappLink' => 'https://wa.me/62xxxxxxxx', // Ganti dengan nomor WhatsApp admin
                'contactUsLink' => url('/contact')
            ]);

        $mail = $this->view('admin.affiliate.response');

        // Periksa apakah file ada sebelum melampirkan
        if ($this->partner->response_image && file_exists(storage_path('app/public/' . $this->partner->response_image))) {
            $mail->attach(storage_path('app/public/' . $this->partner->response_image), [
                'as' => 'response_image.jpg', // Nama file di email
                'mime' => 'image/jpeg', // MIME type untuk gambar
            ]);
        }

        if ($this->partner->response_video && file_exists(storage_path('app/public/' . $this->partner->response_video))) {
            $mail->attach(storage_path('app/public/' . $this->partner->response_video), [
                'as' => 'response_video.mp4', // Nama file di email
                'mime' => 'video/mp4', // MIME type untuk video
            ]);
        }

        return $mail;
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin.affiliate.response',
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
