<?php

namespace App\Http\Controllers\Employer;

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
        $user = $request->user();
        
        $upcomingInterviews = Application::whereHas('job', fn($q) => $q->where('employer_id', $user->id))
            ->where('status', 'interview')
            ->where('scheduled_date', '>', now())
            ->with(['seeker', 'job', 'communications' => function($q) {
                $q->latest()->limit(1);
            }])
            ->orderBy('scheduled_date')
            ->get();

        $pastInterviews = Application::whereHas('job', fn($q) => $q->where('employer_id', $user->id))
            ->where('status', 'interview')
            ->where('scheduled_date', '<=', now())
            ->with(['seeker', 'job', 'communications' => function($q) {
                $q->latest()->limit(1);
            }])
            ->orderBy('scheduled_date', 'desc')
            ->get();

        $scheduledInterviews = $upcomingInterviews->count();
        $completedInterviews = $pastInterviews->count();
        $todayInterviews = Application::whereHas('job', fn($q) => $q->where('employer_id', $user->id))
            ->where('status', 'interview')
            ->whereDate('scheduled_date', now())
            ->count();
        $cancelledInterviews = 0;

        // Calculate success rate
        $selectedCandidates = $pastInterviews->where('interview_outcome', 'selected')->count();
        $successRate = $completedInterviews > 0 ? round(($selectedCandidates / $completedInterviews) * 100) : 0;

        // Average interview duration (in minutes)
        $avgDuration = 45;

        // Count unread messages
        $unreadMessages = Application::whereHas('job', fn($q) => $q->where('employer_id', $user->id))
            ->where('status', 'interview')
            ->withCount(['communications' => function($q) use ($user) {
                $q->where('receiver_id', $user->id)
                  ->whereNull('read_at');
            }])
            ->get()
            ->sum('communications_count');

        return view('employer.interviews', [
            'upcomingInterviews' => $upcomingInterviews,
            'pastInterviews' => $pastInterviews,
            'scheduledInterviews' => $scheduledInterviews,
            'completedInterviews' => $completedInterviews,
            'todayInterviews' => $todayInterviews,
            'cancelledInterviews' => $cancelledInterviews,
            'successRate' => $successRate,
            'avgDuration' => $avgDuration,
            'unreadMessages' => $unreadMessages,
        ]);
    }

    public function show(Request $request, Application $application): View
    {
        $user = $request->user();
        
        if ($application->job->employer_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        $communications = $application->communications()
            ->with(['sender', 'receiver'])
            ->orderBy('created_at')
            ->get();

        $seeker = $application->seeker;

        return view('employer.interview-detail', [
            'application' => $application,
            'communications' => $communications,
            'seeker' => $seeker,
        ]);
    }

    public function schedule(Request $request, Application $application): RedirectResponse
    {
        $user = $request->user();
        
        if ($application->job->employer_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'scheduled_date' => 'required|date|after:now',
            'interview_type' => 'required|in:phone,video,in-person',
            'interviewer_name' => 'required|string|max:255',
            'interview_link' => 'nullable|url',
            'employer_notes' => 'nullable|string|max:1000',
        ]);

        $application->update([
            'status' => 'interview',
            'scheduled_date' => $validated['scheduled_date'],
            'interview_type' => $validated['interview_type'],
            'interviewer_name' => $validated['interviewer_name'],
            'interview_link' => $validated['interview_link'],
            'employer_notes' => $validated['employer_notes'],
        ]);

        // Send notification to seeker
        InterviewCommunication::create([
            'application_id' => $application->id,
            'sender_id' => $user->id,
            'receiver_id' => $application->job_seeker_id,
            'message' => "Your interview has been scheduled for {$validated['scheduled_date']} as a {$validated['interview_type']} interview.",
            'message_type' => 'status_update',
            'metadata' => json_encode([
                'interview_type' => $validated['interview_type'],
                'scheduled_date' => $validated['scheduled_date'],
            ]),
        ]);

        return redirect()->back()->with('success', 'Interview scheduled successfully');
    }

    public function setOutcome(Request $request, Application $application): RedirectResponse
    {
        $user = $request->user();
        
        if ($application->job->employer_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'interview_outcome' => 'required|in:selected,rejected,pending',
            'feedback' => 'nullable|string|max:1000',
        ]);

        $application->update([
            'interview_outcome' => $validated['interview_outcome'],
            'feedback' => $validated['feedback'],
            'interview_completed_at' => now(),
        ]);

        // Send notification to seeker
        InterviewCommunication::create([
            'application_id' => $application->id,
            'sender_id' => $user->id,
            'receiver_id' => $application->job_seeker_id,
            'message' => "Your interview outcome: " . ucfirst($validated['interview_outcome']),
            'message_type' => 'status_update',
            'metadata' => json_encode([
                'outcome' => $validated['interview_outcome'],
            ]),
        ]);

        return redirect()->back()->with('success', 'Interview outcome saved successfully');
    }
}
