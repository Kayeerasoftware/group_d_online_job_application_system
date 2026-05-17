<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BrowseJobsController extends Controller
{
    public function index(Request $request): View
    {
        $jobs = Job::query()
            ->when($request->search, fn($q) => $q->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%'))
            ->when($request->location, fn($q) => $q->where('location', 'like', '%' . $request->location . '%'))
            ->when($request->category, fn($q) => $q->where('category', $request->category))
            ->when($request->job_type, fn($q) => $q->where('job_type', $request->job_type))
            ->when($request->sort === 'salary_high', fn($q) => $q->orderByDesc('salary_max'))
            ->when($request->sort === 'salary_low', fn($q) => $q->orderBy('salary_min'))
            ->when(!$request->sort || $request->sort === 'newest', fn($q) => $q->latest())
            ->paginate(12);

        $totalJobs = Job::count();
        $remoteJobs = Job::where('location', 'like', '%remote%')->count();
        $newJobs = Job::where('created_at', '>=', now()->subDays(7))->count();

        return view('employer.browse-jobs', [
            'jobs' => $jobs,
            'totalJobs' => $totalJobs,
            'remoteJobs' => $remoteJobs,
            'newJobs' => $newJobs,
        ]);
    }
}
