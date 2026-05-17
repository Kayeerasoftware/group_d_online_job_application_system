@extends('layouts.jobseeker')

@section('title', 'Browse Jobs')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-4 md:mb-6">
        <div class="bg-gradient-to-br from-blue-50 via-cyan-50 to-teal-50 rounded-2xl shadow-lg border border-blue-100 p-6 md:p-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
                <div class="flex items-center gap-2 md:gap-4">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                        <div class="relative bg-gradient-to-br from-blue-600 to-cyan-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                            <i class="fas fa-search text-white text-xl md:text-3xl"></i>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-blue-600 via-cyan-600 to-teal-600 bg-clip-text text-transparent mb-1 md:mb-2">Browse Jobs</h1>
                        <p class="text-gray-600 text-xs md:text-sm font-medium">Find your next opportunity</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-3 mb-3 md:mb-4">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-[8px] md:text-[10px] font-medium mb-0.5">Total Jobs</p>
                    <h3 class="text-base md:text-xl font-bold" id="totalJobsCount">{{ $jobs->total() }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-briefcase text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-start justify-between gap-2">
                <div class="space-y-0.5">
                    <p class="text-[7px] md:text-[8px]">Full-time</p>
                    <p class="text-[7px] md:text-[8px]">Part-time</p>
                    <p class="text-[7px] md:text-[8px]">Internship</p>
                    <p class="text-[7px] md:text-[8px]">Contract</p>
                </div>
                <div class="space-y-0.5 text-right">
                    <p class="text-[7px] md:text-[8px] font-semibold" id="fullTimeCount">0 job</p>
                    <p class="text-[7px] md:text-[8px] font-semibold" id="partTimeCount">0 job</p>
                    <p class="text-[7px] md:text-[8px] font-semibold" id="internshipCount">0 job</p>
                    <p class="text-[7px] md:text-[8px] font-semibold" id="contractCount">0 job</p>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-[8px] md:text-[10px] font-medium mb-0.5">New This Week</p>
                    <h3 class="text-base md:text-xl font-bold" id="newThisWeekCount">0</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-star text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-[8px] md:text-[10px] font-medium mb-0.5">Saved Jobs</p>
                    <h3 class="text-base md:text-xl font-bold">{{ count($savedJobIds) }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-bookmark text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filters -->
    <div class="bg-gradient-to-br from-blue-50 via-cyan-50 to-teal-50 rounded-2xl shadow-lg border border-blue-100 overflow-hidden mb-4">
        <div x-data="{ showAdvanced: false }">
            <div class="bg-white/60 backdrop-blur-sm p-3">
                <div class="bg-white/80 rounded-xl p-2.5 border border-blue-100">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-2">
                        <div class="md:col-span-4 relative">
                            <i class="fas fa-search absolute left-2.5 top-1/2 transform -translate-y-1/2 text-blue-400 text-xs"></i>
                            <input type="text" id="searchInput" placeholder="Job title, keywords..." class="w-full pl-8 pr-2 py-1.5 text-xs border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-white">
                        </div>
                        <div class="md:col-span-3 relative">
                            <i class="fas fa-map-marker-alt absolute left-2.5 top-1/2 transform -translate-y-1/2 text-cyan-400 text-xs"></i>
                            <input type="text" id="locationInput" placeholder="Location..." class="w-full pl-8 pr-2 py-1.5 text-xs border border-cyan-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all bg-white">
                        </div>
                        <div class="md:col-span-2 relative">
                            <i class="fas fa-briefcase absolute left-2.5 top-1/2 transform -translate-y-1/2 text-teal-400 text-xs"></i>
                            <select id="categoryInput" class="w-full pl-8 pr-2 py-1.5 text-xs border border-teal-200 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all appearance-none bg-white">
                                <option value="">All Categories</option>
                                <option value="technology">Technology</option>
                                <option value="finance">Finance</option>
                                <option value="healthcare">Healthcare</option>
                                <option value="education">Education</option>
                            </select>
                        </div>
                        <div class="md:col-span-3 flex gap-1.5">
                            <button onclick="resetFilters()" class="flex-1 px-2 py-1.5 text-xs bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold">
                                <i class="fas fa-search mr-1"></i>Clear
                            </button>
                            <a href="{{ route('seeker.browse-jobs') }}" class="px-2 py-1.5 text-xs bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 rounded-lg hover:shadow-md transition-all duration-300 font-semibold">
                                <i class="fas fa-redo"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Advanced Filters Section -->
                    <div x-show="showAdvanced" x-collapse class="mt-2 pt-2 border-t border-blue-100">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                            <select id="jobTypeInput" class="w-full px-2 py-1.5 text-xs border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                                <option value="">All Job Types</option>
                                <option value="full-time">Full-time</option>
                                <option value="part-time">Part-time</option>
                                <option value="contract">Contract</option>
                                <option value="freelance">Freelance</option>
                            </select>
                            <select id="levelInput" class="w-full px-2 py-1.5 text-xs border border-cyan-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent bg-white">
                                <option value="">All Levels</option>
                                <option value="entry">Entry Level</option>
                                <option value="mid">Mid Level</option>
                                <option value="senior">Senior</option>
                                <option value="executive">Executive</option>
                            </select>
                            <select id="workArrangementInput" class="w-full px-2 py-1.5 text-xs border border-teal-200 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent bg-white">
                                <option value="">All Arrangements</option>
                                <option value="remote">Remote</option>
                                <option value="on-site">On-site</option>
                                <option value="hybrid">Hybrid</option>
                            </select>
                            <select id="sortInput" class="w-full px-2 py-1.5 text-xs border border-purple-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white">
                                <option value="newest">Most Recent</option>
                                <option value="relevant">Most Relevant</option>
                                <option value="salary_high">Salary: High to Low</option>
                                <option value="salary_low">Salary: Low to High</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-2 flex justify-end">
                    <button type="button" @click="showAdvanced = !showAdvanced" class="text-xs font-semibold text-blue-600 hover:text-blue-800 transition flex items-center gap-1">
                        <i class="fas fa-sliders-h"></i>
                        <span x-text="showAdvanced ? 'Hide Advanced' : 'Show Advanced'"></span>
                        <i class="fas fa-chevron-down text-[8px] transition-transform" :class="showAdvanced ? 'rotate-180' : ''"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Count & View Toggle -->
    <div class="flex justify-between items-center mb-4">
        <p class="text-gray-600 font-semibold text-sm">Showing <span class="text-blue-600" id="showingCount">0</span> jobs out of <span class="text-blue-600" id="totalCount">{{ $jobs->count() }}</span> jobs</p>
        <div class="flex gap-2">
            <button onclick="switchView('grid')" id="gridViewBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold transition-all duration-300">
                <i class="fas fa-th mr-2"></i>View Grid
            </button>
            <button onclick="switchView('list')" id="listViewBtn" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg font-semibold transition-all duration-300 hover:bg-gray-400">
                <i class="fas fa-list mr-2"></i>View List
            </button>
        </div>
    </div>

    <!-- Job Listings Grid -->
    <div id="gridView" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
        @foreach($jobs as $job)
        <div class="job-card bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border-l-4 border-blue-600 p-3 flex flex-col" data-job-id="{{ $job->id }}" data-title="{{ strtolower($job->title ?? '') }}" data-location="{{ strtolower($job->location ?? '') }}" data-category="{{ strtolower($job->category ?? '') }}" data-job-type="{{ strtolower($job->job_type instanceof \App\Enums\JobType ? $job->job_type->value : ($job->job_type ?? '')) }}" data-level="{{ strtolower($job->level ?? '') }}" data-work-arrangement="{{ strtolower($job->work_arrangement ?? '') }}" data-salary-max="{{ $job->salary_max ?? 0 }}" data-salary-min="{{ $job->salary_min ?? 0 }}" data-created-at="{{ $job->created_at }}">
            <!-- Status Badge -->
            <div class="flex items-center justify-between gap-2 mb-2">
                @php
                    $daysUntilDeadline = $job->deadline ? now()->diffInDays($job->deadline, false) : null;
                    if ($daysUntilDeadline === null) {
                        $statusBadge = 'bg-green-100 text-green-800';
                        $statusText = 'Open';
                    } elseif ($daysUntilDeadline <= 0) {
                        $statusBadge = 'bg-red-100 text-red-800';
                        $statusText = 'Closed';
                    } elseif ($daysUntilDeadline <= 3) {
                        $statusBadge = 'bg-orange-100 text-orange-800';
                        $statusText = 'Closing Soon';
                    } elseif ($daysUntilDeadline <= 7) {
                        $statusBadge = 'bg-yellow-100 text-yellow-800';
                        $statusText = 'Hurry Up';
                    } else {
                        $statusBadge = 'bg-green-100 text-green-800';
                        $statusText = 'Still Open';
                    }
                @endphp
                <span class="px-2 py-0.5 rounded-full text-xs font-semibold {{ $statusBadge }}">
                    {{ $statusText }}
                </span>
                @if(!in_array($job->id, $savedJobIds))
                <form action="{{ route('seeker.saved-jobs.store', $job) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-2 py-0.5 bg-yellow-100 text-yellow-700 rounded text-xs font-semibold hover:bg-yellow-200 transition whitespace-nowrap">
                        Save
                    </button>
                </form>
                @else
                <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded text-xs font-semibold whitespace-nowrap">
                    <i class="fas fa-check mr-0.5"></i>Saved
                </span>
                @endif
            </div>
            
            <!-- Job Title -->
            <div class="mb-2">
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Job</p>
                <h3 class="text-sm font-bold text-gray-900 line-clamp-2">{{ $job->title ?? 'N/A' }}</h3>
            </div>
            
            <!-- Company -->
            <div class="mb-2">
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Company</p>
                <p class="text-sm text-gray-700 font-semibold line-clamp-1">{{ $job->employer?->employerProfile?->company_name ?? $job->employer?->name ?? 'Unknown' }}</p>
            </div>
            
            <!-- Description -->
            <p class="text-gray-600 mb-2 line-clamp-2 text-xs flex-grow">{{ $job->description ?? 'No description' }}</p>
            
            <!-- Details -->
            <div class="space-y-1 mb-2 pb-2 border-b border-gray-200 text-xs text-gray-600">
                <p><i class="fas fa-map-marker-alt mr-1.5 text-blue-600 w-3"></i>{{ $job->location ?? 'Not specified' }}</p>
                <p><i class="fas fa-briefcase mr-1.5 text-blue-600 w-3"></i>{{ ucfirst($job->job_type instanceof \App\Enums\JobType ? $job->job_type->value : ($job->job_type ?? 'N/A')) }}</p>
                @if($job->salary_min || $job->salary_max)
                <p><i class="fas fa-dollar-sign mr-1.5 text-blue-600 w-3"></i>
                    @if($job->salary_min && $job->salary_max)
                        UGX {{ number_format((int)$job->salary_min) }} - {{ number_format((int)$job->salary_max) }}
                    @elseif($job->salary_min)
                        From UGX {{ number_format((int)$job->salary_min) }}
                    @else
                        Up to UGX {{ number_format((int)$job->salary_max) }}
                    @endif
                </p>
                @endif
                @if($job->deadline)
                <p class="bg-gray-100 px-2 py-1 rounded text-xs"><i class="fas fa-calendar mr-1.5 text-red-600 w-3"></i>
                    @php
                        $now = now();
                        $deadline = $job->deadline;
                        
                        if ($deadline <= $now) {
                            echo "<span class='text-red-600 font-semibold'>Closed</span>";
                        } else {
                            $interval = $now->diff($deadline);
                            
                            if ($interval->m > 0) {
                                echo "<span class='text-red-600 font-semibold'>Closing in " . $interval->m . " month" . ($interval->m !== 1 ? "s" : "") . "</span>";
                            } elseif ($interval->d > 0) {
                                echo "<span class='text-red-600 font-semibold'>Closing in " . $interval->d . " day" . ($interval->d !== 1 ? "s" : "") . "</span>";
                            } elseif ($interval->h > 0) {
                                echo "<span class='text-red-600 font-semibold'>Closing in " . $interval->h . " hour" . ($interval->h !== 1 ? "s" : "") . "</span>";
                            } else {
                                echo "<span class='text-red-600 font-semibold'>Closing in " . $interval->i . " minute" . ($interval->i !== 1 ? "s" : "") . "</span>";
                            }
                        }
                    @endphp
                </p>
                @endif
            </div>
            
            <!-- Action Buttons -->
            <div class="flex gap-2 flex-col">
                @if(in_array($job->id, $appliedJobIds))
                    <button disabled class="px-2 py-1.5 bg-gray-400 text-white rounded text-xs font-semibold cursor-not-allowed">
                        <i class="fas fa-check mr-1"></i>Applied
                    </button>
                @else
                    <a href="{{ route('seeker.applications.create', ['job_id' => $job->id]) }}" class="px-2 py-1.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded text-xs font-semibold hover:shadow-md transition text-center">
                        <i class="fas fa-paper-plane mr-1"></i>Apply
                    </a>
                @endif
                <a href="{{ route('seeker.jobs.show', $job) }}" class="px-2 py-1.5 border border-blue-600 text-blue-600 rounded text-xs font-semibold hover:bg-blue-50 transition text-center">
                    <i class="fas fa-eye mr-1"></i>Details
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Job Listings Table -->
    <div id="listView" class="hidden">
        <div class="overflow-x-auto bg-white rounded-lg shadow-md border border-gray-200">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Job Title</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Company</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Location</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Type</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Salary</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Deadline</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="divide-y divide-gray-200">
                    @foreach($jobs as $job)
                    <tr class="hover:bg-gray-50 transition-colors job-table-row" data-job-id="{{ $job->id }}" data-title="{{ strtolower($job->title ?? '') }}" data-location="{{ strtolower($job->location ?? '') }}" data-category="{{ strtolower($job->category ?? '') }}" data-job-type="{{ strtolower($job->job_type instanceof \App\Enums\JobType ? $job->job_type->value : ($job->job_type ?? '')) }}" data-level="{{ strtolower($job->level ?? '') }}" data-work-arrangement="{{ strtolower($job->work_arrangement ?? '') }}" data-salary-max="{{ $job->salary_max ?? 0 }}" data-salary-min="{{ $job->salary_min ?? 0 }}" data-created-at="{{ $job->created_at }}">
                        <td class="px-6 py-4 text-sm font-semibold text-gray-900 border-r border-gray-300 border-opacity-50">{{ $job->title ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 border-r border-gray-300 border-opacity-50">{{ $job->employer?->employerProfile?->company_name ?? $job->employer?->name ?? 'Unknown' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 border-r border-gray-300 border-opacity-50">{{ $job->location ?? 'Not specified' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 border-r border-gray-300 border-opacity-50">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs font-semibold">{{ ucfirst($job->job_type instanceof \App\Enums\JobType ? $job->job_type->value : ($job->job_type ?? 'N/A')) }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700 border-r border-gray-300 border-opacity-50">
                            @if($job->salary_min || $job->salary_max)
                                @if($job->salary_min && $job->salary_max)
                                    UGX {{ number_format((int)$job->salary_min) }} - {{ number_format((int)$job->salary_max) }}
                                @elseif($job->salary_min)
                                    From UGX {{ number_format((int)$job->salary_min) }}
                                @else
                                    Up to UGX {{ number_format((int)$job->salary_max) }}
                                @endif
                            @else
                                <span class="text-gray-400">Not specified</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700 border-r border-gray-300 border-opacity-50">
                            @if($job->deadline)
                                @php
                                    $now = now();
                                    $deadline = $job->deadline;
                                    if ($deadline <= $now) {
                                        $deadlineText = 'Closed';
                                        $deadlineClass = 'text-red-600 font-semibold';
                                    } else {
                                        $interval = $now->diff($deadline);
                                        if ($interval->m > 0) {
                                            $deadlineText = $interval->m . ' month' . ($interval->m !== 1 ? 's' : '');
                                        } elseif ($interval->d > 0) {
                                            $deadlineText = $interval->d . ' day' . ($interval->d !== 1 ? 's' : '');
                                        } else {
                                            $deadlineText = $interval->h . ' hour' . ($interval->h !== 1 ? 's' : '');
                                        }
                                        $deadlineClass = $interval->d <= 3 ? 'text-orange-600 font-semibold' : 'text-gray-700';
                                    }
                                @endphp
                                <span class="{{ $deadlineClass }}">{{ $deadlineText }}</span>
                            @else
                                <span class="text-green-600 font-semibold">Open</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex gap-2 justify-center">
                                @if(in_array($job->id, $appliedJobIds))
                                    <button disabled class="px-3 py-1 bg-gray-400 text-white rounded text-xs font-semibold cursor-not-allowed">
                                        <i class="fas fa-check mr-1"></i>Applied
                                    </button>
                                @else
                                    <a href="{{ route('seeker.applications.create', ['job_id' => $job->id]) }}" class="px-3 py-1 bg-blue-600 text-white rounded text-xs font-semibold hover:bg-blue-700 transition">
                                        <i class="fas fa-paper-plane mr-1"></i>Apply
                                    </a>
                                @endif
                                <a href="{{ route('seeker.jobs.show', $job) }}" class="px-3 py-1 border border-blue-600 text-blue-600 rounded text-xs font-semibold hover:bg-blue-50 transition">
                                    <i class="fas fa-eye mr-1"></i>View
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="noJobsMessage" class="hidden bg-white rounded-lg shadow-md p-12 text-center border border-gray-100">
        <i class="fas fa-briefcase text-gray-400 text-4xl mb-4 block"></i>
        <h3 class="text-xl font-bold text-gray-900 mb-2">No Jobs Found</h3>
        <p class="text-gray-600">Try adjusting your search filters or check back later for new opportunities.</p>
    </div>
</div>

<script>
const allJobs = document.querySelectorAll('.job-card');
const allTableRows = document.querySelectorAll('.job-table-row');
const searchInput = document.getElementById('searchInput');
const locationInput = document.getElementById('locationInput');
const categoryInput = document.getElementById('categoryInput');
const jobTypeInput = document.getElementById('jobTypeInput');
const levelInput = document.getElementById('levelInput');
const workArrangementInput = document.getElementById('workArrangementInput');
const sortInput = document.getElementById('sortInput');
const noJobsMessage = document.getElementById('noJobsMessage');
const gridViewBtn = document.getElementById('gridViewBtn');
const listViewBtn = document.getElementById('listViewBtn');
const gridView = document.getElementById('gridView');
const listView = document.getElementById('listView');

function filterJobs() {
    const searchTerm = searchInput.value.toLowerCase();
    const locationTerm = locationInput.value.toLowerCase();
    const category = categoryInput.value.toLowerCase();
    const jobType = jobTypeInput.value.toLowerCase();
    const level = levelInput.value.toLowerCase();
    const workArrangement = workArrangementInput.value.toLowerCase();
    const sort = sortInput.value;

    let visibleCards = [];
    let visibleRows = [];

    allJobs.forEach(card => {
        const title = card.dataset.title;
        const location = card.dataset.location;
        const cardCategory = card.dataset.category;
        const cardJobType = card.dataset.jobType;
        const cardLevel = card.dataset.level;
        const cardWorkArrangement = card.dataset.workArrangement;

        const matchesSearch = !searchTerm || title.includes(searchTerm) || card.textContent.toLowerCase().includes(searchTerm);
        const matchesLocation = !locationTerm || location.includes(locationTerm);
        const matchesCategory = !category || cardCategory.includes(category);
        const matchesJobType = !jobType || cardJobType.includes(jobType);
        const matchesLevel = !level || cardLevel.includes(level);
        const matchesWorkArrangement = !workArrangement || cardWorkArrangement.includes(workArrangement);

        if (matchesSearch && matchesLocation && matchesCategory && matchesJobType && matchesLevel && matchesWorkArrangement) {
            card.style.display = '';
            visibleCards.push(card);
        } else {
            card.style.display = 'none';
        }
    });

    allTableRows.forEach(row => {
        const title = row.dataset.title;
        const location = row.dataset.location;
        const cardCategory = row.dataset.category;
        const cardJobType = row.dataset.jobType;
        const cardLevel = row.dataset.level;
        const cardWorkArrangement = row.dataset.workArrangement;

        const matchesSearch = !searchTerm || title.includes(searchTerm) || row.textContent.toLowerCase().includes(searchTerm);
        const matchesLocation = !locationTerm || location.includes(locationTerm);
        const matchesCategory = !category || cardCategory.includes(category);
        const matchesJobType = !jobType || cardJobType.includes(jobType);
        const matchesLevel = !level || cardLevel.includes(level);
        const matchesWorkArrangement = !workArrangement || cardWorkArrangement.includes(workArrangement);

        if (matchesSearch && matchesLocation && matchesCategory && matchesJobType && matchesLevel && matchesWorkArrangement) {
            row.style.display = '';
            visibleRows.push(row);
        } else {
            row.style.display = 'none';
        }
    });

    // Sort visible jobs
    if (sort === 'salary_high') {
        visibleCards.sort((a, b) => parseFloat(b.dataset.salaryMax) - parseFloat(a.dataset.salaryMax));
        visibleRows.sort((a, b) => parseFloat(b.dataset.salaryMax) - parseFloat(a.dataset.salaryMax));
    } else if (sort === 'salary_low') {
        visibleCards.sort((a, b) => parseFloat(a.dataset.salaryMin) - parseFloat(b.dataset.salaryMin));
        visibleRows.sort((a, b) => parseFloat(a.dataset.salaryMin) - parseFloat(b.dataset.salaryMin));
    } else if (sort === 'relevant') {
        visibleCards.sort((a, b) => new Date(b.dataset.createdAt) - new Date(a.dataset.createdAt));
        visibleRows.sort((a, b) => new Date(b.dataset.createdAt) - new Date(a.dataset.createdAt));
    } else {
        visibleCards.sort((a, b) => new Date(b.dataset.createdAt) - new Date(a.dataset.createdAt));
        visibleRows.sort((a, b) => new Date(b.dataset.createdAt) - new Date(a.dataset.createdAt));
    }

    // Reorder DOM
    visibleCards.forEach(job => gridView.appendChild(job));
    visibleRows.forEach(row => document.getElementById('tableBody').appendChild(row));

    // Update stats
    updateStats(visibleCards);

    // Show/hide no results message
    if (visibleCards.length === 0) {
        noJobsMessage.classList.remove('hidden');
    } else {
        noJobsMessage.classList.add('hidden');
    }

    document.getElementById('showingCount').textContent = visibleCards.length;
}

function updateStats(visibleJobs) {
    const fullTime = visibleJobs.filter(j => j.dataset.jobType.includes('full-time')).length;
    const partTime = visibleJobs.filter(j => j.dataset.jobType.includes('part-time')).length;
    const internship = visibleJobs.filter(j => j.dataset.jobType.includes('internship')).length;
    const contract = visibleJobs.filter(j => j.dataset.jobType.includes('contract')).length;
    const newThisWeek = visibleJobs.filter(j => {
        const createdDate = new Date(j.dataset.createdAt);
        const weekAgo = new Date();
        weekAgo.setDate(weekAgo.getDate() - 7);
        return createdDate >= weekAgo;
    }).length;

    document.getElementById('fullTimeCount').textContent = fullTime + ' job';
    document.getElementById('partTimeCount').textContent = partTime + ' job';
    document.getElementById('internshipCount').textContent = internship + ' job';
    document.getElementById('contractCount').textContent = contract + ' job';
    document.getElementById('newThisWeekCount').textContent = newThisWeek;
    document.getElementById('totalJobsCount').textContent = visibleJobs.length;
}

function switchView(view) {
    if (view === 'grid') {
        gridView.classList.remove('hidden');
        listView.classList.add('hidden');
        gridViewBtn.classList.add('bg-blue-600', 'text-white');
        gridViewBtn.classList.remove('bg-gray-300', 'text-gray-700');
        listViewBtn.classList.remove('bg-blue-600', 'text-white');
        listViewBtn.classList.add('bg-gray-300', 'text-gray-700');
    } else {
        listView.classList.remove('hidden');
        gridView.classList.add('hidden');
        listViewBtn.classList.add('bg-blue-600', 'text-white');
        listViewBtn.classList.remove('bg-gray-300', 'text-gray-700');
        gridViewBtn.classList.remove('bg-blue-600', 'text-white');
        gridViewBtn.classList.add('bg-gray-300', 'text-gray-700');
    }
}

function resetFilters() {
    searchInput.value = '';
    locationInput.value = '';
    categoryInput.value = '';
    jobTypeInput.value = '';
    levelInput.value = '';
    workArrangementInput.value = '';
    sortInput.value = 'newest';
    filterJobs();
}

searchInput.addEventListener('input', filterJobs);
locationInput.addEventListener('input', filterJobs);
categoryInput.addEventListener('change', filterJobs);
jobTypeInput.addEventListener('change', filterJobs);
levelInput.addEventListener('change', filterJobs);
workArrangementInput.addEventListener('change', filterJobs);
sortInput.addEventListener('change', filterJobs);

// Initial filter
filterJobs();
</script>

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
