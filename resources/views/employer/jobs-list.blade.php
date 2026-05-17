@extends('layouts.employer')

@section('title', 'My Jobs')

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
                            <i class="fas fa-briefcase text-white text-xl md:text-3xl"></i>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-blue-600 via-cyan-600 to-teal-600 bg-clip-text text-transparent mb-1 md:mb-2">My Job Postings</h1>
                        <p class="text-gray-600 text-xs md:text-sm font-medium">Manage and track your job listings</p>
                    </div>
                </div>
                <a href="{{ route('jobs.create') }}" class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:shadow-lg transition-all duration-300 text-sm font-bold flex items-center justify-center gap-2 whitespace-nowrap">
                    <i class="fas fa-plus"></i>Post New Job
                </a>
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
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-[8px] md:text-[10px] font-medium mb-0.5">Open Jobs</p>
                    <h3 class="text-base md:text-xl font-bold" id="openJobsCount">0</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-unlock text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-[8px] md:text-[10px] font-medium mb-0.5">Total Applications</p>
                    <h3 class="text-base md:text-xl font-bold" id="totalApplicationsCount">0</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-inbox text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-[8px] md:text-[10px] font-medium mb-0.5">Total Views</p>
                    <h3 class="text-base md:text-xl font-bold" id="totalViewsCount">0</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-eye text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filters -->
    <div class="bg-gradient-to-br from-blue-50 via-cyan-50 to-teal-50 rounded-2xl shadow-lg border border-blue-100 overflow-hidden mb-4">
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
                        <i class="fas fa-filter absolute left-2.5 top-1/2 transform -translate-y-1/2 text-teal-400 text-xs"></i>
                        <select id="statusFilter" class="w-full pl-8 pr-2 py-1.5 text-xs border border-teal-200 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all appearance-none bg-white">
                            <option value="">All Status</option>
                            <option value="open">Open</option>
                            <option value="closed">Closed</option>
                        </select>
                    </div>
                    <div class="md:col-span-3 flex gap-1.5">
                        <button onclick="filterJobs()" class="flex-1 px-2 py-1.5 text-xs bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold">
                            <i class="fas fa-search mr-1"></i>Search
                        </button>
                        <a href="{{ route('jobs.index') }}" class="px-2 py-1.5 text-xs bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 rounded-lg hover:shadow-md transition-all duration-300 font-semibold">
                            <i class="fas fa-redo"></i>
                        </a>
                    </div>
                </div>
                <div class="mt-2 flex justify-end">
                    <div class="text-xs font-semibold text-blue-600">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <span>Sort By:</span>
                            <select id="sortFilter" class="px-2 py-1 border border-blue-200 rounded-lg text-xs focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                                <option value="newest">Newest First</option>
                                <option value="oldest">Oldest First</option>
                                <option value="most_applications">Most Applications</option>
                                <option value="most_views">Most Views</option>
                            </select>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Count & View Toggle -->
    <div class="flex justify-between items-center mb-4">
        <p class="text-gray-600 font-semibold text-sm">Showing <span class="text-blue-600" id="showingCount">{{ $jobs->count() }}</span> jobs</p>
        <div class="flex gap-2">
            <button onclick="switchView('grid')" id="gridViewBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold transition-all duration-300">
                <i class="fas fa-th mr-2"></i>Grid View
            </button>
            <button onclick="switchView('list')" id="listViewBtn" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg font-semibold transition-all duration-300 hover:bg-gray-400">
                <i class="fas fa-list mr-2"></i>List View
            </button>
        </div>
    </div>

    <!-- Grid View -->
    <div id="gridView" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($jobs as $job)
            @php
                $statusValue = $job->status instanceof \App\Enums\JobStatus ? $job->status->value : $job->status;
            @endphp
            <div class="job-card bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border border-gray-200 overflow-hidden flex flex-col" data-status="{{ $statusValue }}" data-location="{{ strtolower($job->location ?? '') }}" data-created="{{ $job->created_at }}" data-applications="{{ $job->applications_count ?? 0 }}" data-views="{{ $job->views_count ?? 0 }}">
                <!-- Header with Status and Stats -->
                <div class="bg-gradient-to-r from-blue-50 to-cyan-50 p-4 border-b border-gray-200">
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <!-- Status Badge -->
                        <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold whitespace-nowrap
                            @if($statusValue === 'open') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            <i class="fas fa-circle text-xs mr-1"></i>
                            {{ ucfirst($statusValue) }}
                        </span>
                        <!-- Quick Stats -->
                        <div class="flex gap-2 text-xs">
                            <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded-full font-semibold">
                                <i class="fas fa-inbox mr-1"></i>{{ $job->applications_count ?? 0 }}
                            </span>
                            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full font-semibold">
                                <i class="fas fa-eye mr-1"></i>{{ $job->views_count ?? 0 }}
                            </span>
                        </div>
                    </div>
                    <!-- Job Title -->
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 line-clamp-2">{{ $job->title }}</h3>
                        <p class="text-xs text-gray-600 mt-1"><i class="fas fa-map-marker-alt mr-1 text-blue-600"></i>{{ $job->location ?? 'Not specified' }}</p>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-4 flex-grow">
                    <!-- Job Type and Details -->
                    <div class="space-y-2 mb-3 pb-3 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500 font-semibold uppercase">Type</span>
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs font-semibold">
                                {{ ucfirst($job->job_type instanceof \App\Enums\JobType ? $job->job_type->value : ($job->job_type ?? 'N/A')) }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500 font-semibold uppercase">Posted</span>
                            <span class="text-xs text-gray-700">{{ $job->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>

                    <!-- Salary Info -->
                    @if($job->salary_min || $job->salary_max)
                    <div class="mb-3 pb-3 border-b border-gray-200">
                        <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Salary Range</p>
                        <p class="text-xs text-gray-700 font-semibold">
                            @if($job->salary_min && $job->salary_max)
                                UGX {{ number_format((int)$job->salary_min) }} - {{ number_format((int)$job->salary_max) }}
                            @elseif($job->salary_min)
                                From UGX {{ number_format((int)$job->salary_min) }}
                            @else
                                Up to UGX {{ number_format((int)$job->salary_max) }}
                            @endif
                        </p>
                    </div>
                    @endif

                    <!-- Description Preview -->
                    <div class="mb-3">
                        <p class="text-xs text-gray-600 line-clamp-2">{{ $job->description ?? 'No description' }}</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="p-4 border-t border-gray-200 space-y-2">
                    <a href="{{ route('jobs.show', $job) }}" class="w-full px-3 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg text-xs font-semibold hover:shadow-md transition text-center block">
                        <i class="fas fa-eye mr-1"></i>View Details
                    </a>
                    <div class="grid grid-cols-2 gap-2">
                        <a href="{{ route('jobs.edit', $job) }}" class="px-3 py-2 border border-blue-600 text-blue-600 rounded-lg text-xs font-semibold hover:bg-blue-50 transition text-center">
                            <i class="fas fa-edit mr-1"></i>Edit
                        </a>
                        <a href="{{ route('employer.applications') }}?job_id={{ $job->id }}" class="px-3 py-2 bg-purple-600 text-white rounded-lg text-xs font-semibold hover:bg-purple-700 transition text-center">
                            <i class="fas fa-inbox mr-1"></i>Apps
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-lg shadow-md p-12 text-center border border-gray-200">
                <i class="fas fa-briefcase text-5xl text-gray-300 mb-4 block"></i>
                <p class="text-lg font-semibold text-gray-900 mb-2">No Job Postings</p>
                <p class="text-gray-600 mb-4">You haven't posted any jobs yet. Start by creating your first job posting.</p>
                <a href="{{ route('jobs.create') }}" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">
                    <i class="fas fa-plus mr-2"></i>Post Your First Job
                </a>
            </div>
        @endforelse
    </div>

    <!-- List View -->
    <div id="listView" class="hidden">
        <div class="overflow-x-auto bg-white rounded-lg shadow-md border border-gray-200">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Job Title</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Location</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Type</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Applications</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Views</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="divide-y divide-gray-200">
                    @forelse($jobs as $job)
                        @php
                            $statusValue = $job->status instanceof \App\Enums\JobStatus ? $job->status->value : $job->status;
                        @endphp
                        <tr class="hover:bg-gray-50 transition-colors job-table-row" data-status="{{ $statusValue }}" data-location="{{ strtolower($job->location ?? '') }}" data-created="{{ $job->created_at }}" data-applications="{{ $job->applications_count ?? 0 }}" data-views="{{ $job->views_count ?? 0 }}">
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $job->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $job->location ?? 'Not specified' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs font-semibold">{{ ucfirst($job->job_type instanceof \App\Enums\JobType ? $job->job_type->value : ($job->job_type ?? 'N/A')) }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $job->applications_count ?? 0 }}</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $job->views_count ?? 0 }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold
                                    @if($statusValue === 'open') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($statusValue) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex gap-2 justify-center flex-wrap">
                                    <a href="{{ route('jobs.show', $job) }}" class="px-3 py-1 bg-blue-600 text-white rounded text-xs font-semibold hover:bg-blue-700 transition">
                                        <i class="fas fa-eye mr-1"></i>View
                                    </a>
                                    <a href="{{ route('jobs.edit', $job) }}" class="px-3 py-1 bg-emerald-600 text-white rounded text-xs font-semibold hover:bg-emerald-700 transition">
                                        <i class="fas fa-edit mr-1"></i>Edit
                                    </a>
                                    <a href="{{ route('employer.applications') }}?job_id={{ $job->id }}" class="px-3 py-1 bg-purple-600 text-white rounded text-xs font-semibold hover:bg-purple-700 transition">
                                        <i class="fas fa-inbox mr-1"></i>Apps
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <i class="fas fa-briefcase text-4xl text-gray-300 mb-3 block"></i>
                                <p class="text-gray-600">No job postings yet</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($jobs->hasPages())
        <div class="mt-8 flex justify-center">
            {{ $jobs->links() }}
        </div>
    @endif
</div>

<script>
const allCards = document.querySelectorAll('.job-card');
const allTableRows = document.querySelectorAll('.job-table-row');
const searchInput = document.getElementById('searchInput');
const locationInput = document.getElementById('locationInput');
const statusFilter = document.getElementById('statusFilter');
const sortFilter = document.getElementById('sortFilter');
const gridViewBtn = document.getElementById('gridViewBtn');
const listViewBtn = document.getElementById('listViewBtn');
const gridView = document.getElementById('gridView');
const listView = document.getElementById('listView');
const showingCount = document.getElementById('showingCount');

function filterJobs() {
    const searchTerm = searchInput.value.toLowerCase();
    const location = locationInput.value.toLowerCase();
    const status = statusFilter.value.toLowerCase();
    const sort = sortFilter.value;
    let visibleCards = [];
    let visibleRows = [];

    allCards.forEach(card => {
        const cardStatus = card.dataset.status;
        const cardLocation = card.dataset.location;
        const cardText = card.textContent.toLowerCase();
        
        const matchesSearch = !searchTerm || cardText.includes(searchTerm);
        const matchesLocation = !location || cardLocation.includes(location);
        const matchesStatus = !status || cardStatus === status;
        
        if (matchesSearch && matchesLocation && matchesStatus) {
            card.style.display = '';
            visibleCards.push(card);
        } else {
            card.style.display = 'none';
        }
    });

    allTableRows.forEach(row => {
        const rowStatus = row.dataset.status;
        const rowLocation = row.dataset.location;
        const rowText = row.textContent.toLowerCase();
        
        const matchesSearch = !searchTerm || rowText.includes(searchTerm);
        const matchesLocation = !location || rowLocation.includes(location);
        const matchesStatus = !status || rowStatus === status;
        
        if (matchesSearch && matchesLocation && matchesStatus) {
            row.style.display = '';
            visibleRows.push(row);
        } else {
            row.style.display = 'none';
        }
    });

    // Sort
    if (sort === 'oldest') {
        visibleCards.sort((a, b) => new Date(a.dataset.created) - new Date(b.dataset.created));
        visibleRows.sort((a, b) => new Date(a.dataset.created) - new Date(b.dataset.created));
    } else if (sort === 'most_applications') {
        visibleCards.sort((a, b) => parseInt(b.dataset.applications) - parseInt(a.dataset.applications));
        visibleRows.sort((a, b) => parseInt(b.dataset.applications) - parseInt(a.dataset.applications));
    } else if (sort === 'most_views') {
        visibleCards.sort((a, b) => parseInt(b.dataset.views) - parseInt(a.dataset.views));
        visibleRows.sort((a, b) => parseInt(b.dataset.views) - parseInt(a.dataset.views));
    } else {
        visibleCards.sort((a, b) => new Date(b.dataset.created) - new Date(a.dataset.created));
        visibleRows.sort((a, b) => new Date(b.dataset.created) - new Date(a.dataset.created));
    }

    // Reorder DOM
    visibleCards.forEach(card => gridView.appendChild(card));
    visibleRows.forEach(row => document.getElementById('tableBody').appendChild(row));

    // Update stats
    updateStats(visibleCards);

    showingCount.textContent = visibleCards.length;
}

function updateStats(visibleJobs) {
    const openJobs = visibleJobs.filter(j => j.dataset.status === 'open').length;
    const totalApplications = visibleJobs.reduce((sum, j) => sum + parseInt(j.dataset.applications), 0);
    const totalViews = visibleJobs.reduce((sum, j) => sum + parseInt(j.dataset.views), 0);

    document.getElementById('openJobsCount').textContent = openJobs;
    document.getElementById('totalApplicationsCount').textContent = totalApplications;
    document.getElementById('totalViewsCount').textContent = totalViews;
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

searchInput.addEventListener('input', filterJobs);
locationInput.addEventListener('input', filterJobs);
statusFilter.addEventListener('change', filterJobs);
sortFilter.addEventListener('change', filterJobs);

// Initial filter
filterJobs();
</script>
@endsection
