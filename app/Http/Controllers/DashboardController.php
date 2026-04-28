<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobListing;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isEmployer()) {
            $jobs = JobListing::where('user_id', $user->id)->withCount('applications')->latest()->get();
            return view('dashboard.employer', compact('jobs'));
        }

        $applications = Application::where('user_id', $user->id)->with('job')->latest()->get();
        return view('dashboard.applicant', compact('applications'));
    }
}
