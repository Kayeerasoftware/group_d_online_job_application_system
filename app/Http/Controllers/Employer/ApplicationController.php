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
        
        $applications = Application::whereHas('job', fn($q) => $q->where('employer_id', $user->id))
            ->with(['seeker', 'job'])
            ->when($request->search, fn($q) => $q->whereHas('seeker', fn($sq) => $sq->where('name', 'like', '%' . $request->search . '%')))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->job_id, fn($q) => $q->where('job_id', $request->job_id))
            ->latest()
            ->paginate(15);

        $jobs = $user->jobs()->get();
        
        $totalApplications = Application::whereHas('job', fn($q) => $q->where('employer_id', $user->id))->count();
        $pendingApplications = Application::whereHas('job', fn($q) => $q->where('employer_id', $user->id))->where('status', 'pending')->count();
        $shortlistedApplications = Application::whereHas('job', fn($q) => $q->where('employer_id', $user->id))->where('status', 'shortlisted')->count();
        $rejectedApplications = Application::whereHas('job', fn($q) => $q->where('employer_id', $user->id))->where('status', 'rejected')->count();
        
        // Application status distribution for chart
        $applicationStatusData = Application::query()
            ->whereHas('job', fn ($builder) => $builder->where('employer_id', $user->id))
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        return view('employer.applications', [
            'applications' => $applications,
            'jobs' => $jobs,
            'totalApplications' => $totalApplications,
            'pendingApplications' => $pendingApplications,
            'shortlistedApplications' => $shortlistedApplications,
            'rejectedApplications' => $rejectedApplications,
            'applicationStatusData' => $applicationStatusData,
        ]);
    }

    public function show(Request $request, Application $application): View
    {
        $user = $request->user();
        
        // Check if the application belongs to one of the employer's jobs
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
        
        // Check if the application belongs to one of the employer's jobs
        if ($application->job->employer_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,reviewed,shortlisted,interview,rejected,hired',
            'employer_notes' => 'nullable|string|max:1000',
        ]);

        $application->update($validated);

        return redirect()->back()->with('success', 'Application status updated successfully');
    }
}
