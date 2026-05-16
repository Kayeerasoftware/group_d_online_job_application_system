@extends('layouts.jobseeker')

@section('title', 'Interviews')

@section('content')
<div class="space-y-6">
    <!-- Header with Stats -->
    <div class="bg-gradient-to-r from-green-600 to-teal-600 rounded-lg shadow-lg p-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Interviews</h1>
                <p class="text-green-100">Manage your scheduled interviews</p>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white rounded-lg shadow-md p-4 text-center">
            <p class="text-3xl font-bold text-gray-900">{{ $stats['total'] }}</p>
            <p class="text-sm text-gray-600 mt-1">Total Interviews</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 text-center">
            <p class="text-3xl font-bold text-green-600">{{ $stats['upcoming'] }}</p>
            <p class="text-sm text-gray-600 mt-1">Upcoming</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 text-center">
            <p class="text-3xl font-bold text-gray-600">{{ $stats['completed'] }}</p>
            <p class="text-sm text-gray-600 mt-1">Completed</p>
        </div>
    </div>

    <!-- Interviews List -->
    @if($interviews->count() > 0)
    <div class="space-y-4">
        @foreach($interviews as $interview)
        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition p-6 border-l-4 border-green-600">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $interview->job->title }}</h3>
                    <p class="text-gray-600 font-semibold mb-3">{{ $interview->job->employer->name }}</p>
                    
                    <div class="space-y-2 text-sm text-gray-600">
                        @if($interview->interview_date)
                        <div class="flex items-center gap-2">
                            <i class="fas fa-calendar-alt text-green-600 w-5"></i>
                            <span>{{ $interview->interview_date->format('l, F d, Y') }}</span>
                        </div>
                        @endif
                        
                        @if($interview->interview_time)
                        <div class="flex items-center gap-2">
                            <i class="fas fa-clock text-blue-600 w-5"></i>
                            <span>{{ $interview->interview_time }}</span>
                        </div>
                        @endif
                        
                        @if($interview->interview_type)
                        <div class="flex items-center gap-2">
                            <i class="fas fa-video text-purple-600 w-5"></i>
                            <span>{{ ucfirst($interview->interview_type) }}</span>
                        </div>
                        @endif
                        
                        @if($interview->interview_location)
                        <div class="flex items-center gap-2">
                            <i class="fas fa-map-marker-alt text-red-600 w-5"></i>
                            <span>{{ $interview->interview_location }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="flex flex-col items-end gap-3">
                    @php
                        $isUpcoming = $interview->interview_date && $interview->interview_date >= now();
                    @endphp
                    <span class="px-4 py-2 rounded-full font-semibold text-sm {{ $isUpcoming ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                        <i class="fas {{ $isUpcoming ? 'fa-check-circle' : 'fa-history' }} mr-1"></i>{{ $isUpcoming ? 'Upcoming' : 'Completed' }}
                    </span>
                    
                    @if($isUpcoming)
                    <div class="flex gap-2">
                        <button class="px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition text-sm" title="Add to calendar">
                            <i class="fas fa-calendar-plus mr-1"></i>Add to Calendar
                        </button>
                        <a href="{{ route('applications.show', $interview) }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition text-sm">
                            Details
                        </a>
                    </div>
                    @else
                    <a href="{{ route('applications.show', $interview) }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition text-sm">
                        View Details
                    </a>
                    @endif
                </div>
            </div>

            @if($interview->interview_notes)
            <div class="mt-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                <p class="text-sm font-semibold text-blue-900 mb-2">
                    <i class="fas fa-sticky-note mr-2"></i>Notes from Employer
                </p>
                <p class="text-sm text-blue-800">{{ $interview->interview_notes }}</p>
            </div>
            @endif
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $interviews->links() }}
    </div>
    @else
    <div class="bg-white rounded-xl shadow-lg p-12 text-center">
        <i class="fas fa-calendar-times text-6xl text-gray-300 mb-4 block"></i>
        <h3 class="text-2xl font-bold text-gray-900 mb-2">No interviews scheduled</h3>
        <p class="text-gray-600 mb-6">Keep applying to jobs to get interview invitations</p>
        <a href="{{ route('seeker.browse-jobs') }}" class="inline-block px-6 py-3 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition">
            <i class="fas fa-search mr-2"></i>Browse Jobs
        </a>
    </div>
    @endif
</div>
@endsection
