<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\InterviewCommunication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class MessagesController extends Controller
{
    public function index(Request $request): View
    {
        $userId = auth()->id();

        // Get all conversations for the seeker
        $conversations = InterviewCommunication::where('receiver_id', $userId)
            ->orWhere('sender_id', $userId)
            ->with(['sender', 'receiver', 'application.job'])
            ->latest('created_at')
            ->get()
            ->groupBy(function ($message) use ($userId) {
                return $message->sender_id === $userId ? $message->receiver_id : $message->sender_id;
            })
            ->map(function ($messages) use ($userId) {
                $lastMessage = $messages->first();
                $otherUser = $lastMessage->sender_id === $userId ? $lastMessage->receiver : $lastMessage->sender;
                $unreadCount = $messages->where('receiver_id', $userId)->whereNull('read_at')->count();

                return [
                    'user' => $otherUser,
                    'lastMessage' => $lastMessage,
                    'unreadCount' => $unreadCount,
                    'messages' => $messages->sortBy('created_at'),
                ];
            });

        $totalMessages = InterviewCommunication::where('receiver_id', $userId)
            ->orWhere('sender_id', $userId)
            ->count();

        $unreadMessages = InterviewCommunication::where('receiver_id', $userId)
            ->whereNull('read_at')
            ->count();

        $activeChats = $conversations->count();

        return view('seeker.messages', [
            'conversations' => $conversations,
            'totalMessages' => $totalMessages,
            'unreadMessages' => $unreadMessages,
            'activeChats' => $activeChats,
        ]);
    }

    public function getConversation(User $user): JsonResponse
    {
        $userId = auth()->id();

        $messages = InterviewCommunication::where(function ($query) use ($userId, $user) {
            $query->where('sender_id', $userId)->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($userId, $user) {
            $query->where('sender_id', $user->id)->where('receiver_id', $userId);
        })
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();

        // Mark messages as read
        InterviewCommunication::where('receiver_id', $userId)
            ->where('sender_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json([
            'user' => $user,
            'messages' => $messages,
        ]);
    }

    public function sendMessage(Request $request, User $user): JsonResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = InterviewCommunication::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'message' => $validated['message'],
            'message_type' => 'text',
        ]);

        return response()->json([
            'success' => true,
            'message' => $message->load(['sender', 'receiver']),
        ]);
    }

    public function markAsRead(InterviewCommunication $message): JsonResponse
    {
        if ($message->receiver_id === auth()->id() && !$message->read_at) {
            $message->update(['read_at' => now()]);
        }

        return response()->json(['success' => true]);
    }
}
