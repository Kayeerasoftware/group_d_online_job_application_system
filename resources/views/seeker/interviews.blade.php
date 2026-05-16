@extends('layouts.jobseeker')

@section('title', 'Interviews')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
            <div class="flex items-center gap-2 md:gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-blue-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-indigo-600 to-blue-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                        <i class="fas fa-video text-white text-xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-indigo-600 via-blue-600 to-cyan-600 bg-clip-text text-transparent mb-1 md:mb-2">Interviews</h1>
                    <p class="text-gray-600 text-xs md:text-sm font-medium">Manage your upcoming interviews and schedules</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-green-500 to-green-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-green-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Interviews...</span>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-3 mb-3 md:mb-4">
        <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-indigo-100 text-[8px] md:text-[10px] font-medium mb-0.5">Total Interviews</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $totalInterviews }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-video text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-[8px] md:text-[10px] font-medium mb-0.5">Upcoming</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $upcomingInterviews }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-calendar text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-[8px] md:text-[10px] font-medium mb-0.5">Completed</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $completedInterviews }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-check-circle text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-[8px] md:text-[10px] font-medium mb-0.5">Pending</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $pendingInterviews }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-hourglass-half text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Interviews -->
    <div class="mb-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-calendar-alt text-indigo-600 mr-2"></i>Upcoming Interviews
        </h2>
        <div class="space-y-3">
            @forelse($upcomingList as $interview)
            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-indigo-100 p-4">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1">
                        <h3 class="font-bold text-gray-900">{{ $interview->job->title }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $interview->job->company_name }}</p>
                        <div class="flex flex-wrap gap-3 mt-3 text-sm">
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-calendar text-indigo-600"></i>
                                <span>{{ $interview->scheduled_date->format('M d, Y') }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-clock text-indigo-600"></i>
                                <span>{{ $interview->scheduled_date->format('h:i A') }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-user text-indigo-600"></i>
                                <span>{{ $interview->interviewer_name ?? 'HR Team' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full whitespace-nowrap">
                            <i class="fas fa-info-circle"></i>{{ ucfirst($interview->status) }}
                        </span>
                        @if($interview->interview_type)
                        <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full whitespace-nowrap">
                            <i class="fas fa-video"></i>{{ ucfirst($interview->interview_type) }}
                        </span>
                        @endif
                    </div>
                </div>
                @if($interview->notes)
                <div class="mt-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <p class="text-xs text-gray-600"><strong>Notes:</strong> {{ $interview->notes }}</p>
                </div>
                @endif
                <div class="flex gap-2 mt-3">
                    @if($interview->interview_link)
                    <a href="{{ $interview->interview_link }}" target="_blank" class="flex-1 px-3 py-2 text-xs font-semibold text-center bg-gradient-to-r from-indigo-600 to-blue-600 text-white rounded-lg hover:shadow-lg transition-all duration-300">
                        <i class="fas fa-video mr-1"></i>Join Interview
                    </a>
                    @endif
                    <button class="flex-1 px-3 py-2 text-xs font-semibold text-center bg-white text-indigo-600 border border-indigo-200 rounded-lg hover:bg-indigo-50 transition-all duration-300">
                        <i class="fas fa-bell mr-1"></i>Set Reminder
                    </button>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-xl shadow-lg p-8 text-center border border-gray-100">
                <i class="fas fa-calendar text-4xl text-gray-300 mb-3"></i>
                <p class="text-gray-600">No upcoming interviews scheduled</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Past Interviews -->
    <div>
        <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-history text-green-600 mr-2"></i>Past Interviews
        </h2>
        <div class="space-y-3">
            @forelse($pastList as $interview)
            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 p-4 opacity-75">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1">
                        <h3 class="font-bold text-gray-900">{{ $interview->job->title }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $interview->job->company_name }}</p>
                        <div class="flex flex-wrap gap-3 mt-3 text-sm">
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-calendar text-gray-400"></i>
                                <span>{{ $interview->scheduled_date->format('M d, Y') }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-user text-gray-400"></i>
                                <span>{{ $interview->interviewer_name ?? 'HR Team' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        @if($interview->outcome)
                        <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-medium {{ $interview->outcome === 'selected' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} rounded-full whitespace-nowrap">
                            <i class="fas {{ $interview->outcome === 'selected' ? 'fa-check-circle' : 'fa-times-circle' }}"></i>{{ ucfirst($interview->outcome) }}
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full whitespace-nowrap">
                            <i class="fas fa-question-circle"></i>Pending Outcome
                        </span>
                        @endif
                    </div>
                </div>
                @if($interview->feedback)
                <div class="mt-3 p-3 bg-blue-50 rounded-lg border border-blue-200">
                    <p class="text-xs text-blue-900"><strong>Feedback:</strong> {{ $interview->feedback }}</p>
                </div>
                @endif
            </div>
            @empty
            <div class="bg-white rounded-xl shadow-lg p-8 text-center border border-gray-100">
                <i class="fas fa-history text-4xl text-gray-300 mb-3"></i>
                <p class="text-gray-600">No past interviews</p>
            </div>
            @endforelse
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
