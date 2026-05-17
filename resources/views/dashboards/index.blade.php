@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Welcome Header -->
    <div class="bg-gradient-to-r from-emerald-600 to-teal-600 rounded-lg shadow-lg p-3 md:p-4 mb-4 md:mb-6">
        <div class="flex items-center justify-between gap-2">
            <div class="flex items-center gap-3 flex-1 min-w-0">
                <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl overflow-hidden bg-white shadow-lg flex-shrink-0">
                    <img src="{{ auth()->user()->profile_picture_url ?? 'https://via.placeholder.com/56' }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                </div>
                <div class="min-w-0">
                    <h1 class="text-sm sm:text-lg md:text-2xl font-bold text-white truncate">Welcome, <span class="text-emerald-200 text-base sm:text-xl md:text-3xl">{{ auth()->user()->name }}</span> 👋</h1>
                    <p class="text-emerald-100 text-xs sm:text-sm mt-0.5 md:mt-1">Choose your workspace to get started</p>
                </div>
            </div>
            <div class="bg-white/20 backdrop-blur-sm rounded-lg px-2 py-1 sm:px-3 sm:py-1.5 md:px-4 md:py-2 text-right flex-shrink-0">
                <p class="text-white text-xs sm:text-sm font-semibold whitespace-nowrap">{{ now()->format('l, F d, Y') }}</p>
                <p class="text-emerald-100 text-xs mt-0.5 whitespace-nowrap">{{ now()->format('h:i A') }}</p>
            </div>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-green-500 to-green-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-green-600 font-bold animate-slide-text whitespace-nowrap z-10">Choose your workspace...</span>
    </div>

    <!-- Dashboard Selection -->
    <div class="grid gap-6 md:grid-cols-3">
        <!-- Seeker Dashboard -->
        <a href="{{ route('seeker.dashboard') }}" class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition hover:-translate-y-1 group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center shadow">
                    <i class="fas fa-briefcase text-white text-lg"></i>
                </div>
                <span class="inline-flex rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.25em] text-emerald-700">Seeker</span>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2">Job Seeker</h3>
            <p class="text-sm text-gray-600">Browse jobs, track applications, and manage your saved roles from one focused workspace.</p>
            <div class="mt-4 flex items-center text-emerald-600 font-semibold text-sm group-hover:translate-x-1 transition">
                <span>Access Dashboard</span>
                <i class="fas fa-arrow-right ml-2"></i>
            </div>
        </a>

        <!-- Employer Dashboard -->
        <a href="{{ route('employer.dashboard') }}" class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition hover:-translate-y-1 group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow">
                    <i class="fas fa-building text-white text-lg"></i>
                </div>
                <span class="inline-flex rounded-full border border-blue-200 bg-blue-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.25em] text-blue-700">Employer</span>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2">Employer</h3>
            <p class="text-sm text-gray-600">Post jobs, review candidates, and keep your hiring pipeline moving efficiently.</p>
            <div class="mt-4 flex items-center text-blue-600 font-semibold text-sm group-hover:translate-x-1 transition">
                <span>Access Dashboard</span>
                <i class="fas fa-arrow-right ml-2"></i>
            </div>
        </a>

        <!-- Admin Dashboard -->
        <a href="{{ route('admin.dashboard') }}" class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition hover:-translate-y-1 group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center shadow">
                    <i class="fas fa-shield-alt text-white text-lg"></i>
                </div>
                <span class="inline-flex rounded-full border border-purple-200 bg-purple-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.25em] text-purple-700">Admin</span>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2">Administrator</h3>
            <p class="text-sm text-gray-600">Review users, audit logs, and manage compliance reports for the platform.</p>
            <div class="mt-4 flex items-center text-purple-600 font-semibold text-sm group-hover:translate-x-1 transition">
                <span>Access Dashboard</span>
                <i class="fas fa-arrow-right ml-2"></i>
            </div>
        </a>
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
