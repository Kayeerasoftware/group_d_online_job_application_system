<?php

namespace Database\Factories;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AuditLog>
 */
class AuditLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'admin_id' => \App\Models\User::factory(),
            'action' => 'suspend',
            'target_type' => 'User',
            'target_id' => fake()->numberBetween(1, 100),
            'old_values' => ['is_active' => true],
            'new_values' => ['is_active' => false],
            'ip_address' => fake()->ipv4(),
            'reason' => fake()->sentence(),
        ];
    }
}
