<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Throwable;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        try {
            return parent::handle($request, $next, ...$guards);
        } catch (Throwable) {
            return redirect()->route('login');
        }
    }

    protected function redirectTo(Request $request): ?string
    {
        return route('login');
    }
}
