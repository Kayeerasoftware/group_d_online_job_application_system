@extends('layouts.jobseeker')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Welcome Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg shadow-lg p-3 md:p-4 mb-4 md:mb-6">
        <div class="flex items-center justify-between gap-2">
            <div class="flex items-center gap-3 flex-1 min-w-0">
                <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl overflow-hidden bg-white shadow-lg flex-shrink-0">
                    <img src="{{ auth()->user()->profile_picture_url ?? 'https://via.placeholder.com/56' }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                </div>
                <div class="min-w-0">
                    <h1 class="text-sm sm:text-lg md:text-2xl font-bold text-white truncate">Welcome, <span class="text-blue-200 text-base sm:text-xl md:text-3xl">{{ auth()->user()->name }}</span> 👋</h1>
                    <p class="text-blue-100 text-xs sm:text-sm mt-0.5 md:mt-1">Track your job applications and career progress</p>
                </div>
            </div>
            <div class="bg-white/20 backdrop-blur-sm rounded-lg px-2 py-1 sm:px-3 sm:py-1.5 md:px-4 md:py-2 text-right flex-shrink-0">
                <p class="text-white text-xs sm:text-sm font-semibold whitespace-nowrap">{{ now()->format('l, F d, Y') }}</p>
                <p class="text-blue-100 text-xs mt-0.5 whitespace-nowrap">{{ now()->format('h:i A') }}</p>
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
        <!-- Total Applications -->
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-blue-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-file-alt text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Applications</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $stats['applications'] }} <span class="text-xs text-green-600 font-medium">+{{ $stats['applications_this_week'] }}</span></h3>
                </div>
            </div>
        </div>

        <!-- Shortlisted -->
        <div class="bg-gradient-to-r from-amber-50 to-amber-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-amber-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-amber-500 to-amber-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-star text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Shortlisted</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $stats['shortlisted'] }} <span class="text-xs text-gray-500 font-medium">Awaiting</span></h3>
                </div>
            </div>
        </div>

        <!-- Saved Jobs -->
        <div class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-purple-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-bookmark text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Saved Jobs</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $stats['saved_jobs'] }} <span class="text-xs text-orange-600 font-medium">{{ $stats['closing_soon'] }} soon</span></h3>
                </div>
            </div>
        </div>

        <!-- Profile Views -->
        <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-green-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-green-500 to-green-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-eye text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Profile Views</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $stats['profile_views'] }} <span class="text-xs text-gray-500 font-medium">30 days</span></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            <!-- Recent Applications -->
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="fas fa-file-alt text-blue-600 mr-2"></i>Recent Applications
                    </h3>
                    <a href="{{ route('seeker.applications') }}" class="text-blue-600 text-sm hover:underline font-semibold">View All →</a>
                </div>
                <div class="space-y-3">
                    @forelse($recentApplications as $application)
                    <div class="flex items-center justify-between p-3 hover:bg-blue-50 rounded-lg transition cursor-pointer border border-gray-100">
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-900">{{ $application->job->title }}</p>
                            <p class="text-xs text-gray-500">{{ $application->job->company_name }} • {{ $application->created_at->format('M d') }}</p>
                        </div>
                        <span class="px-3 py-1 text-xs rounded-full font-semibold {{ $application->status == 'shortlisted' ? 'bg-green-100 text-green-800' : ($application->status == 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ ucfirst($application->status) }}
                        </span>
                    </div>
                    @empty
                    <p class="text-gray-500 text-sm text-center py-8">No applications yet. <a href="{{ route('jobs.index') }}" class="text-blue-600 hover:underline">Browse jobs</a></p>
                    @endforelse
                </div>
            </div>

            <!-- Application Tracker -->
            @if($trackedApplication)
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-chart-line text-purple-600 mr-2"></i>Application Tracker — {{ $trackedApplication->job->title }}
                </h2>
                <div class="flex items-center justify-between">
                    @foreach(['applied', 'reviewed', 'shortlisted', 'interview', 'hired'] as $index => $stage)
                    <div class="flex flex-col items-center flex-1">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full text-sm font-semibold
                            @if($trackedApplication->status === $stage) bg-blue-600 text-white
                            @elseif(array_search($trackedApplication->status, ['applied', 'reviewed', 'shortlisted', 'interview', 'hired']) > $index) bg-green-600 text-white
                            @else bg-gray-200 text-gray-600
                            @endif">
                            @if(array_search($trackedApplication->status, ['applied', 'reviewed', 'shortlisted', 'interview', 'hired']) > $index)
                                ✓
                            @else
                                {{ $index + 1 }}
                            @endif
                        </div>
                        <p class="mt-2 text-xs text-center font-medium
                            @if($trackedApplication->status === $stage) text-blue-600
                            @elseif(array_search($trackedApplication->status, ['applied', 'reviewed', 'shortlisted', 'interview', 'hired']) > $index) text-green-600
                            @else text-gray-500
                            @endif">
                            {{ ucfirst($stage) }}
                        </p>
                    </div>
                    @if($index < 4)
                    <div class="h-0.5 flex-1 -mt-8 @if(array_search($trackedApplication->status, ['applied', 'reviewed', 'shortlisted', 'interview', 'hired']) > $index) bg-green-600 @else bg-gray-300 @endif"></div>
                    @endif
                    @endforeach
                </div>
                @if($trackedApplication->status === 'shortlisted')
                <div class="mt-4 rounded-xl bg-green-50 p-4 text-sm text-green-800 border border-green-200">
                    <i class="fas fa-check-circle mr-2"></i>Congratulations! You've been shortlisted. Expect a call from HR within 2 working days.
                </div>
                @endif
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Profile Card -->
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition text-center">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-purple-600 font-serif text-2xl text-white shadow-lg">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <h3 class="mt-3 font-semibold text-gray-800">{{ auth()->user()->name }}</h3>
                <p class="text-sm text-gray-600">{{ auth()->user()->jobSeekerProfile->job_title ?? 'Job Seeker' }} · {{ auth()->user()->jobSeekerProfile->location ?? 'Uganda' }}</p>
                <div class="mt-3">
                    <div class="h-1.5 w-full overflow-hidden rounded-full bg-gray-200">
                        <div class="h-full rounded-full bg-gradient-to-r from-blue-600 to-purple-600" style="width: {{ $profileCompletion }}%"></div>
                    </div>
                    <p class="mt-1 text-xs text-gray-600 font-medium">Profile {{ $profileCompletion }}% complete</p>
                </div>
                <a href="{{ route('seeker.profile.edit') }}" class="mt-4 block w-full px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold text-sm">
                    <i class="fas fa-edit mr-2"></i>Edit Profile
                </a>
            </div>

            <!-- Recent Notifications -->
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="fas fa-bell text-orange-600 mr-2"></i>Notifications
                    </h3>
                    <a href="{{ route('seeker.notifications') }}" class="text-blue-600 text-sm hover:underline font-semibold">View All →</a>
                </div>
                <div class="space-y-3">
                    @forelse($recentNotifications as $notification)
                    <div class="flex items-start gap-3 p-3 hover:bg-orange-50 rounded-lg transition border border-gray-100">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full
                            @if($notification->type === 'application_status') bg-blue-100
                            @elseif($notification->type === 'job_closing') bg-orange-100
                            @else bg-purple-100
                            @endif">
                            @if($notification->type === 'application_status') <i class="fas fa-envelope text-blue-600"></i>
                            @elseif($notification->type === 'job_closing') <i class="fas fa-clock text-orange-600"></i>
                            @else <i class="fas fa-eye text-purple-600"></i>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900">{{ $notification->title }}</p>
                            <p class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                        @if(!$notification->read_at)
                        <span class="h-2 w-2 shrink-0 rounded-full bg-blue-600"></span>
                        @endif
                    </div>
                    @empty
                    <p class="text-gray-500 text-sm text-center py-8">No notifications</p>
                    @endforelse
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
