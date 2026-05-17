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
        $totalJobs = Job::count();
        $openJobs = Job::query()->open()->count();
        $applications = Application::count();
        $pendingApplications = Application::query()->where('status', ApplicationStatus::Pending->value)->count();
        $employers = User::query()->where('role', UserRole::Employer->value)->count();
        $seekers = User::query()->where('role', UserRole::Seeker->value)->count();
        $admins = User::query()->where('role', UserRole::Admin->value)->count();
        $activeUsers = User::query()->where('is_active', true)->count();
        $savedJobs = SavedJob::count();
        $pendingReports = RegulatoryReport::query()->where('status', ReportStatus::Draft->value)->count();

        $monthWindows = collect(range(5, 0))->map(function (int $monthsAgo): CarbonImmutable {
            return CarbonImmutable::now()->subMonths($monthsAgo)->startOfMonth();
        });

        $jobMonthlySeries = $this->buildMonthlySeries(Job::class, $monthWindows);
        $applicationMonthlySeries = $this->buildMonthlySeries(Application::class, $monthWindows);
        $monthlyActivity = $this->buildMonthlyActivity($monthWindows, $jobMonthlySeries, $applicationMonthlySeries);

        $applicationBreakdown = $this->buildStatusBreakdown(
            ApplicationStatus::cases(),
            Application::query()->selectRaw('status, COUNT(*) as total')->groupBy('status')->pluck('total', 'status')->all(),
            [
                ApplicationStatus::Pending->value => '#6b7280',
                ApplicationStatus::Reviewed->value => '#1f8a62',
                ApplicationStatus::Shortlisted->value => '#0f766e',
                ApplicationStatus::Rejected->value => '#d97706',
                ApplicationStatus::Hired->value => '#2563eb',
            ],
            $applications
        );

        $jobTypeBreakdown = $this->buildStatusBreakdown(
            JobType::cases(),
            Job::query()->selectRaw('job_type, COUNT(*) as total')->groupBy('job_type')->pluck('total', 'job_type')->all(),
            [
                JobType::FullTime->value => '#1e6b4f',
                JobType::PartTime->value => '#0f766e',
                JobType::Contract->value => '#d97706',
                JobType::Internship->value => '#2563eb',
            ],
            $totalJobs
        );

        $jobStatusBreakdown = $this->buildStatusBreakdown(
            JobStatus::cases(),
            Job::query()->selectRaw('status, COUNT(*) as total')->groupBy('status')->pluck('total', 'status')->all(),
            [
                JobStatus::Open->value => '#1e6b4f',
                JobStatus::Closed->value => '#d97706',
            ],
            $totalJobs
        );

        $featuredJobs = Job::query()
            ->with('employer')
            ->open()
            ->latest()
            ->limit(4)
            ->get();

        if ($featuredJobs->isEmpty()) {
            $featuredJobs = Job::query()
                ->with('employer')
                ->latest()
                ->limit(4)
                ->get();
        }

        return view('welcome', [
            'overviewCards' => [
                [
                    'label' => 'Active jobs',
                    'value' => number_format($totalJobs),
                    'meta' => $openJobs > 0 ? number_format($openJobs) . ' currently open' : 'No active roles yet',
                ],
                [
                    'label' => 'Applications',
                    'value' => number_format($applications),
                    'meta' => $pendingApplications > 0 ? number_format($pendingApplications) . ' still pending' : 'All applications reviewed',
                ],
                [
                    'label' => 'Employers',
                    'value' => number_format($employers),
                    'meta' => number_format($admins) . ' admins supporting the platform',
                ],
                [
                    'label' => 'Job seekers',
                    'value' => number_format($seekers),
                    'meta' => number_format($activeUsers) . ' active accounts overall',
                ],
                [
                    'label' => 'Saved jobs',
                    'value' => number_format($savedJobs),
                    'meta' => 'Bookmarked opportunities across the platform',
                ],
            ],
            'heroStats' => [
                [
                    'value' => number_format($openJobs),
                    'label' => 'Open roles',
                ],
                [
                    'value' => number_format($applications),
                    'label' => 'Applications',
                ],
                [
                    'value' => number_format($employers),
                    'label' => 'Employers',
                ],
            ],
            'heroMetric' => [
                'value' => number_format($totalJobs),
                'label' => 'jobs tracked across the live database',
            ],
            'heroSnapshot' => [
                [
                    'title' => 'Verified employers',
                    'copy' => number_format($employers) . ' companies are registered and ready to post.',
                ],
                [
                    'title' => 'Fast applications',
                    'copy' => number_format($applications) . ' applications have already moved through the system.',
                ],
                [
                    'title' => 'Compliance status',
                    'copy' => number_format($pendingReports) . ' draft reports are waiting in the review queue.',
                ],
            ],
            'applicationBreakdown' => $applicationBreakdown,
            'applicationTotal' => $applications,
            'applicationRingStyle' => $this->buildRingStyle($applicationBreakdown),
            'jobTypeBreakdown' => $jobTypeBreakdown,
            'jobStatusBreakdown' => $jobStatusBreakdown,
            'monthlyActivity' => $monthlyActivity,
            'openJobs' => $openJobs,
            'employers' => $employers,
            'savedJobs' => $savedJobs,
            'featuredJobs' => $this->formatFeaturedJobs($featuredJobs),
        ]);
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
