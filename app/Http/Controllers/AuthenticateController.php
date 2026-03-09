<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

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

    // ==========================================
    // MANAJEMEN PROFIL ADMIN
    // ==========================================

    // 1. Tampilkan halaman profil
    public function adminProfile()
    {
        $user = Auth::user();
        // Sesuaikan 'admin.profile.index' dengan lokasi file blade-mu nanti
        return view('admin.profile.index', compact('user'));
    }

    // 2. Update data profil
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'      => 'required|string|max:255',
            'fullname'  => 'nullable|string|max:255',
            // Gunakan rule unique dan abaikan ID user saat ini agar tidak error saat klik save tanpa ubah email
            'email'     => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'handphone' => 'nullable|string|max:20|unique:users,handphone,' . $user->id,
            'gender'    => 'nullable|in:Laki-laki,Perempuan',
            'date'      => 'nullable|date',
        ], [
            'email.unique' => 'Email ini sudah digunakan oleh akun lain.',
            'handphone.unique' => 'Nomor HP ini sudah terdaftar.',
        ]);

        try {
            // Update data user menggunakan Eloquent (pastikan pakai UUID string)
            $userToUpdate = User::findOrFail($user->id);
            $userToUpdate->update([
                'name'      => $request->name,
                'fullname'  => $request->fullname,
                'email'     => $request->email,
                'handphone' => $request->handphone,
                'gender'    => $request->gender,
                'date'      => $request->date,
            ]);

            Log::info('Admin profile updated successfully for user: ' . $user->email);
            return back()->with('success', 'Profil berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Error updating profile: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan profil.']);
        }
    }

    // 3. Update Password Khusus
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password'     => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'new_password.min' => 'Password minimal harus 8 karakter.',
        ]);

        $user = User::findOrFail(Auth::id());

        // Cek apakah password lama yang diinputkan sesuai dengan di database
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        // Update ke password baru
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        Log::info('Admin password changed successfully for user: ' . $user->email);
        return back()->with('success_password', 'Password berhasil diubah!');
    }

    // 4. Tampilkan Halaman Pengaturan (Settings)
    public function settings()
    {
        // Mengambil semua data setting dan mengubahnya menjadi array assosiatif [ 'key' => 'value' ]
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('admin.settings.index', compact('settings'));
    }

    // 5. Proses Simpan Pengaturan
    public function updateSettings(Request $request)
    {
        // Ambil semua request kecuali token dan file logo
        $data = $request->except(['_token', 'site_logo']);

        foreach ($data as $key => $value) {
            // Cegah password/secret key tertimpa menjadi kosong jika form disubmit tanpa diisi ulang
            if (in_array($key, ['mail_password', 'prismalink_secret_key']) && empty($value)) {
                continue;
            }

            // Simpan atau update ke database
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // Proses khusus untuk upload logo website
        if ($request->hasFile('site_logo')) {
            $file = $request->file('site_logo');
            $filename = time() . '_logo.' . $file->getClientOriginalExtension();

            // Simpan ke folder public/assets/images
            $file->move(public_path('assets/images'), $filename);

            Setting::updateOrCreate(
                ['key' => 'site_logo'],
                ['value' => 'assets/images/' . $filename]
            );
        }

        Log::info('System settings updated by user: ' . Auth::user()->email);
        return back()->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
