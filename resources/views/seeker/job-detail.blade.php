@extends('layouts.jobseeker')

@section('title', $job->title)

@section('content')
<div class="space-y-6">
    <!-- Job Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg shadow-lg p-6">
        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
            <div class="flex-1">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">{{ $job->title }}</h1>
                <p class="text-blue-100 text-lg mb-4">{{ $job->employer?->employerProfile?->company_name ?? $job->employer?->name }}</p>
                <p class="text-blue-100 line-clamp-2">{{ $job->description }}</p>
            </div>
            <div class="flex flex-col gap-3 md:flex-shrink-0">
                @if(safe_auth_check() && safe_auth_user()?->isSeeker() && !$applied)
                    <a href="{{ route('seeker.applications.create', ['job' => $job->id]) }}" class="px-6 py-3 bg-white text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition text-center">
                        <i class="fas fa-paper-plane mr-2"></i>Apply Now
                    </a>
                @elseif(safe_auth_check() && safe_auth_user()?->isSeeker() && $applied)
                    <button disabled class="px-6 py-3 bg-green-100 text-green-700 rounded-lg font-semibold text-center cursor-not-allowed">
                        <i class="fas fa-check mr-2"></i>Already Applied
                    </button>
                @else
                    <a href="{{ route('register') }}" class="px-6 py-3 bg-white text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition text-center">
                        <i class="fas fa-user-plus mr-2"></i>Register to Apply
                    </a>
                @endif

                @if(safe_auth_check() && safe_auth_user()?->isSeeker())
                    <form method="post" action="{{ route('seeker.saved-jobs.store', $job) }}" class="w-full">
                        @csrf
                        <button type="submit" class="w-full px-6 py-3 {{ $saved ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-700' }} rounded-lg font-semibold hover:{{ $saved ? 'bg-yellow-200' : 'bg-gray-200' }} transition">
                            <i class="fas {{ $saved ? 'fa-bookmark' : 'fa-bookmark' }} mr-2"></i>{{ $saved ? 'Saved' : 'Save Job' }}
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Key Information Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 md:gap-4">
        <div class="bg-white rounded-lg shadow-md p-4">
            <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Location</p>
            <p class="text-lg font-bold text-gray-900 mt-2">{{ $job->location }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4">
            <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Job Type</p>
            <p class="text-lg font-bold text-gray-900 mt-2">{{ $job->job_type instanceof \App\Enums\JobType ? $job->job_type->value : $job->job_type }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4">
            <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Status</p>
            <p class="text-lg font-bold text-gray-900 mt-2">{{ $job->statusValue() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4">
            <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Deadline</p>
            <p class="text-lg font-bold text-gray-900 mt-2">{{ optional($job->deadline)->format('M d, Y') }}</p>
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
                        <p class="text-lg font-bold text-green-700 mt-2">UGX {{ number_format((float) $job->salary_min) }} - UGX {{ number_format((float) $job->salary_max) }}</p>
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
                <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed">
                    <p>{{ $job->description }}</p>
                </div>
            </div>

            <!-- Requirements -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-list-check text-blue-600 mr-3"></i>Requirements
                </h2>
                <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed whitespace-pre-line">
                    <p>{{ $job->requirements }}</p>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="space-y-6">
            <!-- Employer Information -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-building text-blue-600 mr-3"></i>About Employer
                </h2>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Company</p>
                        <p class="text-lg font-bold text-gray-900 mt-1">{{ $job->employer?->employerProfile?->company_name ?? $job->employer?->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Location</p>
                        <p class="text-lg font-bold text-gray-900 mt-1">{{ $job->location }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Application Deadline</p>
                        <p class="text-lg font-bold text-gray-900 mt-1">{{ optional($job->deadline)->format('F d, Y') }}</p>
                    </div>
                    @if($job->employer?->employerProfile?->company_description)
                    <div>
                        <p class="text-sm font-semibold text-gray-600">About</p>
                        <p class="text-sm text-gray-700 mt-1">{{ $job->employer->employerProfile->company_description }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Application Tips -->
            <div class="bg-blue-50 rounded-xl shadow-lg p-6 border border-blue-200">
                <h3 class="text-lg font-bold text-blue-900 mb-4 flex items-center">
                    <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>Application Tips
                </h3>
                <ul class="space-y-3 text-sm text-blue-800">
                    <li class="flex gap-2">
                        <i class="fas fa-check-circle text-green-600 flex-shrink-0 mt-0.5"></i>
                        <span>Tailor your resume to match the job requirements</span>
                    </li>
                    <li class="flex gap-2">
                        <i class="fas fa-check-circle text-green-600 flex-shrink-0 mt-0.5"></i>
                        <span>Highlight relevant skills and experience</span>
                    </li>
                    <li class="flex gap-2">
                        <i class="fas fa-check-circle text-green-600 flex-shrink-0 mt-0.5"></i>
                        <span>Write a compelling cover letter</span>
                    </li>
                    <li class="flex gap-2">
                        <i class="fas fa-check-circle text-green-600 flex-shrink-0 mt-0.5"></i>
                        <span>Apply early to increase your chances</span>
                    </li>
                </ul>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-bolt text-yellow-500 mr-2"></i>Quick Actions
                </h3>
                <div class="space-y-3">
                    @if(in_array($job->id, $appliedJobIds ?? []))
                        <button disabled class="w-full px-4 py-3 bg-green-100 text-green-700 rounded-lg font-semibold cursor-not-allowed text-center flex items-center justify-center gap-2">
                            <i class="fas fa-check-circle"></i>Already Applied
                        </button>
                    @else
                        <a href="{{ route('seeker.applications.create', ['job' => $job->id]) }}" class="w-full px-4 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition text-center flex items-center justify-center gap-2" title="Route: seeker.applications.create">
                            <i class="fas fa-paper-plane"></i>Apply to Job
                        </a>
                    @endif
                    <a href="{{ route('seeker.browse-jobs') }}" class="w-full px-4 py-3 bg-gray-200 text-gray-800 rounded-lg font-semibold hover:bg-gray-300 transition text-center flex items-center justify-center gap-2">
                        <i class="fas fa-briefcase"></i>Browse Jobs
                    </a>
                </div>
            </div>

            <!-- Share Job -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Share This Job</h3>
                <div class="flex gap-2">
                    <button onclick="shareVia('email')" class="flex-1 px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-semibold">
                        <i class="fas fa-envelope mr-1"></i>Email
                    </button>
                    <button onclick="shareVia('copy')" class="flex-1 px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-semibold">
                        <i class="fas fa-link mr-1"></i>Copy Link
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="flex justify-start">
        <a href="{{ route('seeker.browse-jobs') }}" class="px-6 py-3 bg-gray-200 text-gray-800 rounded-lg font-semibold hover:bg-gray-300 transition flex items-center gap-2">
            <i class="fas fa-arrow-left"></i>Back to Jobs
        </a>
    </div>
</div>

<script>
    function shareVia(method) {
        const jobUrl = window.location.href;
        const jobTitle = '{{ $job->title }}';
        
        if (method === 'email') {
            window.location.href = `mailto:?subject=Check out this job: ${jobTitle}&body=I found this interesting job: ${jobUrl}`;
        } else if (method === 'copy') {
            navigator.clipboard.writeText(jobUrl).then(() => {
                alert('Job link copied to clipboard!');
            });
        }
    }
</script>
@endsection
