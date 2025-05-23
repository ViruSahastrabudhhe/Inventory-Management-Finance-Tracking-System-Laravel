<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\EnsureUserIsManager;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => EnsureUserIsAdmin::class
        ]);
        $middleware->alias([
            'manager' => EnsureUserIsManager::class
        ]);
        $middleware->redirectGuestsTo('/login');
        $middleware->trustHosts(at: ['127.0.0.1:8000']);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
