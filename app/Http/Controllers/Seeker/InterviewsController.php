<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\InterviewCommunication;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InterviewsController extends Controller
{
    public function index(Request $request): View
    {
        $userId = $request->user()->id;

        $upcomingList = Application::where('job_seeker_id', $userId)
            ->where('status', 'interview')
            ->where('scheduled_date', '>', now())
            ->with(['job', 'communications' => function($q) {
                $q->latest()->limit(1);
            }])
            ->orderBy('scheduled_date')
            ->get();

        $pastList = Application::where('job_seeker_id', $userId)
            ->where('status', 'interview')
            ->where('scheduled_date', '<=', now())
            ->with(['job', 'communications' => function($q) {
                $q->latest()->limit(1);
            }])
            ->orderBy('scheduled_date', 'desc')
            ->get();

        $totalInterviews = $upcomingList->count() + $pastList->count();
        $upcomingInterviews = $upcomingList->count();
        $completedInterviews = $pastList->count();
        $pendingInterviews = Application::where('job_seeker_id', $userId)
            ->where('status', 'pending')
            ->count();

        // Calculate success rate from past interviews
        $successfulInterviews = $pastList->where('interview_outcome', 'selected')->count();
        $successRate = $completedInterviews > 0 ? round(($successfulInterviews / $completedInterviews) * 100) : 0;

        // Count unread messages
        $unreadMessages = Application::where('job_seeker_id', $userId)
            ->where('status', 'interview')
            ->withCount(['communications' => function($q) use ($userId) {
                $q->where('receiver_id', $userId)
                  ->whereNull('read_at');
            }])
            ->get()
            ->sum('communications_count');

        return view('seeker.interviews', [
            'totalInterviews' => $totalInterviews,
            'upcomingInterviews' => $upcomingInterviews,
            'completedInterviews' => $completedInterviews,
            'pendingInterviews' => $pendingInterviews,
            'successRate' => $successRate,
            'unreadMessages' => $unreadMessages,
            'upcomingList' => $upcomingList,
            'pastList' => $pastList,
        ]);
    }

    public function show(Request $request, Application $application): View
    {
        $userId = $request->user()->id;
        
        if ($application->job_seeker_id !== $userId) {
            abort(403, 'Unauthorized');
        }

        $communications = $application->communications()
            ->with(['sender', 'receiver'])
            ->orderBy('created_at')
            ->get();

        // Mark unread messages as read
        $communications->where('receiver_id', auth()->id())
            ->where('read_at', null)
            ->each(fn($msg) => $msg->markAsRead());

        $employer = $application->job->employer;

        return view('seeker.interview-detail', [
            'application' => $application,
            'communications' => $communications,
            'employer' => $employer,
        ]);
    }

    public function sendMessage(Request $request, Application $application): RedirectResponse
    {
        $userId = $request->user()->id;
        
        if ($application->job_seeker_id !== $userId) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        InterviewCommunication::create([
            'application_id' => $application->id,
            'sender_id' => $userId,
            'receiver_id' => $application->job->employer_id,
            'message' => $validated['message'],
            'message_type' => 'text',
        ]);

        return redirect()->back()->with('success', 'Message sent successfully');
    }
}
