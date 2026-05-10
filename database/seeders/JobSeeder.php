<?php

namespace Database\Seeders;

use App\Enums\JobStatus;
use App\Enums\JobType;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $demoEmployer = User::query()->where('email', 'employer@example.com')->first();
        $techForge = User::query()->where('email', 'employer@techforge.co.ug')->first();

        if (! $demoEmployer || ! $techForge) {
            return;
        }

        $jobs = [
            [
                'employer_id' => $demoEmployer->id,
                'title' => 'Laravel Developer',
                'description' => 'Build and maintain the applicant and employer workflows inside the platform.',
                'requirements' => 'Laravel, PHP 8+, Blade, SQL, Git',
                'location' => 'Kampala',
                'salary_min' => 1200000,
                'salary_max' => 2500000,
                'job_type' => JobType::FullTime,
                'deadline' => now()->addDays(30),
                'status' => JobStatus::Open,
                'views_count' => 42,
            ],
            [
                'employer_id' => $demoEmployer->id,
                'title' => 'Product Designer',
                'description' => 'Create modern product screens and maintain a consistent design system.',
                'requirements' => 'Figma, UI systems, user flows, accessibility',
                'location' => 'Remote',
                'salary_min' => 900000,
                'salary_max' => 1800000,
                'job_type' => JobType::Contract,
                'deadline' => now()->addDays(24),
                'status' => JobStatus::Open,
                'views_count' => 28,
            ],
            [
                'employer_id' => $techForge->id,
                'title' => 'HR Officer',
                'description' => 'Handle candidate communication, onboarding coordination, and recruitment records.',
                'requirements' => 'HR management, communication, Microsoft Office',
                'location' => 'Jinja',
                'salary_min' => 1500000,
                'salary_max' => 2700000,
                'job_type' => JobType::FullTime,
                'deadline' => now()->addDays(18),
                'status' => JobStatus::Open,
                'views_count' => 19,
            ],
            [
                'employer_id' => $techForge->id,
                'title' => 'DevOps Intern',
                'description' => 'Support deployment automation, monitoring, and environment maintenance.',
                'requirements' => 'Linux basics, Git, Docker, cloud fundamentals',
                'location' => 'Hybrid',
                'salary_min' => 600000,
                'salary_max' => 1100000,
                'job_type' => JobType::Internship,
                'deadline' => now()->addDays(14),
                'status' => JobStatus::Open,
                'views_count' => 15,
            ],
            [
                'employer_id' => $demoEmployer->id,
                'title' => 'Content Writer',
                'description' => 'Draft recruitment and product content for the public site and campaigns.',
                'requirements' => 'Copywriting, SEO, editing, research',
                'location' => 'Remote',
                'salary_min' => 700000,
                'salary_max' => 1200000,
                'job_type' => JobType::PartTime,
                'deadline' => now()->subDays(3),
                'status' => JobStatus::Closed,
                'views_count' => 9,
            ],
        ];

        foreach ($jobs as $jobData) {
            Job::query()->updateOrCreate(
                [
                    'employer_id' => $jobData['employer_id'],
                    'title' => $jobData['title'],
                ],
                $jobData
            );
        }
    }
}
