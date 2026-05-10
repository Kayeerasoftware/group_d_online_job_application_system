<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsSeeker
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->is_active || ! $request->user()->isSeeker()) {
            abort(403, 'Seeker access required.');
        }

        return $next($request);
    }
}
