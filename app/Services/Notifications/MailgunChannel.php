<?php

namespace App\Services\Notifications;

use App\Models\IntegrationSetting;
use App\Models\Notification;
use App\Services\Notifications\Contracts\NotificationChannel;

class MailgunChannel implements NotificationChannel
{
    public function send(Notification $notification): bool
    {
        $setting = IntegrationSetting::query()->forChannel('email')->first();

        if (! $setting || ! $setting->enabled) {
            return false;
        }

        return filled($setting->api_key) && filled($setting->from_address);
    }
}
