<?php

use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsEmployer;
use App\Http\Middleware\IsSeeker;
use App\Http\Middleware\IsRegulator;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth' => Authenticate::class,
            'guest' => RedirectIfAuthenticated::class,
            'admin' => IsAdmin::class,
            'employer' => IsEmployer::class,
            'seeker' => IsSeeker::class,
            'regulator' => IsRegulator::class,
        ]);
        $middleware->validateCsrfTokens(except: []);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
