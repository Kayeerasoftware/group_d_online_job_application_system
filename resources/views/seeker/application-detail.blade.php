@extends('layouts.jobseeker')

@section('title', 'Application Details')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
            <div class="flex items-center gap-2 md:gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-blue-600 to-indigo-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                        <i class="fas fa-file-alt text-white text-xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 bg-clip-text text-transparent mb-1 md:mb-2">Application Details</h1>
                    <p class="text-gray-600 text-xs md:text-sm font-medium">Track your application progress</p>
                </div>
            </div>
            <a href="{{ route('seeker.applications') }}" class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-blue-800 transition">
                <i class="fas fa-arrow-left"></i>Back to Applications
            </a>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-green-500 to-green-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-green-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Details...</span>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-3 mb-3 md:mb-4">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-[8px] md:text-[10px] font-medium mb-0.5">Application Status</p>
                    <h3 class="text-base md:text-xl font-bold">{{ ucfirst($application->status) }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-check-circle text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-indigo-100 text-[8px] md:text-[10px] font-medium mb-0.5">Applied Date</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $application->created_at->format('M d') }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-calendar text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-[8px] md:text-[10px] font-medium mb-0.5">Days Elapsed</p>
                    <h3 class="text-base md:text-xl font-bold">{{ now()->diffInDays($application->created_at) }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-hourglass-half text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-pink-100 text-[8px] md:text-[10px] font-medium mb-0.5">Last Updated</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $application->updated_at->format('M d') }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-sync text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            <!-- Application Header -->
            <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                <div class="flex items-start gap-4 mb-6">
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl border border-gray-200 bg-gray-50 text-3xl">
                        {{ $application->job->company_logo ?? '💼' }}
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-900">{{ $application->job->title }}</h2>
                        <p class="text-gray-600 font-medium">{{ $application->job->company_name }}</p>
                        <p class="text-sm text-gray-500">{{ $application->job->location }}</p>
                    </div>
                    <span class="inline-flex shrink-0 items-center rounded-full px-4 py-2 text-sm font-medium
                        @if($application->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($application->status === 'reviewed') bg-blue-100 text-blue-800
                        @elseif($application->status === 'shortlisted') bg-green-100 text-green-800
                        @elseif($application->status === 'interview') bg-purple-100 text-purple-800
                        @elseif($application->status === 'hired') bg-green-100 text-green-800
                        @elseif($application->status === 'rejected') bg-red-100 text-red-800
                        @endif">
                        {{ ucfirst($application->status) }}
                    </span>
                </div>

                <!-- Application Timeline -->
                <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 mb-6">
                    <h3 class="font-bold text-gray-900 mb-4">Application Timeline</h3>
                    <div class="flex items-center">
                        @foreach(['applied', 'reviewed', 'shortlisted', 'interview', 'hired'] as $index => $stage)
                        <div class="flex flex-col items-center flex-1">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full text-sm font-bold
                                @if($application->status === $stage) bg-blue-600 text-white
                                @elseif(array_search($application->status, ['applied', 'reviewed', 'shortlisted', 'interview', 'hired']) > $index) bg-green-600 text-white
                                @else bg-gray-300 text-gray-600
                                @endif">
                                @if(array_search($application->status, ['applied', 'reviewed', 'shortlisted', 'interview', 'hired']) > $index)
                                    ✓
                                @else
                                    {{ $index + 1 }}
                                @endif
                            </div>
                            <p class="mt-2 text-xs text-center font-medium
                                @if($application->status === $stage) text-blue-600
                                @elseif(array_search($application->status, ['applied', 'reviewed', 'shortlisted', 'interview', 'hired']) > $index) text-green-600
                                @else text-gray-500
                                @endif">
                                {{ ucfirst($stage) }}
                            </p>
                        </div>
                        @if($index < 4)
                        <div class="h-0.5 flex-1 -mt-8 @if(array_search($application->status, ['applied', 'reviewed', 'shortlisted', 'interview', 'hired']) > $index) bg-green-600 @else bg-gray-300 @endif"></div>
                        @endif
                        @endforeach
                    </div>
                </div>

                <!-- Cover Letter -->
                <div class="mb-6">
                    <h3 class="font-bold text-gray-900 mb-3">Cover Letter</h3>
                    <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 text-sm text-gray-700 whitespace-pre-wrap">{{ $application->cover_letter ?? 'No cover letter provided' }}</div>
                </div>

                <!-- Submitted CV -->
                <div class="mb-6">
                    <h3 class="font-bold text-gray-900 mb-3">Submitted CV</h3>
                    @if($application->cv_path)
                    <div class="flex items-center gap-3 rounded-lg border border-gray-200 bg-gray-50 p-4">
                        <span class="text-3xl">📄</span>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">{{ basename($application->cv_path) }}</p>
                            <p class="text-xs text-gray-600">Uploaded {{ $application->created_at->format('M d, Y') }}</p>
                        </div>
                        <a href="{{ Storage::url($application->cv_path) }}" target="_blank" class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                            Download
                        </a>
                    </div>
                    @else
                    <p class="text-sm text-gray-600">No CV attached</p>
                    @endif
                </div>

                <!-- Employer Notes -->
                @if($application->employer_notes)
                <div>
                    <h3 class="font-bold text-gray-900 mb-3">Employer Notes</h3>
                    <div class="rounded-lg border border-blue-200 bg-blue-50 p-4 text-sm text-blue-900">
                        {{ $application->employer_notes }}
                    </div>
                </div>
                @endif
            </div>

            <!-- Job Details -->
            <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                <h3 class="font-bold text-gray-900 mb-4">Job Details</h3>
                <div class="prose prose-sm max-w-none text-gray-700">
                    {!! nl2br(e($application->job->description)) !!}
                </div>
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <a href="{{ route('jobs.show', $application->job) }}" class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-blue-800 transition">
                        View full job posting <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Application Info -->
            <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-blue-600 mr-2"></i>Application Info
                </h3>
                <div class="space-y-4 text-sm">
                    <div>
                        <p class="text-gray-600 font-medium">Applied</p>
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
                        <p class="font-mono text-xs text-gray-900">{{ $application->id }}</p>
                    </div>
                </div>
            </div>

            <!-- Job Info -->
            <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-briefcase text-indigo-600 mr-2"></i>Job Info
                </h3>
                <div class="space-y-3 text-sm">
                    <div class="flex items-center gap-2">
                        <span class="text-gray-600">💼</span>
                        <span class="text-gray-900">{{ ucfirst($application->job->type) }}</span>
                    </div>
                    @if($application->job->salary_min && $application->job->salary_max)
                    <div class="flex items-center gap-2">
                        <span class="text-gray-600">💰</span>
                        <span class="text-gray-900">UGX {{ number_format($application->job->salary_min) }} - {{ number_format($application->job->salary_max) }}</span>
                    </div>
                    @endif
                    <div class="flex items-center gap-2">
                        <span class="text-gray-600">📍</span>
                        <span class="text-gray-900">{{ $application->job->location }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-gray-600">⏰</span>
                        <span class="text-gray-900">Closes {{ $application->job->deadline->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Withdraw Application -->
            @if($application->status === 'pending' || $application->status === 'applied')
            <div class="bg-white rounded-xl shadow-xl p-6 border border-red-200">
                <h3 class="font-bold text-red-900 mb-2 flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i>Withdraw Application
                </h3>
                <p class="text-sm text-red-700 mb-4">This action cannot be undone.</p>
                <form action="{{ route('seeker.applications') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to withdraw this application?')" class="w-full rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700 transition">
                        Withdraw Application
                    </button>
                </form>
            </div>
            @endif
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
@endsection
