<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
<<<<<<< HEAD
    /**
     * Register any application services.
     */
=======
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
    public function register(): void
    {
        //
    }

<<<<<<< HEAD
    /**
     * Bootstrap any application services.
     */
=======
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
    public function boot(): void
    {
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
