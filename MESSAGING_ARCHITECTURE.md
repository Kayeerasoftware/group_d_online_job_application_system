# Messaging System Refactoring - Architecture Documentation

## Overview
The messaging system has been refactored to follow SOLID principles with clear separation of concerns, making it more maintainable, testable, and scalable.

## Architecture Layers

### 1. **Repository Layer** (`app/Repositories/MessageRepository.php`)
**Responsibility**: Data access and database operations

**Methods**:
- `getConversations(int $userId)` - Fetch all conversations for a user
- `getConversationMessages(int $userId, int $otherUserId)` - Get messages between two users
- `createMessage(int $senderId, int $receiverId, string $messageText)` - Create new message
- `markAsRead(int $userId, int $senderId)` - Mark messages as read
- `getUnreadCount(int $userId)` - Get unread message count
- `getTotalMessageCount(int $userId)` - Get total messages
- `getActiveChatCount(int $userId)` - Get active conversation count

**Benefits**:
- Centralized database queries
- Easy to mock for testing
- Single source of truth for data access

### 2. **Service Layer** (`app/Services/MessageService.php`)
**Responsibility**: Business logic and data formatting

**Methods**:
- `sendMessage()` - Send message with error handling and logging
- `markMessagesAsRead()` - Mark messages as read with logging
- `formatConversationData()` - Format data for view
- `formatMessageResponse()` - Format message for API response

**Benefits**:
- Encapsulates business logic
- Handles error logging
- Provides consistent data formatting
- Reusable across controllers

### 3. **Request Validation** (`app/Http/Requests/SendMessageRequest.php`)
**Responsibility**: Input validation and sanitization

**Validations**:
- Message is required
- Must be string type
- Min 1 character, Max 1000 characters
- Cannot be only whitespace
- Automatically trims whitespace

**Benefits**:
- Centralized validation rules
- Automatic error messages
- Reusable across endpoints

### 4. **Controller Layer** (Seeker & Employer)
**Responsibility**: HTTP request handling and response

**Methods**:
- `index()` - Display messages page
- `getConversation()` - Fetch conversation via AJAX
- `sendMessage()` - Send message via AJAX
- `markAsRead()` - Mark message as read

**Benefits**:
- Thin controllers (delegating to service)
- Consistent error handling
- Proper HTTP status codes

## Data Flow

### Sending a Message
```
User Input (Frontend)
    ↓
SendMessageRequest (Validation)
    ↓
MessagesController::sendMessage()
    ↓
MessageService::sendMessage()
    ↓
MessageRepository::createMessage()
    ↓
Database (InterviewCommunication)
    ↓
JSON Response (Frontend)
```

### Receiving Messages
```
Frontend AJAX Request
    ↓
MessagesController::getConversation()
    ↓
MessageService::getConversationMessages()
    ↓
MessageRepository::getConversationMessages()
    ↓
Database Query
    ↓
MessageService::formatMessageResponse()
    ↓
JSON Response (Frontend)
    ↓
Frontend Display
```

## Key Features

### 1. **Error Handling**
- Try-catch blocks in service layer
- Comprehensive logging with context
- User-friendly error messages
- Proper HTTP status codes (200, 422, 500)

### 2. **Validation**
- Server-side validation via SendMessageRequest
- Client-side validation in JavaScript
- Whitespace trimming
- Character limit enforcement

### 3. **Security**
- HTML escaping in frontend (XSS prevention)
- CSRF token validation
- User authentication checks
- Authorization checks (receiver_id validation)

### 4. **Performance**
- Eager loading of relationships
- Efficient database queries
- Grouped conversations for better UX
- Pagination-ready structure

### 5. **Logging**
- Message creation logging
- Error logging with full context
- Read status logging
- Helps with debugging and monitoring

## File Structure

```
app/
├── Repositories/
│   └── MessageRepository.php          # Data access layer
├── Services/
│   └── MessageService.php             # Business logic layer
├── Http/
│   ├── Controllers/
│   │   ├── Seeker/MessagesController.php
│   │   └── Employer/MessagesController.php
│   └── Requests/
│       └── SendMessageRequest.php     # Validation rules
└── Models/
    └── InterviewCommunication.php     # Message model
```

## Usage Example

### In Controller
```php
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
```

## Testing Considerations

### Unit Tests
- Test MessageRepository queries
- Test MessageService business logic
- Test SendMessageRequest validation

### Integration Tests
- Test full message flow
- Test error scenarios
- Test authorization

### Example Test
```php
public function test_send_message_creates_record()
{
    $sender = User::factory()->create();
    $receiver = User::factory()->create();
    
    $message = $this->messageService->sendMessage(
        $sender->id,
        $receiver->id,
        'Test message'
    );
    
    $this->assertDatabaseHas('interview_communications', [
        'sender_id' => $sender->id,
        'receiver_id' => $receiver->id,
        'message' => 'Test message',
    ]);
}
```

## Future Enhancements

1. **Real-time Messaging** - Add WebSocket support via Laravel Echo
2. **Message Attachments** - Support file uploads
3. **Message Reactions** - Add emoji reactions
4. **Message Search** - Full-text search capability
5. **Message Encryption** - End-to-end encryption
6. **Typing Indicators** - Show when user is typing
7. **Message Editing** - Allow editing sent messages
8. **Message Deletion** - Soft delete messages
9. **Read Receipts** - Show when message is read
10. **Notification System** - Real-time notifications for new messages

## Dependencies

- Laravel Framework
- Eloquent ORM
- Laravel Validation
- Logging (built-in)

## Notes

- Both Seeker and Employer controllers use identical logic
- MessageService is dependency-injected for better testability
- All database operations go through repository
- Comprehensive error logging for debugging
- User model `is_active` column removed (doesn't exist in database)
