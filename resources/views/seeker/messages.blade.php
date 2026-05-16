@extends('layouts.jobseeker')

@section('title', 'Messages')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
            <div class="flex items-center gap-2 md:gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-indigo-600 to-purple-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                        <i class="fas fa-envelope text-white text-xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent mb-1 md:mb-2">Messages</h1>
                    <p class="text-gray-600 text-xs md:text-sm font-medium">Communicate with employers and recruiters</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-green-500 to-green-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-green-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Messages...</span>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-3 mb-3 md:mb-4">
        <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-indigo-100 text-[8px] md:text-[10px] font-medium mb-0.5">Total Messages</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $totalMessages ?? 24 }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-envelope text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-[8px] md:text-[10px] font-medium mb-0.5">Conversations</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $conversations ?? 8 }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-comments text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-pink-100 text-[8px] md:text-[10px] font-medium mb-0.5">Unread</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $unreadMessages ?? 3 }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-bell text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-[8px] md:text-[10px] font-medium mb-0.5">Active Chats</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $activeChats ?? 3 }}</h3>
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
            <div class="p-4 border-b border-gray-200 bg-gradient-to-r from-indigo-50 to-purple-50">
                <h2 class="text-lg font-bold text-gray-800 flex items-center">
                    <i class="fas fa-list mr-2 text-indigo-600"></i>Conversations
                </h2>
            </div>
            <div class="divide-y divide-gray-200 max-h-96 overflow-y-auto">
                <div class="p-4 hover:bg-indigo-50 cursor-pointer transition border-l-4 border-indigo-600 bg-indigo-50">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">Tech Company Inc.</h3>
                            <p class="text-sm text-gray-600 truncate">Thanks for your application...</p>
                        </div>
                        <span class="bg-indigo-600 text-white text-xs px-2 py-1 rounded-full font-semibold">1</span>
                    </div>
                </div>
                <div class="p-4 hover:bg-gray-50 cursor-pointer transition">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">Startup Solutions</h3>
                            <p class="text-sm text-gray-600 truncate">We would like to schedule...</p>
                        </div>
                    </div>
                </div>
                <div class="p-4 hover:bg-gray-50 cursor-pointer transition">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">Global Enterprises</h3>
                            <p class="text-sm text-gray-600 truncate">Your profile looks great...</p>
                        </div>
                    </div>
                </div>
                <div class="p-4 hover:bg-gray-50 cursor-pointer transition">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">Innovation Labs</h3>
                            <p class="text-sm text-gray-600 truncate">Interview scheduled for...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chat Area -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-xl overflow-hidden flex flex-col border border-gray-100">
            <!-- Chat Header -->
            <div class="p-4 border-b border-gray-200 bg-gradient-to-r from-indigo-50 to-purple-50">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Tech Company Inc.</h3>
                        <p class="text-sm text-gray-600">Hiring Manager</p>
                    </div>
                    <div class="flex gap-2">
                        <button class="p-2 hover:bg-indigo-100 rounded-lg transition text-indigo-600">
                            <i class="fas fa-phone"></i>
                        </button>
                        <button class="p-2 hover:bg-indigo-100 rounded-lg transition text-indigo-600">
                            <i class="fas fa-video"></i>
                        </button>
                        <button class="p-2 hover:bg-indigo-100 rounded-lg transition text-indigo-600">
                            <i class="fas fa-info-circle"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Messages -->
            <div class="flex-1 p-4 overflow-y-auto space-y-4">
                <div class="flex justify-start">
                    <div class="bg-gray-100 rounded-lg p-3 max-w-xs shadow-sm">
                        <p class="text-gray-800">Thanks for your application! We're impressed with your profile.</p>
                        <p class="text-xs text-gray-500 mt-1">10:30 AM</p>
                    </div>
                </div>
                <div class="flex justify-end">
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg p-3 max-w-xs shadow-sm">
                        <p>Thank you! I'm very interested in this opportunity.</p>
                        <p class="text-xs text-indigo-100 mt-1">10:45 AM</p>
                    </div>
                </div>
                <div class="flex justify-start">
                    <div class="bg-gray-100 rounded-lg p-3 max-w-xs shadow-sm">
                        <p class="text-gray-800">Would you be available for an interview next week?</p>
                        <p class="text-xs text-gray-500 mt-1">11:00 AM</p>
                    </div>
                </div>
                <div class="flex justify-end">
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg p-3 max-w-xs shadow-sm">
                        <p>Yes, I'm available anytime next week. What works best for you?</p>
                        <p class="text-xs text-indigo-100 mt-1">11:15 AM</p>
                    </div>
                </div>
            </div>

            <!-- Message Input -->
            <div class="p-4 border-t border-gray-200 bg-gray-50">
                <div class="flex gap-2">
                    <button class="p-2 hover:bg-gray-200 rounded-lg transition text-gray-600">
                        <i class="fas fa-paperclip"></i>
                    </button>
                    <input type="text" placeholder="Type your message..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent">
                    <button class="px-6 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:shadow-lg transition font-semibold">
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
