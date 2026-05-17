<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Job;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $userId = $request->user()->id;
        $user = $request->user();
        
        $jobs = Job::query()
            ->where('employer_id', $userId)
            ->withCount('applications')
            ->latest()
            ->take(10)
            ->get();

        $activeJobs = Job::where('employer_id', $userId)->where('status', 'open')->count();
        $closedJobs = Job::where('employer_id', $userId)->where('status', 'closed')->count();

        $applicationCount = Application::query()
            ->whereHas('job', fn ($builder) => $builder->where('employer_id', $userId))
            ->count();

        $totalViews = Job::query()
            ->where('employer_id', $userId)
            ->sum('views_count');

        $conversionRate = $totalViews > 0
            ? round(($applicationCount / $totalViews) * 100, 2)
            : 0;

        $shortlistedCount = Application::query()
            ->whereHas('job', fn ($builder) => $builder->where('employer_id', $userId))
            ->where('status', 'shortlisted')
            ->count();

        $rejectedCount = Application::query()
            ->whereHas('job', fn ($builder) => $builder->where('employer_id', $userId))
            ->where('status', 'rejected')
            ->count();

        $pendingCount = Application::query()
            ->whereHas('job', fn ($builder) => $builder->where('employer_id', $userId))
            ->where('status', 'pending')
            ->count();

        $recentApplications = Application::query()
            ->whereHas('job', fn ($builder) => $builder->where('employer_id', $userId))
            ->with(['seeker', 'job'])
            ->latest()
            ->take(10)
            ->get();

        $recentNotifications = Notification::query()
            ->where('user_id', $userId)
            ->latest()
            ->take(10)
            ->get();

        $stats = [
            'active_jobs' => $activeJobs,
            'closed_jobs' => $closedJobs,
            'jobs_this_month' => Job::where('employer_id', $userId)->whereMonth('created_at', now()->month)->count(),
            'total_applications' => $applicationCount,
            'pending_applications' => $pendingCount,
            'shortlisted' => $shortlistedCount,
            'rejected' => $rejectedCount,
            'total_views' => $totalViews,
            'conversion_rate' => $conversionRate,
        ];

        // Application status distribution
        $applicationStatusData = Application::query()
            ->whereHas('job', fn ($builder) => $builder->where('employer_id', $userId))
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Applications over last 7 days
        $applicationsLast7Days = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $count = Application::query()
                ->whereHas('job', fn ($builder) => $builder->where('employer_id', $userId))
                ->whereDate('created_at', $date)
                ->count();
            $applicationsLast7Days[now()->subDays($i)->format('M d')] = $count;
        }

        // Calculate profile completion percentage
        $profileCompletion = $this->calculateProfileCompletion($user);

        // Unread notifications count
        $unreadNotificationsCount = Notification::query()
            ->where('user_id', $userId)
            ->whereNull('read_at')
            ->count();

        return view('employer.dashboard', [
            'jobs' => $jobs,
            'jobCount' => $jobs->count(),
            'activeJobs' => $activeJobs,
            'closedJobs' => $closedJobs,
            'applicationCount' => $applicationCount,
            'totalViews' => $totalViews,
            'conversionRate' => $conversionRate,
            'shortlistedCount' => $shortlistedCount,
            'rejectedCount' => $rejectedCount,
            'pendingCount' => $pendingCount,
            'recentJobs' => $jobs,
            'recentApplications' => $recentApplications,
            'recentNotifications' => $recentNotifications,
            'stats' => $stats,
            'profileCompletion' => $profileCompletion,
            'applicationStatusData' => $applicationStatusData,
            'applicationsLast7Days' => $applicationsLast7Days,
            'unreadNotificationsCount' => $unreadNotificationsCount,
        ]);
    }

    /**
     * Calculate profile completion percentage based on employer profile data
     */
    private function calculateProfileCompletion($user): int
    {
        $completionPercentage = 0;
        $totalFields = 0;

        $profile = $user->employerProfile;

        if (!$profile) {
            return 0;
        }

        // Check basic user fields
        $totalFields += 2;
        if (!empty($user->name)) $completionPercentage += 1;
        if (!empty($user->email)) $completionPercentage += 1;

        // Check employer profile fields
        $profileFields = [
            'company_name',
            'company_description',
            'company_website',
            'industry',
            'company_logo',
            'tax_id',
        ];

        $totalFields += count($profileFields);

        foreach ($profileFields as $field) {
            if (!empty($profile->$field)) {
                $completionPercentage += 1;
            }
        }

        return $totalFields > 0 ? round(($completionPercentage / $totalFields) * 100) : 0;
    }
}
