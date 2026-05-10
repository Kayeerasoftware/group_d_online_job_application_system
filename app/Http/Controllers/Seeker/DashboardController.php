<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        return view('dashboards.seeker', [
            'openJobs' => Job::query()->where('status', 'open')->count(),
            'applicationCount' => Application::query()->where('job_seeker_id', $request->user()->id)->count(),
            'savedJobCount' => $request->user()->savedJobs()->count(),
            'recentApplications' => Application::query()
                ->where('job_seeker_id', $request->user()->id)
                ->with('job')
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }
}
