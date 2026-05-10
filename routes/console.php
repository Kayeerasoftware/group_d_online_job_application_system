<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('app:ping', function (): void {
    $this->comment('Pong');
})->purpose('Check the application is wired correctly.');
