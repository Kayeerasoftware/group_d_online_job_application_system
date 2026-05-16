@extends('layouts.jobseeker')

@section('title', 'Notifications')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg shadow-lg p-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Notifications</h1>
                <p class="text-indigo-100">Stay updated with your job search</p>
            </div>
            <div class="text-right">
                <p class="text-3xl font-bold text-white">0</p>
                <p class="text-indigo-100 text-sm">Unread</p>
            </div>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-6">
        <div class="h-full bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-indigo-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Notifications...</span>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-3 mb-6">
        <!-- Total Notifications -->
        <div class="bg-gradient-to-r from-indigo-50 to-indigo-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-indigo-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-bell text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Total</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">0</h3>
                </div>
            </div>
        </div>

        <!-- Unread -->
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-blue-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-envelope text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Unread</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">0</h3>
                </div>
            </div>
        </div>

        <!-- Applications -->
        <div class="bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-orange-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-file-alt text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Applications</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">0</h3>
                </div>
            </div>
        </div>

        <!-- Interviews -->
        <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-green-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-green-500 to-green-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-calendar-check text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Interviews</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">0</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="bg-white rounded-xl shadow-lg p-4 flex flex-wrap gap-3 items-center justify-between">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('seeker.notifications') }}" class="px-4 py-2 rounded-lg font-semibold transition {{ !request('type') ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                All
            </a>
            <a href="{{ route('seeker.notifications', ['type' => 'application']) }}" class="px-4 py-2 rounded-lg font-semibold transition {{ request('type') === 'application' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Applications
            </a>
            <a href="{{ route('seeker.notifications', ['type' => 'interview']) }}" class="px-4 py-2 rounded-lg font-semibold transition {{ request('type') === 'interview' ? 'bg-orange-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Interviews
            </a>
            <a href="{{ route('seeker.notifications', ['type' => 'job']) }}" class="px-4 py-2 rounded-lg font-semibold transition {{ request('type') === 'job' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Jobs
            </a>
        </div>
    </div>

    <!-- Empty State -->
    <div class="bg-white rounded-xl shadow-lg p-12 text-center">
        <i class="fas fa-bell text-6xl text-gray-300 mb-4 block"></i>
        <h3 class="text-2xl font-bold text-gray-900 mb-2">No notifications</h3>
        <p class="text-gray-600">You're all caught up! Check back later for updates</p>
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
