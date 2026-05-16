<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function index(Request $request): View
    {
        $query = Notification::where('user_id', $request->user()->id);
        
        if ($request->filter === 'unread') {
            $query->whereNull('read_at');
        } elseif ($request->filter === 'application') {
            $query->where('type', 'like', 'application%');
        } elseif ($request->filter === 'job') {
            $query->where('type', 'like', 'job%');
        }
        
        $notifications = $query->latest()->paginate(20);
        
        $counts = [
            'all' => Notification::where('user_id', $request->user()->id)->count(),
            'unread' => Notification::where('user_id', $request->user()->id)->whereNull('read_at')->count(),
        ];
        
        $unreadCount = $counts['unread'];
        
        return view('seeker.notifications', compact('notifications', 'counts', 'unreadCount'));
    }
    
    public function markRead(Request $request, Notification $notification): RedirectResponse
    {
        $this->authorize('update', $notification);
        
        $notification->update(['read_at' => now()]);
        
        return back()->with('success', 'Notification marked as read');
    }
    
    public function markAllRead(Request $request): RedirectResponse
    {
        Notification::where('user_id', $request->user()->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
        
        return back()->with('success', 'All notifications marked as read');
    }
}
