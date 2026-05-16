@extends('layouts.jobseeker')

@section('title', 'Notifications')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
            <div class="flex items-center gap-2 md:gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-orange-600 to-red-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-orange-600 to-red-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                        <i class="fas fa-bell text-white text-xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-orange-600 via-red-600 to-pink-600 bg-clip-text text-transparent mb-1 md:mb-2">Notifications</h1>
                    <p class="text-gray-600 text-xs md:text-sm font-medium">Stay updated on your applications and opportunities</p>
                </div>
            </div>
            <div class="flex gap-1.5 md:gap-2 w-full md:w-auto">
                <button onclick="markAllAsRead()" class="flex-1 md:flex-none px-3 md:px-5 py-2 md:py-2.5 bg-gradient-to-r from-orange-600 to-red-600 text-white rounded-lg md:rounded-xl hover:shadow-lg transition-all duration-300 text-xs md:text-sm font-bold flex items-center justify-center gap-1 md:gap-2 transform hover:scale-105">
                    <i class="fas fa-check-double"></i><span class="hidden sm:inline">Mark All Read</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-green-500 to-green-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-green-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Notifications...</span>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-3 mb-3 md:mb-4">
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-[8px] md:text-[10px] font-medium mb-0.5">Total</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $notifications->count() }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-bell text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-[8px] md:text-[10px] font-medium mb-0.5">Unread</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $unreadCount }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-envelope text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-[8px] md:text-[10px] font-medium mb-0.5">Application</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $applicationNotifications }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-file-alt text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-[8px] md:text-[10px] font-medium mb-0.5">Job Alerts</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $jobAlerts }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-briefcase text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="bg-white rounded-xl shadow-lg p-3 mb-4 border border-gray-100">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('seeker.notifications') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all {{ !request('type') ? 'bg-gradient-to-r from-orange-600 to-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                <i class="fas fa-inbox mr-2"></i>All
            </a>
            <a href="{{ route('seeker.notifications', ['type' => 'application']) }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all {{ request('type') == 'application' ? 'bg-gradient-to-r from-blue-600 to-blue-700 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                <i class="fas fa-file-alt mr-2"></i>Applications
            </a>
            <a href="{{ route('seeker.notifications', ['type' => 'job']) }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all {{ request('type') == 'job' ? 'bg-gradient-to-r from-green-600 to-green-700 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                <i class="fas fa-briefcase mr-2"></i>Job Alerts
            </a>
            <a href="{{ route('seeker.notifications', ['type' => 'system']) }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all {{ request('type') == 'system' ? 'bg-gradient-to-r from-purple-600 to-purple-700 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                <i class="fas fa-cog mr-2"></i>System
            </a>
        </div>
    </div>

    <!-- Notifications List -->
    <div class="space-y-3">
        @forelse($notifications as $notification)
        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border {{ $notification->read_at ? 'border-gray-100' : 'border-blue-200 bg-blue-50' }} p-4">
            <div class="flex items-start gap-4">
                <!-- Icon -->
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full
                    @if($notification->type === 'application_status') bg-blue-100
                    @elseif($notification->type === 'job_closing') bg-orange-100
                    @elseif($notification->type === 'job_match') bg-green-100
                    @else bg-purple-100
                    @endif">
                    @if($notification->type === 'application_status')
                        <i class="fas fa-file-alt text-blue-600 text-lg"></i>
                    @elseif($notification->type === 'job_closing')
                        <i class="fas fa-clock text-orange-600 text-lg"></i>
                    @elseif($notification->type === 'job_match')
                        <i class="fas fa-star text-green-600 text-lg"></i>
                    @else
                        <i class="fas fa-bell text-purple-600 text-lg"></i>
                    @endif
                </div>

                <!-- Content -->
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-2">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">{{ $notification->title }}</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ $notification->message }}</p>
                            <p class="text-xs text-gray-500 mt-2">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                        @if(!$notification->read_at)
                        <span class="h-3 w-3 shrink-0 rounded-full bg-blue-600 mt-1"></span>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-2 mt-3">
                        @if(!$notification->read_at)
                        <form action="{{ route('seeker.notifications.read', $notification) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-xs font-semibold text-blue-600 hover:text-blue-800 transition">
                                <i class="fas fa-check mr-1"></i>Mark as Read
                            </button>
                        </form>
                        @endif
                        @if($notification->action_url)
                        <a href="{{ $notification->action_url }}" class="text-xs font-semibold text-purple-600 hover:text-purple-800 transition">
                            <i class="fas fa-arrow-right mr-1"></i>View Details
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Delete -->
                <form action="{{ route('seeker.notifications.destroy', $notification) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-gray-400 hover:text-red-600 transition" title="Delete notification">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-2xl shadow-lg p-12 text-center border border-gray-100">
            <i class="fas fa-bell text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-bold text-gray-900 mb-2">No Notifications</h3>
            <p class="text-gray-600">You're all caught up! Check back later for updates on your applications.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($notifications->hasPages())
    <div class="mt-6 flex justify-center">
        {{ $notifications->links() }}
    </div>
    @endif
</div>

<script>
function markAllAsRead() {
    if (confirm('Mark all notifications as read?')) {
        fetch('{{ route('seeker.notifications.mark-all-read') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            }
        }).then(response => {
            if (response.ok) {
                location.reload();
            }
        });
    }
}
</script>

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
