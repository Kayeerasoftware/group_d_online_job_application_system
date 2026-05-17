<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\SavedJob;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BrowseJobsController extends Controller
{
    public function index(Request $request): View
    {
        $query = Job::where('status', 'open')
            ->with(['employer', 'employer.employerProfile'])
            ->withCount('applications');

        if ($request->search) {
            $query->search($request->search);
        }

        if ($request->location) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        if ($request->category) {
            $query->where('category', $request->category);
        }

        if ($request->job_type) {
            $query->where('job_type', $request->job_type);
        }

        if ($request->level) {
            $query->where('level', $request->level);
        }

        if ($request->work_arrangement) {
            $query->where('work_arrangement', $request->work_arrangement);
        }

        if ($request->sort === 'salary_high') {
            $query->orderByDesc('salary_max');
        } elseif ($request->sort === 'salary_low') {
            $query->orderBy('salary_min');
        } elseif ($request->sort === 'relevant') {
            $query->latest('views_count');
        } else {
            $query->latest();
        }

        $jobs = $query->paginate(12);

        $savedJobIds = auth()->check() ? SavedJob::where('job_seeker_id', auth()->id())
            ->pluck('job_id')
            ->toArray() : [];

        $appliedJobIds = auth()->check() ? auth()->user()->applications()
            ->pluck('job_id')
            ->toArray() : [];

        return view('seeker.browse-jobs', [
            'jobs' => $jobs,
            'savedJobIds' => $savedJobIds,
            'appliedJobIds' => $appliedJobIds,
        ]);
    }

    public function show(Request $request, Job $job): View
    {
        $job->increment('views_count');

        $saved = SavedJob::where('job_seeker_id', $request->user()->id)
            ->where('job_id', $job->id)
            ->exists();

        $applied = $request->user()->applications()
            ->where('job_id', $job->id)
            ->exists();

        $appliedJobIds = $request->user()->applications()
            ->pluck('job_id')
            ->toArray();

        return view('seeker.job-detail', compact('job', 'saved', 'applied', 'appliedJobIds'));
    }
}
