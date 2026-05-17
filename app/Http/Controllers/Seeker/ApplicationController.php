<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function index(Request $request): View
    {
        $query = Application::where('job_seeker_id', $request->user()->id)
            ->with('job');
        
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        $applications = $query->latest()->paginate(15);
        
        $counts = [
            'all' => Application::where('job_seeker_id', $request->user()->id)->count(),
            'pending' => Application::where('job_seeker_id', $request->user()->id)->where('status', 'pending')->count(),
            'reviewed' => Application::where('job_seeker_id', $request->user()->id)->where('status', 'reviewed')->count(),
            'shortlisted' => Application::where('job_seeker_id', $request->user()->id)->where('status', 'shortlisted')->count(),
            'rejected' => Application::where('job_seeker_id', $request->user()->id)->where('status', 'rejected')->count(),
        ];
        
        return view('seeker.applications', compact('applications', 'counts'));
    }
    
    public function show(Request $request, Application $application): View
    {
        if ($application->job_seeker_id !== $request->user()->id) {
            abort(403, 'Unauthorized');
        }
        
        return view('seeker.application-detail', compact('application'));
    }

    public function create(Request $request): View
    {
        $jobId = $request->query('job_id');
        $job = $jobId ? Job::findOrFail($jobId) : null;
        
        $userProfile = $request->user()->seekerProfile;
        
        return view('seeker.applications-create', compact('job', 'userProfile'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'cover_letter' => 'required|string|max:2000',
            'cv_path' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $cvPath = null;
        if ($request->hasFile('cv_path') && $request->file('cv_path')->isValid()) {
            $file = $request->file('cv_path');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/cvs'), $filename);
            $cvPath = 'uploads/cvs/' . $filename;
        }

        $application = Application::create([
            'job_seeker_id' => $request->user()->id,
            'job_id' => $validated['job_id'],
            'cover_letter' => $validated['cover_letter'],
            'cv_path' => $cvPath,
            'status' => 'pending',
            'applied_date' => now(),
        ]);

        return redirect()->route('seeker.applications')
            ->with('success', 'Application submitted successfully!');
    }

    public function destroy(Request $request, Application $application)
    {
        if ($application->job_seeker_id !== $request->user()->id) {
            abort(403, 'Unauthorized');
        }

        $application->delete();

        return redirect()->route('seeker.applications')
            ->with('success', 'Application deleted successfully!');
    }
}
