<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PromoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectText;
    public $messageText;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subjectText, $messageText)
    {
        $this->subjectText = $subjectText;
        $this->messageText = $messageText;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Mengarahkan ke template blade email
        return $this->subject($this->subjectText)
                    ->view('email.promo');
    }
}
