@extends('layouts.employer')

@section('title', $job->title)

@section('content')
<div class="space-y-6 p-3 md:p-6">
    <!-- Job Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg shadow-lg p-6">
        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
            <div class="flex-1">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">{{ $job->title }}</h1>
                <p class="text-blue-100 text-lg mb-4">{{ $job->location }}</p>
                <p class="text-blue-100 line-clamp-2">{{ $job->description }}</p>
            </div>
            <div class="flex flex-col gap-3 md:flex-shrink-0">
                <a href="{{ route('jobs.edit', $job) }}" class="px-6 py-3 bg-white text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition text-center">
                    <i class="fas fa-edit mr-2"></i>Edit Job
                </a>
                <span class="px-6 py-3 bg-blue-500 text-white rounded-lg font-semibold text-center cursor-default">
                    <i class="fas fa-{{ $job->status instanceof \App\Enums\JobStatus ? ($job->status->value === 'open' ? 'unlock' : 'lock') : ($job->status === 'open' ? 'unlock' : 'lock') }} mr-2"></i>{{ ucfirst($job->status instanceof \App\Enums\JobStatus ? $job->status->value : $job->status) }}
                </span>
            </div>
        </div>
    </div>

    <!-- Key Information Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 md:gap-4">
        <div class="bg-white rounded-lg shadow-md p-4">
            <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Job Type</p>
            <p class="text-lg font-bold text-gray-900 mt-2">{{ ucfirst($job->job_type instanceof \App\Enums\JobType ? $job->job_type->value : ($job->job_type ?? 'N/A')) }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4">
            <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Applications</p>
            <p class="text-lg font-bold text-gray-900 mt-2">{{ $job->applications_count ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4">
            <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Views</p>
            <p class="text-lg font-bold text-gray-900 mt-2">{{ $job->views_count ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4">
            <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Deadline</p>
            <p class="text-lg font-bold text-gray-900 mt-2">{{ optional($job->deadline)->format('M d, Y') ?? 'N/A' }}</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Overview Stats -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-chart-bar text-blue-600 mr-3"></i>Overview
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-4 border border-green-200">
                        <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Salary Range</p>
                        <p class="text-lg font-bold text-green-700 mt-2">
                            @if($job->salary_min && $job->salary_max)
                                UGX {{ number_format((int)$job->salary_min) }} - {{ number_format((int)$job->salary_max) }}
                            @elseif($job->salary_min)
                                From UGX {{ number_format((int)$job->salary_min) }}
                            @elseif($job->salary_max)
                                Up to UGX {{ number_format((int)$job->salary_max) }}
                            @else
                                Not specified
                            @endif
                        </p>
                    </div>
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-4 border border-blue-200">
                        <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Views</p>
                        <p class="text-lg font-bold text-blue-700 mt-2">{{ number_format($job->views_count ?? 0) }}</p>
                    </div>
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-4 border border-purple-200">
                        <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Applications</p>
                        <p class="text-lg font-bold text-purple-700 mt-2">{{ number_format($job->applications_count ?? 0) }}</p>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-file-alt text-blue-600 mr-3"></i>Job Description
                </h2>
                <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed whitespace-pre-line">
                    {{ $job->description }}
                </div>
            </div>

            <!-- Requirements -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-list-check text-blue-600 mr-3"></i>Requirements
                </h2>
                <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed whitespace-pre-line">
                    {{ $job->requirements }}
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="space-y-6">
            <!-- Job Statistics -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-chart-line text-blue-600 mr-3"></i>Statistics
                </h2>
                <div class="space-y-4">
                    <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                        <span class="text-gray-600 font-medium">Total Applications</span>
                        <span class="text-2xl font-bold text-blue-600">{{ $job->applications_count ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                        <span class="text-gray-600 font-medium">Total Views</span>
                        <span class="text-2xl font-bold text-green-600">{{ $job->views_count ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 font-medium">Posted Date</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $job->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Job Details -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-blue-600 mr-3"></i>Job Details
                </h2>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Location</p>
                        <p class="text-lg font-bold text-gray-900 mt-1">{{ $job->location }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Job Type</p>
                        <p class="text-lg font-bold text-gray-900 mt-1">{{ ucfirst($job->job_type instanceof \App\Enums\JobType ? $job->job_type->value : ($job->job_type ?? 'N/A')) }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Status</p>
                        <p class="text-lg font-bold text-gray-900 mt-1">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $job->status instanceof \App\Enums\JobStatus ? ($job->status->value === 'open' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800') : ($job->status === 'open' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ ucfirst($job->status instanceof \App\Enums\JobStatus ? $job->status->value : $job->status) }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Application Deadline</p>
                        <p class="text-lg font-bold text-gray-900 mt-1">{{ optional($job->deadline)->format('F d, Y') ?? 'No deadline' }}</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-bolt text-yellow-500 mr-2"></i>Quick Actions
                </h3>
                <div class="space-y-3">
                    <a href="{{ route('jobs.edit', $job) }}" class="w-full px-4 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition text-center flex items-center justify-center gap-2">
                        <i class="fas fa-edit"></i>Edit Job
                    </a>
                    <a href="{{ route('employer.applications') }}?job_id={{ $job->id }}" class="w-full px-4 py-3 bg-purple-600 text-white rounded-lg font-semibold hover:bg-purple-700 transition text-center flex items-center justify-center gap-2">
                        <i class="fas fa-inbox"></i>View Applications ({{ $job->applications_count ?? 0 }})
                    </a>
                    <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="w-full" onsubmit="return confirm('Are you sure you want to delete this job?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-3 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition flex items-center justify-center gap-2">
                            <i class="fas fa-trash"></i>Delete Job
                        </button>
                    </form>
                </div>
            </div>

            <!-- Back Button -->
            <div>
                <a href="{{ route('jobs.index') }}" class="w-full px-4 py-3 bg-gray-200 text-gray-800 rounded-lg font-semibold hover:bg-gray-300 transition text-center flex items-center justify-center gap-2">
                    <i class="fas fa-arrow-left"></i>Back to Jobs
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
