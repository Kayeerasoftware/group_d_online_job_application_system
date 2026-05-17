@extends('layouts.employer')

@section('title', 'Dashboard')

@section('content')
<div class="bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Welcome Header -->
    <div class="bg-gradient-to-r from-emerald-600 to-teal-600 rounded-lg shadow-lg p-3 md:p-4 mb-4 md:mb-6">
        <div class="flex items-center justify-between gap-2">
            <div class="flex items-center gap-3 flex-1 min-w-0">
                <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl overflow-hidden bg-white shadow-lg flex-shrink-0">
                    <img src="{{ auth()->user()->profile_picture_url ?? 'https://via.placeholder.com/56' }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                </div>
                <div class="min-w-0">
                    <h1 class="text-sm sm:text-lg md:text-2xl font-bold text-white truncate">Welcome, <span class="text-emerald-200 text-base sm:text-xl md:text-3xl">{{ auth()->user()->name }}</span> 👋</h1>
                    <p class="text-emerald-100 text-xs sm:text-sm mt-0.5 md:mt-1">Manage your job postings and applications</p>
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
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-2 md:gap-3 mb-4 md:mb-6">
        <!-- Active Jobs -->
        <div class="bg-gradient-to-r from-emerald-50 to-emerald-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-emerald-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-briefcase text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Active Jobs</p>
                    <h3 class="text-lg md:text-2xl font-bold text-gray-900 leading-tight">{{ $stats['active_jobs'] }} <span class="text-xs text-green-600 font-medium">+{{ $stats['jobs_this_month'] }}</span></h3>
                </div>
            </div>
        </div>

        <!-- Total Applications -->
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-blue-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-file-alt text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Applications</p>
                    <h3 class="text-lg md:text-2xl font-bold text-gray-900 leading-tight">{{ $stats['total_applications'] }} <span class="text-xs text-blue-600 font-medium">{{ $stats['pending_applications'] }} pending</span></h3>
                </div>
            </div>
        </div>

        <!-- Shortlisted Candidates -->
        <div class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-purple-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-star text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Shortlisted</p>
                    <h3 class="text-lg md:text-2xl font-bold text-gray-900 leading-tight">{{ $stats['shortlisted'] }} <span class="text-xs text-purple-600 font-medium">Candidates</span></h3>
                </div>
            </div>
        </div>

        <!-- Rejected Applications -->
        <div class="bg-gradient-to-r from-red-50 to-red-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-red-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-red-500 to-red-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-times-circle text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Rejected</p>
                    <h3 class="text-lg md:text-2xl font-bold text-gray-900 leading-tight">{{ $stats['rejected'] }} <span class="text-xs text-red-600 font-medium">Applications</span></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid gap-6 lg:grid-cols-2 mb-6">
        <!-- Applications Trend Chart -->
        <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-800 flex items-center">
                    <i class="fas fa-chart-line text-blue-600 mr-2"></i>Applications Trend (7 Days)
                </h3>
            </div>
            <div class="relative h-80">
                <canvas id="applicationsChart"></canvas>
            </div>
        </div>

        <!-- Application Status Distribution -->
        <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-800 flex items-center">
                    <i class="fas fa-chart-pie text-purple-600 mr-2"></i>Application Status Distribution
                </h3>
            </div>
            <div class="relative h-80">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid gap-6 lg:grid-cols-5">
        <!-- Left Column: Recent Job Postings -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition h-full flex flex-col">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="fas fa-briefcase text-emerald-600 mr-2"></i>Recent Jobs ({{ $recentJobs->count() }})
                    </h3>
                    <a href="{{ route('jobs.index') }}" class="text-emerald-600 text-xs hover:underline font-semibold">View All →</a>
                </div>
                <div class="flex-1 overflow-y-auto pr-2 space-y-2" style="max-height: 500px;">
                    @forelse($recentJobs as $job)
                    <div class="flex items-start justify-between p-3 hover:bg-emerald-50 rounded-lg transition cursor-pointer border border-gray-100">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900">{{ $job->title }}</p>
                            <p class="text-xs text-gray-500">{{ $job->applications_count }} applications</p>
                            <p class="text-xs text-gray-400">{{ $job->created_at->format('M d, Y') }}</p>
                        </div>
                        <span class="px-2 py-1 text-xs rounded-full font-semibold flex-shrink-0 ml-2 {{ ($job->status instanceof \App\Enums\JobStatus ? $job->status->value : $job->status) == 'open' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($job->status instanceof \App\Enums\JobStatus ? $job->status->value : $job->status) }}
                        </span>
                    </div>
                    @empty
                    <p class="text-gray-500 text-sm text-center py-8">No job postings yet. <a href="{{ route('jobs.create') }}" class="text-emerald-600 hover:underline">Create one</a></p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Middle Column: Recent Applications -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition h-full flex flex-col">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="fas fa-inbox text-blue-600 mr-2"></i>Recent Applications ({{ $recentApplications->count() }})
                    </h3>
                    <a href="{{ route('employer.applications') }}" class="text-blue-600 text-xs hover:underline font-semibold">View All →</a>
                </div>
                <div class="flex-1 overflow-y-auto pr-2 space-y-2" style="max-height: 500px;">
                    @forelse($recentApplications as $application)
                    <div class="flex items-start justify-between p-3 hover:bg-blue-50 rounded-lg transition border border-gray-100">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900">{{ $application->seeker->name ?? 'Unknown' }}</p>
                            <p class="text-xs text-gray-500">{{ $application->job->title ?? 'Unknown Job' }}</p>
                            <p class="text-xs text-gray-400">{{ $application->created_at->format('M d, Y') }}</p>
                        </div>
                        <span class="px-2 py-1 text-xs rounded-full font-semibold flex-shrink-0 ml-2 {{ ($application->status instanceof \App\Enums\ApplicationStatus ? $application->status->value : $application->status) == 'shortlisted' ? 'bg-green-100 text-green-800' : (($application->status instanceof \App\Enums\ApplicationStatus ? $application->status->value : $application->status) == 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ ucfirst($application->status instanceof \App\Enums\ApplicationStatus ? $application->status->value : $application->status) }}
                        </span>
                    </div>
                    @empty
                    <p class="text-gray-500 text-sm text-center py-8">No applications yet</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right Column: Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Company Card -->
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition text-center">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 font-serif text-2xl text-white shadow-lg">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <h3 class="mt-3 font-semibold text-gray-800 text-sm">{{ auth()->user()->name }}</h3>
                <p class="text-xs text-gray-600">{{ auth()->user()->employerProfile->company_name ?? 'Company' }}</p>
                <p class="text-xs text-gray-600">{{ auth()->user()->employerProfile->location ?? 'Location' }}</p>
                <div class="mt-3">
                    <div class="h-1.5 w-full overflow-hidden rounded-full bg-gray-200">
                        <div class="h-full rounded-full bg-gradient-to-r from-emerald-600 to-teal-600" style="width: {{ $profileCompletion }}%"></div>
                    </div>
                    <p class="mt-1 text-xs text-gray-600 font-medium">Profile {{ $profileCompletion }}% complete</p>
                </div>
                <a href="{{ route('employer.profile.edit') }}" class="mt-4 block w-full px-4 py-2 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold text-sm">
                    <i class="fas fa-edit mr-2"></i>Edit Profile
                </a>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-lightning-bolt text-yellow-600 mr-2"></i>Quick Actions
                </h3>
                <div class="space-y-2">
                    <a href="{{ route('jobs.create') }}" class="block w-full px-4 py-2 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold text-sm text-center">
                        <i class="fas fa-plus mr-2"></i>Post New Job
                    </a>
                    <a href="{{ route('employer.applications') }}" class="block w-full px-4 py-2 bg-white text-emerald-600 border border-emerald-200 rounded-lg hover:bg-emerald-50 transition-all duration-300 font-semibold text-sm text-center">
                        <i class="fas fa-inbox mr-2"></i>View Applications
                    </a>
                </div>
            </div>

            <!-- Recent Notifications -->
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="fas fa-bell text-orange-600 mr-2"></i>Notifications
                        @if($unreadNotificationsCount > 0)
                        <span class="ml-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{ $unreadNotificationsCount }}</span>
                        @endif
                    </h3>
                    <a href="{{ route('employer.notifications') }}" class="text-emerald-600 text-xs hover:underline font-semibold">View All →</a>
                </div>
                <div class="space-y-3 max-h-96 overflow-y-auto pr-2">
                    @forelse($recentNotifications as $notification)
                    <div class="flex items-start gap-3 p-3 hover:bg-orange-50 rounded-lg transition border {{ !$notification->read_at ? 'border-orange-300 bg-orange-50' : 'border-gray-100' }}">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full {{ $notification->type === 'application' ? 'bg-blue-100' : ($notification->type === 'job_closing' ? 'bg-orange-100' : 'bg-purple-100') }}">
                            @if($notification->type === 'application') <i class="fas fa-envelope text-blue-600"></i>
                            @elseif($notification->type === 'job_closing') <i class="fas fa-clock text-orange-600"></i>
                            @else <i class="fas fa-star text-purple-600"></i>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900">{{ $notification->title }}</p>
                            <p class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                        @if(!$notification->read_at)
                        <span class="h-2 w-2 shrink-0 rounded-full bg-emerald-600"></span>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Applications Trend Chart
    const applicationsCtx = document.getElementById('applicationsChart').getContext('2d');
    new Chart(applicationsCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_keys($applicationsLast7Days)) !!},
            datasets: [{
                label: 'Applications',
                data: {!! json_encode(array_values($applicationsLast7Days)) !!},
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointBackgroundColor: '#3b82f6',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        font: { size: 12, weight: 'bold' },
                        color: '#374151'
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { color: '#6b7280' },
                    grid: { color: '#e5e7eb' }
                },
                x: {
                    ticks: { color: '#6b7280' },
                    grid: { color: '#e5e7eb' }
                }
            }
        }
    });

    // Application Status Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    const statusLabels = {!! json_encode(array_keys($applicationStatusData)) !!};
    const statusData = {!! json_encode(array_values($applicationStatusData)) !!};
    
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: statusLabels.map(label => label.charAt(0).toUpperCase() + label.slice(1)),
            datasets: [{
                data: statusData,
                backgroundColor: [
                    '#10b981',
                    '#f59e0b',
                    '#ef4444',
                    '#8b5cf6'
                ],
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: { size: 12, weight: 'bold' },
                        color: '#374151',
                        padding: 15
                    }
                }
            }
        }
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

/* Custom scrollbar styling */
div::-webkit-scrollbar {
    width: 6px;
}

div::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 10px;
}

div::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 10px;
}

div::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}
</style>
@endsection
