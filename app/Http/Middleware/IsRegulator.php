<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsRegulator
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->is_active || $request->user()->roleValue() !== UserRole::Regulator->value) {
            abort(403, 'Regulator access required.');
        }

        return $next($request);
    }
}
