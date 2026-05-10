<?php

namespace Database\Factories;

use App\Models\EmployerProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<EmployerProfile>
 */
class EmployerProfileFactory extends Factory
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
            'company_name' => fake()->company(),
            'company_description' => fake()->paragraphs(2, true),
            'company_website' => fake()->url(),
            'industry' => fake()->jobTitle(),
            'company_logo' => null,
            'tax_id' => fake()->bothify('TIN-######'),
            'verified_by_admin' => false,
            'verification_date' => null,
        ];
    }
}
