@extends('layouts.employer')

@section('title', 'My Jobs')

@section('content')
<div class="bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-emerald-600 to-teal-600 rounded-lg shadow-lg p-3 md:p-4 mb-4 md:mb-6">
        <div class="flex items-center justify-between gap-2">
            <div class="flex items-center gap-3 flex-1 min-w-0">
                <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl overflow-hidden bg-white shadow-lg flex-shrink-0 flex items-center justify-center">
                    <i class="fas fa-briefcase text-emerald-600 text-2xl"></i>
                </div>
                <div class="min-w-0">
                    <h1 class="text-sm sm:text-lg md:text-2xl font-bold text-white truncate">My Job Postings</h1>
                    <p class="text-emerald-100 text-xs sm:text-sm mt-0.5 md:mt-1">Manage and track your job listings</p>
                </div>
            </div>
            <a href="{{ route('jobs.create') }}" class="px-4 py-2 bg-white text-emerald-600 rounded-lg hover:bg-gray-100 transition font-semibold text-sm flex-shrink-0">
                <i class="fas fa-plus mr-2"></i>Post New Job
            </a>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-green-500 to-green-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-green-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Jobs...</span>
    </div>

    <!-- Jobs List -->
    <div class="space-y-4">
        @forelse($jobs as $job)
            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition overflow-hidden border-l-4 border-emerald-600">
                <div class="p-4 md:p-6">
                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-4">
                        <div class="flex-1">
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-1">{{ $job->title }}</h3>
                            <p class="text-gray-600 text-sm mb-2">{{ $job->location }}</p>
                            <p class="text-gray-600 text-sm line-clamp-2">{{ $job->description }}</p>
                        </div>
                        <div class="flex flex-col items-end gap-2">
                            <span class="px-3 py-1 text-xs rounded-full font-semibold {{ ($job->status instanceof \App\Enums\JobStatus ? $job->status->value : $job->status) == 'open' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($job->status instanceof \App\Enums\JobStatus ? $job->status->value : $job->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Job Stats -->
                    <div class="grid grid-cols-3 md:grid-cols-6 gap-3 mb-4 pb-4 border-b border-gray-200">
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Applications</p>
                            <p class="text-lg font-bold text-gray-900">{{ $job->applications_count ?? 0 }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Views</p>
                            <p class="text-lg font-bold text-gray-900">{{ $job->views_count ?? 0 }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Posted</p>
                            <p class="text-lg font-bold text-gray-900">{{ $job->created_at->format('M d') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Salary</p>
                            <p class="text-lg font-bold text-gray-900">${{ number_format($job->salary_min ?? 0) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Type</p>
                            <p class="text-lg font-bold text-gray-900">{{ ucfirst($job->job_type instanceof \App\Enums\JobType ? $job->job_type->value : $job->job_type) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Deadline</p>
                            @if($job->deadline)
                                <p class="text-lg font-bold text-gray-900">{{ $job->deadline->diffForHumans() }}</p>
                            @else
                                <p class="text-lg font-bold text-gray-900">N/A</p>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-2 flex-wrap">
                        <a href="{{ route('jobs.show', $job) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium text-sm">
                            <i class="fas fa-eye mr-2"></i>View
                        </a>
                        <a href="{{ route('jobs.edit', $job) }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-medium text-sm">
                            <i class="fas fa-edit mr-2"></i>Edit
                        </a>
                        <a href="{{ route('employer.applications') }}?job_id={{ $job->id }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition font-medium text-sm">
                            <i class="fas fa-inbox mr-2"></i>Applications ({{ $job->applications_count ?? 0 }})
                        </a>
                        <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium text-sm">
                                <i class="fas fa-trash mr-2"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl shadow-md p-12 text-center">
                <i class="fas fa-briefcase text-gray-400 text-5xl mb-4 block"></i>
                <h3 class="text-xl font-bold text-gray-900 mb-2">No Job Postings</h3>
                <p class="text-gray-600 mb-4">You haven't posted any jobs yet. Start by creating your first job posting.</p>
                <a href="{{ route('jobs.create') }}" class="inline-block px-6 py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-semibold">
                    <i class="fas fa-plus mr-2"></i>Post Your First Job
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($jobs->hasPages())
        <div class="flex justify-center mt-8">
            {{ $jobs->links() }}
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
