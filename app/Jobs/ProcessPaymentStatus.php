<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessPaymentStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orderId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            // Panggil metode untuk memeriksa status pembayaran
            $status = app()->call('App\Http\Controllers\DokuPaymentController@getPaymentStatus', [
                'orderId' => $this->orderId
            ]);

            Log::info('Payment status checked via job', [
                'orderId' => $this->orderId,
                'status' => $status,
            ]);

            // Lakukan logika tambahan berdasarkan status pembayaran
            if ($status === 'PAID') {
                // Update status pembayaran di database
                // Kirim notifikasi ke pengguna, dsb.
            }
        } catch (\Exception $e) {
            Log::error('Error processing payment status', [
                'orderId' => $this->orderId,
                'error' => $e->getMessage()
            ]);
        }
    }
}

