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
        $notifications = $request->user()
            ->notifications()
            ->latest()
            ->paginate(15);

        $unreadCount = $request->user()->notifications()->whereNull('read_at')->count();
        $applicationNotifications = $request->user()->notifications()->where('type', 'application_status')->count();
        $jobAlerts = $request->user()->notifications()->where('type', 'job_match')->count();

        return view('seeker.notifications', compact('notifications', 'unreadCount', 'applicationNotifications', 'jobAlerts'));
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

        return back()->with('status', 'Notification deleted.');
    }

    public function markRead(Request $request, Notification $notification): RedirectResponse
    {
        abort_unless($notification->user_id === $request->user()->id, 403);

        $notification->update(['read_at' => now()]);

        return back()->with('status', 'Notification marked as read.');
    }

    public function markAllRead(Request $request)
    {
        $request->user()->notifications()->whereNull('read_at')->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }
}
