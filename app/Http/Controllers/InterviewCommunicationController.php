<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\InterviewCommunication;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class InterviewCommunicationController extends Controller
{
    public function show(Application $application): View
    {
        $this->authorize('view', $application);

        $communications = $application->communications()
            ->with(['sender', 'receiver'])
            ->orderBy('created_at')
            ->get();

        // Mark unread messages as read
        $communications->where('receiver_id', auth()->id())
            ->where('read_at', null)
            ->each(fn($msg) => $msg->markAsRead());

        $employer = $application->job->employer;
        $seeker = $application->seeker;

        return view('interviews.communication', [
            'application' => $application,
            'communications' => $communications,
            'employer' => $employer,
            'seeker' => $seeker,
        ]);
    }

    public function store(Request $request, Application $application): JsonResponse
    {
        $this->authorize('update', $application);

        $validated = $request->validate([
            'message' => 'required|string|max:1000',
            'message_type' => 'required|in:text,reschedule_request,status_update,feedback',
            'metadata' => 'nullable|array',
        ]);

        $receiver_id = auth()->id() === $application->job->employer_id
            ? $application->job_seeker_id
            : $application->job->employer_id;

        $communication = InterviewCommunication::create([
            'application_id' => $application->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $receiver_id,
            'message' => $validated['message'],
            'message_type' => $validated['message_type'],
            'metadata' => $validated['metadata'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'communication' => $communication->load(['sender', 'receiver']),
        ]);
    }

    public function rescheduleRequest(Request $request, Application $application): JsonResponse
    {
        $this->authorize('update', $application);

        $validated = $request->validate([
            'proposed_date' => 'required|date|after:now',
            'reason' => 'required|string|max:500',
        ]);

        $receiver_id = auth()->id() === $application->job->employer_id
            ? $application->job_seeker_id
            : $application->job->employer_id;

        $communication = InterviewCommunication::create([
            'application_id' => $application->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $receiver_id,
            'message' => $validated['reason'],
            'message_type' => 'reschedule_request',
            'metadata' => [
                'proposed_date' => $validated['proposed_date'],
                'status' => 'pending',
            ],
        ]);

        return response()->json([
            'success' => true,
            'communication' => $communication,
        ]);
    }

    public function approveReschedule(Request $request, InterviewCommunication $communication): JsonResponse
    {
        $application = $communication->application;
        $this->authorize('update', $application);

        if ($communication->message_type !== 'reschedule_request') {
            return response()->json(['error' => 'Invalid communication type'], 400);
        }

        $application->update([
            'scheduled_date' => $communication->metadata['proposed_date'],
        ]);

        $communication->update([
            'metadata' => array_merge($communication->metadata, ['status' => 'approved']),
        ]);

        InterviewCommunication::create([
            'application_id' => $application->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $communication->sender_id,
            'message' => 'Interview reschedule has been approved',
            'message_type' => 'status_update',
            'metadata' => ['action' => 'reschedule_approved'],
        ]);

        return response()->json(['success' => true]);
    }

    public function rejectReschedule(Request $request, InterviewCommunication $communication): JsonResponse
    {
        $application = $communication->application;
        $this->authorize('update', $application);

        if ($communication->message_type !== 'reschedule_request') {
            return response()->json(['error' => 'Invalid communication type'], 400);
        }

        $communication->update([
            'metadata' => array_merge($communication->metadata, ['status' => 'rejected']),
        ]);

        InterviewCommunication::create([
            'application_id' => $application->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $communication->sender_id,
            'message' => 'Interview reschedule has been rejected',
            'message_type' => 'status_update',
            'metadata' => ['action' => 'reschedule_rejected'],
        ]);

        return response()->json(['success' => true]);
    }

    public function submitFeedback(Request $request, Application $application): JsonResponse
    {
        $this->authorize('update', $application);

        $validated = $request->validate([
            'feedback' => 'required|string|max:1000',
            'interview_outcome' => 'required|in:selected,rejected,pending',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $application->update([
            'feedback' => $validated['feedback'],
            'interview_outcome' => $validated['interview_outcome'],
            'interview_completed_at' => now(),
        ]);

        $receiver_id = auth()->id() === $application->job->employer_id
            ? $application->job_seeker_id
            : $application->job->employer_id;

        $communication = InterviewCommunication::create([
            'application_id' => $application->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $receiver_id,
            'message' => $validated['feedback'],
            'message_type' => 'feedback',
            'metadata' => [
                'outcome' => $validated['interview_outcome'],
                'rating' => $validated['rating'] ?? null,
            ],
        ]);

        return response()->json([
            'success' => true,
            'communication' => $communication,
        ]);
    }
}
