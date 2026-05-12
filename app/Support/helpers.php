<?php

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

if (! function_exists('safe_auth_user')) {
    function safe_auth_user(): ?Authenticatable
    {
        try {
            return Auth::user();
        } catch (Throwable) {
            return null;
        }
    }
}

if (! function_exists('safe_auth_check')) {
    function safe_auth_check(): bool
    {
        try {
            return Auth::check();
        } catch (Throwable) {
            return false;
        }
    }
}

if (! function_exists('safe_auth_id')) {
    function safe_auth_id(): mixed
    {
        try {
            return Auth::id();
        } catch (Throwable) {
            return null;
        }
    }
}
