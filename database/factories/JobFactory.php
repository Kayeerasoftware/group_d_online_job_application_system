<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employer_id' => \App\Models\User::factory(),
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraphs(3, true),
            'requirements' => fake()->paragraphs(2, true),
            'location' => fake()->city(),
            'salary_min' => fake()->numberBetween(500, 2000),
            'salary_max' => fake()->numberBetween(2000, 10000),
            'job_type' => 'full-time',
            'deadline' => fake()->dateTimeBetween('now', '+30 days'),
            'status' => 'open',
        ];
    }
}
