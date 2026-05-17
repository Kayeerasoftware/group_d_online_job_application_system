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

        $closingSoon = $allSavedJobs->filter(function($s) {
            $daysLeft = now()->diffInDays($s->job->deadline, false);
            return $daysLeft > 0 && $daysLeft <= 7;
        })->count();

        $activeJobs = $allSavedJobs->filter(function($s) {
            return now()->diffInDays($s->job->deadline, false) > 7;
        })->count();

        return view('seeker.saved-jobs', [
            'savedJobs' => $savedJobs,
            'closingSoon' => $closingSoon,
            'activeJobs' => $activeJobs,
        ]);
    }
}
