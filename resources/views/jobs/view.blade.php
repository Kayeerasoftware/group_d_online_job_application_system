<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $job->title }} - Online Job Application System</title>
    @if (file_exists(public_path('hot')) || file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="joblink-theme min-h-screen overflow-x-hidden antialiased">
    <div class="joblink-canvas relative min-h-screen overflow-hidden bg-[#fffdd0]">
        <div class="joblink-grid pointer-events-none absolute inset-0 opacity-70 [mask-image:linear-gradient(to_bottom,rgba(0,0,0,0.88),transparent)] hidden"></div>
        <div class="pointer-events-none absolute -left-24 top-24 h-72 w-72 rounded-full bg-emerald-500/10 blur-3xl animate-float-slow hidden"></div>
        <div class="pointer-events-none absolute -right-28 top-1/2 h-80 w-80 rounded-full bg-sky-500/10 blur-3xl animate-float-slow hidden" style="animation-delay: -4s;"></div>

        @include('partials.job-view-topbar')

        <main class="app-main relative z-10 mx-auto max-w-7xl px-4 pb-12 pt-6 md:px-6 md:pb-16 md:pt-8 animate-fade-up">
            @include('partials.alerts')

            <div class="joblink-content">
                <div class="min-h-screen bg-gray-50">
                    <!-- Job Header -->
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-8">
                        <div class="max-w-6xl mx-auto px-4">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                                <div class="flex-1">
                                    <h1 class="text-3xl md:text-4xl font-bold mb-2">{{ $job->title }}</h1>
                                    <p class="text-blue-100 text-lg mb-4">{{ $job->employer?->employerProfile?->company_name ?? $job->employer?->name }}</p>
                                    <p class="text-blue-100 line-clamp-2">{{ $job->description }}</p>
                                </div>
                                <div class="flex flex-col gap-3 md:flex-shrink-0">
                                    @if(auth()->check() && auth()->user()->isSeeker())
                                        @if(in_array($job->id, $appliedJobIds ?? []))
                                            <button disabled class="px-6 py-3 bg-green-100 text-green-700 rounded-lg font-semibold text-center cursor-not-allowed">
                                                <i class="fas fa-check mr-2"></i>Already Applied
                                            </button>
                                        @else
                                            <a href="{{ route('seeker.applications.create', ['job' => $job->id]) }}" class="px-6 py-3 bg-white text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition text-center">
                                                <i class="fas fa-paper-plane mr-2"></i>Apply Now
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="px-6 py-3 bg-white text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition text-center">
                                            <i class="fas fa-sign-in-alt mr-2"></i>Login to Apply
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Content -->
                    <div class="max-w-6xl mx-auto px-4 py-8">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                            <!-- Left Column -->
                            <div class="lg:col-span-2 space-y-6">
                                <!-- Key Information Cards -->
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                    <div class="bg-white rounded-lg shadow p-4">
                                        <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Location</p>
                                        <p class="text-lg font-bold text-gray-900 mt-2">{{ $job->location }}</p>
                                    </div>
                                    <div class="bg-white rounded-lg shadow p-4">
                                        <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Job Type</p>
                                        <p class="text-lg font-bold text-gray-900 mt-2">{{ ucfirst($job->job_type instanceof \App\Enums\JobType ? $job->job_type->value : ($job->job_type ?? 'N/A')) }}</p>
                                    </div>
                                    <div class="bg-white rounded-lg shadow p-4">
                                        <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Status</p>
                                        <p class="text-lg font-bold text-gray-900 mt-2">
                                            @php
                                                $daysUntilDeadline = $job->deadline ? now()->diffInDays($job->deadline, false) : null;
                                                if ($daysUntilDeadline === null) {
                                                    $statusText = 'Open';
                                                } elseif ($daysUntilDeadline <= 0) {
                                                    $statusText = 'Closed';
                                                } elseif ($daysUntilDeadline <= 3) {
                                                    $statusText = 'Closing Soon';
                                                } else {
                                                    $statusText = 'Open';
                                                }
                                            @endphp
                                            {{ $statusText }}
                                        </p>
                                    </div>
                                    <div class="bg-white rounded-lg shadow p-4">
                                        <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Deadline</p>
                                        <p class="text-lg font-bold text-gray-900 mt-2">{{ optional($job->deadline)->format('M d, Y') ?? 'N/A' }}</p>
                                    </div>
                                </div>

                                <!-- Salary Section -->
                                <div class="bg-white rounded-lg shadow-lg p-6">
                                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                        <i class="fas fa-dollar-sign text-green-600 mr-3"></i>Salary Range
                                    </h2>
                                    <p class="text-2xl font-bold text-green-700">
                                        @if($job->salary_min && $job->salary_max)
                                            UGX {{ number_format((int)$job->salary_min) }} - {{ number_format((int)$job->salary_max) }}
                                        @elseif($job->salary_min)
                                            From UGX {{ number_format((int)$job->salary_min) }}
                                        @elseif($job->salary_max)
                                            Up to UGX {{ number_format((int)$job->salary_max) }}
                                        @else
                                            Not specified
                                        @endif
                                    </p>
                                </div>

                                <!-- Description -->
                                <div class="bg-white rounded-lg shadow-lg p-6">
                                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                        <i class="fas fa-file-alt text-blue-600 mr-3"></i>Job Description
                                    </h2>
                                    <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed whitespace-pre-line">
                                        {{ $job->description }}
                                    </div>
                                </div>

                                <!-- Requirements -->
                                <div class="bg-white rounded-lg shadow-lg p-6">
                                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                        <i class="fas fa-list-check text-blue-600 mr-3"></i>Requirements
                                    </h2>
                                    <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed whitespace-pre-line">
                                        {{ $job->requirements }}
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-6">
                                <!-- Company Information -->
                                <div class="bg-white rounded-lg shadow-lg p-6">
                                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                        <i class="fas fa-building text-blue-600 mr-3"></i>About Company
                                    </h2>
                                    <div class="space-y-4">
                                        <!-- Company Logo -->
                                        <div class="flex justify-center mb-4">
                                            @if($job->employer?->employerProfile?->company_logo)
                                                <img src="{{ asset($job->employer->employerProfile->company_logo) }}" alt="Company" class="h-24 w-24 object-cover rounded-lg" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                <div class="h-24 w-24 bg-gray-300/30 flex items-center justify-center text-3xl font-bold text-gray-600 rounded-lg hidden">{{ substr($job->employer?->name ?? 'C', 0, 1) }}</div>
                                            @else
                                                <div class="h-24 w-24 bg-gray-300/30 flex items-center justify-center text-3xl font-bold text-gray-600 rounded-lg">{{ substr($job->employer?->name ?? 'C', 0, 1) }}</div>
                                            @endif
                                        </div>
                                        
                                        <div>
                                            <p class="text-sm font-semibold text-gray-600">Company Name</p>
                                            <p class="text-lg font-bold text-gray-900 mt-1">{{ $job->employer?->employerProfile?->company_name ?? $job->employer?->name ?? 'Unknown' }}</p>
                                        </div>
                                        
                                        @if($job->employer?->employerProfile?->company_description)
                                        <div>
                                            <p class="text-sm font-semibold text-gray-600">About</p>
                                            <p class="text-sm text-gray-700 mt-1">{{ $job->employer->employerProfile->company_description }}</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Job Details -->
                                <div class="bg-white rounded-lg shadow-lg p-6">
                                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                        <i class="fas fa-info-circle text-blue-600 mr-3"></i>Job Details
                                    </h2>
                                    <div class="space-y-4">
                                        <div>
                                            <p class="text-sm font-semibold text-gray-600">Category</p>
                                            <p class="text-lg font-bold text-gray-900 mt-1">{{ $job->category ?? 'N/A' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-600">Level</p>
                                            <p class="text-lg font-bold text-gray-900 mt-1">{{ $job->level ?? 'N/A' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-600">Work Arrangement</p>
                                            <p class="text-lg font-bold text-gray-900 mt-1">{{ $job->work_arrangement ?? 'N/A' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-600">Posted Date</p>
                                            <p class="text-lg font-bold text-gray-900 mt-1">{{ $job->created_at->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Statistics -->
                                <div class="bg-white rounded-lg shadow-lg p-6">
                                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                        <i class="fas fa-chart-bar text-blue-600 mr-3"></i>Statistics
                                    </h2>
                                    <div class="space-y-4">
                                        <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                            <span class="text-gray-600 font-medium">Total Views</span>
                                            <span class="text-2xl font-bold text-blue-600">{{ number_format($job->views_count ?? 0) }}</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-600 font-medium">Applications</span>
                                            <span class="text-2xl font-bold text-green-600">{{ number_format($job->applications_count ?? 0) }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="bg-white rounded-lg shadow-lg p-6 space-y-3">
                                    @if(auth()->check() && auth()->user()->isSeeker())
                                        @if(in_array($job->id, $appliedJobIds ?? []))
                                            <button disabled class="w-full px-4 py-3 bg-green-100 text-green-700 rounded-lg font-semibold cursor-not-allowed text-center flex items-center justify-center gap-2">
                                                <i class="fas fa-check-circle"></i>Already Applied
                                            </button>
                                        @else
                                            <a href="{{ route('seeker.applications.create', ['job' => $job->id]) }}" class="w-full px-4 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition text-center flex items-center justify-center gap-2">
                                                <i class="fas fa-paper-plane"></i>Apply to Job
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="w-full px-4 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition text-center flex items-center justify-center gap-2">
                                            <i class="fas fa-sign-in-alt"></i>Login to Apply
                                        </a>
                                    @endif
                                    
                                    <a href="{{ route('home') }}" class="w-full px-4 py-3 bg-gray-200 text-gray-800 rounded-lg font-semibold hover:bg-gray-300 transition text-center flex items-center justify-center gap-2">
                                        <i class="fas fa-arrow-left"></i>Back to Jobs
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
