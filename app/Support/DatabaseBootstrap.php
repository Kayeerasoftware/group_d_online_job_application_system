<?php

namespace App\Support;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Throwable;

class DatabaseBootstrap
{
    public function ensure(): void
    {
        if (! app()->environment('production')) {
            return;
        }

        if (Cache::get('schema_bootstrapped_at')) {
            return;
        }

        try {
            if (Schema::hasTable('users')) {
                Cache::put('schema_bootstrapped_at', now()->timestamp, now()->addMinutes(30));
                return;
            }
        } catch (Throwable) {
            return;
        }

        try {
            Artisan::call('migrate', [
                '--force' => true,
                '--no-interaction' => true,
            ]);

            if (Schema::hasTable('users')) {
                Cache::put('schema_bootstrapped_at', now()->timestamp, now()->addMinutes(30));
            }
        } catch (Throwable) {
            // Let the request continue; the middleware/controller will surface any remaining issue.
        }
    }
}
