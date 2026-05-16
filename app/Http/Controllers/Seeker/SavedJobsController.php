<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\SavedJob;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SavedJobsController extends Controller
{
    public function index(Request $request): View
    {
        $userId = $request->user()->id;
        
        $savedJobs = SavedJob::where('job_seeker_id', $userId)
            ->with('job.employer')
            ->latest()
            ->paginate(15);

        $allSavedJobs = SavedJob::where('job_seeker_id', $userId)
            ->with('job')
            ->get();

        $metrics = [
            'fullTime' => $allSavedJobs->filter(fn($s) => $s->job->job_type === 'full-time')->count(),
            'partTime' => $allSavedJobs->filter(fn($s) => $s->job->job_type === 'part-time')->count(),
            'remote' => $allSavedJobs->filter(fn($s) => strtolower($s->job->location) === 'remote')->count(),
        ];

        return view('jobseeker.saved-jobs', [
            'savedJobs' => $savedJobs,
            'metrics' => $metrics,
        ]);
    }
}
