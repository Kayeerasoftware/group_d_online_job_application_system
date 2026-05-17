@extends('layouts.jobseeker')

@section('title', 'Interviews')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
            <div class="flex items-center gap-2 md:gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-teal-500 to-cyan-500 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-teal-500 to-cyan-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                        <i class="fas fa-video text-white text-xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-teal-600 via-cyan-600 to-blue-600 bg-clip-text text-transparent mb-1 md:mb-2">Interviews</h1>
                    <p class="text-gray-600 text-xs md:text-sm font-medium">Manage your upcoming interviews and schedules</p>
                </div>
            </div>
            @if($unreadMessages > 0)
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded-lg font-semibold">
                <i class="fas fa-bell mr-2"></i>{{ $unreadMessages }} unread message{{ $unreadMessages !== 1 ? 's' : '' }}
            </div>
            @endif
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-teal-500 to-cyan-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-teal-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Interviews...</span>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-3 mb-3 md:mb-4">
        <div class="bg-gradient-to-br from-teal-500 to-teal-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-teal-100 text-[8px] md:text-[10px] font-medium mb-0.5">Total Interviews</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $totalInterviews }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-video text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-cyan-100 text-[8px] md:text-[10px] font-medium mb-0.5">Upcoming</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $upcomingInterviews }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-calendar text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-emerald-100 text-[8px] md:text-[10px] font-medium mb-0.5">Completed</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $completedInterviews }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-check-circle text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-amber-100 text-[8px] md:text-[10px] font-medium mb-0.5">Success Rate</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $successRate }}%</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-chart-line text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Interviews Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Upcoming Interviews -->
        <div>
            <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-calendar-alt text-teal-600 mr-2"></i>Upcoming Interviews
            </h2>
            <div class="space-y-3">
                @forelse($upcomingList as $interview)
                <a href="{{ route('seeker.interviews.show', $interview->id) }}" class="block bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-teal-100 p-4 hover:border-teal-300">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <h3 class="font-bold text-gray-900">{{ $interview->job->title }}</h3>
                                @if($interview->interview_type)
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">
                                    <i class="fas fa-{{ $interview->interview_type === 'video' ? 'video' : ($interview->interview_type === 'phone' ? 'phone' : 'building') }}"></i>{{ ucfirst($interview->interview_type) }}
                                </span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-600">{{ $interview->job->company_name ?? 'Company' }}</p>
                            <div class="flex flex-wrap gap-3 mt-3 text-sm">
                                <div class="flex items-center gap-2 text-gray-600">
                                    <i class="fas fa-calendar text-teal-600"></i>
                                    <span>{{ $interview->scheduled_date->format('M d, Y') }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-gray-600">
                                    <i class="fas fa-clock text-teal-600"></i>
                                    <span>{{ $interview->scheduled_date->format('h:i A') }}</span>
                                </div>
                                @if($interview->interviewer_name)
                                <div class="flex items-center gap-2 text-gray-600">
                                    <i class="fas fa-user text-teal-600"></i>
                                    <span>{{ $interview->interviewer_name }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full whitespace-nowrap">
                                <i class="fas fa-info-circle"></i>Scheduled
                            </span>
                            @if($interview->scheduled_date->diffInHours(now()) <= 24)
                            <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full whitespace-nowrap">
                                <i class="fas fa-exclamation-circle"></i>Soon
                            </span>
                            @endif
                            @if($interview->communications()->where('receiver_id', auth()->id())->whereNull('read_at')->count() > 0)
                            <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full whitespace-nowrap">
                                <i class="fas fa-envelope"></i>{{ $interview->communications()->where('receiver_id', auth()->id())->whereNull('read_at')->count() }} new
                            </span>
                            @endif
                        </div>
                    </div>
                    @if($interview->communications->first())
                    <div class="mt-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                        <p class="text-xs text-gray-600"><strong>Latest:</strong> {{ Str::limit($interview->communications->first()->message, 60) }}</p>
                    </div>
                    @endif
                </a>
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
                <i class="fas fa-history text-emerald-600 mr-2"></i>Past Interviews
            </h2>
            <div class="space-y-3">
                @forelse($pastList as $interview)
                <a href="{{ route('seeker.interviews.show', $interview->id) }}" class="block bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 p-4 hover:border-emerald-300">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <h3 class="font-bold text-gray-900">{{ $interview->job->title }}</h3>
                                @if($interview->interview_type)
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">
                                    <i class="fas fa-{{ $interview->interview_type === 'video' ? 'video' : ($interview->interview_type === 'phone' ? 'phone' : 'building') }}"></i>{{ ucfirst($interview->interview_type) }}
                                </span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-600">{{ $interview->job->company_name ?? 'Company' }}</p>
                            <div class="flex flex-wrap gap-3 mt-3 text-sm">
                                <div class="flex items-center gap-2 text-gray-600">
                                    <i class="fas fa-calendar text-gray-400"></i>
                                    <span>{{ $interview->scheduled_date->format('M d, Y') }}</span>
                                </div>
                                @if($interview->interviewer_name)
                                <div class="flex items-center gap-2 text-gray-600">
                                    <i class="fas fa-user text-gray-400"></i>
                                    <span>{{ $interview->interviewer_name }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-col gap-2">
                            @if($interview->interview_outcome)
                            <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-medium {{ $interview->interview_outcome === 'selected' ? 'bg-green-100 text-green-800' : ($interview->interview_outcome === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800') }} rounded-full whitespace-nowrap">
                                <i class="fas {{ $interview->interview_outcome === 'selected' ? 'fa-check-circle' : ($interview->interview_outcome === 'rejected' ? 'fa-times-circle' : 'fa-question-circle') }}"></i>{{ ucfirst($interview->interview_outcome) }}
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full whitespace-nowrap">
                                <i class="fas fa-question-circle"></i>Pending Outcome
                            </span>
                            @endif
                        </div>
                    </div>
                    @if($interview->feedback)
                    <div class="mt-3 p-3 bg-amber-50 rounded-lg border border-amber-200">
                        <p class="text-xs text-amber-900"><strong>Feedback:</strong> {{ Str::limit($interview->feedback, 60) }}</p>
                    </div>
                    @endif
                </a>
                @empty
                <div class="bg-white rounded-xl shadow-lg p-8 text-center border border-gray-100">
                    <i class="fas fa-history text-4xl text-gray-300 mb-3"></i>
                    <p class="text-gray-600">No past interviews</p>
                </div>
                @endforelse
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
@endsection
