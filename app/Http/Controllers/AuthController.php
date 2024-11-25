<?php

namespace App\Http\Controllers;

use App\Mail\sendMailCodeNewUser;
use App\Models\Role;
use App\Models\Shipping_address;
use App\Models\User;
use App\Models\VoucherNewUser;
use App\Models\Cart;
use Exception;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Cek apakah email terdaftar di database
        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            // Email ditemukan, sekarang cek apakah password cocok
            if (Hash::check($credentials['password'], $user->password)) {
                // Jika password benar, lakukan autentikasi
                Auth::login($user);

                session()->put([
                    'id_user' => $user['id'],
                    'username' => $user['fullname'],
                ]);

                return response()->json(['success' => true, 'message' => 'Login Berhasil']);
            } else {
                // Jika password salah
                return response()->json(['error' => true, 'message' => 'Password Salah']);
            }
        } else {
            // Jika email tidak ditemukan
            return response()->json(['error' => true, 'message' => 'Oops Email Belum Terdaftar']);
        }
    }

    public function register(Request $request)
    {
        try {

            if (User::where('email', $request->email)->exists()) {
                return response()->json(['error' => true, 'message' => 'Email Sudah Terdaftar']);
            }
            if (User::where('handphone', $request->handphone)->exists()) {
                return response()->json(['error' => true, 'message' => 'Handphone Sudah Terdaftar']);
            }

            // Set nilai role secara langsung
            $role = 'user';  // Kamu bisa mengubah ini sesuai kebutuhan

            $user = User::create([
                'fullname'   => $request->fullname,
                'email'      => $request->email,
                'password'   => Hash::make($request->password),
                'handphone'  => $request->handphone,
                'date'       => $request->date,
                'gender'     => $request->gender,
                'role'       => $role,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Cart::create([
                'user_id' => $user['id'],
            ]);
            
            event(new Registered($user));
            $userLogin = User::where('email', $user->email)->first();



            // CHECK UNTUK VOUCHER 
            if ($userLogin) {
                $checkVoucherNewUser = VoucherNewUser::where('email', $user->email)->exists();

                if($checkVoucherNewUser){
                    Auth::login($userLogin);
                    session()->put([
                        'id_user' => $user['id'],
                        'username' => $user['fullname'],
                    ]);

                    $voucherNewUser = VoucherNewUser::where('email', $request->email)->first();
                    $voucherNewUser->update([
                        'user_id' => $userLogin->id,
                    ]);
    
                    return response()->json([
                        'success' => true, 
                        'message' => 'Registrasi Berhasil, Silakan cek email Anda untuk verifikasi'
                    ]);
                }else{
                    $increment = VoucherNewUser::count() + 1;
    
                    // Ambil 4 karakter pertama dari ID user
                    $idFragment = substr($userLogin->id, 0, 4);
    
                    // Buat kode voucher sesuai format "increment-4hurufID"
                    $codeUser = "{$increment}-{$idFragment}";
    
                    VoucherNewUser::create([
                        'code' => $codeUser,
                        'user_id' => $userLogin->id,
                        'is_use' => 0,
                        'email' => $user->email,
                    ]);
    
                    Auth::login($userLogin);
    
                    $data = [
                        'code' => $codeUser,
                        'fullname' => $userLogin->fullname,
                    ];
                    $email_target = $userLogin->email;
                    
                    Mail::to($email_target)->send(new sendMailCodeNewUser($data));
    
                    session()->put([
                        'id_user' => $user['id'],
                        'username' => $user['fullname'],
                    ]);
    
                    return response()->json([
                        'success' => true, 
                        'message' => 'Registrasi Berhasil, Silakan cek email Anda untuk verifikasi & Jangan lupa periksa voucher kamu'
                    ]);
                }

            } else {
                return response()->json(['error' => true, 'message' => 'Oops Email Gagal Didaftarkan']);
            }

        } catch (Exception $err) {
            return response()->json([
                'error'   => true, 
                'message' => $err->getMessage(), // Menangkap pesan error
            ]); // Mengembalikan status 500 untuk menandakan error server
        }
    }

    public function checkEmail(Request $request)
    {
        $emailExists = User::where('email', $request->email)->exists();

        return response()->json(['exists' => $emailExists]);
    }

    public function checkHandphone(Request $request)
    {
        $handphoneExists = User::where('handphone', $request->handphone)->exists();

        return response()->json(['exists' => $handphoneExists]);
    }

    protected function authenticated(Request $request, $user)
    {
        if (!$user->hasVerifiedEmail()) {
            Auth::logout();
            return redirect('/email/verify')->with('warning', 'Verifikasi email Anda terlebih dahulu.');
        }

        return redirect()->intended('/');
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
            session()->flush(); // Untuk menghapus semua session
            return response()->json(['success' => true, 'message' => 'Logout berhasil']);
        } catch (Exception $err) {
            dd($err);
        }
    }
}
