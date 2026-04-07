<?php

use App\Http\Middleware\RedirectGuestFromVerification;
use App\Http\Middleware\UpdateStatusUserMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        // api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'guest.verification' => RedirectGuestFromVerification::class,
        ]);

        $middleware->appendToGroup('web', [
            UpdateStatusUserMiddleware::class
        ]);

        $middleware->validateCsrfTokens(
            except: ['moota/callback']
        );
        
        // $middleware->trustHosts(at: ['adeeva.test'], subdomains:false);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
