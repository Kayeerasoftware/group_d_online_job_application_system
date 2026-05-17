<?php

namespace App\Repositories;

use App\Models\InterviewCommunication;
use Illuminate\Support\Collection;


class MessageRepository
{
    /**
     * Get all conversations for a user
     */
    public function getConversations(int $userId): array
    {
        return InterviewCommunication::where('receiver_id', $userId)
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
            })
            ->toArray();
    }

    /**
     * Get conversation between two users
     */
    public function getConversationMessages(int $userId, int $otherUserId): Collection
    {
        return InterviewCommunication::where(function ($query) use ($userId, $otherUserId) {
            $query->where('sender_id', $userId)->where('receiver_id', $otherUserId);
        })->orWhere(function ($query) use ($userId, $otherUserId) {
            $query->where('sender_id', $otherUserId)->where('receiver_id', $userId);
        })
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();
    }

    /**
     * Create a new message
     */
    public function createMessage(int $senderId, int $receiverId, string $messageText, ?int $applicationId = null): InterviewCommunication
    {
        return InterviewCommunication::create([
            'application_id' => $applicationId,
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'message' => $messageText,
            'message_type' => 'text',
        ]);
    }

    /**
     * Mark messages as read
     */
    public function markAsRead(int $userId, int $senderId): int
    {
        return InterviewCommunication::where('receiver_id', $userId)
            ->where('sender_id', $senderId)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
    }

    /**
     * Get unread count for a user
     */
    public function getUnreadCount(int $userId): int
    {
        return InterviewCommunication::where('receiver_id', $userId)
            ->whereNull('read_at')
            ->count();
    }

    /**
     * Get total message count for a user
     */
    public function getTotalMessageCount(int $userId): int
    {
        return InterviewCommunication::where('receiver_id', $userId)
            ->orWhere('sender_id', $userId)
            ->count();
    }

    /**
     * Get active chat count for a user
     */
    public function getActiveChatCount(int $userId): int
    {
        return count($this->getConversations($userId));
    }
}
