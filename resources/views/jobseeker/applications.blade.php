@extends('layouts.jobseeker')

@section('title', 'My Applications')

@section('content')
<div class="space-y-6">
    <!-- Header with Stats -->
    <div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-lg shadow-lg p-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">My Applications</h1>
                <p class="text-purple-100">Track and manage all your job applications</p>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-5 gap-4">
        <div class="bg-white rounded-lg shadow-md p-4 text-center">
            <p class="text-3xl font-bold text-gray-900">{{ $stats['total'] }}</p>
            <p class="text-sm text-gray-600 mt-1">Total</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 text-center">
            <p class="text-3xl font-bold text-blue-600">{{ $stats['pending'] }}</p>
            <p class="text-sm text-gray-600 mt-1">Pending</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 text-center">
            <p class="text-3xl font-bold text-green-600">{{ $stats['shortlisted'] }}</p>
            <p class="text-sm text-gray-600 mt-1">Shortlisted</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 text-center">
            <p class="text-3xl font-bold text-orange-600">{{ $stats['interview'] }}</p>
            <p class="text-sm text-gray-600 mt-1">Interviews</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 text-center">
            <p class="text-3xl font-bold text-red-600">{{ $stats['rejected'] }}</p>
            <p class="text-sm text-gray-600 mt-1">Rejected</p>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="bg-white rounded-xl shadow-lg p-4">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('seeker.applications') }}" class="px-4 py-2 rounded-lg font-semibold transition {{ !request('status') ? 'bg-purple-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                All
            </a>
            <a href="{{ route('seeker.applications', ['status' => 'pending']) }}" class="px-4 py-2 rounded-lg font-semibold transition {{ request('status') === 'pending' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Pending
            </a>
            <a href="{{ route('seeker.applications', ['status' => 'shortlisted']) }}" class="px-4 py-2 rounded-lg font-semibold transition {{ request('status') === 'shortlisted' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Shortlisted
            </a>
            <a href="{{ route('seeker.applications', ['status' => 'interview']) }}" class="px-4 py-2 rounded-lg font-semibold transition {{ request('status') === 'interview' ? 'bg-orange-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Interviews
            </a>
            <a href="{{ route('seeker.applications', ['status' => 'rejected']) }}" class="px-4 py-2 rounded-lg font-semibold transition {{ request('status') === 'rejected' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Rejected
            </a>
        </div>
    </div>

    <!-- Applications List -->
    @if($applications->count() > 0)
    <div class="space-y-4">
        @foreach($applications as $application)
        @php
            $statusValue = $application->status instanceof \App\Enums\ApplicationStatus ? $application->status->value : $application->status;
            $statusColors = [
                'pending' => ['bg' => 'bg-blue-50', 'border' => 'border-blue-200', 'badge' => 'bg-blue-100 text-blue-700', 'icon' => 'fas fa-clock'],
                'shortlisted' => ['bg' => 'bg-green-50', 'border' => 'border-green-200', 'badge' => 'bg-green-100 text-green-700', 'icon' => 'fas fa-check-circle'],
                'interview' => ['bg' => 'bg-orange-50', 'border' => 'border-orange-200', 'badge' => 'bg-orange-100 text-orange-700', 'icon' => 'fas fa-calendar-check'],
                'rejected' => ['bg' => 'bg-red-50', 'border' => 'border-red-200', 'badge' => 'bg-red-100 text-red-700', 'icon' => 'fas fa-times-circle'],
            ];
            $colors = $statusColors[$statusValue] ?? $statusColors['pending'];
        @endphp
        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition p-6 {{ $colors['bg'] }} border-l-4 {{ $colors['border'] }}">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex-1">
                    <div class="flex items-start gap-4">
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $application->job->title }}</h3>
                            <p class="text-gray-600 font-semibold mb-2">{{ $application->job->employer->name }}</p>
                            <div class="flex flex-wrap gap-2 text-sm text-gray-600">
                                <span><i class="fas fa-map-marker-alt mr-1"></i>{{ $application->job->location }}</span>
                                <span><i class="fas fa-calendar mr-1"></i>{{ $application->applied_date->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col items-end gap-3">
                    <span class="px-4 py-2 rounded-full font-semibold text-sm {{ $colors['badge'] }}">
                        <i class="{{ $colors['icon'] }} mr-1"></i>{{ ucfirst($statusValue) }}
                    </span>
                    <a href="{{ route('applications.show', $application) }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg font-semibold hover:bg-purple-700 transition text-sm">
                        View Details
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $applications->links() }}
    </div>
    @else
    <div class="bg-white rounded-xl shadow-lg p-12 text-center">
        <i class="fas fa-inbox text-6xl text-gray-300 mb-4 block"></i>
        <h3 class="text-2xl font-bold text-gray-900 mb-2">No applications yet</h3>
        <p class="text-gray-600 mb-6">Start applying to jobs to see your applications here</p>
        <a href="{{ route('seeker.browse-jobs') }}" class="inline-block px-6 py-3 bg-purple-600 text-white rounded-lg font-semibold hover:bg-purple-700 transition">
            <i class="fas fa-search mr-2"></i>Browse Jobs
        </a>
    </div>
    @endif
</div>
@endsection
