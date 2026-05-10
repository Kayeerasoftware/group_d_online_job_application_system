<?php

<<<<<<< HEAD
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
=======
use Illuminate\Support\Facades\Artisan;

Artisan::command('app:ping', function (): void {
    $this->comment('Pong');
})->purpose('Check the application is wired correctly.');
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
