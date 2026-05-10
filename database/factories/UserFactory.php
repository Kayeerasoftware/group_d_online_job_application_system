<?php

namespace Database\Factories;

<<<<<<< HEAD
=======
use App\Models\User;
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
<<<<<<< HEAD
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
=======
 * @extends Factory<User>
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
<<<<<<< HEAD
=======
            'phone' => fake()->phoneNumber(),
            'profile_picture' => null,
            'role' => 'seeker',
            'is_active' => true,
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
