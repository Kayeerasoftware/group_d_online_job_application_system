<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MessagesController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        
        $conversations = Application::whereHas('job', fn($q) => $q->where('employer_id', $user->id))
            ->with(['seeker', 'job'])
            ->distinct()
            ->latest()
            ->paginate(20);

        $totalConversations = Application::whereHas('job', fn($q) => $q->where('employer_id', $user->id))
            ->distinct('job_seeker_id')
            ->count();

        $activeConversations = $totalConversations;
        $unreadMessages = 0; // This would need a messages table to track properly

        return view('employer.messages', [
            'conversations' => $conversations,
            'totalConversations' => $totalConversations,
            'activeConversations' => $activeConversations,
            'unreadMessages' => $unreadMessages,
        ]);
    }
}
