<?php

namespace Database\Factories;

use App\Models\SavedJob;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SavedJob>
 */
class SavedJobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_seeker_id' => \App\Models\User::factory(),
            'job_id' => \App\Models\Job::factory(),
            'saved_date' => now(),
        ];
    }
}
