<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        
        $notifications = Notification::where('user_id', $user->id)
            ->when($request->type, fn($q) => $q->where('type', $request->type))
            ->latest()
            ->paginate(20);

        $totalNotifications = Notification::where('user_id', $user->id)->count();
        
        $unreadNotifications = Notification::where('user_id', $user->id)
            ->whereNull('read_at')
            ->count();

        $applicationNotifications = Notification::where('user_id', $user->id)
            ->where('type', 'application_status')
            ->count();

        $jobMatchNotifications = Notification::where('user_id', $user->id)
            ->where('type', 'job_match')
            ->count();

        $interviewNotifications = Notification::where('user_id', $user->id)
            ->where('type', 'interview')
            ->count();

        $messageNotifications = Notification::where('user_id', $user->id)
            ->where('type', 'message')
            ->count();

        // Notification type distribution for chart
        $notificationTypeData = Notification::query()
            ->where('user_id', $user->id)
            ->selectRaw('type, COUNT(*) as count')
            ->groupBy('type')
            ->pluck('count', 'type')
            ->toArray();

        return view('seeker.notifications', [
            'notifications' => $notifications,
            'totalNotifications' => $totalNotifications,
            'unreadNotifications' => $unreadNotifications,
            'applicationNotifications' => $applicationNotifications,
            'jobMatchNotifications' => $jobMatchNotifications,
            'interviewNotifications' => $interviewNotifications,
            'messageNotifications' => $messageNotifications,
            'notificationTypeData' => $notificationTypeData,
        ]);
    }

    public function create()
    {
        abort(404);
    }

    public function store(StoreNotificationRequest $request)
    {
        abort(404);
    }

    public function show(Notification $notification)
    {
        abort(404);
    }

    public function edit(Notification $notification)
    {
        abort(404);
    }

    public function update(UpdateNotificationRequest $request, Notification $notification)
    {
        abort(404);
    }

    public function destroy(Notification $notification): RedirectResponse
    {
        abort_unless($notification->user_id === auth()->id(), 403);

        $notification->delete();

        return back()->with('success', 'Notification deleted.');
    }

    public function markRead(Request $request, Notification $notification): RedirectResponse
    {
        abort_unless($notification->user_id === $request->user()->id, 403);

        $notification->update(['read_at' => now()]);

        return back()->with('success', 'Notification marked as read.');
    }

    public function markAllRead(Request $request): RedirectResponse
    {
        $request->user()->notifications()
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return back()->with('success', 'All notifications marked as read.');
    }
}
