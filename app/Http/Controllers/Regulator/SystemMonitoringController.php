<?php

namespace App\Http\Controllers\Regulator;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Job;
use App\Models\Application;
use Illuminate\View\View;

class SystemMonitoringController extends Controller
{
    public function index(): View
    {
        $userStats = [
            'total' => User::count(),
            'seekers' => User::where('role', 'seeker')->count(),
            'employers' => User::where('role', 'employer')->count(),
            'admins' => User::where('role', 'admin')->count(),
            'regulators' => User::where('role', 'regulator')->count(),
        ];

        $jobStats = [
            'total' => Job::count(),
            'active' => Job::where('status', 'active')->count(),
            'closed' => Job::where('status', 'closed')->count(),
            'draft' => Job::where('status', 'draft')->count(),
        ];

        $applicationStats = [
            'total' => Application::count(),
            'pending' => Application::where('status', 'pending')->count(),
            'accepted' => Application::where('status', 'accepted')->count(),
            'rejected' => Application::where('status', 'rejected')->count(),
        ];

        $recentUsers = User::latest()->limit(10)->get();
        $recentJobs = Job::latest()->limit(10)->get();

        return view('regulator.system-monitoring.index', [
            'userStats' => $userStats,
            'jobStats' => $jobStats,
            'applicationStats' => $applicationStats,
            'recentUsers' => $recentUsers,
            'recentJobs' => $recentJobs,
        ]);
    }
}
