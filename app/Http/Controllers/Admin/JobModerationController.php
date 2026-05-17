<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\AuditLog;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class JobModerationController extends Controller
{
    public function index(): View
    {
        $jobs = Job::with('employer')->latest()->paginate(15);
        $flaggedJobs = Job::where('is_flagged', true)->count();
        $totalJobs = Job::count();

        return view('admin.jobs.index', [
            'jobs' => $jobs,
            'flaggedJobs' => $flaggedJobs,
            'totalJobs' => $totalJobs,
        ]);
    }

    public function show(Job $job): View
    {
        return view('admin.jobs.show', ['job' => $job]);
    }

    public function flag(Job $job, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $job->update(['is_flagged' => true]);

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'flag_job',
            'model_type' => Job::class,
            'model_id' => $job->id,
            'description' => $validated['reason'],
        ]);

        return redirect()->back()->with('success', 'Job flagged successfully.');
    }

    public function unflag(Job $job): RedirectResponse
    {
        $job->update(['is_flagged' => false]);

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'unflag_job',
            'model_type' => Job::class,
            'model_id' => $job->id,
        ]);

        return redirect()->back()->with('success', 'Job unflagged successfully.');
    }

    public function approve(Job $job): RedirectResponse
    {
        $job->update(['status' => 'active']);

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'approve_job',
            'model_type' => Job::class,
            'model_id' => $job->id,
        ]);

        return redirect()->back()->with('success', 'Job approved successfully.');
    }

    public function reject(Job $job, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $job->update(['status' => 'rejected']);

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'reject_job',
            'model_type' => Job::class,
            'model_id' => $job->id,
            'description' => $validated['reason'],
        ]);

        return redirect()->back()->with('success', 'Job rejected successfully.');
    }

    public function delete(Job $job): RedirectResponse
    {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete_job',
            'model_type' => Job::class,
            'model_id' => $job->id,
        ]);

        $job->delete();

        return redirect()->route('admin.jobs.index')->with('success', 'Job deleted successfully.');
    }
}
