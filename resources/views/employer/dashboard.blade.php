@extends('layouts.employer')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Welcome Header -->
    <div class="bg-gradient-to-r from-emerald-600 to-teal-600 rounded-lg shadow-lg p-4 md:p-6 mb-6">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-4 flex-1">
                <div class="w-16 h-16 rounded-xl overflow-hidden bg-white shadow-lg flex-shrink-0 flex items-center justify-center">
                    @if(auth()->user()->employerProfile && auth()->user()->employerProfile->company_logo)
                        <img src="{{ asset(auth()->user()->employerProfile->company_logo) }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-emerald-400 to-teal-600 flex items-center justify-center">
                            <i class="fas fa-building text-white text-2xl"></i>
                        </div>
                    @endif
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white">Welcome, <span class="text-emerald-100">{{ auth()->user()->employerProfile->company_name ?? auth()->user()->name }}</span> 👋</h1>
                    <p class="text-emerald-100 text-sm mt-1">Manage your job postings and applications</p>
                </div>
            </div>
            <div class="bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2 text-right flex-shrink-0">
                <p class="text-white text-sm font-semibold">{{ now()->format('l, F d, Y') }}</p>
                <p class="text-emerald-100 text-xs mt-0.5">{{ now()->format('h:i A') }}</p>
            </div>
        </div>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-emerald-600">
            <p class="text-xs font-semibold uppercase text-emerald-600">Active Jobs</p>
            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $activeJobs }}</p>
            <p class="text-xs text-gray-500 mt-1">Job Postings</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-blue-600">
            <p class="text-xs font-semibold uppercase text-blue-600">Applications</p>
            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $applicationCount }}</p>
            <p class="text-xs text-gray-500 mt-1">Total Received</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-purple-600">
            <p class="text-xs font-semibold uppercase text-purple-600">Shortlisted</p>
            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $shortlistedCount }}</p>
            <p class="text-xs text-gray-500 mt-1">Candidates</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-red-600">
            <p class="text-xs font-semibold uppercase text-red-600">Rejected</p>
            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $rejectedCount }}</p>
            <p class="text-xs text-gray-500 mt-1">Applications</p>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid gap-6 lg:grid-cols-2 mb-6">
        <!-- Applications Trend Chart -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-chart-line text-emerald-600 mr-2"></i><span class="text-emerald-600">Applications</span> Trend (7 Days)
            </h3>
            <div class="relative h-80">
                <canvas id="applicationsChart"></canvas>
            </div>
        </div>

        <!-- Application Status Distribution -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-chart-pie text-purple-600 mr-2"></i><span class="text-purple-600">Application</span> Status Distribution
            </h3>
            <div class="relative h-80">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid gap-6 lg:grid-cols-5">
        <!-- Left Column: Recent Job Postings Table -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden flex flex-col h-full">
                <div class="flex justify-between items-center p-6 pb-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="fas fa-briefcase text-emerald-600 mr-2"></i><span class="text-emerald-600">Recent</span> Jobs
                        <span class="ml-2 px-2 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-semibold">{{ $jobCount }}</span>
                    </h3>
                    <a href="{{ route('jobs.index') }}" class="text-emerald-600 text-xs hover:underline font-semibold">View All →</a>
                </div>
                <div class="flex-1 overflow-x-auto">
                    @if($jobCount > 0)
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-emerald-600">Job Title</th>
                                    <th class="px-4 py-3 text-center font-semibold text-emerald-600">Apps</th>
                                    <th class="px-4 py-3 text-center font-semibold text-emerald-600">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($recentJobs as $job)
                                    @php
                                        $statusValue = $job->status instanceof \App\Enums\JobStatus ? $job->status->value : $job->status;
                                    @endphp
                                    <tr class="hover:bg-emerald-50 transition cursor-pointer" onclick="window.location.href='{{ route('jobs.show', $job) }}'">
                                        <td class="px-4 py-3">
                                            <div>
                                                <p class="font-semibold text-gray-900 line-clamp-1">{{ $job->title }}</p>
                                                <p class="text-xs text-gray-500">{{ $job->created_at->format('M d, Y') }}</p>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="inline-flex items-center justify-center px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                                                {{ $job->applications_count ?? 0 }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="px-2 py-1 text-xs rounded-full font-semibold {{ $statusValue === 'open' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ ucfirst($statusValue) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="p-8 text-center">
                            <i class="fas fa-briefcase text-gray-300 text-3xl mb-2 block"></i>
                            <p class="text-gray-500 text-sm">No job postings yet</p>
                            <a href="{{ route('jobs.create') }}" class="text-emerald-600 hover:underline text-xs font-semibold mt-2 inline-block">Create one</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Middle Column: Recent Applications Table -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden flex flex-col h-full">
                <div class="flex justify-between items-center p-6 pb-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="fas fa-inbox text-blue-600 mr-2"></i><span class="text-blue-600">Recent</span> Applications
                        <span class="ml-2 px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">{{ count($recentApplications) }}</span>
                    </h3>
                    <a href="{{ route('employer.applications') }}" class="text-blue-600 text-xs hover:underline font-semibold">View All →</a>
                </div>
                <div class="flex-1 overflow-x-auto">
                    @if(count($recentApplications) > 0)
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-blue-600">Candidate</th>
                                    <th class="px-4 py-3 text-left font-semibold text-blue-600">Position</th>
                                    <th class="px-4 py-3 text-center font-semibold text-blue-600">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($recentApplications as $application)
                                    @php
                                        $statusValue = $application->status instanceof \App\Enums\ApplicationStatus ? $application->status->value : $application->status;
                                    @endphp
                                    <tr class="hover:bg-blue-50 transition cursor-pointer" onclick="window.location.href='{{ route('employer.applications.show', $application) }}'">
                                        <td class="px-4 py-3">
                                            <div>
                                                <p class="font-semibold text-gray-900 line-clamp-1">{{ $application->seeker->name ?? 'Unknown' }}</p>
                                                <p class="text-xs text-gray-500">{{ $application->created_at->format('M d, Y') }}</p>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <p class="text-gray-700 line-clamp-1">{{ $application->job->title ?? 'Unknown Job' }}</p>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="px-2 py-1 text-xs rounded-full font-semibold {{ $statusValue === 'shortlisted' ? 'bg-green-100 text-green-800' : ($statusValue === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                {{ ucfirst(str_replace('_', ' ', $statusValue)) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="p-8 text-center">
                            <i class="fas fa-inbox text-gray-300 text-3xl mb-2 block"></i>
                            <p class="text-gray-500 text-sm">No applications yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column: Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Company Card -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 text-center">
                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-lg bg-gradient-to-br from-emerald-400 to-teal-600 font-serif text-2xl text-white shadow-lg overflow-hidden">
                    @if(auth()->user()->employerProfile && auth()->user()->employerProfile->company_logo)
                        <img src="{{ asset(auth()->user()->employerProfile->company_logo) }}" alt="Company Logo" class="w-full h-full object-cover">
                    @else
                        <i class="fas fa-building"></i>
                    @endif
                </div>
                <h3 class="mt-3 font-semibold text-gray-800 text-sm">{{ auth()->user()->employerProfile->company_name ?? auth()->user()->name }}</h3>
                <p class="text-xs text-emerald-600 font-semibold">{{ auth()->user()->employerProfile->industry ?? 'Industry' }}</p>
                <p class="text-xs text-gray-600">{{ auth()->user()->email }}</p>
                <div class="mt-4">
                    <div class="h-2 w-full overflow-hidden rounded-full bg-gray-200">
                        <div class="h-full rounded-full bg-gradient-to-r from-emerald-600 to-teal-600" style="width: {{ $profileCompletion }}%"></div>
                    </div>
                    <p class="mt-2 text-xs text-gray-600 font-medium"><span class="text-emerald-600 font-bold">Profile</span> {{ $profileCompletion }}% complete</p>
                </div>
                <a href="{{ route('employer.profile.edit') }}" class="mt-4 block w-full px-4 py-2 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold text-sm">
                    <i class="fas fa-edit mr-2"></i>Edit Profile
                </a>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-lightning-bolt text-yellow-600 mr-2"></i><span class="text-yellow-600">Quick</span> Actions
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
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="fas fa-bell text-orange-600 mr-2"></i><span class="text-orange-600">Recent</span> Notifications
                        @if($unreadNotificationsCount > 0)
                            <span class="ml-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold text-white bg-red-600 rounded-full">{{ $unreadNotificationsCount }}</span>
                        @endif
                    </h3>
                    <a href="{{ route('employer.notifications') }}" class="text-orange-600 text-xs hover:underline font-semibold">View All →</a>
                </div>
                <div class="space-y-3 max-h-96 overflow-y-auto pr-2">
                    @forelse($recentNotifications as $notification)
                        <div class="flex items-start gap-3 p-3 rounded-lg transition border {{ !$notification->read_at ? 'border-orange-300 bg-orange-50' : 'border-gray-200 hover:bg-gray-50' }}">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full {{ $notification->type === 'application' ? 'bg-blue-100' : ($notification->type === 'job_closing' ? 'bg-orange-100' : 'bg-purple-100') }}">
                                @if($notification->type === 'application')
                                    <i class="fas fa-envelope text-blue-600"></i>
                                @elseif($notification->type === 'job_closing')
                                    <i class="fas fa-clock text-orange-600"></i>
                                @else
                                    <i class="fas fa-star text-purple-600"></i>
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
                        <div class="text-center py-8">
                            <i class="fas fa-bell text-gray-300 text-3xl mb-2 block"></i>
                            <p class="text-gray-500 text-sm">No notifications</p>
                        </div>
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
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Applications',
                data: [12, 19, 3, 5, 2, 3, 9],
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointBackgroundColor: '#10b981',
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
    
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Shortlisted', 'Pending', 'Rejected', 'Hired'],
            datasets: [{
                data: [{{ $shortlistedCount }}, {{ $pendingCount }}, {{ $rejectedCount }}, 0],
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
