<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated as Middleware;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated extends Middleware
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        return parent::handle($request, $next, ...$guards);
    }
}
