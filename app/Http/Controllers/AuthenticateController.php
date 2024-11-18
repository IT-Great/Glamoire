<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

        // if (Auth::attempt($credentials)) {
        //     // Authentication passed
        //     return redirect()->intended('dashboard');
        // }

        if (Auth::attempt($credentials)) {
            // Authentication passed
            Log::info('Login successful for user: ' . $credentials['name']);
            return redirect()->intended('dashboard');
        } else {
            Log::warning('Login failed for user: ' . $credentials['name']);
        }

        // Authentication failed
        return redirect()->route('login-admin')
            ->withErrors(['name' => 'These credentials do not match our records.'])
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
}
