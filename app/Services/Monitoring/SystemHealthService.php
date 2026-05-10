<?php

namespace App\Services\Monitoring;

use App\Enums\DeliveryStatus;
use App\Models\Application;
use App\Models\IntegrationSetting;
use App\Models\Job;
use App\Models\Notification;
use App\Models\RegulatoryReport;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SystemHealthService
{
    public function snapshot(): array
    {
        $databaseHealthy = true;

        try {
            DB::connection()->getPdo();
        } catch (\Throwable) {
            $databaseHealthy = false;
        }

        $logPath = storage_path('logs/laravel.log');
        $recentErrors = $this->extractRecentErrors($logPath);

        $healthyChecks = collect([
            $databaseHealthy,
            File::isWritable(storage_path('framework')),
            IntegrationSetting::query()->where('enabled', true)->exists(),
        ])->filter()->count();

        $uptimeEstimate = round(97.5 + ($healthyChecks * 0.8), 2);

        return [
            'uptime_estimate' => min($uptimeEstimate, 99.99),
            'database_healthy' => $databaseHealthy,
            'storage_healthy' => File::isWritable(storage_path('framework')),
            'email_configured' => IntegrationSetting::query()->forChannel('email')->where('enabled', true)->exists(),
            'sms_configured' => IntegrationSetting::query()->forChannel('sms')->where('enabled', true)->exists(),
            'recent_errors' => $recentErrors,
            'metrics' => [
                'users' => User::count(),
                'jobs' => Job::count(),
                'applications' => Application::count(),
                'open_jobs' => Job::query()->where('status', 'open')->count(),
                'active_users' => User::query()->where('is_active', true)->count(),
                'sent_notifications' => Notification::query()->where('delivery_status', DeliveryStatus::Sent)->count(),
                'pending_reports' => RegulatoryReport::query()->where('status', 'draft')->count(),
            ],
            'generated_at' => now(),
        ];
    }

    private function extractRecentErrors(string $logPath): array
    {
        if (! File::exists($logPath)) {
            return [];
        }

        $lines = collect(preg_split('/\r?\n/', File::get($logPath)) ?: []);

        return $lines
            ->filter(fn (string $line) => str_contains($line, '] ERROR') || str_contains($line, '] CRITICAL'))
            ->take(-10)
            ->values()
            ->all();
    }
}
