<?php

namespace App\Http\Controllers\Regulator;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\RegulatoryReport;
use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalUsers = User::count();
        $totalJobs = Job::count();
        $totalApplications = Application::count();
        $totalReports = RegulatoryReport::count();
        
        $recentAuditLogs = AuditLog::latest()->limit(10)->get();
        $pendingReports = RegulatoryReport::where('status', 'pending')->count();
        $submittedReports = RegulatoryReport::where('status', 'submitted')->count();
        
        $applicationsByStatus = Application::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->get();
        
        $jobsByStatus = Job::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->get();

        return view('regulator.dashboard', [
            'totalUsers' => $totalUsers,
            'totalJobs' => $totalJobs,
            'totalApplications' => $totalApplications,
            'totalReports' => $totalReports,
            'recentAuditLogs' => $recentAuditLogs,
            'pendingReports' => $pendingReports,
            'submittedReports' => $submittedReports,
            'applicationsByStatus' => $applicationsByStatus,
            'jobsByStatus' => $jobsByStatus,
        ]);
    }
}
