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

    <!-- Saved Jobs Grid -->
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
@endsection
