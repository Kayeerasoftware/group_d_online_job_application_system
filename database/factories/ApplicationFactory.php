<?php

namespace Database\Factories;

use App\Models\Application;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_id' => \App\Models\Job::factory(),
            'job_seeker_id' => \App\Models\User::factory(),
            'cover_letter' => fake()->paragraphs(2, true),
            'cv_path' => 'cvs/demo-cv.pdf',
            'status' => 'pending',
            'applied_date' => now(),
            'employer_notes' => null,
        ];
    }
}
