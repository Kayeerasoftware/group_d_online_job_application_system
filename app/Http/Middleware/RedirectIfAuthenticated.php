<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated as Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class RedirectIfAuthenticated extends Middleware
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        try {
            return parent::handle($request, $next, ...$guards);
        } catch (Throwable) {
            return $next($request);
        }
    }
}
