<?php

namespace Database\Seeders;

use App\Enums\DeliveryStatus;
use App\Enums\NotificationChannel;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $demoSeeker = User::query()->where('email', 'seeker@example.com')->first();
        $amina = User::query()->where('email', 'seeker.amina@example.com')->first();
        $brian = User::query()->where('email', 'seeker.brian@example.com')->first();
        $demoEmployer = User::query()->where('email', 'employer@example.com')->first();
        $techForge = User::query()->where('email', 'employer@techforge.co.ug')->first();
        $admin = User::query()->where('email', 'admin@example.com')->first();

        $targets = array_filter([$demoSeeker, $amina, $brian, $demoEmployer, $techForge, $admin]);

        if (count($targets) === 0) {
            return;
        }

        $notifications = [
            [
                'user' => $demoSeeker,
                'subject' => 'Welcome to the platform',
                'message' => 'Your seeker profile is ready. Browse jobs and start saving opportunities.',
                'type' => NotificationChannel::App,
                'delivery_status' => DeliveryStatus::Sent,
                'is_read' => false,
            ],
            [
                'user' => $demoSeeker,
                'subject' => 'Application shortlisted',
                'message' => 'Your application for Laravel Developer has moved to shortlist review.',
                'type' => NotificationChannel::Email,
                'delivery_status' => DeliveryStatus::Sent,
                'is_read' => false,
            ],
            [
                'user' => $amina,
                'subject' => 'New match found',
                'message' => 'A new DevOps Intern opening matches your profile and saved search behavior.',
                'type' => NotificationChannel::App,
                'delivery_status' => DeliveryStatus::Sent,
                'is_read' => true,
            ],
            [
                'user' => $brian,
                'subject' => 'Profile update reminder',
                'message' => 'Add more technical skills to your profile to improve matching accuracy.',
                'type' => NotificationChannel::Sms,
                'delivery_status' => DeliveryStatus::Pending,
                'is_read' => false,
            ],
            [
                'user' => $demoEmployer,
                'subject' => 'New application received',
                'message' => 'You have a fresh application for the Laravel Developer role.',
                'type' => NotificationChannel::Email,
                'delivery_status' => DeliveryStatus::Sent,
                'is_read' => false,
            ],
            [
                'user' => $admin,
                'subject' => 'Compliance check due',
                'message' => 'A new monthly compliance report is ready for review.',
                'type' => NotificationChannel::App,
                'delivery_status' => DeliveryStatus::Sent,
                'is_read' => false,
            ],
        ];

        foreach ($notifications as $notificationData) {
            if (! $notificationData['user']) {
                continue;
            }

            Notification::query()->updateOrCreate(
                [
                    'user_id' => $notificationData['user']->id,
                    'subject' => $notificationData['subject'],
                ],
                [
                    'type' => $notificationData['type'],
                    'message' => $notificationData['message'],
                    'is_read' => $notificationData['is_read'],
                    'sent_at' => now()->subHours(random_int(1, 48)),
                    'delivery_status' => $notificationData['delivery_status'],
                ]
            );
        }
    }
}
