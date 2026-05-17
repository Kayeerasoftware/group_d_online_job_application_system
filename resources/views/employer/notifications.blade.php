@extends('layouts.employer')

@section('title', 'Notifications')

@section('content')
<div class="bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-orange-600 to-orange-700 rounded-lg shadow-lg p-3 md:p-4 mb-4 md:mb-6">
        <div class="flex items-center justify-between gap-2">
            <div class="flex items-center gap-3 flex-1 min-w-0">
                <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl overflow-hidden bg-white shadow-lg flex-shrink-0 flex items-center justify-center">
                    <i class="fas fa-bell text-orange-600 text-2xl"></i>
                </div>
                <div class="min-w-0">
                    <h1 class="text-sm sm:text-lg md:text-2xl font-bold text-white truncate">Notifications</h1>
                    <p class="text-orange-100 text-xs sm:text-sm mt-0.5 md:mt-1">Stay updated with important events</p>
                </div>
            </div>
            <div class="flex gap-2 flex-shrink-0">
                <button class="px-4 py-2 bg-white text-orange-600 rounded-lg hover:bg-gray-100 transition font-semibold text-sm">
                    <i class="fas fa-check-double mr-2"></i>Mark All Read
                </button>
            </div>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-orange-500 to-orange-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-orange-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Notifications...</span>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-3 mb-4 md:mb-6">
        <!-- Total -->
        <div class="bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-orange-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-bell text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Total</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $totalNotifications ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <!-- Unread -->
        <div class="bg-gradient-to-r from-red-50 to-red-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-red-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-red-500 to-red-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-exclamation-circle text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Unread</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $unreadNotifications ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <!-- Applications -->
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-blue-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-file-alt text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Applications</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $applicationNotifications ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <!-- System -->
        <div class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-purple-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-cog text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">System</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $systemNotifications ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="bg-white rounded-xl shadow-md p-4 mb-6 flex gap-2 overflow-x-auto">
        <button class="px-4 py-2 bg-orange-600 text-white rounded-lg font-semibold text-sm whitespace-nowrap">
            All
        </button>
        <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-semibold text-sm whitespace-nowrap">
            Applications
        </button>
        <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-semibold text-sm whitespace-nowrap">
            Interviews
        </button>
        <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-semibold text-sm whitespace-nowrap">
            Messages
        </button>
        <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-semibold text-sm whitespace-nowrap">
            System
        </button>
    </div>

    <!-- Notifications List -->
    <div class="space-y-4">
        @if(isset($notifications) && is_array($notifications) && count($notifications) > 0)
            @foreach($notifications as $notification)
                <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition overflow-hidden border-l-4 {{ !($notification->read_at ?? false) ? 'border-orange-500 bg-orange-50' : 'border-gray-200' }}">
                    <div class="p-4 md:p-6 flex gap-4">
                        <!-- Icon -->
                        <div class="flex-shrink-0">
                            @php
                                $notificationType = $notification->type ?? 'system';
                                $iconClass = $notificationType === 'application' ? 'bg-blue-100' : 
                                            ($notificationType === 'interview' ? 'bg-purple-100' : 
                                            ($notificationType === 'message' ? 'bg-green-100' : 'bg-gray-100'));
                                $iconColor = $notificationType === 'application' ? 'text-blue-600' : 
                                            ($notificationType === 'interview' ? 'text-purple-600' : 
                                            ($notificationType === 'message' ? 'text-green-600' : 'text-gray-600'));
                                $icon = $notificationType === 'application' ? 'fa-file-alt' : 
                                       ($notificationType === 'interview' ? 'fa-calendar-check' : 
                                       ($notificationType === 'message' ? 'fa-envelope' : 'fa-info-circle'));
                            @endphp
                            <div class="w-12 h-12 rounded-full flex items-center justify-center {{ $iconClass }}">
                                <i class="fas {{ $icon }} {{ $iconColor }} text-lg"></i>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <h3 class="text-sm md:text-base font-bold text-gray-900">{{ $notification->title ?? 'Notification' }}</h3>
                                @if(!($notification->read_at ?? false))
                                    <span class="w-2 h-2 rounded-full bg-orange-600 flex-shrink-0 mt-2"></span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-600 mb-3">{{ $notification->message ?? 'No message' }}</p>
                            <div class="flex items-center justify-between">
                                <p class="text-xs text-gray-500">{{ isset($notification->created_at) ? $notification->created_at->diffForHumans() : 'Recently' }}</p>
                                <div class="flex gap-2">
                                    @if(!($notification->read_at ?? false))
                                        <form action="#" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-xs text-orange-600 hover:text-orange-700 font-semibold">
                                                Mark as Read
                                            </button>
                                        </form>
                                    @endif
                                    <button class="text-xs text-red-600 hover:text-red-700 font-semibold">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="bg-white rounded-xl shadow-md p-12 text-center">
                <i class="fas fa-bell text-gray-400 text-5xl mb-4 block"></i>
                <h3 class="text-xl font-bold text-gray-900 mb-2">No Notifications</h3>
                <p class="text-gray-600">You're all caught up! Check back later for updates.</p>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    @if(isset($notifications) && method_exists($notifications, 'hasPages') && $notifications->hasPages())
        <div class="flex justify-center mt-8">
            {{ $notifications->links() }}
        </div>
    @endif
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
