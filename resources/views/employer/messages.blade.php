@extends('layouts.employer')

@section('title', 'Messages')

@section('content')
<div class="bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-lg shadow-lg p-3 md:p-4 mb-4 md:mb-6">
        <div class="flex items-center justify-between gap-2">
            <div class="flex items-center gap-3 flex-1 min-w-0">
                <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl overflow-hidden bg-white shadow-lg flex-shrink-0 flex items-center justify-center">
                    <i class="fas fa-envelope text-green-600 text-2xl"></i>
                </div>
                <div class="min-w-0">
                    <h1 class="text-sm sm:text-lg md:text-2xl font-bold text-white truncate">Messages</h1>
                    <p class="text-green-100 text-xs sm:text-sm mt-0.5 md:mt-1">Communicate with candidates</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-green-500 to-green-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-green-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Messages...</span>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-3 mb-4 md:mb-6">
        <!-- Total Conversations -->
        <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-green-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-green-500 to-green-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-comments text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Total</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $totalConversations ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <!-- Unread -->
        <div class="bg-gradient-to-r from-red-50 to-red-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-red-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-red-500 to-red-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-bell text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Unread</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $unreadMessages ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <!-- Active -->
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-blue-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-user-check text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Active</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $activeConversations ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <!-- Archived -->
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-gray-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-gray-500 to-gray-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-archive text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Archived</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $archivedConversations ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid gap-6 lg:grid-cols-4">
        <!-- Conversations List -->
        <div class="lg:col-span-1 bg-white rounded-xl shadow-xl overflow-hidden">
            <!-- Search -->
            <div class="p-4 border-b border-gray-200">
                <input type="text" placeholder="Search conversations..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm">
            </div>

            <!-- Conversations -->
            <div class="divide-y divide-gray-200 max-h-96 overflow-y-auto">
                @if(isset($conversations) && is_array($conversations) && count($conversations) > 0)
                    @foreach($conversations as $conversation)
                        <a href="#" class="block p-4 hover:bg-gray-50 transition border-l-4 {{ ($conversation->unread ?? false) ? 'border-green-500 bg-green-50' : 'border-transparent' }}">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                    <span class="text-sm font-bold text-green-600">{{ strtoupper(substr($conversation->participant_name ?? 'U', 0, 1)) }}</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900 truncate">{{ $conversation->participant_name ?? 'Unknown' }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ $conversation->last_message ?? 'No messages' }}</p>
                                </div>
                                @if($conversation->unread ?? false)
                                    <span class="w-2 h-2 rounded-full bg-green-600 flex-shrink-0"></span>
                                @endif
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="p-8 text-center text-gray-500">
                        <i class="fas fa-inbox text-3xl mb-2 block text-gray-400"></i>
                        <p class="text-sm">No conversations yet</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Chat Area -->
        <div class="lg:col-span-3 bg-white rounded-xl shadow-xl overflow-hidden flex flex-col">
            <!-- Chat Header -->
            <div class="p-4 border-b border-gray-200 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                        <span class="text-sm font-bold text-green-600">J</span>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">John Doe</p>
                        <p class="text-xs text-gray-500">Active now</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button class="p-2 hover:bg-gray-100 rounded-lg transition">
                        <i class="fas fa-phone text-gray-600"></i>
                    </button>
                    <button class="p-2 hover:bg-gray-100 rounded-lg transition">
                        <i class="fas fa-video text-gray-600"></i>
                    </button>
                    <button class="p-2 hover:bg-gray-100 rounded-lg transition">
                        <i class="fas fa-ellipsis-v text-gray-600"></i>
                    </button>
                </div>
            </div>

            <!-- Messages -->
            <div class="flex-1 p-4 overflow-y-auto space-y-4 bg-gray-50">
                <!-- Received Message -->
                <div class="flex gap-3">
                    <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                        <span class="text-xs font-bold text-green-600">J</span>
                    </div>
                    <div class="max-w-xs">
                        <div class="bg-white rounded-lg p-3 shadow-sm">
                            <p class="text-sm text-gray-900">Hi, I'm interested in the Senior Developer position</p>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">10:30 AM</p>
                    </div>
                </div>

                <!-- Sent Message -->
                <div class="flex gap-3 justify-end">
                    <div class="max-w-xs">
                        <div class="bg-green-600 text-white rounded-lg p-3 shadow-sm">
                            <p class="text-sm">Great! Let's schedule an interview</p>
                        </div>
                        <p class="text-xs text-gray-500 mt-1 text-right">10:35 AM</p>
                    </div>
                </div>
            </div>

            <!-- Message Input -->
            <div class="p-4 border-t border-gray-200 bg-white">
                <div class="flex gap-2">
                    <input type="text" placeholder="Type a message..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm">
                    <button class="p-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
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
</style>
@endsection
