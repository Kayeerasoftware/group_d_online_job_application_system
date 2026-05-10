<?php

namespace App\Services\Notifications\Contracts;

use App\Models\Notification;

interface NotificationChannel
{
    public function send(Notification $notification): bool;
}
