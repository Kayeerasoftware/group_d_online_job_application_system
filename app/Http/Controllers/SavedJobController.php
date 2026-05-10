<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSavedJobRequest;
use App\Http\Requests\UpdateSavedJobRequest;
use App\Models\Job;
use App\Models\SavedJob;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SavedJobController extends Controller
{
    public function index(Request $request): View
    {
        $savedJobs = $request->user()
            ->savedJobs()
            ->with('job.employer.employerProfile')
            ->latest('saved_date')
            ->paginate(10);

        return view('saved-jobs.index', compact('savedJobs'));
    }

    public function create()
    {
        abort(404);
    }

    public function store(Request $request, Job $job): RedirectResponse
    {
        $request->user()->savedJobs()->firstOrCreate([
            'job_id' => $job->id,
        ], [
            'saved_date' => now(),
        ]);

        return back()->with('status', 'Job saved for later.');
    }

    public function show(SavedJob $savedJob)
    {
        abort(404);
    }

    public function edit(SavedJob $savedJob)
    {
        abort(404);
    }

    public function update(UpdateSavedJobRequest $request, SavedJob $savedJob)
    {
        abort(404);
    }

    public function destroy(Request $request, SavedJob $savedJob): RedirectResponse
    {
        abort_unless($savedJob->job_seeker_id === $request->user()->id, 403);

        $savedJob->delete();

        return back()->with('status', 'Saved job removed.');
    }
}
