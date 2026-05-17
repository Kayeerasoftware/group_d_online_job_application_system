<?php

namespace App\Services;

use App\Models\InterviewCommunication;
use App\Repositories\MessageRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class MessageService
{
    private MessageRepository $repository;

    public function __construct(MessageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all conversations for a user
     */
    public function getConversations(int $userId): array
    {
        return $this->repository->getConversations($userId);
    }

    /**
     * Get conversation between two users
     */
    public function getConversationMessages(int $userId, int $otherUserId): Collection
    {
        return $this->repository->getConversationMessages($userId, $otherUserId);
    }

    /**
     * Send a message from one user to another
     */
    public function sendMessage(int $senderId, int $receiverId, string $messageText): InterviewCommunication
    {
        try {
            $message = $this->repository->createMessage($senderId, $receiverId, $messageText);

            Log::info('Message sent successfully', [
                'message_id' => $message->id,
                'sender_id' => $senderId,
                'receiver_id' => $receiverId,
            ]);

            return $message->load(['sender', 'receiver']);
        } catch (\Exception $e) {
            Log::error('Failed to send message', [
                'sender_id' => $senderId,
                'receiver_id' => $receiverId,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    /**
     * Mark messages as read
     */
    public function markMessagesAsRead(int $userId, int $senderId): int
    {
        try {
            $updated = $this->repository->markAsRead($userId, $senderId);

            Log::info('Messages marked as read', [
                'receiver_id' => $userId,
                'sender_id' => $senderId,
                'count' => $updated,
            ]);

            return $updated;
        } catch (\Exception $e) {
            Log::error('Failed to mark messages as read', [
                'receiver_id' => $userId,
                'sender_id' => $senderId,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    /**
     * Get unread message count for a user
     */
    public function getUnreadCount(int $userId): int
    {
        return $this->repository->getUnreadCount($userId);
    }

    /**
     * Get total message count for a user
     */
    public function getTotalMessageCount(int $userId): int
    {
        return $this->repository->getTotalMessageCount($userId);
    }

    /**
     * Get active chat count for a user
     */
    public function getActiveChatCount(int $userId): int
    {
        return $this->repository->getActiveChatCount($userId);
    }

    /**
     * Format conversation data for response
     */
    public function formatConversationData(int $userId): array
    {
        $conversations = $this->getConversations($userId);

        return [
            'conversations' => $conversations,
            'totalMessages' => $this->getTotalMessageCount($userId),
            'unreadMessages' => $this->getUnreadCount($userId),
            'activeChats' => $this->getActiveChatCount($userId),
        ];
    }

    /**
     * Format message for API response
     */
    public function formatMessageResponse(InterviewCommunication $message): array
    {
        return [
            'id' => $message->id,
            'sender_id' => $message->sender_id,
            'receiver_id' => $message->receiver_id,
            'message' => $message->message,
            'message_type' => $message->message_type,
            'read_at' => $message->read_at,
            'created_at' => $message->created_at,
            'sender' => $message->sender ? [
                'id' => $message->sender->id,
                'name' => $message->sender->name,
            ] : null,
            'receiver' => $message->receiver ? [
                'id' => $message->receiver->id,
                'name' => $message->receiver->name,
            ] : null,
        ];
    }
}
