@extends('layouts.jobseeker')

@section('title', 'Saved Jobs')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-yellow-600 to-orange-600 rounded-lg shadow-lg p-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Saved Jobs</h1>
                <p class="text-yellow-100">Your collection of interesting opportunities</p>
            </div>
            <div class="text-right">
                <p class="text-3xl font-bold text-white">{{ $savedJobs->total() }}</p>
                <p class="text-yellow-100 text-sm">Saved</p>
            </div>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-6">
        <div class="h-full bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-yellow-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Saved Jobs...</span>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-3 mb-6">
        <!-- Total Saved -->
        <div class="bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-yellow-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-bookmark text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Total Saved</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $savedJobs->total() }}</h3>
                </div>
            </div>
        </div>

        <!-- Full-time -->
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-blue-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-briefcase text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Full-time</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $metrics['fullTime'] }}</h3>
                </div>
            </div>
        </div>

        <!-- Part-time -->
        <div class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-purple-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-clock text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Part-time</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $metrics['partTime'] }}</h3>
                </div>
            </div>
        </div>

        <!-- Remote -->
        <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-green-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-green-500 to-green-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-map-marker-alt text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Remote</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $metrics['remote'] }}</h3>
                </div>
            </div>
        </div>
    </div>
    @if($savedJobs->count() > 0)
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @foreach($savedJobs as $savedJob)
        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition p-6 border-l-4 border-yellow-500">
            <div class="flex items-start justify-between gap-4 mb-4">
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $savedJob->job->title }}</h3>
                    <p class="text-gray-600 font-semibold">{{ $savedJob->job->employer->name }}</p>
                </div>
                <form action="{{ route('seeker.saved-jobs.destroy', $savedJob) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-2xl text-yellow-400 hover:text-yellow-500 transition" title="Remove from saved">
                        <i class="fas fa-bookmark"></i>
                    </button>
                </form>
            </div>

            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $savedJob->job->description }}</p>

            <div class="flex flex-wrap gap-2 mb-4">
                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                    <i class="fas fa-briefcase mr-1"></i>{{ ucfirst($savedJob->job->job_type) }}
                </span>
                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                    <i class="fas fa-map-marker-alt mr-1"></i>{{ $savedJob->job->location }}
                </span>
                @if($savedJob->job->salary_min && $savedJob->job->salary_max)
                <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">
                    <i class="fas fa-money-bill-wave mr-1"></i>UGX {{ number_format($savedJob->job->salary_min) }} - {{ number_format($savedJob->job->salary_max) }}
                </span>
                @endif
            </div>

            <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                <p class="text-xs text-gray-600">
                    <i class="fas fa-calendar mr-2"></i>Saved on {{ $savedJob->created_at->format('M d, Y') }}
                </p>
                @if($savedJob->job->deadline)
                <p class="text-xs text-gray-600 mt-1">
                    <i class="fas fa-hourglass-end mr-2"></i>Deadline: {{ $savedJob->job->deadline->format('M d, Y') }}
                </p>
                @endif
            </div>

            <div class="flex gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('jobs.show', $savedJob->job) }}" class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition text-center text-sm">
                    View Details
                </a>
                <a href="{{ route('applications.create', ['job_id' => $savedJob->job->id]) }}" class="flex-1 px-4 py-2 bg-yellow-600 text-white rounded-lg font-semibold hover:bg-yellow-700 transition text-center text-sm">
                    <i class="fas fa-paper-plane mr-1"></i>Apply Now
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $savedJobs->links() }}
    </div>
    @else
    <div class="bg-white rounded-xl shadow-lg p-12 text-center">
        <i class="fas fa-bookmark text-6xl text-gray-300 mb-4 block"></i>
        <h3 class="text-2xl font-bold text-gray-900 mb-2">No saved jobs yet</h3>
        <p class="text-gray-600 mb-6">Save jobs you're interested in to view them later</p>
        <a href="{{ route('seeker.browse-jobs') }}" class="inline-block px-6 py-3 bg-yellow-600 text-white rounded-lg font-semibold hover:bg-yellow-700 transition">
            <i class="fas fa-search mr-2"></i>Browse Jobs
        </a>
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
