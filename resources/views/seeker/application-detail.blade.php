@extends('layouts.jobseeker')

@section('title', 'Application Details')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-teal-600 to-cyan-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-teal-600 to-cyan-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                        <i class="fas fa-file-alt text-white text-xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Application Details</h1>
                    <p class="text-gray-600 text-sm font-medium">Track your application progress</p>
                </div>
            </div>
            <a href="{{ route('seeker.applications') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-300 transition">
                <i class="fas fa-arrow-left"></i>Back
            </a>
        </div>
    </div>

    <!-- Job Header Card -->
    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 border border-gray-100 mb-6">
        <div class="flex flex-col md:flex-row items-start justify-between gap-6 mb-6">
            <div class="flex-1">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">{{ $application->job->title }}</h2>
                <p class="text-xl text-teal-600 font-semibold mb-4">{{ $application->job->employer?->employerProfile?->company_name ?? $application->job->employer?->name ?? 'N/A' }}</p>
                <div class="flex flex-wrap gap-4">
                    <span class="inline-flex items-center gap-2 text-gray-600">
                        <i class="fas fa-map-marker-alt text-teal-600 text-lg"></i>
                        <span class="font-medium">{{ $application->job->location }}</span>
                    </span>
                    @if($application->job->job_type)
                    <span class="inline-flex items-center gap-2 text-gray-600">
                        <i class="fas fa-briefcase text-teal-600 text-lg"></i>
                        <span class="font-medium">{{ ucfirst($application->job->job_type->value) }}</span>
                    </span>
                    @endif
                    @if($application->job->salary_min && $application->job->salary_max)
                    <span class="inline-flex items-center gap-2 text-gray-600">
                        <i class="fas fa-dollar-sign text-teal-600 text-lg"></i>
                        <span class="font-medium">UGX {{ number_format((int)$application->job->salary_min) }} - {{ number_format((int)$application->job->salary_max) }}</span>
                    </span>
                    @endif
                </div>
            </div>
            <span class="inline-flex items-center rounded-full px-6 py-3 text-lg font-bold whitespace-nowrap
                @if($application->status->value === 'pending') bg-yellow-100 text-yellow-800
                @elseif($application->status->value === 'reviewed') bg-blue-100 text-blue-800
                @elseif($application->status->value === 'shortlisted') bg-green-100 text-green-800
                @elseif($application->status->value === 'hired') bg-purple-100 text-purple-800
                @elseif($application->status->value === 'rejected') bg-red-100 text-red-800
                @endif">
                <i class="fas fa-circle text-xs mr-2"></i>
                {{ ucfirst($application->status->value) }}
            </span>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-3 gap-4 pt-6 border-t border-gray-200">
            <div class="text-center">
                <p class="text-xs text-gray-600 font-semibold uppercase">Applied</p>
                <p class="text-2xl font-bold text-gray-900 mt-2">{{ $application->created_at->format('M d') }}</p>
                <p class="text-xs text-gray-500">{{ $application->created_at->format('Y') }}</p>
            </div>
            <div class="text-center">
                <p class="text-xs text-gray-600 font-semibold uppercase">Time Elapsed</p>
                <p class="text-2xl font-bold text-gray-900 mt-2">
                    @php
                        $diff = $application->created_at->diff(now());
                        if ($diff->days > 0) {
                            echo $diff->days;
                            $unit = 'day';
                        } elseif ($diff->h > 0) {
                            echo $diff->h;
                            $unit = 'hour';
                        } else {
                            echo $diff->i;
                            $unit = 'minute';
                        }
                    @endphp
                </p>
                <p class="text-xs text-gray-500">{{ $unit }}{{ ($unit === 'day' && $diff->days > 1) || ($unit === 'hour' && $diff->h > 1) || ($unit === 'minute' && $diff->i > 1) ? 's' : '' }} ago</p>
            </div>
            <div class="text-center">
                <p class="text-xs text-gray-600 font-semibold uppercase">Last Updated</p>
                <p class="text-2xl font-bold text-gray-900 mt-2">{{ $application->updated_at->format('M d') }}</p>
                <p class="text-xs text-gray-500">{{ $application->updated_at->diffForHumans() }}</p>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid gap-6 lg:grid-cols-3">
        <!-- Left Column - Application Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Application Timeline -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="font-bold text-gray-900 mb-4 text-lg flex items-center">
                    <i class="fas fa-tasks text-teal-600 mr-3"></i>Application Timeline
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-teal-600 text-white font-bold text-sm flex-shrink-0">
                            <i class="fas fa-check"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Applied</p>
                            <p class="text-sm text-gray-600">{{ $application->created_at->format('M d, Y \a\t h:i A') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full {{ $application->status->value !== 'pending' ? 'bg-teal-600 text-white' : 'bg-gray-200 text-gray-600' }} font-bold text-sm flex-shrink-0">
                            <i class="fas fa-{{ $application->status->value !== 'pending' ? 'check' : 'clock' }}"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Under Review</p>
                            <p class="text-sm text-gray-600">{{ $application->status->value !== 'pending' ? 'Completed' : 'In progress' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full {{ in_array($application->status->value, ['shortlisted', 'hired']) ? 'bg-teal-600 text-white' : 'bg-gray-200 text-gray-600' }} font-bold text-sm flex-shrink-0">
                            <i class="fas fa-{{ in_array($application->status->value, ['shortlisted', 'hired']) ? 'check' : 'star' }}"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Shortlisted</p>
                            <p class="text-sm text-gray-600">{{ in_array($application->status->value, ['shortlisted', 'hired']) ? 'Completed' : 'Pending' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full {{ $application->status->value === 'hired' ? 'bg-teal-600 text-white' : 'bg-gray-200 text-gray-600' }} font-bold text-sm flex-shrink-0">
                            <i class="fas fa-{{ $application->status->value === 'hired' ? 'check' : 'handshake' }}"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Hired</p>
                            <p class="text-sm text-gray-600">{{ $application->status->value === 'hired' ? 'Completed' : 'Pending' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cover Letter -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="font-bold text-gray-900 mb-4 text-lg flex items-center">
                    <i class="fas fa-pen-fancy text-teal-600 mr-3"></i>Cover Letter
                </h3>
                <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 text-sm text-gray-700 whitespace-pre-wrap max-h-64 overflow-y-auto">
                    {{ $application->cover_letter ?? 'No cover letter provided' }}
                </div>
            </div>

            <!-- Submitted CV -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="font-bold text-gray-900 mb-4 text-lg flex items-center">
                    <i class="fas fa-file-pdf text-teal-600 mr-3"></i>Submitted CV
                </h3>
                @if($application->cv_path)
                <div class="flex items-center gap-4 rounded-lg border border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100 p-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-red-100 flex-shrink-0">
                        <i class="fas fa-file-pdf text-2xl text-red-600"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ basename($application->cv_path) }}</p>
                        <p class="text-xs text-gray-600">Uploaded {{ $application->created_at->format('M d, Y') }}</p>
                    </div>
                    <a href="{{ asset($application->cv_path) }}" target="_blank" class="rounded-lg border border-teal-300 bg-white px-4 py-2 text-sm font-semibold text-teal-600 hover:bg-teal-50 transition flex items-center gap-2 flex-shrink-0">
                        <i class="fas fa-download"></i>Download
                    </a>
                </div>
                @else
                <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
                    <p class="text-sm text-gray-600"><i class="fas fa-info-circle mr-2 text-gray-400"></i>No CV was attached to this application</p>
                </div>
                @endif
            </div>

            <!-- Employer Notes -->
            <div class="bg-blue-50 rounded-xl border border-blue-200 p-6">
                <h3 class="font-bold text-blue-900 mb-3 text-lg flex items-center">
                    <i class="fas fa-comment text-blue-600 mr-3"></i>Employer Notes
                </h3>
                @if($application->employer_notes)
                    <p class="text-sm text-blue-800 whitespace-pre-wrap">{{ $application->employer_notes }}</p>
                @else
                    <p class="text-sm text-blue-600 italic"><i class="fas fa-info-circle mr-2"></i>No notes from employer yet</p>
                @endif
            </div>

            <!-- Job Description -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="font-bold text-gray-900 mb-4 text-lg flex items-center">
                    <i class="fas fa-book text-teal-600 mr-3"></i>Job Description
                </h3>
                <div class="prose prose-sm max-w-none text-gray-700 mb-4">
                    {!! nl2br(e($application->job->description)) !!}
                </div>
                <div class="pt-4 border-t border-gray-200">
                    <a href="{{ route('seeker.jobs.show', $application->job) }}" class="inline-flex items-center gap-2 text-sm font-semibold text-teal-600 hover:text-teal-800 transition">
                        View full job posting <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Column - Sidebar -->
        <div class="space-y-6">
            <!-- Status Card -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="font-bold text-gray-900 mb-4 text-lg">Current Status</h3>
                <div class="text-center mb-4">
                    <span class="inline-flex items-center rounded-full px-6 py-3 text-lg font-bold
                        @if($application->status->value === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($application->status->value === 'reviewed') bg-blue-100 text-blue-800
                        @elseif($application->status->value === 'shortlisted') bg-green-100 text-green-800
                        @elseif($application->status->value === 'hired') bg-purple-100 text-purple-800
                        @elseif($application->status->value === 'rejected') bg-red-100 text-red-800
                        @endif">
                        {{ ucfirst($application->status->value) }}
                    </span>
                </div>
                <p class="text-xs text-gray-600 text-center leading-relaxed">
                    @if($application->status->value === 'pending')
                        <i class="fas fa-hourglass-half text-yellow-600 mr-1"></i>Your application is being reviewed by the employer
                    @elseif($application->status->value === 'reviewed')
                        <i class="fas fa-eye text-blue-600 mr-1"></i>Your application has been reviewed
                    @elseif($application->status->value === 'shortlisted')
                        <i class="fas fa-star text-green-600 mr-1"></i>Congratulations! You've been shortlisted
                    @elseif($application->status->value === 'hired')
                        <i class="fas fa-check-circle text-purple-600 mr-1"></i>You've been hired! Check your email for details
                    @elseif($application->status->value === 'rejected')
                        <i class="fas fa-times-circle text-red-600 mr-1"></i>Unfortunately, you were not selected for this position
                    @endif
                </p>
            </div>

            <!-- Application Info -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="font-bold text-gray-900 mb-4 text-lg flex items-center">
                    <i class="fas fa-info-circle text-teal-600 mr-3"></i>Application Info
                </h3>
                <div class="space-y-4 text-sm">
                    <div>
                        <p class="text-gray-600 font-medium">Applied Date</p>
                        <p class="text-gray-900 font-semibold">{{ $application->created_at->format('M d, Y') }}</p>
                        <p class="text-xs text-gray-500">{{ $application->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="border-t border-gray-200 pt-4">
                        <p class="text-gray-600 font-medium">Last Updated</p>
                        <p class="text-gray-900 font-semibold">{{ $application->updated_at->format('M d, Y') }}</p>
                        <p class="text-xs text-gray-500">{{ $application->updated_at->diffForHumans() }}</p>
                    </div>
                    <div class="border-t border-gray-200 pt-4">
                        <p class="text-gray-600 font-medium">Application ID</p>
                        <p class="font-mono text-xs text-gray-900 bg-gray-50 p-2 rounded border border-gray-200">{{ $application->id }}</p>
                    </div>
                </div>
            </div>

            <!-- Job Details Summary -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="font-bold text-gray-900 mb-4 text-lg flex items-center">
                    <i class="fas fa-building text-teal-600 mr-3"></i>Job Details
                </h3>
                <div class="space-y-3 text-sm">
                    @if($application->job->deadline)
                    <div class="flex items-start gap-3 pb-3 border-b border-gray-200">
                        <span class="text-lg">⏰</span>
                        <div>
                            <p class="text-gray-600 font-medium">Deadline</p>
                            <p class="text-gray-900 font-semibold">{{ $application->job->deadline->format('M d, Y') }}</p>
                        </div>
                    </div>
                    @endif
                    @if($application->job->level)
                    <div class="flex items-start gap-3 pb-3 border-b border-gray-200">
                        <span class="text-lg">📊</span>
                        <div>
                            <p class="text-gray-600 font-medium">Experience Level</p>
                            <p class="text-gray-900 font-semibold">{{ ucfirst($application->job->level) }}</p>
                        </div>
                    </div>
                    @endif
                    @if($application->job->category)
                    <div class="flex items-start gap-3">
                        <span class="text-lg">🏷️</span>
                        <div>
                            <p class="text-gray-600 font-medium">Category</p>
                            <p class="text-gray-900 font-semibold">{{ ucfirst($application->job->category) }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="font-bold text-gray-900 mb-4 text-lg">Actions</h3>
                <div class="space-y-2">
                    <a href="{{ route('seeker.applications') }}" class="block w-full px-4 py-2 text-center bg-teal-600 text-white rounded-lg text-sm font-semibold hover:bg-teal-700 transition flex items-center justify-center gap-2">
                        <i class="fas fa-arrow-left"></i>Back to Applications
                    </a>
                    <a href="{{ route('seeker.browse-jobs') }}" class="block w-full px-4 py-2 text-center bg-gray-200 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-300 transition flex items-center justify-center gap-2">
                        <i class="fas fa-search"></i>Browse More Jobs
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
