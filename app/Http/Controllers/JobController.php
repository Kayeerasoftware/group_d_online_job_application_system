<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobListing;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = JobListing::with('employer')->latest();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('company_name', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('job_type')) {
            $query->where('job_type', $request->job_type);
        }

        $jobs = $query->paginate(9)->withQueryString();
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        abort_unless(auth()->user()->isEmployer(), 403, 'Only employers can post jobs.');
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        abort_unless(auth()->user()->isEmployer(), 403);

        $validated = $request->validate([
            'title'        => 'required|max:255',
            'description'  => 'required',
            'company_name' => 'required|max:255',
            'location'     => 'required|max:255',
            'salary'       => 'required|numeric|min:0',
            'job_type'     => 'required|in:full-time,part-time,contract,remote',
            'deadline'     => 'nullable|date|after:today',
        ]);

        JobListing::create($validated + ['user_id' => auth()->id()]);

        return redirect()->route('jobs.index')->with('success', 'Job posted successfully!');
    }

    public function show(JobListing $job)
    {
        $hasApplied = auth()->check()
            ? Application::where('job_id', $job->id)->where('user_id', auth()->id())->exists()
            : false;

        $job->load('employer');
        return view('jobs.show', compact('job', 'hasApplied'));
    }

    public function edit(JobListing $job)
    {
        $this->authorize('update', $job);
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, JobListing $job)
    {
        $this->authorize('update', $job);

        $validated = $request->validate([
            'title'        => 'required|max:255',
            'description'  => 'required',
            'company_name' => 'required|max:255',
            'location'     => 'required|max:255',
            'salary'       => 'required|numeric|min:0',
            'job_type'     => 'required|in:full-time,part-time,contract,remote',
            'deadline'     => 'nullable|date',
        ]);

        $job->update($validated);

        return redirect()->route('jobs.show', $job)->with('success', 'Job updated successfully!');
    }

    public function destroy(JobListing $job)
    {
        $this->authorize('delete', $job);
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully!');
    }

    public function apply(Request $request, JobListing $job)
    {
        abort_unless(auth()->user()->isApplicant(), 403, 'Only applicants can apply for jobs.');

        $alreadyApplied = Application::where('job_id', $job->id)->where('user_id', auth()->id())->exists();
        if ($alreadyApplied) {
            return back()->with('error', 'You have already applied for this job.');
        }

        $request->validate([
            'cv'           => 'required|file|mimes:pdf,doc,docx|max:2048',
            'cover_letter' => 'nullable|string|max:2000',
        ]);

        $cvPath = $request->file('cv')->store('cvs', 'public');

        Application::create([
            'job_id'       => $job->id,
            'user_id'      => auth()->id(),
            'cv_path'      => $cvPath,
            'cover_letter' => $request->cover_letter,
        ]);

        return redirect()->route('jobs.show', $job)->with('success', 'Application submitted successfully!');
    }

    public function applications(JobListing $job)
    {
        abort_unless(auth()->id() === $job->user_id, 403);
        $applications = $job->applications()->with('applicant')->latest()->paginate(15);
        return view('jobs.applications', compact('job', 'applications'));
    }
}
