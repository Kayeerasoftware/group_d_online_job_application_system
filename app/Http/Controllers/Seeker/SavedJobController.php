<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\SavedJob;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SavedJobController extends Controller
{
    public function index(Request $request): View
    {
        $savedJobs = SavedJob::where('job_seeker_id', $request->user()->id)
            ->with('job')
            ->latest()
            ->paginate(15);
        
        return view('seeker.saved-jobs', compact('savedJobs'));
    }
    
    public function store(Request $request, Job $job): RedirectResponse
    {
        $exists = SavedJob::where('job_seeker_id', $request->user()->id)
            ->where('job_id', $job->id)
            ->exists();
        
        if ($exists) {
            return back()->with('info', 'Job already saved!');
        }
        
        SavedJob::create([
            'job_seeker_id' => $request->user()->id,
            'job_id' => $job->id,
        ]);
        
        return back()->with('success', 'Job saved successfully!');
    }
    
    public function destroy(Request $request, SavedJob $savedJob): RedirectResponse
    {
        $this->authorize('delete', $savedJob);
        
        $savedJob->delete();
        
        return back()->with('success', 'Job removed from saved list!');
    }
}
