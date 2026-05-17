@extends('layouts.jobseeker')

@section('title', 'Notifications')

@section('content')
<div class="bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6 min-h-screen">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-emerald-600 to-teal-600 rounded-lg shadow-lg p-3 md:p-4 mb-4 md:mb-6">
        <div class="flex items-center justify-between gap-2">
            <div class="flex items-center gap-3 flex-1 min-w-0">
                <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl overflow-hidden bg-white shadow-lg flex-shrink-0 flex items-center justify-center">
                    <i class="fas fa-bell text-emerald-600 text-2xl"></i>
                </div>
                <div class="min-w-0">
                    <h1 class="text-sm sm:text-lg md:text-2xl font-bold text-white truncate">Notifications</h1>
                    <p class="text-emerald-100 text-xs sm:text-sm mt-0.5 md:mt-1">Stay updated with important events</p>
                </div>
            </div>
            <div class="flex gap-2 flex-shrink-0">
                <form action="{{ route('seeker.notifications.mark-all-read') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-white text-emerald-600 rounded-lg hover:bg-gray-100 transition font-semibold text-sm">
                        <i class="fas fa-check-double mr-2"></i>Mark All Read
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-emerald-500 to-teal-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-emerald-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Notifications...</span>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-2 md:gap-3 mb-4 md:mb-6">
        <!-- Total -->
        <div class="bg-gradient-to-r from-emerald-50 to-emerald-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-emerald-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-bell text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-emerald-600 font-bold leading-tight">Total</p>
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
                    <p class="text-xs md:text-sm text-red-600 font-bold leading-tight">Unread</p>
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
                    <p class="text-xs md:text-sm text-blue-600 font-bold leading-tight">Applications</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $applicationNotifications ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <!-- Interviews -->
        <div class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-purple-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-calendar-check text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-purple-600 font-bold leading-tight">Interviews</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $interviewNotifications ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <!-- Job Alerts -->
        <div class="bg-gradient-to-r from-teal-50 to-teal-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-teal-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-teal-500 to-teal-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-briefcase text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-teal-600 font-bold leading-tight">Job Alerts</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $jobMatchNotifications ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="bg-white rounded-xl shadow-md p-4 mb-6 flex gap-2 overflow-x-auto">
        <a href="{{ route('seeker.notifications') }}" class="px-4 py-2 {{ !request('type') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} rounded-lg font-semibold text-sm whitespace-nowrap transition">
            All
        </a>
        <a href="{{ route('seeker.notifications', ['type' => 'application_status']) }}" class="px-4 py-2 {{ request('type') === 'application_status' ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} rounded-lg font-semibold text-sm whitespace-nowrap transition">
            <span class="{{ request('type') === 'application_status' ? 'text-white' : 'text-blue-600' }} font-bold">Applications</span>
        </a>
        <a href="{{ route('seeker.notifications', ['type' => 'interview']) }}" class="px-4 py-2 {{ request('type') === 'interview' ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} rounded-lg font-semibold text-sm whitespace-nowrap transition">
            <span class="{{ request('type') === 'interview' ? 'text-white' : 'text-purple-600' }} font-bold">Interviews</span>
        </a>
        <a href="{{ route('seeker.notifications', ['type' => 'job_match']) }}" class="px-4 py-2 {{ request('type') === 'job_match' ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} rounded-lg font-semibold text-sm whitespace-nowrap transition">
            <span class="{{ request('type') === 'job_match' ? 'text-white' : 'text-teal-600' }} font-bold">Job Alerts</span>
        </a>
        <a href="{{ route('seeker.notifications', ['type' => 'system']) }}" class="px-4 py-2 {{ request('type') === 'system' ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} rounded-lg font-semibold text-sm whitespace-nowrap transition">
            <span class="{{ request('type') === 'system' ? 'text-white' : 'text-gray-600' }} font-bold">System</span>
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 rounded-lg text-emerald-700 text-sm">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    <!-- Notifications List -->
    <div class="space-y-4">
        @if($notifications->count() > 0)
            @foreach($notifications as $notification)
                <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition overflow-hidden border-l-4 {{ !$notification->read_at ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200' }}">
                    <div class="p-4 md:p-6 flex gap-4">
                        <!-- Icon -->
                        <div class="flex-shrink-0">
                            @php
                                $notificationType = $notification->type ?? 'system';
                                $iconClass = $notificationType === 'application_status' ? 'bg-blue-100' : 
                                            ($notificationType === 'interview' ? 'bg-purple-100' : 
                                            ($notificationType === 'job_match' ? 'bg-teal-100' : 'bg-gray-100'));
                                $iconColor = $notificationType === 'application_status' ? 'text-blue-600' : 
                                            ($notificationType === 'interview' ? 'text-purple-600' : 
                                            ($notificationType === 'job_match' ? 'text-teal-600' : 'text-gray-600'));
                                $icon = $notificationType === 'application_status' ? 'fa-file-alt' : 
                                       ($notificationType === 'interview' ? 'fa-calendar-check' : 
                                       ($notificationType === 'job_match' ? 'fa-briefcase' : 'fa-info-circle'));
                            @endphp
                            <div class="w-12 h-12 rounded-full flex items-center justify-center {{ $iconClass }}">
                                <i class="fas {{ $icon }} {{ $iconColor }} text-lg"></i>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <h3 class="text-sm md:text-base font-bold text-gray-900">{{ $notification->title ?? 'Notification' }}</h3>
                                @if(!$notification->read_at)
                                    <span class="w-2 h-2 rounded-full bg-emerald-600 flex-shrink-0 mt-2"></span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-600 mb-3">{{ $notification->message ?? 'No message' }}</p>
                            <div class="flex items-center justify-between flex-wrap gap-2">
                                <p class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                                <div class="flex gap-2">
                                    @if(!$notification->read_at)
                                        <form action="{{ route('seeker.notifications.read', $notification) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-xs text-emerald-600 hover:text-emerald-700 font-semibold">
                                                Mark as Read
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('seeker.notifications.destroy', $notification) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs text-red-600 hover:text-red-700 font-semibold">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Pagination -->
            @if($notifications->hasPages())
                <div class="flex justify-center mt-8">
                    {{ $notifications->links() }}
                </div>
            @endif
        @else
            <div class="bg-white rounded-xl shadow-md p-12 text-center">
                <i class="fas fa-bell text-gray-400 text-5xl mb-4 block"></i>
                <h3 class="text-xl font-bold text-gray-900 mb-2">No Notifications</h3>
                <p class="text-gray-600">You're all caught up! Check back later for updates.</p>
            </div>
        @endif
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
