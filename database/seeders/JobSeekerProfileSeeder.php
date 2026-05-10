<?php

namespace Database\Seeders;

use App\Models\JobSeekerProfile;
use App\Models\User;
use Illuminate\Database\Seeder;

class JobSeekerProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeker = User::query()->where('email', 'seeker@example.com')->first();
        $amina = User::query()->where('email', 'seeker.amina@example.com')->first();
        $brian = User::query()->where('email', 'seeker.brian@example.com')->first();

        if ($seeker) {
            JobSeekerProfile::query()->updateOrCreate(
                ['user_id' => $seeker->id],
                [
                    'date_of_birth' => now()->subYears(25)->toDateString(),
                    'gender' => 'Male',
                    'location' => 'Kampala',
                    'education_level' => 'Bachelor of Information Systems',
                    'years_experience' => 3,
                    'resume_path' => 'cvs/demo-seeker.pdf',
                    'skills' => ['Laravel', 'PHP', 'Blade', 'MySQL'],
                    'notification_preferences' => ['email' => true, 'sms' => false, 'app' => true],
                ]
            );
        }

        if ($amina) {
            JobSeekerProfile::query()->updateOrCreate(
                ['user_id' => $amina->id],
                [
                    'date_of_birth' => now()->subYears(29)->toDateString(),
                    'gender' => 'Female',
                    'location' => 'Remote',
                    'education_level' => 'Diploma in Software Engineering',
                    'years_experience' => 5,
                    'resume_path' => 'cvs/amina-okello.pdf',
                    'skills' => ['UI Design', 'React', 'Tailwind', 'Project Coordination'],
                    'notification_preferences' => ['email' => true, 'sms' => true, 'app' => true],
                ]
            );
        }

        if ($brian) {
            JobSeekerProfile::query()->updateOrCreate(
                ['user_id' => $brian->id],
                [
                    'date_of_birth' => now()->subYears(23)->toDateString(),
                    'gender' => 'Male',
                    'location' => 'Wakiso',
                    'education_level' => 'Certificate in Computer Science',
                    'years_experience' => 2,
                    'resume_path' => 'cvs/brian-kato.pdf',
                    'skills' => ['Content Writing', 'SEO', 'Research', 'MS Office'],
                    'notification_preferences' => ['email' => true, 'sms' => false, 'app' => true],
                ]
            );
        }
    }
}
