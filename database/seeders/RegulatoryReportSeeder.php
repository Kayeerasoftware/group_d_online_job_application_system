<?php

namespace Database\Seeders;

use App\Enums\ReportStatus;
use App\Models\RegulatoryReport;
use App\Models\User;
use Illuminate\Database\Seeder;

class RegulatoryReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::query()->where('email', 'admin@example.com')->first();

        if (! $admin) {
            return;
        }

        RegulatoryReport::query()->updateOrCreate(
            [
                'generated_by' => $admin->id,
                'report_type' => 'Platform Compliance Report',
            ],
            [
                'date_range_start' => now()->subMonth()->startOfMonth(),
                'date_range_end' => now()->subMonth()->endOfMonth(),
                'aggregated_data' => [
                    'users_reviewed' => 4,
                    'jobs_posted' => 5,
                    'applications_processed' => 4,
                    'notifications_sent' => 6,
                ],
                'status' => ReportStatus::Submitted,
                'notes' => 'Primary demo report showing monthly compliance activity.',
            ]
        );

        RegulatoryReport::query()->updateOrCreate(
            [
                'generated_by' => $admin->id,
                'report_type' => 'Hiring Activity Summary',
            ],
            [
                'date_range_start' => now()->subDays(14)->startOfWeek(),
                'date_range_end' => now()->subDays(1),
                'aggregated_data' => [
                    'open_roles' => 4,
                    'shortlisted_candidates' => 1,
                    'rejected_candidates' => 1,
                    'saved_jobs' => 5,
                ],
                'status' => ReportStatus::Draft,
                'notes' => 'Internal summary for dashboard demonstration.',
            ]
        );
    }
}
