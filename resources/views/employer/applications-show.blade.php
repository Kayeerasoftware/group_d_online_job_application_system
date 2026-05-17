@extends('layouts.employer')

@section('title', 'Application Details')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
            <div class="flex items-center gap-2 md:gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-teal-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-emerald-600 to-teal-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                        <i class="fas fa-file-alt text-white text-xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 bg-clip-text text-transparent mb-1 md:mb-2">Application Details</h1>
                    <p class="text-gray-600 text-xs md:text-sm font-medium">Review candidate application</p>
                </div>
            </div>
            <a href="{{ route('employer.applications') }}" class="px-3 md:px-5 py-2 md:py-2.5 bg-gradient-to-r from-gray-600 to-gray-700 text-white rounded-lg md:rounded-xl hover:shadow-lg transition-all duration-300 text-xs md:text-sm font-bold flex items-center justify-center gap-1 md:gap-2">
                <i class="fas fa-arrow-left"></i><span class="hidden sm:inline">Back</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-emerald-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Application...</span>
    </div>

    <!-- Application Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Application Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Candidate Information -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-user text-emerald-600 mr-2"></i>Candidate Information
                </h2>
                <div class="flex items-start gap-4 mb-6">
                    <div class="w-20 h-20 rounded-lg overflow-hidden bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center text-white text-2xl font-bold flex-shrink-0">
                        {{ strtoupper(substr($application->seeker->name, 0, 2)) }}
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-900">{{ $application->seeker->name }}</h3>
                        <p class="text-gray-600 text-sm">{{ $application->seeker->email }}</p>
                        <p class="text-gray-600 text-sm">{{ $application->seeker->phone ?? 'N/A' }}</p>
                        <div class="mt-3 flex gap-2">
                            <a href="{{ route('seeker.profile', $application->seeker->id) }}" class="px-3 py-1 text-xs bg-emerald-100 text-emerald-700 rounded-lg hover:bg-emerald-200 transition">
                                <i class="fas fa-eye mr-1"></i>View Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Job Position -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-briefcase text-emerald-600 mr-2"></i>Job Position
                </h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Position</p>
                        <p class="text-gray-900 font-semibold">{{ $application->job->title }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Location</p>
                        <p class="text-gray-900 font-semibold">{{ $application->job->location }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Job Type</p>
                        <p class="text-gray-900 font-semibold">{{ ucfirst($application->job->job_type instanceof \App\Enums\JobType ? $application->job->job_type->value : $application->job->job_type) }}</p>
                    </div>
                </div>
            </div>

            <!-- Cover Letter -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-file-text text-emerald-600 mr-2"></i>Cover Letter
                </h2>
                <div class="bg-gray-50 rounded-lg p-4 text-gray-700 leading-relaxed">
                    {{ $application->cover_letter ?? 'No cover letter provided' }}
                </div>
            </div>

            <!-- Application Timeline -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-history text-emerald-600 mr-2"></i>Application Timeline
                </h2>
                <div class="space-y-4">
                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-4 h-4 rounded-full bg-emerald-600"></div>
                            <div class="w-0.5 h-12 bg-gray-300"></div>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Applied</p>
                            <p class="text-sm text-gray-600">{{ $application->applied_date->format('M d, Y - h:i A') }}</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-4 h-4 rounded-full {{ ($application->status instanceof \App\Enums\ApplicationStatus ? $application->status->value : $application->status) === 'reviewed' ? 'bg-emerald-600' : 'bg-gray-300' }}"></div>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Reviewed</p>
                            <p class="text-sm text-gray-600">{{ $application->updated_at->format('M d, Y - h:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Actions & Status -->
        <div class="space-y-6">
            <!-- Status Card -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-flag text-emerald-600 mr-2"></i>Application Status
                </h3>
                <form method="POST" action="{{ route('employer.applications.status', $application) }}" class="space-y-4">
                    @csrf
                    @method('PATCH')
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Change Status</label>
                        <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                            <option value="pending" {{ ($application->status instanceof \App\Enums\ApplicationStatus ? $application->status->value : $application->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="reviewed" {{ ($application->status instanceof \App\Enums\ApplicationStatus ? $application->status->value : $application->status) === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                            <option value="shortlisted" {{ ($application->status instanceof \App\Enums\ApplicationStatus ? $application->status->value : $application->status) === 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                            <option value="interview" {{ ($application->status instanceof \App\Enums\ApplicationStatus ? $application->status->value : $application->status) === 'interview' ? 'selected' : '' }}>Interview</option>
                            <option value="rejected" {{ ($application->status instanceof \App\Enums\ApplicationStatus ? $application->status->value : $application->status) === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="hired" {{ ($application->status instanceof \App\Enums\ApplicationStatus ? $application->status->value : $application->status) === 'hired' ? 'selected' : '' }}>Hired</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Employer Notes</label>
                        <textarea name="employer_notes" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent resize-none" placeholder="Add notes about this candidate...">{{ $application->employer_notes }}</textarea>
                    </div>

                    <button type="submit" class="w-full px-4 py-2 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold">
                        <i class="fas fa-save mr-2"></i>Update Status
                    </button>
                </form>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-lightning-bolt text-yellow-600 mr-2"></i>Quick Actions
                </h3>
                <div class="space-y-2">
                    <button class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold text-sm">
                        <i class="fas fa-envelope mr-2"></i>Send Message
                    </button>
                    <button onclick="openScheduleModal({{ $application->id }})" class="w-full px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition font-semibold text-sm">
                        <i class="fas fa-calendar mr-2"></i>Schedule Interview
                    </button>
                    <button class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold text-sm">
                        <i class="fas fa-download mr-2"></i>Download CV
                    </button>
                </div>
            </div>

            <!-- Application Info -->
            <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-200">
                <p class="text-sm text-emerald-900 font-medium">
                    <i class="fas fa-info-circle mr-2"></i>Application ID: #{{ $application->id }}
                </p>
                <p class="text-xs text-emerald-700 mt-2">
                    Applied on {{ $application->applied_date->format('M d, Y') }}
                </p>
            </div>
        </div>
    </div>
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

@include('components.schedule-interview-modal')
@endsection
