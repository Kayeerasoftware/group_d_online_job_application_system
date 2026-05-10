<?php

namespace App\Services\Notifications;

use App\Enums\DeliveryStatus;
use App\Enums\NotificationChannel;
use App\Models\IntegrationSetting;
use App\Models\Notification;
use App\Services\Notifications\Contracts\NotificationChannel as NotificationChannelContract;

class NotificationDispatcher
{
    public function dispatch(Notification $notification): bool
    {
        $channel = $this->resolveChannel($notification);
        $attempts = 3;
        $lastError = null;

        for ($attempt = 1; $attempt <= $attempts; $attempt++) {
            $notification->forceFill([
                'delivery_attempts' => $attempt,
                'last_attempt_at' => now(),
                'delivery_status' => DeliveryStatus::Pending,
            ])->save();

            if ($channel->send($notification)) {
                $notification->forceFill([
                    'delivery_status' => DeliveryStatus::Sent,
                    'sent_at' => now(),
                    'delivery_error' => null,
                ])->save();

                return true;
            }

            $lastError = "Delivery attempt {$attempt} failed for {$notification->type->value} notification.";
        }

        $notification->forceFill([
            'delivery_status' => DeliveryStatus::Failed,
            'delivery_error' => $lastError,
        ])->save();

        return false;
    }

    private function resolveChannel(Notification $notification): NotificationChannelContract
    {
        $type = $notification->type instanceof NotificationChannel
            ? $notification->type
            : NotificationChannel::tryFrom((string) $notification->type) ?? NotificationChannel::App;

        return match ($type) {
            NotificationChannel::Sms => new SmsChannel(),
            NotificationChannel::Email => new MailgunChannel(),
            NotificationChannel::App => new class implements Contracts\NotificationChannel {
                public function send(Notification $notification): bool
                {
                    return true;
                }
            },
        };
    }
}
