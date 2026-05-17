<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $seekers = User::where('role', 'seeker')->limit(3)->get();

        if ($seekers->isEmpty()) {
            return;
        }

        $notifications = [
            [
                'type' => 'application_status',
                'title' => 'Application Status Update',
                'subject' => 'Your application has been reviewed',
                'message' => 'Your application for Laravel Developer has been shortlisted. Check your email for more details.',
                'action_url' => '/seeker/applications',
            ],
            [
                'type' => 'job_match',
                'title' => 'New Job Match',
                'subject' => 'Perfect job match found',
                'message' => 'A new Senior PHP Developer position matches your profile perfectly.',
                'action_url' => '/seeker/browse-jobs',
            ],
            [
                'type' => 'job_closing',
                'title' => 'Job Closing Soon',
                'subject' => 'Application deadline approaching',
                'message' => 'The DevOps Engineer position you saved closes in 2 days. Apply now!',
                'action_url' => '/seeker/saved-jobs',
            ],
            [
                'type' => 'system',
                'title' => 'System Notification',
                'subject' => 'Profile update reminder',
                'message' => 'Update your profile to improve job matching accuracy.',
                'action_url' => '/seeker/profile/edit',
            ],
            [
                'type' => 'application_status',
                'title' => 'Interview Scheduled',
                'subject' => 'Interview invitation',
                'message' => 'You have been invited for an interview. Check your messages for details.',
                'action_url' => '/seeker/interviews',
            ],
            [
                'type' => 'job_match',
                'title' => 'New Opportunity',
                'subject' => 'Matching job opportunity',
                'message' => 'A new Frontend Developer role is available and matches your skills.',
                'action_url' => '/seeker/browse-jobs',
            ],
        ];

        foreach ($seekers as $seeker) {
            foreach ($notifications as $index => $notificationData) {
                Notification::create([
                    'user_id' => $seeker->id,
                    'type' => $notificationData['type'],
                    'title' => $notificationData['title'],
                    'subject' => $notificationData['subject'],
                    'message' => $notificationData['message'],
                    'action_url' => $notificationData['action_url'],
                    'is_read' => $index % 2 === 0,
                    'read_at' => $index % 2 === 0 ? now()->subHours(random_int(1, 24)) : null,
                    'sent_at' => now()->subHours(random_int(1, 48)),
                    'delivery_status' => 'sent',
                ]);
            }
        }
    }
}
