<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    // Fungsi untuk me-redirect user ke halaman login Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Fungsi untuk menangani balikan (callback) dari Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cek apakah user dengan google_id tersebut sudah ada
            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                // Jika sudah ada, langsung login
                Auth::login($user);
                session(['id_user' => $user->id, 'role' => $user->role]);

                return redirect()->intended('/')->with('success', 'Berhasil masuk dengan Google');
            } else {
                // Cek apakah email sudah terdaftar secara manual sebelumnya
                $existingEmailUser = User::where('email', $googleUser->email)->first();

                if($existingEmailUser) {
                     // Jika email sudah ada, update google_id nya
                     $existingEmailUser->update(['google_id' => $googleUser->id]);
                     Auth::login($existingEmailUser);
                     session(['id_user' => $existingEmailUser->id, 'role' => $existingEmailUser->role]);

                     return redirect()->intended('/')->with('success', 'Akun berhasil ditautkan dengan Google');
                }

                // Jika user benar-benar baru, buat akun baru
                $newUser = User::create([
                    'id' => (string) Str::uuid(), // Sesuaikan jika Anda menggunakan UUID
                    'fullname' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt(Str::random(16)), // Password acak yang aman
                    'role' => 'user',
                    'email_verified_at' => now(), // Otomatis terverifikasi karena dari Google
                ]);

                Auth::login($newUser);
                session(['id_user' => $newUser->id, 'role' => $newUser->role]);

                return redirect()->intended('/')->with('success', 'Pendaftaran dengan Google berhasil!');
            }
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Gagal terhubung dengan Google. Silakan coba lagi.');
        }
    }
}
