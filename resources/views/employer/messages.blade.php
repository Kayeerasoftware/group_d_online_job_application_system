@extends('layouts.employer')

@section('title', 'Messages')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
            <div class="flex items-center gap-2 md:gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-teal-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-emerald-600 to-teal-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                        <i class="fas fa-envelope text-white text-xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 bg-clip-text text-transparent mb-1 md:mb-2">Messages</h1>
                    <p class="text-gray-600 text-xs md:text-sm font-medium">Communicate with candidates</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-emerald-500 to-teal-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-emerald-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Messages...</span>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-3 mb-3 md:mb-4">
        <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-emerald-100 text-[8px] md:text-[10px] font-medium mb-0.5"><span class="font-bold">Total</span> Messages</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $totalMessages }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-envelope text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-teal-500 to-teal-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-teal-100 text-[8px] md:text-[10px] font-medium mb-0.5"><span class="font-bold">Active</span> Conversations</p>
                    <h3 class="text-base md:text-xl font-bold">{{ count($conversations) }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-comments text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-cyan-100 text-[8px] md:text-[10px] font-medium mb-0.5"><span class="font-bold">Unread</span> Messages</p>
                    <h3 class="text-base md:text-xl font-bold unread-count">{{ $unreadMessages }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-bell text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-[8px] md:text-[10px] font-medium mb-0.5"><span class="font-bold">Online</span> Chats</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $activeChats }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-comment-dots text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Messages Container -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Conversations List -->
        <div class="lg:col-span-1 bg-white rounded-xl shadow-xl overflow-hidden border border-gray-100">
            <div class="p-4 border-b border-gray-200 bg-gradient-to-r from-emerald-50 to-teal-50">
                <h2 class="text-lg font-bold text-gray-800 flex items-center">
                    <i class="fas fa-list mr-2 text-emerald-600"></i><span class="text-emerald-600">Active</span> Conversations
                </h2>
            </div>
            <div class="divide-y divide-gray-200 max-h-96 overflow-y-auto" id="conversationsList">
                @forelse($conversations as $conversationId => $conversation)
                    <div class="conversation-item p-4 hover:bg-emerald-50 cursor-pointer transition border-l-4 {{ $loop->first ? 'border-emerald-600 bg-emerald-50' : 'border-transparent' }}" 
                         data-user-id="{{ $conversation['user']->id }}"
                         onclick="loadConversation({{ $conversation['user']->id }}, '{{ $conversation['user']->name }}')">
                        <div class="flex items-center justify-between">
                            <div class="flex-1 min-w-0">
                                <h3 class="font-semibold text-gray-900 truncate">{{ $conversation['user']->name }}</h3>
                                <p class="text-sm text-gray-600 truncate">{{ Str::limit($conversation['lastMessage']->message, 40) }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $conversation['lastMessage']->created_at->diffForHumans() }}</p>
                            </div>
                            @if($conversation['unreadCount'] > 0)
                                <span class="bg-emerald-600 text-white text-xs px-2 py-1 rounded-full font-semibold flex-shrink-0 ml-2 unread-badge">{{ $conversation['unreadCount'] }}</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center">
                        <i class="fas fa-inbox text-2xl mb-2 block opacity-50 text-gray-400"></i>
                        <p class="text-gray-600 text-sm">No conversations yet</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Chat Area -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-xl overflow-hidden flex flex-col border border-gray-100">
            @if(count($conversations) > 0)
                @php
                    $firstConversation = reset($conversations);
                    $otherUser = $firstConversation['user'];
                    $messages = $firstConversation['messages'];
                @endphp

                <!-- Chat Header -->
                <div class="p-4 border-b border-gray-200 bg-gradient-to-r from-emerald-50 to-teal-50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white font-bold">
                                {{ substr($otherUser->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 chat-user-name">{{ $otherUser->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $otherUser->role->name ?? 'User' }}</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button class="p-2 hover:bg-emerald-100 rounded-lg transition text-emerald-600" title="Call">
                                <i class="fas fa-phone"></i>
                            </button>
                            <button class="p-2 hover:bg-emerald-100 rounded-lg transition text-emerald-600" title="Video">
                                <i class="fas fa-video"></i>
                            </button>
                            <button class="p-2 hover:bg-emerald-100 rounded-lg transition text-emerald-600" title="Info">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Messages -->
                <div class="flex-1 p-4 overflow-y-auto space-y-4 messages-container" id="messagesContainer">
                    @foreach($messages as $message)
                        @if($message->sender_id === auth()->id())
                            <div class="flex justify-end">
                                <div class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-lg p-3 max-w-xs shadow-sm">
                                    <p>{{ $message->message }}</p>
                                    <p class="text-xs text-emerald-100 mt-1">{{ $message->created_at->format('h:i A') }}</p>
                                </div>
                            </div>
                        @else
                            <div class="flex justify-start">
                                <div class="bg-gray-100 rounded-lg p-3 max-w-xs shadow-sm">
                                    <p class="text-gray-800">{{ $message->message }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $message->created_at->format('h:i A') }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Message Input -->
                <div class="p-4 border-t border-gray-200 bg-gray-50">
                    <!-- Error Alert -->
                    <div id="errorAlert" class="hidden mb-3 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm flex items-center gap-2">
                        <i class="fas fa-exclamation-circle"></i>
                        <span id="errorMessage"></span>
                    </div>

                    <form id="messageForm" onsubmit="sendMessage(event, {{ $otherUser->id }})">
                        @csrf
                        <div class="flex gap-2 items-end">
                            <button type="button" class="p-2 hover:bg-gray-200 rounded-lg transition text-gray-600 flex-shrink-0" title="Attach file">
                                <i class="fas fa-paperclip"></i>
                            </button>
                            
                            <div class="flex-1 relative">
                                <textarea 
                                    id="messageInput" 
                                    name="message" 
                                    placeholder="Type your message... (Shift+Enter for new line)" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent resize-none"
                                    rows="1"
                                    maxlength="1000"
                                    required></textarea>
                                <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                                    <span id="charCount">0</span>/1000
                                </div>
                            </div>
                            
                            <button type="submit" id="sendBtn" class="px-6 py-2 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-lg hover:shadow-lg transition font-semibold flex-shrink-0 disabled:opacity-50 disabled:cursor-not-allowed" title="Send message (Enter)">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <div class="flex-1 flex items-center justify-center">
                    <div class="text-center">
                        <i class="fas fa-inbox text-4xl mb-4 block opacity-50 text-gray-400"></i>
                        <p class="text-gray-600 text-lg font-semibold">No messages yet</p>
                        <p class="text-gray-500 text-sm mt-2">Start a conversation with candidates</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
@keyframes slide-right {
    0% { width: 0%; }
    100% { width: 100%; }
}
.animate-slide-right {
    animation: slide-right 5s ease-out forwards;
}
@keyframes slide-text {
    0% { left: 0%; opacity: 1; }
    95% { opacity: 1; }
    100% { left: 100%; opacity: 0; }
}
.animate-slide-text {
    animation: slide-text 5s ease-out forwards;
}

#messageInput {
    max-height: 120px;
    overflow-y: auto;
}

.message-sending {
    opacity: 0.7;
    pointer-events: none;
}
</style>

<script>
const getConversationUrl = '{{ route("employer.messages.conversation", ":id") }}';
const sendMessageUrl = '{{ route("employer.messages.send", ":id") }}';
let currentUserId = null;
let isSending = false;

function loadConversation(userId, userName) {
    const form = document.getElementById('messageForm');
    if (!form) return;

    currentUserId = userId;
    const url = getConversationUrl.replace(':id', userId);

    fetch(url)
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('messagesContainer');
            const chatUserName = document.querySelector('.chat-user-name');
            
            if (chatUserName) {
                chatUserName.textContent = userName;
            }

            container.innerHTML = '';
            
            data.messages.forEach(message => {
                const isOwn = message.sender_id === {{ auth()->id() }};
                const messageDiv = document.createElement('div');
                messageDiv.className = `flex ${isOwn ? 'justify-end' : 'justify-start'}`;
                
                const messageContent = document.createElement('div');
                messageContent.className = `${isOwn ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white' : 'bg-gray-100'} rounded-lg p-3 max-w-xs shadow-sm`;
                
                const time = new Date(message.created_at);
                const timeStr = time.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
                
                messageContent.innerHTML = `
                    <p class="${isOwn ? 'text-white' : 'text-gray-800'}">${escapeHtml(message.message)}</p>
                    <p class="text-xs ${isOwn ? 'text-emerald-100' : 'text-gray-500'} mt-1">${timeStr}</p>
                `;
                
                messageDiv.appendChild(messageContent);
                container.appendChild(messageDiv);
            });

            container.scrollTop = container.scrollHeight;

            // Update form action
            form.onsubmit = (e) => sendMessage(e, userId);

            // Update active conversation
            document.querySelectorAll('.conversation-item').forEach(item => {
                item.classList.remove('border-emerald-600', 'bg-emerald-50');
                item.classList.add('border-transparent');
            });
            document.querySelector(`[data-user-id="${userId}"]`).classList.add('border-emerald-600', 'bg-emerald-50');
        })
        .catch(error => {
            console.error('Error:', error);
            showError('Failed to load conversation');
        });
}

function sendMessage(event, userId) {
    event.preventDefault();
    
    if (isSending) return;
    
    const input = document.getElementById('messageInput');
    const message = input.value.trim();
    const sendBtn = document.getElementById('sendBtn');
    
    if (!message) {
        showError('Message cannot be empty');
        return;
    }

    if (message.length > 1000) {
        showError('Message is too long (max 1000 characters)');
        return;
    }

    isSending = true;
    sendBtn.disabled = true;
    sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || 
                      document.querySelector('input[name="_token"]')?.value || 
                      '{{ csrf_token() }}';

    const sendUrl = sendMessageUrl.replace(':id', userId);
    
    fetch(sendUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: JSON.stringify({ message })
    })
    .then(response => {
        if (response.status === 200 || response.status === 201) {
            return response.json();
        } else if (response.status === 422) {
            return response.json().then(data => {
                throw new Error(data.message || 'Validation error');
            });
        } else {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
    })
    .then(data => {
        if (data.success) {
            const container = document.getElementById('messagesContainer');
            const messageDiv = document.createElement('div');
            messageDiv.className = 'flex justify-end animate-fade-in';
            
            const time = new Date(data.message.created_at);
            const timeStr = time.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
            
            messageDiv.innerHTML = `
                <div class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-lg p-3 max-w-xs shadow-sm">
                    <p>${escapeHtml(data.message.message)}</p>
                    <p class="text-xs text-emerald-100 mt-1">${timeStr}</p>
                </div>
            `;
            
            container.appendChild(messageDiv);
            container.scrollTop = container.scrollHeight;
            input.value = '';
            input.style.height = 'auto';
            document.getElementById('charCount').textContent = '0';
            hideError();
        } else {
            showError(data.message || 'Failed to send message');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showError(error.message || 'Failed to send message. Please try again.');
    })
    .finally(() => {
        isSending = false;
        sendBtn.disabled = false;
        sendBtn.innerHTML = '<i class="fas fa-paper-plane"></i>';
        input.focus();
    });
}

function showError(message) {
    const errorAlert = document.getElementById('errorAlert');
    const errorMessage = document.getElementById('errorMessage');
    errorMessage.textContent = message;
    errorAlert.classList.remove('hidden');
    setTimeout(() => hideError(), 5000);
}

function hideError() {
    const errorAlert = document.getElementById('errorAlert');
    errorAlert.classList.add('hidden');
}

function escapeHtml(text) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, m => map[m]);
}

// Auto-expand textarea
const messageInput = document.getElementById('messageInput');
if (messageInput) {
    messageInput.addEventListener('input', function() {
        // Update character count
        document.getElementById('charCount').textContent = this.value.length;
        
        // Auto-expand textarea
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 120) + 'px';
    });

    // Handle Enter key (send) and Shift+Enter (new line)
    messageInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            document.getElementById('messageForm').dispatchEvent(new Event('submit'));
        }
    });
}

// Auto-scroll to bottom on page load
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('messagesContainer');
    if (container) {
        container.scrollTop = container.scrollHeight;
    }
});

// Add fade-in animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-fade-in {
        animation: fadeIn 0.3s ease-in-out;
    }
`;
document.head.appendChild(style);
</script>
@endsection
