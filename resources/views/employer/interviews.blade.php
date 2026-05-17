@extends('layouts.employer')

@section('title', 'Interviews')

@section('content')
<div class="bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-purple-600 to-purple-700 rounded-lg shadow-lg p-3 md:p-4 mb-4 md:mb-6">
        <div class="flex items-center justify-between gap-2">
            <div class="flex items-center gap-3 flex-1 min-w-0">
                <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl overflow-hidden bg-white shadow-lg flex-shrink-0 flex items-center justify-center">
                    <i class="fas fa-calendar-check text-purple-600 text-2xl"></i>
                </div>
                <div class="min-w-0">
                    <h1 class="text-sm sm:text-lg md:text-2xl font-bold text-white truncate">Interviews</h1>
                    <p class="text-purple-100 text-xs sm:text-sm mt-0.5 md:mt-1">Schedule and manage interviews</p>
                </div>
            </div>
            @if($unreadMessages > 0)
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded-lg font-semibold text-sm flex-shrink-0">
                <i class="fas fa-bell mr-2"></i>{{ $unreadMessages }} new
            </div>
            @endif
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-purple-500 to-purple-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-purple-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Interviews...</span>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-3 mb-4 md:mb-6">
        <!-- Scheduled -->
        <div class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-purple-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-calendar text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Scheduled</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $scheduledInterviews }}</h3>
                </div>
            </div>
        </div>

        <!-- Today -->
        <div class="bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-orange-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-clock text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Today</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $todayInterviews }}</h3>
                </div>
            </div>
        </div>

        <!-- Completed -->
        <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-green-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-green-500 to-green-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-check-circle text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Completed</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $completedInterviews }}</h3>
                </div>
            </div>
        </div>

        <!-- Success Rate -->
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-blue-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-chart-line text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Success Rate</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $successRate }}%</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid gap-6 lg:grid-cols-3">
        <!-- Interviews Cards Side by Side -->
        <div class="lg:col-span-2 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Upcoming Interviews -->
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="fas fa-calendar-alt text-purple-600 mr-2"></i>Upcoming
                    </h3>
                    @if($upcomingInterviews->count() > 0)
                    <a href="#" class="text-purple-600 text-sm hover:underline font-semibold">View All →</a>
                    @endif
                </div>
                <div class="space-y-3 max-h-96 overflow-y-auto">
                    @forelse($upcomingInterviews as $interview)
                        <div class="flex items-start justify-between p-4 hover:bg-purple-50 rounded-lg transition border border-gray-100 hover:border-purple-300">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <p class="text-sm font-semibold text-gray-900">{{ $interview->seeker->name ?? 'Unknown' }}</p>
                                    @if($interview->interview_type)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">
                                        <i class="fas fa-{{ $interview->interview_type === 'video' ? 'video' : ($interview->interview_type === 'phone' ? 'phone' : 'building') }}"></i>{{ ucfirst($interview->interview_type) }}
                                    </span>
                                    @endif
                                </div>
                                <p class="text-xs text-gray-500">{{ $interview->job->title }}</p>
                                <p class="text-xs text-gray-500 mt-1"><i class="fas fa-calendar mr-1"></i>{{ $interview->scheduled_date->format('M d, Y h:i A') }}</p>
                                @if($interview->interviewer_name)
                                <p class="text-xs text-gray-500 mt-1"><i class="fas fa-user mr-1"></i>{{ $interview->interviewer_name }}</p>
                                @endif
                                @if($interview->interview_link)
                                <p class="text-xs text-gray-500 mt-1"><i class="fas fa-link mr-1"></i><a href="{{ $interview->interview_link }}" target="_blank" class="text-purple-600 hover:underline">Meeting Link</a></p>
                                @endif
                                @if($interview->communications->first())
                                <p class="text-xs text-gray-600 mt-1"><strong>Latest:</strong> {{ Str::limit($interview->communications->first()->message, 35) }}</p>
                                @endif
                            </div>
                            <div class="flex flex-col gap-2 ml-2">
                                <a href="{{ route('employer.interviews.show', $interview->id) }}" class="px-2 py-1 text-xs rounded-full font-semibold bg-purple-100 text-purple-800 whitespace-nowrap text-center hover:bg-purple-200 transition">
                                    View
                                </a>
                                @if($interview->scheduled_date->diffInHours(now()) <= 24)
                                <span class="px-2 py-1 text-xs rounded-full font-semibold bg-red-100 text-red-800 whitespace-nowrap text-center">
                                    Soon
                                </span>
                                @endif
                                @if($interview->communications()->where('receiver_id', auth()->id())->whereNull('read_at')->count() > 0)
                                <span class="px-2 py-1 text-xs rounded-full font-semibold bg-blue-100 text-blue-800 whitespace-nowrap text-center">
                                    {{ $interview->communications()->where('receiver_id', auth()->id())->whereNull('read_at')->count() }} new
                                </span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm text-center py-8">No upcoming interviews</p>
                    @endforelse
                </div>
            </div>

            <!-- Past Interviews -->
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="fas fa-list-check text-green-600 mr-2"></i>Past
                    </h3>
                    @if($pastInterviews->count() > 0)
                    <a href="#" class="text-green-600 text-sm hover:underline font-semibold">View All →</a>
                    @endif
                </div>
                <div class="space-y-3 max-h-96 overflow-y-auto">
                    @forelse($pastInterviews as $interview)
                        <div class="flex items-start justify-between p-4 hover:bg-green-50 rounded-lg transition border border-gray-100 hover:border-green-300">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <p class="text-sm font-semibold text-gray-900">{{ $interview->seeker->name ?? 'Unknown' }}</p>
                                    @if($interview->interview_type)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">
                                        <i class="fas fa-{{ $interview->interview_type === 'video' ? 'video' : ($interview->interview_type === 'phone' ? 'phone' : 'building') }}"></i>{{ ucfirst($interview->interview_type) }}
                                    </span>
                                    @endif
                                </div>
                                <p class="text-xs text-gray-500">{{ $interview->job->title }}</p>
                                <p class="text-xs text-gray-500 mt-1"><i class="fas fa-calendar mr-1"></i>{{ $interview->scheduled_date->format('M d, Y') }}</p>
                                @if($interview->interviewer_name)
                                <p class="text-xs text-gray-500 mt-1"><i class="fas fa-user mr-1"></i>{{ $interview->interviewer_name }}</p>
                                @endif
                                @if($interview->feedback)
                                <p class="text-xs text-gray-600 mt-1"><strong>Feedback:</strong> {{ Str::limit($interview->feedback, 35) }}</p>
                                @endif
                            </div>
                            <div class="flex flex-col gap-2 ml-2">
                                <a href="{{ route('employer.interviews.show', $interview->id) }}" class="px-2 py-1 text-xs rounded-full font-semibold bg-green-100 text-green-800 whitespace-nowrap text-center hover:bg-green-200 transition">
                                    View
                                </a>
                                @if($interview->interview_outcome)
                                <span class="px-2 py-1 text-xs rounded-full font-semibold {{ $interview->interview_outcome === 'selected' ? 'bg-green-100 text-green-800' : ($interview->interview_outcome === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800') }} whitespace-nowrap text-center">
                                    {{ ucfirst($interview->interview_outcome) }}
                                </span>
                                @else
                                <span class="px-2 py-1 text-xs rounded-full font-semibold bg-gray-100 text-gray-800 whitespace-nowrap text-center">
                                    Pending
                                </span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm text-center py-8">No past interviews</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Interview Statistics -->
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-chart-bar text-blue-600 mr-2"></i>Statistics
                </h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                        <span class="text-sm text-gray-600">Total Interviews</span>
                        <span class="text-lg font-bold text-gray-900">{{ $scheduledInterviews + $completedInterviews }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                        <span class="text-sm text-gray-600">Success Rate</span>
                        <span class="text-lg font-bold text-gray-900">{{ $successRate }}%</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                        <span class="text-sm text-gray-600">Avg. Duration</span>
                        <span class="text-lg font-bold text-gray-900">{{ $avgDuration }} min</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Pending</span>
                        <span class="text-lg font-bold text-gray-900">{{ $scheduledInterviews }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-lightning-bolt text-yellow-600 mr-2"></i>Quick Actions
                </h3>
                <div class="space-y-2">
                    <a href="{{ route('employer.applications') }}" class="block w-full px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold text-sm text-center">
                        <i class="fas fa-plus mr-2"></i>Schedule Interview
                    </a>
                    <a href="#" class="block w-full px-4 py-2 bg-white text-purple-600 border border-purple-200 rounded-lg hover:bg-purple-50 transition-all duration-300 font-semibold text-sm text-center">
                        <i class="fas fa-download mr-2"></i>Export Schedule
                    </a>
                </div>
            </div>

            <!-- Interview Tips -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl shadow-md p-6 border border-blue-200">
                <h3 class="text-lg font-bold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-lightbulb text-blue-600 mr-2"></i>Tips
                </h3>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li class="flex gap-2">
                        <span class="text-blue-600 font-bold">•</span>
                        <span>Send interview reminders 24 hours before</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-blue-600 font-bold">•</span>
                        <span>Prepare interview questions in advance</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-blue-600 font-bold">•</span>
                        <span>Document feedback immediately after</span>
                    </li>
                </ul>
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
