<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\Application;
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
        $this->authorize('view', $application);
        
        return view('seeker.application-detail', compact('application'));
    }
}
