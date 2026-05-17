@extends('layouts.jobseeker')

@section('title', $employer->name . ' - Jobs')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Employer Header -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6 border border-gray-100">
        <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
            <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-3xl shadow-md flex-shrink-0">
                {{ strtoupper(substr($employer->name, 0, 1)) }}
            </div>
            <div class="flex-1">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $employer->name }}</h1>
                <p class="text-gray-600 mb-2">{{ $employer->email }}</p>
                @if($employer->phone)
                    <p class="text-gray-600">
                        <i class="fas fa-phone text-blue-600 mr-2"></i>{{ $employer->phone }}
                    </p>
                @endif
            </div>
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-4 text-center border border-blue-200">
                <p class="text-3xl font-bold text-blue-600">{{ $jobs->total() }}</p>
                <p class="text-sm text-gray-600 font-medium">Active Jobs</p>
            </div>
        </div>
    </div>

    <!-- Jobs Grid -->
    @if($jobs->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($jobs as $job)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden">
                    <div class="p-6">
                        <!-- Job Title -->
                        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">{{ $job->title }}</h3>
                        
                        <!-- Description -->
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $job->description }}</p>

                        <!-- Details -->
                        <div class="space-y-2 mb-4 pb-4 border-b border-gray-200 text-sm text-gray-600">
                            @if($job->location)
                                <p><i class="fas fa-map-marker-alt text-blue-600 mr-2 w-4"></i>{{ $job->location }}</p>
                            @endif
                            @if($job->job_type)
                                <p><i class="fas fa-briefcase text-blue-600 mr-2 w-4"></i>{{ ucfirst($job->job_type instanceof \App\Enums\JobType ? $job->job_type->value : $job->job_type) }}</p>
                            @endif
                            @if($job->salary_min || $job->salary_max)
                                <p><i class="fas fa-dollar-sign text-blue-600 mr-2 w-4"></i>
                                    @if($job->salary_min && $job->salary_max)
                                        UGX {{ number_format((int)$job->salary_min) }} - {{ number_format((int)$job->salary_max) }}
                                    @elseif($job->salary_min)
                                        From UGX {{ number_format((int)$job->salary_min) }}
                                    @else
                                        Up to UGX {{ number_format((int)$job->salary_max) }}
                                    @endif
                                </p>
                            @endif
                        </div>

                        <!-- Stats -->
                        <div class="grid grid-cols-2 gap-3 mb-4">
                            <div class="bg-blue-50 rounded-lg p-2 text-center border border-blue-200">
                                <p class="text-lg font-bold text-blue-600">{{ $job->applications_count ?? 0 }}</p>
                                <p class="text-xs text-gray-600 font-medium">Applications</p>
                            </div>
                            <div class="bg-green-50 rounded-lg p-2 text-center border border-green-200">
                                <p class="text-lg font-bold text-green-600">{{ $job->created_at->format('M d') }}</p>
                                <p class="text-xs text-gray-600 font-medium">Posted</p>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <a 
                            href="{{ route('jobs.show', $job) }}"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-medium py-2 px-4 rounded-lg text-center transition-all duration-300 inline-flex items-center justify-center gap-2"
                        >
                            <i class="fas fa-eye"></i>View Details
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $jobs->links() }}
        </div>
    @else
        <div class="bg-white rounded-xl shadow-lg p-12 text-center border border-gray-100">
            <i class="fas fa-briefcase text-gray-400 text-5xl mb-4 block"></i>
            <h3 class="text-xl font-bold text-gray-900 mb-2">No jobs posted yet</h3>
            <p class="text-gray-600">This employer hasn't posted any jobs yet. Check back later!</p>
        </div>
    @endif
</div>
@endsection
