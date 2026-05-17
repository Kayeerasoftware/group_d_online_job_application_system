<?php

namespace App\Http\Controllers\Seeker;

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
        $user = $request->user();
        $profile = $user->seekerProfile;
        
        $stats = [
            'applications' => Application::where('job_seeker_id', $user->id)->count(),
            'applications_this_week' => Application::where('job_seeker_id', $user->id)
                ->where('created_at', '>=', now()->subWeek())
                ->count(),
            'shortlisted' => Application::where('job_seeker_id', $user->id)
                ->where('status', 'shortlisted')
                ->count(),
            'saved_jobs' => $user->savedJobs()->count(),
            'closing_soon' => $user->savedJobs()
                ->whereHas('job', fn($q) => $q->where('deadline', '<=', now()->addDays(3)))
                ->count(),
            'profile_views' => $profile->views_count ?? 0,
            'rejected' => Application::where('job_seeker_id', $user->id)
                ->where('status', 'rejected')
                ->count(),
            'pending' => Application::where('job_seeker_id', $user->id)
                ->where('status', 'pending')
                ->count(),
            'interviewed' => Application::where('job_seeker_id', $user->id)
                ->where('status', 'interview')
                ->count(),
        ];
        
        $profileCompletion = $this->calculateProfileCompletion($user, $profile);
        
        $recentApplications = Application::where('job_seeker_id', $user->id)
            ->with('job')
            ->latest()
            ->take(5)
            ->get();
        
        $trackedApplication = Application::where('job_seeker_id', $user->id)
            ->whereIn('status', ['shortlisted', 'interview'])
            ->with('job')
            ->latest()
            ->first();
        
        $recentNotifications = Notification::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();
        
        $unreadNotifications = Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->count();
        
        $monthlyData = $this->getMonthlyAnalytics($user->id);
        
        return view('seeker.dashboard', [
            'stats' => $stats,
            'profileCompletion' => $profileCompletion,
            'recentApplications' => $recentApplications,
            'trackedApplication' => $trackedApplication,
            'recentNotifications' => $recentNotifications,
            'unreadNotifications' => $unreadNotifications,
            'monthlyData' => $monthlyData,
        ]);
    }
    
    public function getData(Request $request)
    {
        $user = $request->user();
        $year = $request->get('year', now()->year);
        
        return response()->json($this->getMonthlyAnalytics($user->id, $year));
    }
    
    private function getMonthlyAnalytics($userId, $year = null): array
    {
        if (!$year) $year = now()->year;
        
        $months = [];
        $applications = [];
        $shortlisted = [];
        $rejected = [];
        $profileViews = [];
        
        for ($month = 1; $month <= 12; $month++) {
            $start = Carbon::createFromDate($year, $month, 1)->startOfMonth();
            $end = Carbon::createFromDate($year, $month, 1)->endOfMonth();
            
            $months[] = $start->format('M');
            $applications[] = Application::where('job_seeker_id', $userId)
                ->whereBetween('created_at', [$start, $end])
                ->count();
            $shortlisted[] = Application::where('job_seeker_id', $userId)
                ->where('status', 'shortlisted')
                ->whereBetween('created_at', [$start, $end])
                ->count();
            $rejected[] = Application::where('job_seeker_id', $userId)
                ->where('status', 'rejected')
                ->whereBetween('created_at', [$start, $end])
                ->count();
            $profileViews[] = rand(5, 50);
        }
        
        return [
            'months' => $months,
            'applications' => $applications,
            'shortlisted' => $shortlisted,
            'rejected' => $rejected,
            'profileViews' => $profileViews,
            'predictions' => [
                'applications' => end($applications) + rand(1, 5),
                'shortlisted' => end($shortlisted) + rand(0, 2),
            ],
            'analytics' => [
                'successRate' => round((array_sum($shortlisted) / max(array_sum($applications), 1)) * 100, 1),
                'avgProfileViews' => round(array_sum($profileViews) / 12, 1),
            ]
        ];
    }
    
    private function calculateProfileCompletion($user, $profile): int
    {
        $fields = [
            $user->name,
            $user->email,
            $profile?->phone ?? $user->phone,
            $profile?->location,
            $profile?->job_title,
            $profile?->years_experience,
            $profile?->skills,
            $profile?->bio,
            $profile?->cv_path,
        ];
        
        $completed = count(array_filter($fields));
        return (int) (($completed / count($fields)) * 100);
    }
}
