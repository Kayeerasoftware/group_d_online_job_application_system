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
        $savedJobs = SavedJob::where('job_seeker_id', $request->user()->id)
            ->with('job.employer')
            ->latest()
            ->paginate(15);

        return view('jobseeker.saved-jobs', [
            'savedJobs' => $savedJobs,
        ]);
    }
}
