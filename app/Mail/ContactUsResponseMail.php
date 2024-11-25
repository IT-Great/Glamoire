<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ContactUsResponseMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;
    public $response;

    // public function __construct($contact, $response)
    // {
    //     $this->contact = $contact;
    //     $this->response = $response;
    // }

    public function __construct($contact)  // Ubah constructor untuk hanya menerima $contact
    {
        $this->contact = $contact;
        $this->response = $contact->response;  // Ambil response dari contact object
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Response to Your Question - ' . config('app.name'),
        );
    }

    public function build()
    {
        $mail = $this->subject('Response to Your Question')
            ->view('admin.contactus.contact-response');

        // Periksa apakah file ada sebelum melampirkan
        if ($this->contact->response_image && file_exists(storage_path('app/public/' . $this->contact->response_image))) {
            $mail->attach(storage_path('app/public/' . $this->contact->response_image), [
                'as' => 'response_image.jpg', // Nama file di email
                'mime' => 'image/jpeg', // MIME type untuk gambar
            ]);
        }

        if ($this->contact->response_video && file_exists(storage_path('app/public/' . $this->contact->response_video))) {
            $mail->attach(storage_path('app/public/' . $this->contact->response_video), [
                'as' => 'response_video.mp4', // Nama file di email
                'mime' => 'video/mp4', // MIME type untuk video
            ]);
        }

        return $mail;
    }
}
