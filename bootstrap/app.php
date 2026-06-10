<?php

use App\Http\Middleware\SuperAdminGuestMiddleware;
use App\Http\Middleware\SuperAdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'superadmin.auth' => SuperAdminMiddleware::class,
            'superadmin.guest' => SuperAdminGuestMiddleware::class,
        ]);
        $middleware->append(\App\Http\Middleware\HandleLargeUploads::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
