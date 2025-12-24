<?php

use App\Http\Middleware\RedirectGuestFromVerification;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'guest.verification' => RedirectGuestFromVerification::class,
        ]);
        
        $middleware->trustHosts(at: ['adeeva.test'], subdomains:false);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
