<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BiteshipController extends Controller
{
    public function callback(Request $request)
    {
        try {
            // Log request body (untuk debugging awal)
            Log::info('Biteship Callback Received:', [
                'headers' => $request->headers->all(),
                'body' => $request->getContent(),
            ]);

            // Selalu balas dengan "ok" saat instalasi
            return response('ok', 200)
                ->header('Content-Type', 'text/plain');
        } catch (\Exception $e) {
            Log::error('Biteship Callback Error: ' . $e->getMessage());
            return response('error', 500)
                ->header('Content-Type', 'text/plain');
        }
    }


}
