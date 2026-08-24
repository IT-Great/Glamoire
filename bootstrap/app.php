<?php

use App\Http\Middleware\Role;
use App\Http\Middleware\Costumer;
use Illuminate\Foundation\Application;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        // $middleware->append(Authenticate::class); // Gunakan nama middleware yang benar
        // $middleware->append(Role::class); // Menambahkan middleware authenticate
        $middleware->alias([
            'auth' => \App\Http\Middleware\Authenticate::class,
            'role' => \App\Http\Middleware\Role::class,
        ]);

        // Tambahkan baris ini
        $middleware->validateCsrfTokens(except: [
            'xendit/webhook',
            // 'api/*', // (opsional jika Anda punya route api lain)
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
