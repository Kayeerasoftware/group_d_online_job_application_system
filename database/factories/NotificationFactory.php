<?php

namespace Database\Factories;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'type' => 'email',
            'subject' => fake()->sentence(),
            'message' => fake()->paragraph(),
            'is_read' => false,
            'sent_at' => now(),
            'delivery_status' => 'sent',
        ];
    }
}
