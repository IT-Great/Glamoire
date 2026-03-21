<?php

// namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
// use App\Models\Contactus;
// use App\Models\Subscribe;
// use Illuminate\Http\Request;

// class SubscribeController extends Controller
// {
//     public function indexSubscribeAdmin()
//     {
//         $subscribe = Subscribe::paginate(8);

//         return view('admin.subscribe.index', compact('subscribe'));
//     }
// }

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail; // WAJIB DI-IMPORT
use App\Mail\PromoMail; // WAJIB DI-IMPORT

class SubscribeController extends Controller
{
    public function indexSubscribeAdmin()
    {
        $subscribe = Subscribe::paginate(8);
        return view('admin.subscribe.index', compact('subscribe'));
    }

    // Fungsi baru untuk menangani pengiriman email
    public function sendEmail(Request $request)
    {
        $request->validate([
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            // Eksekusi pengiriman email SECARA LANGSUNG (Synchronous)
            Mail::to($request->email)->send(new PromoMail($request->subject, $request->message));

            Log::info("Email sukses terkirim ke: {$request->email} | Subject: {$request->subject}");

            return response()->json([
                'success' => true,
                'message' => 'Email berhasil dimasukkan ke antrean dan akan segera dikirim ke ' . $request->email
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email subscribe: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim email: ' . $e->getMessage()
            ], 500);
        }
    }
}
