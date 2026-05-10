<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
=======
use App\Enums\DeliveryStatus;
use App\Enums\NotificationChannel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
<<<<<<< HEAD
        'message',
        'is_read',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
=======
        'subject',
        'message',
        'is_read',
        'sent_at',
        'delivery_status',
        'delivery_attempts',
        'last_attempt_at',
        'delivery_error',
    ];

    protected function casts(): array
    {
        return [
            'type' => NotificationChannel::class,
            'is_read' => 'boolean',
            'sent_at' => 'datetime',
            'delivery_status' => DeliveryStatus::class,
            'delivery_attempts' => 'integer',
            'last_attempt_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
