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

        return view('notifications.index', compact('notifications'));
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

    public function destroy(Notification $notification)
    {
        abort(404);
    }

    public function markRead(Request $request, Notification $notification): RedirectResponse
    {
        abort_unless($notification->user_id === $request->user()->id, 403);

        $notification->update(['is_read' => true]);

        return back()->with('status', 'Notification marked as read.');
    }
}
