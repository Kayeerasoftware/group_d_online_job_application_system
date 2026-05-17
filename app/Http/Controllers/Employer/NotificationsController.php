<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NotificationsController extends Controller
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
            ->where('type', 'application')
            ->count();

        $systemNotifications = Notification::where('user_id', $user->id)
            ->where('type', 'system')
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

        return view('employer.notifications', [
            'notifications' => $notifications,
            'totalNotifications' => $totalNotifications,
            'unreadNotifications' => $unreadNotifications,
            'applicationNotifications' => $applicationNotifications,
            'systemNotifications' => $systemNotifications,
            'interviewNotifications' => $interviewNotifications,
            'messageNotifications' => $messageNotifications,
            'notificationTypeData' => $notificationTypeData,
        ]);
    }

    public function markRead(Request $request, Notification $notification): RedirectResponse
    {
        $this->authorize('update', $notification);

        $notification->update(['read_at' => now()]);

        return redirect()->back()->with('success', 'Notification marked as read');
    }

    public function markAllRead(Request $request): RedirectResponse
    {
        $user = $request->user();
        
        Notification::where('user_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return redirect()->back()->with('success', 'All notifications marked as read');
    }

    public function destroy(Request $request, Notification $notification): RedirectResponse
    {
        $this->authorize('delete', $notification);

        $notification->delete();

        return redirect()->back()->with('success', 'Notification deleted');
    }
}
