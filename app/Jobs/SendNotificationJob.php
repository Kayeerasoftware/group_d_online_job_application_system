<?php

namespace App\Jobs;

use App\Models\Notification;
use App\Services\Notifications\NotificationDispatcher;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNotificationJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $tries = 3;

    public function backoff(): array
    {
        return [1, 5, 15];
    }

    public function __construct(public Notification $notification)
    {
    }

    public function handle(NotificationDispatcher $dispatcher): void
    {
        $dispatcher->dispatch($this->notification);
    }
}
