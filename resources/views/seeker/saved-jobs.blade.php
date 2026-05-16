@extends('layouts.jobseeker')

@section('title', 'Saved Jobs')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
            <div class="flex items-center gap-2 md:gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-pink-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-purple-600 to-pink-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                        <i class="fas fa-bookmark text-white text-xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-purple-600 via-pink-600 to-red-600 bg-clip-text text-transparent mb-1 md:mb-2">Saved Jobs</h1>
                    <p class="text-gray-600 text-xs md:text-sm font-medium">Your collection of interesting job opportunities</p>
                </div>
            </div>
            <div class="flex gap-1.5 md:gap-2 w-full md:w-auto">
                <a href="{{ route('jobs.index') }}" class="flex-1 md:flex-none px-3 md:px-5 py-2 md:py-2.5 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg md:rounded-xl hover:shadow-lg transition-all duration-300 text-xs md:text-sm font-bold flex items-center justify-center gap-1 md:gap-2 transform hover:scale-105">
                    <i class="fas fa-search"></i><span class="hidden sm:inline">Browse Jobs</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-green-500 to-green-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-green-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Saved Jobs...</span>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-3 gap-2 md:gap-3 mb-3 md:mb-4">
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-[8px] md:text-[10px] font-medium mb-0.5">Total Saved</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $savedJobs->count() }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-bookmark text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-[8px] md:text-[10px] font-medium mb-0.5">Closing Soon</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $closingSoon }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-clock text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-[8px] md:text-[10px] font-medium mb-0.5">Active</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $activeJobs }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-check-circle text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="bg-gradient-to-br from-purple-50 via-pink-50 to-red-50 rounded-2xl shadow-lg border border-purple-100 overflow-hidden mb-4">
        <form method="GET" action="{{ route('seeker.saved-jobs') }}">
            <div class="bg-white/60 backdrop-blur-sm p-3">
                <div class="bg-white/80 rounded-xl p-2.5 border border-purple-100">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-2">
                        <div class="md:col-span-4 relative">
                            <i class="fas fa-search absolute left-2.5 top-1/2 transform -translate-y-1/2 text-purple-400 text-xs"></i>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search saved jobs..." class="w-full pl-8 pr-2 py-1.5 text-xs border border-purple-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all bg-white">
                        </div>
                        <div class="md:col-span-3 relative">
                            <i class="fas fa-briefcase absolute left-2.5 top-1/2 transform -translate-y-1/2 text-pink-400 text-xs"></i>
                            <select name="category" class="w-full pl-8 pr-2 py-1.5 text-xs border border-pink-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all appearance-none bg-white">
                                <option value="">All Categories</option>
                                <option value="technology" {{ request('category') == 'technology' ? 'selected' : '' }}>Technology</option>
                                <option value="finance" {{ request('category') == 'finance' ? 'selected' : '' }}>Finance</option>
                                <option value="healthcare" {{ request('category') == 'healthcare' ? 'selected' : '' }}>Healthcare</option>
                                <option value="education" {{ request('category') == 'education' ? 'selected' : '' }}>Education</option>
                            </select>
                        </div>
                        <div class="md:col-span-2 relative">
                            <i class="fas fa-calendar absolute left-2.5 top-1/2 transform -translate-y-1/2 text-red-400 text-xs"></i>
                            <select name="sort" class="w-full pl-8 pr-2 py-1.5 text-xs border border-red-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all appearance-none bg-white">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                                <option value="closing" {{ request('sort') == 'closing' ? 'selected' : '' }}>Closing Soon</option>
                            </select>
                        </div>
                        <div class="md:col-span-3 flex gap-1.5">
                            <button type="submit" class="flex-1 px-2 py-1.5 text-xs bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold">
                                <i class="fas fa-search mr-1"></i>Search
                            </button>
                            <a href="{{ route('seeker.saved-jobs') }}" class="px-2 py-1.5 text-xs bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 rounded-lg hover:shadow-md transition-all duration-300 font-semibold">
                                <i class="fas fa-redo"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Saved Jobs Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($savedJobs as $savedJob)
        <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 group">
            <!-- Job Header -->
            <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-4 border-b border-gray-100">
                <div class="flex items-start justify-between gap-2">
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-gray-900 group-hover:text-purple-600 transition">{{ $savedJob->job->title }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $savedJob->job->company_name }}</p>
                    </div>
                    <form action="{{ route('seeker.saved-jobs.destroy', $savedJob) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 transition" title="Remove from saved">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Job Details -->
            <div class="p-4 space-y-3">
                <div class="flex items-center gap-2 text-sm text-gray-600">
                    <i class="fas fa-map-marker-alt text-purple-600"></i>
                    <span>{{ $savedJob->job->location ?? 'Remote' }}</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-600">
                    <i class="fas fa-briefcase text-purple-600"></i>
                    <span>{{ $savedJob->job->job_type ?? 'Full-time' }}</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-600">
                    <i class="fas fa-dollar-sign text-purple-600"></i>
                    <span>{{ $savedJob->job->salary_range ?? 'Competitive' }}</span>
                </div>

                <!-- Deadline Status -->
                @php
                    $daysUntilDeadline = now()->diffInDays($savedJob->job->deadline, false);
                @endphp
                <div class="pt-2 border-t border-gray-100">
                    @if($daysUntilDeadline <= 0)
                        <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">
                            <i class="fas fa-times-circle"></i>Closed
                        </span>
                    @elseif($daysUntilDeadline <= 7)
                        <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-medium bg-orange-100 text-orange-800 rounded-full">
                            <i class="fas fa-clock"></i>Closing in {{ $daysUntilDeadline }} days
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                            <i class="fas fa-check-circle"></i>{{ $daysUntilDeadline }} days left
                        </span>
                    @endif
                </div>
            </div>

            <!-- Actions -->
            <div class="px-4 py-3 bg-gray-50 border-t border-gray-100 flex gap-2">
                <a href="{{ route('jobs.show', $savedJob->job) }}" class="flex-1 px-3 py-2 text-xs font-semibold text-center bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:shadow-lg transition-all duration-300">
                    <i class="fas fa-eye mr-1"></i>View Job
                </a>
                <a href="{{ route('seeker.applications') }}" class="flex-1 px-3 py-2 text-xs font-semibold text-center bg-white text-purple-600 border border-purple-200 rounded-lg hover:bg-purple-50 transition-all duration-300">
                    <i class="fas fa-paper-plane mr-1"></i>Apply
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full">
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center border border-gray-100">
                <i class="fas fa-bookmark text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-900 mb-2">No Saved Jobs Yet</h3>
                <p class="text-gray-600 mb-6">Start saving jobs to keep track of opportunities that interest you</p>
                <a href="{{ route('jobs.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold">
                    <i class="fas fa-search"></i>Browse Jobs
                </a>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($savedJobs->hasPages())
    <div class="mt-6 flex justify-center">
        {{ $savedJobs->links() }}
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
