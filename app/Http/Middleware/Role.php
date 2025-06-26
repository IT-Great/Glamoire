<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    // default code
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // } 


    // berfungsi
    // public function handle(Request $request, Closure $next, ...$roles)
    // {
    //     if (!Auth::check()) {
    //         return redirect('login-admin');
    //     }

    //     $user = Auth::user();

    //     foreach ($roles as $role) {
    //         if ($user->role == $role) {
    //             return $next($request);
    //         }
    //     }

    //     // Store the current URL in the session before redirecting
    //     session(['last_page' => url()->previous()]);

    //     return response()->view('error-403', [], 403);
    // }

    // new update code
    // public function handle(Request $request, Closure $next, ...$roles)
    // {
    //     if (!Auth::check()) {
    //         return redirect('login-admin');
    //     }

    //     $user = Auth::user();

    //     // Jika user memiliki role yang diizinkan, lanjutkan ke request berikutnya
    //     if (in_array($user->role, $roles)) {
    //         return $next($request);
    //     }

    //     // Jika user memiliki role 'user' dan mencoba mengakses halaman admin, redirect ke home
    //     if ($user->role === 'user') {
    //         return redirect('/');
    //     }

    //     // Untuk role lain yang tidak diizinkan, tampilkan halaman error 403
    //     return response()->view('error-403', [], 403);
    // }

    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('login-admin');
        }

        $user = Auth::user();

        // Jika ini adalah rute dashboard dan user bukan admin/superadmin
        if ($request->is('dashboard') && !in_array($user->role, ['admin', 'superadmin'])) {
            return redirect('/');
        }

        // Jika user memiliki role yang diizinkan, lanjutkan ke request berikutnya
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Jika user memiliki role 'user' dan mencoba mengakses halaman admin/accounting, redirect ke home
        if ($user->role === 'user') {
            return redirect('/');
        }

        // Untuk role lain yang tidak diizinkan, tampilkan halaman error 403
        return response()->view('error-403', [], 403);
    }
}
