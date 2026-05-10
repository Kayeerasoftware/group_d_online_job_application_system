<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $jobs = Job::query()
            ->where('employer_id', $request->user()->id)
            ->withCount('applications')
            ->latest()
            ->take(5)
            ->get();

        $applicationCount = Application::query()
            ->whereHas('job', fn ($builder) => $builder->where('employer_id', $request->user()->id))
            ->count();

        $totalViews = Job::query()
            ->where('employer_id', $request->user()->id)
            ->sum('views_count');

        $conversionRate = $totalViews > 0
            ? round(($applicationCount / $totalViews) * 100, 2)
            : 0;

        return view('dashboards.employer', [
            'jobs' => $jobs,
            'jobCount' => $jobs->count(),
            'applicationCount' => $applicationCount,
            'totalViews' => $totalViews,
            'conversionRate' => $conversionRate,
            'shortlistedCount' => Application::query()
                ->whereHas('job', fn ($builder) => $builder->where('employer_id', $request->user()->id))
                ->where('status', 'shortlisted')
                ->count(),
        ]);
    }
}
