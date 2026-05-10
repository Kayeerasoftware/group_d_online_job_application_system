<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\EmployerProfile;
use Illuminate\Database\Seeder;

class EmployerProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employer = User::query()->where('email', 'employer@example.com')->first();
        $techForge = User::query()->where('email', 'employer@techforge.co.ug')->first();

        if ($employer) {
            EmployerProfile::query()->updateOrCreate(
                ['user_id' => $employer->id],
                [
                    'company_name' => 'Demo Employer Ltd',
                    'company_description' => 'A polished sample employer used for demos, hiring workflows, and presentation screens.',
                    'company_website' => 'https://demoemployer.example',
                    'industry' => 'Technology',
                    'tax_id' => 'TAX-DEMO-001',
                    'company_logo' => null,
                    'verified_by_admin' => true,
                    'verification_date' => now()->subDays(12),
                ]
            );
        }

        if ($techForge) {
            EmployerProfile::query()->updateOrCreate(
                ['user_id' => $techForge->id],
                [
                    'company_name' => 'TechForge Solutions',
                    'company_description' => 'Product engineering and digital transformation consultancy hiring across multiple technical disciplines.',
                    'company_website' => 'https://techforge.co.ug',
                    'industry' => 'Software Development',
                    'tax_id' => 'TAX-TECH-204',
                    'company_logo' => null,
                    'verified_by_admin' => true,
                    'verification_date' => now()->subDays(7),
                ]
            );
        }
    }
}
