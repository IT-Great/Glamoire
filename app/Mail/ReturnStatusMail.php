<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReturnStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $statusAction; // 'approved' atau 'rejected'

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, $statusAction)
    {
        $this->order = $order;
        $this->statusAction = $statusAction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->statusAction == 'approved'
            ? 'Pengajuan Retur Disetujui - Glamoire'
            : 'Pengajuan Retur Ditolak - Glamoire';

        return $this->subject($subject)
                    ->view('emails.return_status');
    }
}
