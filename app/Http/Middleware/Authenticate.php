<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle($request, Closure $next, $guard = null)
    // {
    //     if (Auth::guard($guard)->guest()) {
    //         Log::info('Guest accessed dashboard'); // Tambahkan log
    //         return redirect('/login')->withErrors(['error' => 'You must log in to access that page.']);
    //     }

    //     return $next($request);
    // }

    // public function handle($request, Closure $next, $guard = null)
    // {
    //     if (Auth::guard($guard)->guest()) {
    //         Log::info('Guest accessed dashboard'); // Tambahkan log
    //         return redirect('/login')->withErrors(['error' => 'You must log in first.']); // Redirect dengan pesan error
    //     }

    //     return $next($request);
    // }

    // public function handle($request, Closure $next, $guard = null)
    // {
    //     if (Auth::guard($guard)->guest()) {
    //         if ($request->is('login')) {
    //             return $next($request);  // Jangan redirect jika sudah di halaman login
    //         }

    //         return redirect('/login')->withErrors(['error' => 'You must log in first.']);
    //     }

    //     return $next($request);
    // }

    // berfungsi
    public function handle($request, Closure $next, $guard = null)
    {        
        if (Auth::guard($guard)->guest()) {
            Log::info('Auth guard is guest, redirecting to login');
            return redirect()->guest('login-admin');
        }

        Log::info('Authenticated user: ' . Auth::user()->name);

        return $next($request);
    }
    
}
