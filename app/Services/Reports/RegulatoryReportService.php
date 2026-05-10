<?php

namespace App\Services\Reports;

use App\Models\Application;
use App\Models\Job;
use App\Models\RegulatoryReport;
use Illuminate\Support\Carbon;

class RegulatoryReportService
{
    public function generate(RegulatoryReport $report): array
    {
        $start = Carbon::parse($report->date_range_start)->startOfDay();
        $end = Carbon::parse($report->date_range_end)->endOfDay();

        $jobs = Job::query()
            ->whereBetween('created_at', [$start, $end])
            ->get();

        $applications = Application::query()
            ->whereBetween('created_at', [$start, $end])
            ->get();

        $averageSalaryMin = (float) ($jobs->avg('salary_min') ?? 0);
        $averageSalaryMax = (float) ($jobs->avg('salary_max') ?? 0);
        $conversionRate = $applications->count() > 0
            ? round(($applications->where('status', 'hired')->count() / $applications->count()) * 100, 2)
            : 0.0;

        return [
            'report_type' => $report->report_type,
            'total_jobs_posted' => $jobs->count(),
            'total_applications' => $applications->count(),
            'average_salary_min' => round($averageSalaryMin, 2),
            'average_salary_max' => round($averageSalaryMax, 2),
            'jobs_by_type' => $jobs->groupBy('job_type')->map->count(),
            'applications_by_status' => $applications->groupBy('status')->map->count(),
            'top_job_titles' => $jobs->pluck('title')->take(10)->values(),
            'application_to_hire_conversion_rate' => $conversionRate,
        ];
    }
}
