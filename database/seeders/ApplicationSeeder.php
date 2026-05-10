<?php

namespace Database\Seeders;

use App\Enums\ApplicationStatus;
use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $demoSeeker = User::query()->where('email', 'seeker@example.com')->first();
        $amina = User::query()->where('email', 'seeker.amina@example.com')->first();
        $brian = User::query()->where('email', 'seeker.brian@example.com')->first();

        if (! $demoSeeker || ! $amina || ! $brian) {
            return;
        }

        $jobs = Job::query()->whereIn('title', [
            'Laravel Developer',
            'Product Designer',
            'HR Officer',
            'DevOps Intern',
            'Content Writer',
        ])->get()->keyBy('title');

        $applications = [
            [
                'job' => $jobs['Laravel Developer'] ?? null,
                'seeker' => $demoSeeker,
                'status' => ApplicationStatus::Pending,
                'cover_letter' => 'I would love to help build the recruitment platform and keep the backend clean, maintainable, and reliable.',
                'employer_notes' => null,
                'cv_path' => 'cvs/demo-seeker.pdf',
                'applied_date' => now()->subDays(6),
            ],
            [
                'job' => $jobs['Laravel Developer'] ?? null,
                'seeker' => $amina,
                'status' => ApplicationStatus::Shortlisted,
                'cover_letter' => 'My background in UI systems and React projects gives me a strong product mindset to complement the backend team.',
                'employer_notes' => 'Strong portfolio and great communication. Invite for technical interview.',
                'cv_path' => 'cvs/amina-okello.pdf',
                'applied_date' => now()->subDays(5),
            ],
            [
                'job' => $jobs['Product Designer'] ?? null,
                'seeker' => $brian,
                'status' => ApplicationStatus::Reviewed,
                'cover_letter' => 'I enjoy content strategy, layout systems, and writing clean reusable copy for digital products.',
                'employer_notes' => 'Good writing sample, but role needs more direct product design experience.',
                'cv_path' => 'cvs/brian-kato.pdf',
                'applied_date' => now()->subDays(4),
            ],
            [
                'job' => $jobs['HR Officer'] ?? null,
                'seeker' => $demoSeeker,
                'status' => ApplicationStatus::Rejected,
                'cover_letter' => 'I am eager to contribute to hiring coordination, records management, and candidate support.',
                'employer_notes' => 'Reapply for a more technical role later in the cycle.',
                'cv_path' => 'cvs/demo-seeker.pdf',
                'applied_date' => now()->subDays(2),
            ],
        ];

        foreach ($applications as $applicationData) {
            if (! $applicationData['job']) {
                continue;
            }

            Application::query()->updateOrCreate(
                [
                    'job_id' => $applicationData['job']->id,
                    'job_seeker_id' => $applicationData['seeker']->id,
                ],
                [
                    'cover_letter' => $applicationData['cover_letter'],
                    'cv_path' => $applicationData['cv_path'],
                    'status' => $applicationData['status'],
                    'applied_date' => $applicationData['applied_date'],
                    'employer_notes' => $applicationData['employer_notes'],
                ]
            );
        }
    }
}
