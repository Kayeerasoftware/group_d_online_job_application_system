<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ApplicationsController extends Controller
{
    public function index(Request $request): View
    {
        $query = Application::where('job_seeker_id', $request->user()->id)
            ->with('job.employer');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $applications = $query->latest()->paginate(20);

        $stats = [
            'total' => Application::where('job_seeker_id', $request->user()->id)->count(),
            'pending' => Application::where('job_seeker_id', $request->user()->id)->where('status', 'pending')->count(),
            'shortlisted' => Application::where('job_seeker_id', $request->user()->id)->where('status', 'shortlisted')->count(),
            'rejected' => Application::where('job_seeker_id', $request->user()->id)->where('status', 'rejected')->count(),
            'interview' => Application::where('job_seeker_id', $request->user()->id)->where('status', 'interview')->count(),
        ];

        return view('seeker.applications', [
            'applications' => $applications,
            'stats' => $stats,
        ]);
    }
}
