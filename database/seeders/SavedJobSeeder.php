<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\SavedJob;
use App\Models\User;
use Illuminate\Database\Seeder;

class SavedJobSeeder extends Seeder
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
            'DevOps Intern',
            'Content Writer',
            'HR Officer',
        ])->get()->keyBy('title');

        $savedJobs = [
            [$demoSeeker, 'Product Designer'],
            [$demoSeeker, 'DevOps Intern'],
            [$amina, 'Laravel Developer'],
            [$amina, 'HR Officer'],
            [$brian, 'Content Writer'],
        ];

        foreach ($savedJobs as [$seeker, $title]) {
            if (! isset($jobs[$title])) {
                continue;
            }

            SavedJob::query()->updateOrCreate(
                [
                    'job_seeker_id' => $seeker->id,
                    'job_id' => $jobs[$title]->id,
                ],
                [
                    'saved_date' => now()->subDays(random_int(1, 10)),
                ]
            );
        }
    }
}
