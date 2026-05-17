<?php

namespace App\Models;

use App\Enums\DeliveryStatus;
use App\Enums\NotificationChannel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'subject',
        'title',
        'message',
        'is_read',
        'read_at',
        'sent_at',
        'delivery_status',
        'delivery_attempts',
        'last_attempt_at',
        'delivery_error',
        'action_url',
    ];

    protected function casts(): array
    {
        return [
            'type' => NotificationChannel::class,
            'is_read' => 'boolean',
            'read_at' => 'datetime',
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
