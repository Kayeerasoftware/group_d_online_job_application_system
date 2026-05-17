<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendMessageRequest;
use App\Models\InterviewCommunication;
use App\Models\User;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class MessagesController extends Controller
{
    private MessageService $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function index(Request $request): View
    {
        $userId = auth()->id();
        $data = $this->messageService->formatConversationData($userId);

        return view('employer.messages', $data);
    }

    public function getConversation(User $user): JsonResponse
    {
        try {
            $userId = auth()->id();
            $messages = $this->messageService->getConversationMessages($userId, $user->id);

            // Mark messages as read
            $this->messageService->markMessagesAsRead($userId, $user->id);

            return response()->json([
                'user' => $user,
                'messages' => $messages->map(fn($msg) => $this->messageService->formatMessageResponse($msg)),
            ]);
        } catch (\Exception $e) {
            Log::error('Error in getConversation', ['exception' => $e]);
            return response()->json([
                'success' => false,
                'message' => 'Error loading conversation',
            ], 500);
        }
    }

    public function sendMessage(SendMessageRequest $request, User $user): JsonResponse
    {
        try {
            $validated = $request->validated();
            $userId = auth()->id();

            $message = $this->messageService->sendMessage(
                $userId,
                $user->id,
                $validated['message']
            );

            return response()->json([
                'success' => true,
                'message' => $this->messageService->formatMessageResponse($message),
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error in sendMessage', ['exception' => $e]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to send message',
            ], 500);
        }
    }

    public function markAsRead(InterviewCommunication $message): JsonResponse
    {
        try {
            $userId = auth()->id();

            if ($message->receiver_id === $userId && !$message->read_at) {
                $message->update(['read_at' => now()]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error in markAsRead', ['exception' => $e]);
            return response()->json([
                'success' => false,
                'message' => 'Error marking message as read',
            ], 500);
        }
    }
}
