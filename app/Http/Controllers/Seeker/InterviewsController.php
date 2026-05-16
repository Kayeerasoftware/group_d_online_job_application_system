<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InterviewsController extends Controller
{
    public function index(Request $request): View
    {
        $interviews = Application::where('job_seeker_id', $request->user()->id)
            ->where('status', 'interview')
            ->with('job.employer')
            ->latest()
            ->paginate(20);

        $stats = [
            'total' => Application::where('job_seeker_id', $request->user()->id)->where('status', 'interview')->count(),
            'upcoming' => 0,
            'completed' => 0,
        ];

        return view('jobseeker.interviews', [
            'interviews' => $interviews,
            'stats' => $stats,
        ]);
    }
}
