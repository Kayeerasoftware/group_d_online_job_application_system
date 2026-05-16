<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Job;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $profile = $user->jobSeekerProfile;
        
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
        
        return view('layouts.jobseeker', [
            'stats' => $stats,
            'profileCompletion' => $profileCompletion,
            'recentApplications' => $recentApplications,
            'trackedApplication' => $trackedApplication,
            'recentNotifications' => $recentNotifications,
            'unreadNotifications' => $unreadNotifications
        ]);
    }
    
    private function calculateProfileCompletion($user, $profile): int
    {
        $fields = [
            $user->name,
            $user->email,
            $profile?->phone,
            $profile?->location,
            $profile?->job_title,
            $profile?->experience_years,
            $profile?->skills,
            $profile?->bio,
            $profile?->cv_path,
        ];
        
        $completed = count(array_filter($fields));
        return (int) (($completed / count($fields)) * 100);
    }
}
