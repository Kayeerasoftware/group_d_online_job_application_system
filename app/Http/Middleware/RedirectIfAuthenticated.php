<?php

namespace App\Http\Middleware;

use App\Support\DatabaseBootstrap;
use Closure;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated as Middleware;
use Throwable;

class RedirectIfAuthenticated extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        app(DatabaseBootstrap::class)->ensure();

        try {
            return parent::handle($request, $next, ...$guards);
        } catch (Throwable) {
            return $next($request);
        }
    }
}
