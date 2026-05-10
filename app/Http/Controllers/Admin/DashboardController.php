<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\AuditLog;
use App\Models\Job;
use App\Models\RegulatoryReport;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboards.admin', [
            'userCount' => User::count(),
            'jobCount' => Job::count(),
            'applicationCount' => Application::count(),
            'reportCount' => RegulatoryReport::count(),
            'pendingReports' => RegulatoryReport::where('status', 'draft')->count(),
            'flaggedJobs' => AuditLog::query()->where('action', 'flag_job')->count(),
        ]);
    }
}
