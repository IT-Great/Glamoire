<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Exception;

class PasswordResetController extends Controller
{

    public function sendResetLink(Request $request)
    {
        // Hitung jumlah permintaan reset password dalam 24 jam terakhir
        $tokenCount = Cache::get("reset_password_{$request->email}", 0);

        if ($tokenCount >= 2) {
            return response()->json(['error' => true, 'message' => 'Anda sudah meminta reset password 2 kali hari ini. Silahkan coba lagi besok.']);
        }
        
        // Jika permintaan berhasil, tingkatkan hitungan di cache
        Cache::put("reset_password_{$request->email}", $tokenCount + 1, now()->addDay());
        

        // Token baru
        $token = Str::random(60);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        // Menyimpan token ke dalam tabel password_reset_tokens
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
        ]);

        // Kirim email reset link
        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['success' => true, 'message' => 'Cek Emailmu. Kami telah mengirimkan link untuk mengatur ulang kata sandimu']);
        } else {
            return response()->json(['error' => true, 'message' => $status]);
        }
    }


    public function showResetPasswordForm($email)
    {
        if (DB::table('password_reset_tokens')->where('email', $email)->exists()) {
            $token = DB::table('password_reset_tokens')->where('email', $email)->value('token');
    
            return view('user.component.forgot-password-user', 
            [
                'token' => $token,
                'email' => $email,
            ]);
        }
        else {
            return redirect()->route('home.glamoire');
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            // Dekripsi email dan token
            $email = decrypt($request->email);
            $token = decrypt($request->token);

            // Cek apakah token reset masih ada di database
            $passwordReset = DB::table('password_reset_tokens')
                ->where('email', $email)
                ->where('token', $token)
                ->first();

            if (!$passwordReset) {
                session()->flash('failed_reset_password', 'Token tidak valid atau sudah pernah digunakan.');
                return redirect()->route('home.glamoire');
            }

            // Cek apakah token sudah kadaluarsa (lebih dari 60 menit)
            if (Carbon::parse($passwordReset->created_at)->addMinutes(60)->isPast()) {
                session()->flash('failed_reset_password', 'Token reset sudah kadaluarsa. Silakan minta token baru.');
                return redirect()->route('home.glamoire');
            }

            // Token valid, perbarui password
            $user = User::where('email', $email)->first();
            if (!$user) {
                session()->flash('failed_reset_password', 'Pengguna tidak ditemukan.');
                return redirect()->route('home.glamoire');
            }

            $user->update([
                'password' => Hash::make($request->password)
            ]);

            // Hapus token setelah digunakan
            DB::table('password_reset_tokens')->where('email', $email)->delete();

            session()->flash('after_reset_password');
            return redirect()->route('home.glamoire');

        } catch (Exception $err) {
            return view('error-403');
        }
    }

}
