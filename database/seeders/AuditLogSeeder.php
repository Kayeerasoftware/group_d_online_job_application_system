<?php

namespace Database\Seeders;

use App\Models\AuditLog;
use App\Models\Job;
use App\Models\RegulatoryReport;
use App\Models\User;
use Illuminate\Database\Seeder;

class AuditLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::query()->where('email', 'admin@example.com')->first();
        $demoEmployer = User::query()->where('email', 'employer@example.com')->first();
        $demoSeeker = User::query()->where('email', 'seeker@example.com')->first();
        $report = RegulatoryReport::query()->where('report_type', 'Platform Compliance Report')->first();
        $job = Job::query()->where('title', 'Content Writer')->first();

        if (! $admin) {
            return;
        }

        $logs = [
            [
                'action' => 'verify-employer',
                'target_type' => 'EmployerProfile',
                'target_id' => $demoEmployer?->employerProfile?->id,
                'old_values' => ['verified_by_admin' => false],
                'new_values' => ['verified_by_admin' => true],
                'reason' => 'Employer profile verified during onboarding review.',
            ],
            [
                'action' => 'suspend-user',
                'target_type' => 'User',
                'target_id' => $demoSeeker?->id,
                'old_values' => ['is_active' => true],
                'new_values' => ['is_active' => true],
                'reason' => 'Demo audit entry showing user review activity.',
            ],
            [
                'action' => 'close-job',
                'target_type' => 'Job',
                'target_id' => $job?->id,
                'old_values' => ['status' => 'open'],
                'new_values' => ['status' => 'closed'],
                'reason' => 'Role closed after hiring window elapsed.',
            ],
            [
                'action' => 'submit-report',
                'target_type' => 'RegulatoryReport',
                'target_id' => $report?->id,
                'old_values' => ['status' => 'draft'],
                'new_values' => ['status' => 'submitted'],
                'reason' => 'Monthly compliance report submitted to the review queue.',
            ],
        ];

        foreach ($logs as $logData) {
            if (! $logData['target_id']) {
                continue;
            }

            AuditLog::query()->updateOrCreate(
                [
                    'admin_id' => $admin->id,
                    'action' => $logData['action'],
                    'target_type' => $logData['target_type'],
                    'target_id' => $logData['target_id'],
                ],
                [
                    'old_values' => $logData['old_values'],
                    'new_values' => $logData['new_values'],
                    'ip_address' => '127.0.0.1',
                    'reason' => $logData['reason'],
                ]
            );
        }
    }
}
