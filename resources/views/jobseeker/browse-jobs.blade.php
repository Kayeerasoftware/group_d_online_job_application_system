@extends('layouts.jobseeker')

@section('title', 'Browse Jobs')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg shadow-lg p-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Browse Jobs</h1>
                <p class="text-blue-100">Discover opportunities that match your skills</p>
            </div>
            <div class="text-right">
                <p class="text-3xl font-bold text-white">{{ $jobs->total() }}</p>
                <p class="text-blue-100 text-sm">Open Positions</p>
            </div>
        </div>
    </div>

    <!-- Search & Filters -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <form method="GET" action="{{ route('seeker.browse-jobs') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Job title, company..." class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Location</label>
                    <input type="text" name="location" value="{{ request('location') }}" placeholder="City or Remote" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Job Type</label>
                    <select name="job_type" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                        <option value="">All Types</option>
                        <option value="full-time" @selected(request('job_type') === 'full-time')>Full-time</option>
                        <option value="part-time" @selected(request('job_type') === 'part-time')>Part-time</option>
                        <option value="contract" @selected(request('job_type') === 'contract')>Contract</option>
                        <option value="internship" @selected(request('job_type') === 'internship')>Internship</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Min Salary</label>
                    <input type="number" name="salary_min" value="{{ request('salary_min') }}" placeholder="UGX" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Max Salary</label>
                    <input type="number" name="salary_max" value="{{ request('salary_max') }}" placeholder="UGX" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                </div>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                    <i class="fas fa-search mr-2"></i>Search
                </button>
                <a href="{{ route('seeker.browse-jobs') }}" class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition">
                    <i class="fas fa-redo mr-2"></i>Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Jobs Grid -->
    @if($jobs->count() > 0)
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @foreach($jobs as $job)
        @php
            $jobType = $job->job_type instanceof \App\Enums\JobType ? $job->job_type->value : $job->job_type;
        @endphp
        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition p-6 border-l-4 border-blue-600">
            <div class="flex items-start justify-between gap-4 mb-4">
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $job->title }}</h3>
                    <p class="text-gray-600 font-semibold">{{ $job->employer->name }}</p>
                </div>
                <button type="button" onclick="toggleSaveJob({{ $job->id }})" class="text-2xl transition {{ in_array($job->id, $savedJobIds) ? 'text-yellow-400' : 'text-gray-300 hover:text-yellow-400' }}">
                    <i class="fas fa-bookmark"></i>
                </button>
            </div>

            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $job->description }}</p>

            <div class="flex flex-wrap gap-2 mb-4">
                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                    <i class="fas fa-briefcase mr-1"></i>{{ ucfirst($jobType) }}
                </span>
                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                    <i class="fas fa-map-marker-alt mr-1"></i>{{ $job->location }}
                </span>
                @if($job->salary_min && $job->salary_max)
                <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">
                    <i class="fas fa-money-bill-wave mr-1"></i>UGX {{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }}
                </span>
                @endif
            </div>

            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                <div class="flex gap-4 text-sm text-gray-600">
                    <span><i class="fas fa-eye mr-1"></i>{{ $job->views_count ?? 0 }} views</span>
                    <span><i class="fas fa-users mr-1"></i>{{ $job->applications_count ?? 0 }} applied</span>
                </div>
                <a href="{{ route('jobs.show', $job) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition text-sm">
                    View Details
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $jobs->links() }}
    </div>
    @else
    <div class="bg-white rounded-xl shadow-lg p-12 text-center">
        <i class="fas fa-search text-6xl text-gray-300 mb-4 block"></i>
        <h3 class="text-2xl font-bold text-gray-900 mb-2">No jobs found</h3>
        <p class="text-gray-600 mb-6">Try adjusting your search filters or check back later for new opportunities</p>
        <a href="{{ route('seeker.browse-jobs') }}" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
            <i class="fas fa-redo mr-2"></i>Clear Filters
        </a>
    </div>
    @endif
</div>

<script>
function toggleSaveJob(jobId) {
    // This would typically make an AJAX request to save/unsave the job
    console.log('Toggle save job:', jobId);
}
</script>
@endsection
