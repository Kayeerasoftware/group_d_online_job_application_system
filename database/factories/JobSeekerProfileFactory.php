<?php

namespace Database\Factories;

use App\Models\JobSeekerProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<JobSeekerProfile>
 */
class JobSeekerProfileFactory extends Factory
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
            'date_of_birth' => fake()->date(),
            'gender' => fake()->randomElement(['male', 'female', 'other']),
            'location' => fake()->city(),
            'education_level' => fake()->randomElement(['certificate', 'diploma', 'degree', 'masters']),
            'years_experience' => fake()->numberBetween(0, 15),
            'resume_path' => 'resumes/demo-resume.pdf',
            'skills' => ['Laravel', 'PHP', 'Blade'],
            'notification_preferences' => ['email' => true, 'sms' => false],
        ];
    }
}
