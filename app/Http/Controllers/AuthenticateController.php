<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Validation\Rules;



class AuthenticateController extends Controller
{
    // login
    public function indexlogin()
    {
        // Check if the user is already authenticated
        if (Auth::check()) {
            // Redirect to the dashboard if already logged in
            return redirect()->route('dashboard');
        }

        // Otherwise, show the login form
        return view('admin.login.index'); // Adjust the view name accordingly
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login-admin')
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
            Log::info('Login successful for user: ' . $credentials['name']);
            return redirect()->intended('dashboard');
        } else {
            Log::warning('Login failed for user: ' . $credentials['name']);
        }

        // Authentication failed
        return redirect()->route('login-admin')
            ->withErrors(['name' => 'Username atau password tidak sesuai dengan data kami.'])
            ->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login-admin');
    }



    // forgot password
    public function forgotPassword()
    {
        return view('forgot-password');
    }

    // Kirim link reset password
    public function sendResetLink(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
            ]);

            // Cek apakah user ada dan memiliki role yang diizinkan
            $user = User::where('email', $request->email)
                ->whereIn('role', ['admin', 'superadmin', 'accounting'])
                ->first();

            if (!$user) {
                Log::warning('Password reset attempt for unauthorized user: ' . $request->email);
                return back()->withErrors([
                    'email' => 'Email tidak ditemukan atau tidak memiliki akses untuk reset password.'
                ]);
            }

            // Generate token
            $token = Str::random(64);

            // Simpan token ke database
            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $request->email],
                [
                    'token' => Hash::make($token),
                    'created_at' => now()
                ]
            );

            // Kirim email dengan token
            Mail::to($request->email)->send(new ResetPasswordMail($token, $user->name ?? $user->fullname));

            Log::info('Password reset email sent successfully to: ' . $request->email);
            return back()->with('success', 'Link reset password telah dikirim ke email Anda.');
        } catch (\Exception $e) {
            Log::error('Error in sendResetLink: ' . $e->getMessage(), [
                'email' => $request->email ?? 'unknown',
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return back()->withErrors([
                'email' => 'Terjadi kesalahan. Silakan coba lagi.'
            ]);
        }
    }

    // Tampilkan form reset password
    public function showResetForm($token)
    {
        return view('reset-password', ['token' => $token]);
    }

    // Proses reset password
    public function resetPassword(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            // Cek token di database
            $passwordReset = DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->first();

            if (!$passwordReset || !Hash::check($request->token, $passwordReset->token)) {
                Log::warning('Invalid password reset token for: ' . $request->email);
                return back()->withErrors([
                    'token' => 'Token reset password tidak valid atau sudah kedaluwarsa.'
                ]);
            }

            // Cek apakah token sudah lebih dari 1 jam
            if (now()->diffInMinutes($passwordReset->created_at) > 60) {
                Log::warning('Password reset token expired for: ' . $request->email);
                return back()->withErrors([
                    'token' => 'Token reset password sudah kedaluwarsa.'
                ]);
            }

            // Cek user dan role
            $user = User::where('email', $request->email)
                ->whereIn('role', ['admin', 'superadmin', 'accounting'])
                ->first();

            if (!$user) {
                Log::warning('Password reset attempt for unauthorized user: ' . $request->email);
                return back()->withErrors([
                    'email' => 'User tidak ditemukan atau tidak memiliki akses.'
                ]);
            }

            // Update password
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            // Hapus token setelah digunakan
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();

            Log::info('Password reset successful for: ' . $request->email);
            return redirect()->route('login-admin')->with('success', 'Password berhasil diubah. Silakan login dengan password baru.');
        } catch (\Exception $e) {
            Log::error('Error in resetPassword: ' . $e->getMessage(), [
                'email' => $request->email ?? 'unknown',
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return back()->withErrors([
                'password' => 'Terjadi kesalahan. Silakan coba lagi.'
            ]);
        }
    }
}
