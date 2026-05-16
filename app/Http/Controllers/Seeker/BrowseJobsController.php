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
        $query = Job::where('status', 'open')->with('employer');

        if ($request->search) {
            $query->search($request->search);
        }

        if ($request->location) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        if ($request->job_type) {
            $query->where('job_type', $request->job_type);
        }

        if ($request->salary_min) {
            $query->where('salary_min', '>=', $request->salary_min);
        }

        if ($request->salary_max) {
            $query->where('salary_max', '<=', $request->salary_max);
        }

        $jobs = $query->latest()->paginate(15);

        $savedJobIds = SavedJob::where('job_seeker_id', $request->user()->id)
            ->pluck('job_id')
            ->toArray();

        $appliedJobIds = $request->user()->applications()
            ->pluck('job_id')
            ->toArray();

        return view('jobseeker.browse-jobs', [
            'jobs' => $jobs,
            'savedJobIds' => $savedJobIds,
            'appliedJobIds' => $appliedJobIds,
        ]);
    }
}
