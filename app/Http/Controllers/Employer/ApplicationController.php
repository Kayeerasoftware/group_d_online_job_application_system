<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        
        $validated = $request->validate([
            'search' => 'nullable|string|max:255',
            'status' => 'nullable|in:pending,reviewed,shortlisted,interview,rejected,hired',
            'job_id' => 'nullable|integer|exists:jobs,id',
        ]);
        
        $query = Application::whereHas('job', fn($q) => $q->where('employer_id', $user->id))
            ->with(['seeker', 'job', 'seeker.seekerProfile']);
        
        if ($validated['search'] ?? null) {
            $query->whereHas('seeker', fn($q) => $q->where('name', 'like', '%' . $validated['search'] . '%'));
        }
        
        if ($validated['status'] ?? null) {
            $query->where('status', $validated['status']);
        }
        
        if ($validated['job_id'] ?? null) {
            $query->where('job_id', $validated['job_id']);
        }
        
        $applications = $query->latest()->paginate(15);
        $jobs = $user->jobs()->select('id', 'title')->get();
        
        $baseQuery = Application::whereHas('job', fn($q) => $q->where('employer_id', $user->id));
        
        return view('employer.applications', [
            'applications' => $applications,
            'jobs' => $jobs,
            'totalApplications' => $baseQuery->count(),
            'pendingApplications' => $baseQuery->where('status', 'pending')->count(),
            'shortlistedApplications' => $baseQuery->where('status', 'shortlisted')->count(),
            'rejectedApplications' => $baseQuery->where('status', 'rejected')->count(),
        ]);
    }

    public function show(Request $request, Application $application): View
    {
        $user = $request->user();
        
        if ($application->job->employer_id !== $user->id) {
            abort(403, 'Unauthorized');
        }
        
        return view('employer.applications-show', [
            'application' => $application->load(['seeker', 'job']),
        ]);
    }

    public function update(Request $request, Application $application): RedirectResponse
    {
        $user = $request->user();
        
        if ($application->job->employer_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,reviewed,shortlisted,interview,rejected,hired',
            'employer_notes' => 'nullable|string|max:1000',
        ]);

        $application->update($validated);

        return redirect()->back()->with('success', 'Application updated successfully');
    }
}
