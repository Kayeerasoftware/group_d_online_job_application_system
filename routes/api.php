<?php

use Illuminate\Support\Facades\Route;

Route::prefix('webhooks')->group(function (): void {
    Route::post('/mail', fn () => response()->noContent())->name('webhooks.mail');
    Route::post('/sms', fn () => response()->noContent())->name('webhooks.sms');
});
