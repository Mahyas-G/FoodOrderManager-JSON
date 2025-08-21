<?php

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
        $middleware->appendToGroup('web', \Illuminate\Session\Middleware\StartSession::class);
        $middleware->appendToGroup('web', \Illuminate\View\Middleware\ShareErrorsFromSession::class);
        $middleware->appendToGroup('web', \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);
        $middleware->appendToGroup('web', \Illuminate\Routing\Middleware\SubstituteBindings::class);

        $middleware->alias([
            'auth'  => \App\Http\Middleware\CheckAuthenticated::class,
            'admin' => \App\Http\Middleware\CheckAdminRole::class,
            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
