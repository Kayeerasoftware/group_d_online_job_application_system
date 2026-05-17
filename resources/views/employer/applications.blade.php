@extends('layouts.employer')

@section('title', 'Applications')

@section('content')
<div class="bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg shadow-lg p-3 md:p-4 mb-4 md:mb-6">
        <div class="flex items-center justify-between gap-2">
            <div class="flex items-center gap-3 flex-1 min-w-0">
                <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl overflow-hidden bg-white shadow-lg flex-shrink-0 flex items-center justify-center">
                    <i class="fas fa-inbox text-blue-600 text-2xl"></i>
                </div>
                <div class="min-w-0">
                    <h1 class="text-sm sm:text-lg md:text-2xl font-bold text-white truncate">Applications</h1>
                    <p class="text-blue-100 text-xs sm:text-sm mt-0.5 md:mt-1">Manage and review job applications</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-blue-500 to-blue-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-blue-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Applications...</span>
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
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Total</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $totalApplications ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <!-- Pending Applications -->
        <div class="bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-yellow-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-clock text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Pending</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $pendingApplications ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <!-- Shortlisted -->
        <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-green-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-green-500 to-green-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-check-circle text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Shortlisted</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $shortlistedApplications ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <!-- Rejected -->
        <div class="bg-gradient-to-r from-red-50 to-red-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-red-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-red-500 to-red-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-times-circle text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Rejected</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $rejectedApplications ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white rounded-xl shadow-md p-4 md:p-6 mb-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-filter text-blue-600 mr-2"></i>Filter Applications
        </h3>
        <form method="GET" action="{{ route('employer.applications') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search Candidate</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Candidate name..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Job Position</label>
                    <select name="job_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">All Jobs</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="shortlisted" {{ request('status') === 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                        <i class="fas fa-search mr-2"></i>Search
                    </button>
                    <a href="{{ route('employer.applications') }}" class="flex-1 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium text-center">
                        Clear
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Applications List -->
    <div class="space-y-4">
        @forelse($applications ?? [] as $application)
            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition overflow-hidden border border-gray-200">
                <div class="p-4 md:p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                    <span class="text-lg font-bold text-blue-600">{{ strtoupper(substr($application->seeker->name ?? 'U', 0, 1)) }}</span>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">{{ $application->seeker->name ?? 'Unknown' }}</h3>
                                    <p class="text-sm text-gray-600">{{ $application->seeker->email ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        @php
                            $statusValue = $application->status instanceof \App\Enums\ApplicationStatus ? $application->status->value : $application->status;
                            $statusClass = $statusValue == 'shortlisted' ? 'bg-green-100 text-green-800' : ($statusValue == 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800');
                        @endphp
                        <span class="px-4 py-2 rounded-full text-sm font-semibold {{ $statusClass }}">
                            {{ ucfirst($statusValue) }}
                        </span>
                    </div>

                    <!-- Application Details -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4 pb-4 border-b border-gray-200">
                        <div>
                            <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Position</p>
                            <p class="text-sm font-semibold text-gray-900 mt-1">{{ $application->job->title ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Applied</p>
                            <p class="text-sm font-semibold text-gray-900 mt-1">{{ $application->created_at->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Phone</p>
                            <p class="text-sm font-semibold text-gray-900 mt-1">{{ $application->seeker->phone ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Experience</p>
                            <p class="text-sm font-semibold text-gray-900 mt-1">{{ $application->seeker->seekerProfile->experience_level ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-2 flex-wrap">
                        <a href="{{ route('employer.applications.show', $application) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium text-sm">
                            <i class="fas fa-eye mr-2"></i>View Details
                        </a>
                        @if($statusValue !== 'shortlisted')
                            <form action="{{ route('employer.applications.status', $application) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="shortlisted">
                                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium text-sm">
                                    <i class="fas fa-check mr-2"></i>Shortlist
                                </button>
                            </form>
                        @endif
                        @if($statusValue !== 'rejected')
                            <form action="{{ route('employer.applications.status', $application) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium text-sm">
                                    <i class="fas fa-times mr-2"></i>Reject
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl shadow-md p-12 text-center">
                <i class="fas fa-inbox text-gray-400 text-5xl mb-4 block"></i>
                <h3 class="text-xl font-bold text-gray-900 mb-2">No Applications</h3>
                <p class="text-gray-600">You don't have any applications yet. Post a job to start receiving applications.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if(isset($applications) && $applications->hasPages())
        <div class="flex justify-center mt-8">
            {{ $applications->links() }}
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
