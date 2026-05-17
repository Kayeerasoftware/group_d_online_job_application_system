@extends('layouts.app')

@section('title', 'Seeker Dashboard')

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
                    <p class="text-emerald-100 text-xs sm:text-sm mt-0.5 md:mt-1">Find your next opportunity and track your applications</p>
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
        <span class="absolute -top-6 text-2xl md:text-3xl text-green-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Dashboard data...</span>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-3 mb-4 md:mb-6">
        <!-- Open Jobs -->
        <div class="bg-gradient-to-r from-emerald-50 to-emerald-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-emerald-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-briefcase text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Open Jobs</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $openJobs }}</h3>
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
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $applicationCount }}</h3>
                </div>
            </div>
        </div>

        <!-- Saved Jobs -->
        <div class="bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-yellow-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-bookmark text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Saved Jobs</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $savedJobCount }}</h3>
                </div>
            </div>
        </div>

        <!-- Profile Views -->
        <div class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-purple-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-eye text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Profile Views</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">0</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid gap-6 lg:grid-cols-3" x-data="{ sidebarOpen: false }">
        <div class="lg:col-span-2 space-y-6 min-w-0">
            <!-- Saved Jobs -->
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="fas fa-bookmark text-emerald-600 mr-2"></i>Saved Jobs
                    </h3>
                    <a href="{{ route('seeker.saved-jobs') }}" class="text-emerald-600 text-sm hover:underline font-semibold">View All →</a>
                </div>
                <div class="space-y-3">
                    @if($savedJobCount > 0)
                        @foreach($recentApplications->take(3) as $application)
                            <div class="flex items-center justify-between p-3 hover:bg-emerald-50 rounded-lg transition border border-gray-100">
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-gray-900">{{ $application->job->title }}</p>
                                    <p class="text-xs text-gray-500"><i class="fas fa-map-marker-alt text-emerald-600 mr-1"></i>{{ $application->job->location }}</p>
                                </div>
                                <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center">
                                    <i class="fas fa-bookmark text-emerald-600"></i>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-bookmark text-2xl mb-2 block opacity-50 text-gray-400"></i>
                            <p class="text-gray-600">No saved jobs yet. <a href="{{ route('jobs.index') }}" class="text-emerald-600 hover:text-emerald-700 font-semibold">Explore jobs</a></p>
                        </div>
                    @endelse
                </div>
            </div>

            <!-- Recent Applications -->
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="fas fa-file-alt text-emerald-600 mr-2"></i>Recent Applications
                    </h3>
                    <a href="{{ route('applications.index') }}" class="text-emerald-600 text-sm hover:underline font-semibold">View All →</a>
                </div>
                <div class="space-y-3">
                    @forelse($recentApplications as $application)
                        <div class="flex items-center justify-between p-3 hover:bg-emerald-50 rounded-lg transition cursor-pointer border border-gray-100">
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">{{ $application->job->title }}</p>
                                <p class="text-xs text-gray-500">{{ $application->job->location }} • {{ $application->created_at->format('M d, Y') }}</p>
                            </div>
                            <x-ui.status-badge :value="$application->statusValue()" />
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <i class="fas fa-inbox text-2xl mb-2 block opacity-50 text-gray-400"></i>
                            <p class="text-gray-600">No applications yet. <a href="{{ route('jobs.index') }}" class="text-emerald-600 hover:text-emerald-700 font-semibold">Start browsing jobs</a></p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Sidebar Toggle Button (Mobile) -->
        <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden fixed bottom-6 right-6 z-40 w-14 h-14 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-full shadow-lg hover:shadow-xl transition-all flex items-center justify-center">
            <i class="fas fa-bars text-xl"></i>
        </button>

        <!-- Sidebar Backdrop (Mobile) -->
        <div @click="sidebarOpen = false" :class="sidebarOpen ? 'opacity-100 visible' : 'opacity-0 invisible'" class="lg:hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-30 transition-all duration-300"></div>

        <!-- Sidebar -->
        <div :class="sidebarOpen ? 'translate-x-0' : 'translate-x-full'" class="fixed lg:static right-0 top-0 h-screen lg:h-auto w-80 lg:w-auto bg-white lg:bg-transparent z-40 lg:z-auto overflow-y-auto lg:overflow-visible transition-transform duration-300 lg:translate-x-0 space-y-6 p-4 lg:p-0">
            <!-- Close Button (Mobile) -->
            <button @click="sidebarOpen = false" class="lg:hidden absolute top-4 right-4 w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-lg flex items-center justify-center transition">
                <i class="fas fa-times text-gray-600"></i>
            </button>

            <!-- Profile Card -->
            <div class="bg-white rounded-xl shadow-xl p-4 md:p-6 hover:shadow-2xl transition text-center mt-12 lg:mt-0">
                <div class="mx-auto h-16 w-16 rounded-full overflow-hidden shadow-lg flex-shrink-0 bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center">
                    @if(auth()->user()->profile_picture_url)
                        <img src="{{ auth()->user()->profile_picture_url }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-white font-serif text-2xl">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                    @endif
                </div>
                <h3 class="mt-3 font-semibold text-gray-800">{{ auth()->user()->name }}</h3>
                <p class="text-sm text-gray-600">Job Seeker · Uganda</p>
                <div class="mt-3">
                    <div class="h-1.5 w-full overflow-hidden rounded-full bg-gray-200">
                        <div class="h-full rounded-full bg-gradient-to-r from-emerald-600 to-teal-600" style="width: 88%"></div>
                    </div>
                    <p class="mt-1 text-xs text-gray-600 font-medium">Profile 88% complete</p>
                </div>
                <a href="{{ route('seeker.profile.edit') }}" class="mt-4 block w-full px-4 py-2 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold text-sm">
                    <i class="fas fa-edit mr-2"></i>Edit Profile
                </a>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-xl p-4 md:p-6 hover:shadow-2xl transition" @click="sidebarOpen = false">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-lightning-bolt text-emerald-600 mr-2"></i>Quick Actions
                </h3>
                <div class="space-y-2">
                    <a href="{{ route('jobs.index') }}" class="flex items-center gap-3 p-3 hover:bg-emerald-50 rounded-lg transition border border-gray-100 cursor-pointer">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center">
                            <i class="fas fa-search text-emerald-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Browse Jobs</p>
                            <p class="text-xs text-gray-500">Find new opportunities</p>
                        </div>
                    </a>
                    <a href="{{ route('applications.index') }}" class="flex items-center gap-3 p-3 hover:bg-blue-50 rounded-lg transition border border-gray-100 cursor-pointer">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-inbox text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">My Applications</p>
                            <p class="text-xs text-gray-500">Track your progress</p>
                        </div>
                    </a>
                    <a href="{{ route('seeker.saved-jobs') }}" class="flex items-center gap-3 p-3 hover:bg-purple-50 rounded-lg transition border border-gray-100 cursor-pointer">
                        <div class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center">
                            <i class="fas fa-bookmark text-purple-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Saved Jobs</p>
                            <p class="text-xs text-gray-500">View your bookmarks</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Application Status Summary -->
            <div class="bg-white rounded-xl shadow-xl p-4 md:p-6 hover:shadow-2xl transition" @click="sidebarOpen = false">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="fas fa-chart-pie text-orange-600 mr-2"></i>Status Summary
                    </h3>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 hover:bg-orange-50 rounded-lg transition border border-gray-100">
                        <span class="text-sm font-medium text-gray-900 flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
                            Pending
                        </span>
                        <span class="text-sm font-bold text-gray-900">{{ $recentApplications->where('status', 'pending')->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 hover:bg-orange-50 rounded-lg transition border border-gray-100">
                        <span class="text-sm font-medium text-gray-900 flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-green-500"></span>
                            Accepted
                        </span>
                        <span class="text-sm font-bold text-gray-900">{{ $recentApplications->where('status', 'accepted')->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 hover:bg-orange-50 rounded-lg transition border border-gray-100">
                        <span class="text-sm font-medium text-gray-900 flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-red-500"></span>
                            Rejected
                        </span>
                        <span class="text-sm font-bold text-gray-900">{{ $recentApplications->where('status', 'rejected')->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Close sidebar when clicking on links
    document.addEventListener('DOMContentLoaded', () => {
        const sidebarLinks = document.querySelectorAll('[x-data] a');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', () => {
                const sidebarDiv = link.closest('[x-data]');
                if (sidebarDiv) {
                    // Trigger Alpine.js update
                    const event = new CustomEvent('click');
                    sidebarDiv.dispatchEvent(event);
                }
            });
        });
    });
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
