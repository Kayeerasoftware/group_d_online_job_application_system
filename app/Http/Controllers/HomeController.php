<?php

namespace App\Http\Controllers;

use App\Enums\ApplicationStatus;
use App\Enums\JobStatus;
use App\Enums\JobType;
use App\Enums\ReportStatus;
use App\Enums\UserRole;
use App\Models\Application;
use App\Models\Job;
use App\Models\RegulatoryReport;
use App\Models\SavedJob;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // Get dashboard data for the welcome page
        $totalJobs = Job::count();
        $openJobs = Job::query()->open()->count();
        $applications = Application::count();
        $employers = User::query()->where('role', UserRole::Employer->value)->count();
        $seekers = User::query()->where('role', UserRole::Seeker->value)->count();
        $savedJobs = SavedJob::count();
        $activeUsers = User::query()->where('is_active', true)->count();
        $newJobsThisWeek = Job::query()->where('created_at', '>=', now()->subWeek())->count();

        // Get jobs for the grid/list view
        $jobs = Job::query()
            ->with(['employer.employerProfile'])
            ->latest()
            ->paginate(20);

        $savedJobIds = [];
        $appliedJobIds = [];

        if (auth()->check() && auth()->user()->isSeeker()) {
            $savedJobIds = SavedJob::query()
                ->where('user_id', auth()->id())
                ->pluck('job_id')
                ->toArray();

            $appliedJobIds = Application::query()
                ->where('user_id', auth()->id())
                ->pluck('job_id')
                ->toArray();
        }

        return view('welcome', compact(
            'totalJobs',
            'openJobs', 
            'applications',
            'employers',
            'seekers',
            'savedJobs',
            'activeUsers',
            'newJobsThisWeek',
            'jobs',
            'savedJobIds',
            'appliedJobIds'
        ));
    }

    public function landing(): View
    {
        // Get dashboard data for the landing page
        $totalJobs = Job::count();
        $openJobs = Job::query()->open()->count();
        $applications = Application::count();
        $employers = User::query()->where('role', UserRole::Employer->value)->count();
        $seekers = User::query()->where('role', UserRole::Seeker->value)->count();
        $savedJobs = SavedJob::count();
        $activeUsers = User::query()->where('is_active', true)->count();
        $newJobsThisWeek = Job::query()->where('created_at', '>=', now()->subWeek())->count();

        // Get jobs for the grid/list view
        $jobs = Job::query()
            ->with(['employer.employerProfile'])
            ->latest()
            ->paginate(20);

        $savedJobIds = [];
        $appliedJobIds = [];

        if (auth()->check() && auth()->user()->isSeeker()) {
            $savedJobIds = SavedJob::query()
                ->where('user_id', auth()->id())
                ->pluck('job_id')
                ->toArray();

            $appliedJobIds = Application::query()
                ->where('user_id', auth()->id())
                ->pluck('job_id')
                ->toArray();
        }

        return view('landing', compact(
            'totalJobs',
            'openJobs', 
            'applications',
            'employers',
            'seekers',
            'savedJobs',
            'activeUsers',
            'newJobsThisWeek',
            'jobs',
            'savedJobIds',
            'appliedJobIds'
        ));
    }

    /**
     * @param class-string $modelClass
     * @return array<int, array{key: string, label: string, value: int}>
     */
    private function buildMonthlySeries(string $modelClass, Collection $months): array
    {
        $start = $months->first();
        $end = $months->last()->endOfMonth();

        $records = $modelClass::query()
            ->whereBetween('created_at', [$start, $end])
            ->get(['created_at']);

        $counts = $records
            ->groupBy(fn ($record) => $record->created_at->format('Y-m'))
            ->map
            ->count();

        return $months->map(function (CarbonImmutable $month) use ($counts): array {
            $key = $month->format('Y-m');

            return [
                'key' => $key,
                'label' => $month->format('M'),
                'value' => (int) ($counts[$key] ?? 0),
            ];
        })->all();
    }

    /**
     * @param array<int, array{key: string, label: string, value: int}> $jobSeries
     * @param array<int, array{key: string, label: string, value: int}> $applicationSeries
     * @return array<int, array{label: string, jobs: int, applications: int, jobsPercent: int, applicationsPercent: int}>
     */
    private function buildMonthlyActivity(Collection $months, array $jobSeries, array $applicationSeries): array
    {
        $maxValue = max(
            collect($jobSeries)->pluck('value')->max() ?? 0,
            collect($applicationSeries)->pluck('value')->max() ?? 0,
            1
        );

        return $months->values()->map(function (CarbonImmutable $month, int $index) use ($jobSeries, $applicationSeries, $maxValue): array {
            $jobs = $jobSeries[$index]['value'] ?? 0;
            $applications = $applicationSeries[$index]['value'] ?? 0;

            return [
                'label' => $month->format('M'),
                'jobs' => $jobs,
                'applications' => $applications,
                'jobsPercent' => (int) round(($jobs / $maxValue) * 100),
                'applicationsPercent' => (int) round(($applications / $maxValue) * 100),
            ];
        })->all();
    }

    /**
     * @param array<string, int> $counts
     * @param array<string, string> $colors
     * @param array<int, \BackedEnum> $cases
     * @return array<int, array{value: int, label: string, percent: int, color: string}>
     */
    private function buildStatusBreakdown(array $cases, array $counts, array $colors, int $total): array
    {
        return collect($cases)->map(function ($case) use ($counts, $colors, $total): array {
            $value = (int) ($counts[$case->value] ?? 0);

            return [
                'value' => $value,
                'label' => Str::headline(str_replace('-', ' ', $case->value)),
                'percent' => $total > 0 ? (int) round(($value / $total) * 100) : 0,
                'color' => $colors[$case->value] ?? '#1e6b4f',
            ];
        })->all();
    }

    /**
     * @param array<int, array{value: int, color: string}> $segments
     */
    private function buildRingStyle(array $segments): string
    {
        $total = collect($segments)->sum('value');

        if ($total <= 0) {
            return 'background: conic-gradient(#e7e1d7 0deg 360deg);';
        }

        $cursor = 0.0;
        $stops = [];

        foreach ($segments as $segment) {
            $span = ($segment['value'] / $total) * 360;
            $start = number_format($cursor, 2, '.', '');
            $end = number_format($cursor + $span, 2, '.', '');
            $stops[] = "{$segment['color']} {$start}deg {$end}deg";
            $cursor += $span;
        }

        return 'background: conic-gradient(' . implode(', ', $stops) . ');';
    }

    /**
     * @return array<int, array{
     *     title: string,
     *     company: string,
     *     status: string,
     *     statusClass: string,
     *     summary: string,
     *     meta: array<int, string>,
     *     icon: string
     * }>
     */
    private function formatFeaturedJobs(Collection $jobs): array
    {
        return $jobs->map(function (Job $job): array {
            $salaryRange = $this->formatSalaryRange($job);

            return [
                'title' => $job->title,
                'company' => $job->employer?->name ?? 'Verified employer',
                'status' => Str::headline($job->statusValue()),
                'statusClass' => $job->isOpen() ? 'home-job-badge--green' : 'home-job-badge--amber',
                'summary' => Str::limit(strip_tags((string) $job->description), 145),
                'meta' => array_values(array_filter([
                    $job->location,
                    $job->job_type ? Str::headline($job->job_type->value) : null,
                    $salaryRange,
                    $job->deadline ? 'Deadline ' . $job->deadline->format('d M') : null,
                ])),
                'icon' => $this->resolveJobIcon($job),
            ];
        })->all();
    }

    private function formatSalaryRange(Job $job): ?string
    {
        if ($job->salary_min === null && $job->salary_max === null) {
            return null;
        }

        $format = static fn ($value): string => number_format((float) $value, 0, '.', ',');

        if ($job->salary_min !== null && $job->salary_max !== null) {
            return 'Salary ' . $format($job->salary_min) . ' - ' . $format($job->salary_max);
        }

        if ($job->salary_min !== null) {
            return 'From ' . $format($job->salary_min);
        }

        return 'Up to ' . $format($job->salary_max);
    }

    private function resolveJobIcon(Job $job): string
    {
        return match ($job->job_type?->value ?? $job->statusValue()) {
            JobType::PartTime->value => 'clock',
            JobType::Contract->value => 'document',
            JobType::Internship->value => 'spark',
            default => 'briefcase',
        };
    }
}
