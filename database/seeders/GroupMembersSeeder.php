<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class GroupMembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Group Members (from EXAM WEB REQUIREMENTS ENGINEERING DOCUMENT)
        $groupMembers = [
            ['name' => 'Okello Jude', 'email' => 'okello.jude@group.com', 'role' => 'seeker'],
            ['name' => 'Mwesigwa Derrick', 'email' => 'mwesigwa.derrick@group.com', 'role' => 'seeker'],
            ['name' => 'Nsubuga Derrick', 'email' => 'nsubuga.derrick@group.com', 'role' => 'seeker'],
            ['name' => 'Ssemanda Jude', 'email' => 'ssemanda.jude@group.com', 'role' => 'seeker'],
            ['name' => 'Mwesigwa Derrick', 'email' => 'mwesigwa.derrick2@group.com', 'role' => 'employer'],
        ];

        // Admin Users (Real Names)
        $admins = [
            ['name' => 'Dr. Sarah Nakamatte', 'email' => 'admin.sarah@system.com', 'role' => 'admin'],
            ['name' => 'Prof. James Kiggundu', 'email' => 'admin.james@system.com', 'role' => 'admin'],
        ];

        // Regulator Users (Real Names)
        $regulators = [
            ['name' => 'Hon. Margaret Namutebi', 'email' => 'regulator.margaret@system.com', 'role' => 'regulator'],
            ['name' => 'Dr. Peter Ochieng', 'email' => 'regulator.peter@system.com', 'role' => 'regulator'],
        ];

        // Additional Job Seekers (5 more)
        $additionalSeekers = [
            ['name' => 'Kamau David', 'email' => 'kamau.david@seekers.com', 'role' => 'seeker'],
            ['name' => 'Achieng Moses', 'email' => 'achieng.moses@seekers.com', 'role' => 'seeker'],
            ['name' => 'Kipchoge Samuel', 'email' => 'kipchoge.samuel@seekers.com', 'role' => 'seeker'],
            ['name' => 'Omondi Victor', 'email' => 'omondi.victor@seekers.com', 'role' => 'seeker'],
            ['name' => 'Kariuki Paul', 'email' => 'kariuki.paul@seekers.com', 'role' => 'seeker'],
        ];

        // Additional Employers (5 more)
        $additionalEmployers = [
            ['name' => 'Equity Bank Uganda', 'email' => 'hr@equitybank.co.ug', 'role' => 'employer'],
            ['name' => 'Stanbic Bank Uganda', 'email' => 'recruitment@stanbic.co.ug', 'role' => 'employer'],
            ['name' => 'MTN Uganda', 'email' => 'careers@mtn.co.ug', 'role' => 'employer'],
            ['name' => 'Airtel Uganda', 'email' => 'jobs@airtel.co.ug', 'role' => 'employer'],
            ['name' => 'Pearl Insurance', 'email' => 'hr@pearlinsurance.co.ug', 'role' => 'employer'],
        ];

        // Merge all users
        $allUsers = array_merge(
            $groupMembers,
            $admins,
            $regulators,
            $additionalSeekers,
            $additionalEmployers
        );

        // Create users
        foreach ($allUsers as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => bcrypt('password123'),
                    'role' => $userData['role'],
                    'email_verified_at' => now(),
                    'notifications_enabled' => true,
                    'job_recommendations' => true,
                    'application_updates' => true,
                    'message_notifications' => true,
                    'interview_reminders' => true,
                    'profile_visible' => true,
                    'show_email' => false,
                    'show_phone' => false,
                    'theme' => 'light',
                ]
            );
        }
    }
}
