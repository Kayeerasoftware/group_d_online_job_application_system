<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = auth()->user()->applications()->with('job')->latest()->paginate(10);
        return view('applications.index', compact('applications'));
    }

    public function updateStatus(Request $request, Application $application)
    {
        // Only the employer who owns the job can update status
        abort_unless(auth()->id() === $application->job->user_id, 403);

        $request->validate(['status' => 'required|in:pending,reviewed,accepted,rejected']);
        $application->update(['status' => $request->status]);

        return back()->with('success', 'Application status updated.');
    }

    public function destroy(Application $application)
    {
        abort_unless(auth()->id() === $application->user_id, 403);
        $application->delete();
        return back()->with('success', 'Application withdrawn.');
    }
}
