@extends('layouts.employer')

@section('title', 'Applications')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-blue-600 to-blue-700 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                        <i class="fas fa-inbox text-white text-xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Applications</h1>
                    <p class="text-gray-600 text-sm font-medium">Manage and review job applications</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-blue-600">
            <p class="text-xs text-gray-600 font-semibold uppercase">Total</p>
            <p class="text-2xl font-bold text-gray-900 mt-1" id="totalCount">{{ $totalApplications ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-yellow-500">
            <p class="text-xs text-gray-600 font-semibold uppercase">Pending</p>
            <p class="text-2xl font-bold text-yellow-600 mt-1" id="pendingCount">{{ $pendingApplications ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-green-500">
            <p class="text-xs text-gray-600 font-semibold uppercase">Shortlisted</p>
            <p class="text-2xl font-bold text-green-600 mt-1" id="shortlistedCount">{{ $shortlistedApplications ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-red-500">
            <p class="text-xs text-gray-600 font-semibold uppercase">Rejected</p>
            <p class="text-2xl font-bold text-red-600 mt-1" id="rejectedCount">{{ $rejectedApplications ?? 0 }}</p>
        </div>
    </div>

    <!-- Search & Filters -->
    <div class="bg-gradient-to-br from-blue-50 via-cyan-50 to-blue-50 rounded-2xl shadow-lg border border-blue-100 overflow-hidden mb-6">
        <div class="bg-white/60 backdrop-blur-sm p-3">
            <div class="bg-white/80 rounded-xl p-2.5 border border-blue-100">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-2">
                    <div class="md:col-span-4 relative">
                        <i class="fas fa-search absolute left-2.5 top-1/2 transform -translate-y-1/2 text-blue-400 text-xs"></i>
                        <input type="text" id="searchInput" placeholder="Candidate name, job title..." class="w-full pl-8 pr-2 py-1.5 text-xs border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-white">
                    </div>
                    <div class="md:col-span-3 relative">
                        <i class="fas fa-filter absolute left-2.5 top-1/2 transform -translate-y-1/2 text-blue-400 text-xs"></i>
                        <select id="statusFilter" class="w-full pl-8 pr-2 py-1.5 text-xs border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all appearance-none bg-white">
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="shortlisted">Shortlisted</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="md:col-span-2 relative">
                        <i class="fas fa-briefcase absolute left-2.5 top-1/2 transform -translate-y-1/2 text-blue-400 text-xs"></i>
                        <select id="jobFilter" class="w-full pl-8 pr-2 py-1.5 text-xs border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all appearance-none bg-white">
                            <option value="">All Jobs</option>
                            @foreach($jobs as $job)
                                <option value="{{ $job->id }}">{{ $job->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="md:col-span-3 flex gap-1.5">
                        <button onclick="filterApplications()" class="flex-1 px-2 py-1.5 text-xs bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold">
                            <i class="fas fa-search mr-1"></i>Search
                        </button>
                        <a href="{{ route('employer.applications') }}" class="px-2 py-1.5 text-xs bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 rounded-lg hover:shadow-md transition-all duration-300 font-semibold">
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
                            </select>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Count & View Toggle -->
    <div class="flex justify-between items-center mb-4">
        <p class="text-gray-600 font-semibold text-sm">Showing <span class="text-blue-600" id="showingCount">{{ $applications->count() }}</span> applications</p>
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
        @forelse($applications as $application)
            @php
                $statusValue = $application->status instanceof \App\Enums\ApplicationStatus ? $application->status->value : $application->status;
            @endphp
            <div class="application-card bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border border-gray-200 overflow-hidden flex flex-col" data-status="{{ $statusValue }}" data-created="{{ $application->created_at }}" data-job="{{ $application->job_id }}">
                <!-- Header with Profile Picture and Status -->
                <div class="bg-gradient-to-r from-blue-50 to-cyan-50 p-4 border-b border-gray-200">
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <!-- Profile Picture -->
                        <div class="flex-shrink-0">
                            @if($application->seeker->profile_picture)
                                <img src="{{ asset($application->seeker->profile_picture) }}" alt="{{ $application->seeker->name }}" class="w-14 h-14 rounded-lg object-cover border-2 border-blue-300 shadow-md">
                            @else
                                <div class="w-14 h-14 rounded-lg bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold text-lg shadow-md">
                                    {{ strtoupper(substr($application->seeker->name ?? 'U', 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <!-- Status Badge -->
                        <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold whitespace-nowrap
                            @if($statusValue === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($statusValue === 'shortlisted') bg-green-100 text-green-800
                            @elseif($statusValue === 'rejected') bg-red-100 text-red-800
                            @endif">
                            <i class="fas fa-circle text-xs mr-1"></i>
                            {{ ucfirst(str_replace('_', ' ', $statusValue)) }}
                        </span>
                    </div>
                    <!-- Candidate Name and Email -->
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 line-clamp-1">{{ $application->seeker->name ?? 'Unknown' }}</h3>
                        <p class="text-xs text-gray-600 line-clamp-1">{{ $application->seeker->email ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-4 flex-grow">
                    <!-- Job Title -->
                    <div class="mb-3">
                        <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide mb-1">Position</p>
                        <p class="text-sm font-semibold text-gray-900 line-clamp-2">{{ $application->job->title ?? 'N/A' }}</p>
                    </div>

                    <!-- Contact Info -->
                    <div class="space-y-1.5 mb-3 pb-3 border-b border-gray-200 text-xs text-gray-600">
                        <p><i class="fas fa-phone mr-2 text-blue-600 w-3\"></i>{{ $application->seeker->phone ?? 'N/A' }}</p>
                        <p><i class="fas fa-calendar mr-2 text-blue-600 w-3\"></i>Applied {{ $application->created_at->format('M d, Y') }}</p>
                    </div>

                    <!-- Experience -->
                    @if($application->seeker->seekerProfile?->experience_level)
                    <div class="mb-3">
                        <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Experience</p>
                        <p class="text-xs text-gray-700 inline-block px-2 py-1 bg-blue-50 rounded border border-blue-200">{{ $application->seeker->seekerProfile->experience_level }}</p>
                    </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="p-4 border-t border-gray-200 space-y-2">
                    <a href="{{ route('employer.applications.show', $application) }}" class="w-full px-3 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg text-xs font-semibold hover:shadow-md transition text-center block">
                        <i class="fas fa-eye mr-1"></i>View Details
                    </a>
                    @if($statusValue !== 'shortlisted')
                        <form action="{{ route('employer.applications.status', $application) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="shortlisted">
                            <button type="submit" class="w-full px-3 py-2 bg-green-600 text-white rounded-lg text-xs font-semibold hover:bg-green-700 transition">
                                <i class="fas fa-check mr-1"></i>Shortlist
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-lg shadow-md p-12 text-center border border-gray-200">
                <i class="fas fa-inbox text-5xl text-gray-300 mb-4 block"></i>
                <p class="text-lg font-semibold text-gray-900 mb-2">No applications yet</p>
                <p class="text-gray-600">Applications will appear here as job seekers apply to your positions</p>
            </div>
        @endforelse
    </div>

    <!-- List View -->
    <div id="listView" class="hidden">
        <div class="overflow-x-auto bg-white rounded-lg shadow-md border border-gray-200">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Candidate</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Position</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Applied</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="divide-y divide-gray-200">
                    @forelse($applications as $application)
                        @php
                            $statusValue = $application->status instanceof \App\Enums\ApplicationStatus ? $application->status->value : $application->status;
                        @endphp
                        <tr class="hover:bg-gray-50 transition-colors application-table-row" data-status="{{ $statusValue }}" data-created="{{ $application->created_at }}" data-job="{{ $application->job_id }}">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <!-- Profile Picture -->
                                    <div class="flex-shrink-0">
                                        @if($application->seeker->profile_picture)
                                            <img src="{{ asset($application->seeker->profile_picture) }}" alt="{{ $application->seeker->name }}" class="w-10 h-10 rounded-full object-cover border-2 border-blue-200">
                                        @else
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold text-sm">
                                                {{ strtoupper(substr($application->seeker->name ?? 'U', 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Candidate Info -->
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">{{ $application->seeker->name ?? 'Unknown' }}</p>
                                        <p class="text-xs text-gray-600">{{ $application->seeker->email ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $application->job->title ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $application->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold
                                    @if($statusValue === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($statusValue === 'shortlisted') bg-green-100 text-green-800
                                    @elseif($statusValue === 'rejected') bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $statusValue)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('employer.applications.show', $application) }}" class="px-3 py-1 bg-blue-600 text-white rounded text-xs font-semibold hover:bg-blue-700 transition">
                                    <i class="fas fa-eye mr-1"></i>View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <i class="fas fa-inbox text-4xl text-gray-300 mb-3 block"></i>
                                <p class="text-gray-600">No applications yet</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($applications->hasPages())
        <div class="mt-8 flex justify-center">
            {{ $applications->links() }}
        </div>
    @endif
</div>

<script>
const allCards = document.querySelectorAll('.application-card');
const allTableRows = document.querySelectorAll('.application-table-row');
const searchInput = document.getElementById('searchInput');
const statusFilter = document.getElementById('statusFilter');
const jobFilter = document.getElementById('jobFilter');
const sortFilter = document.getElementById('sortFilter');
const gridViewBtn = document.getElementById('gridViewBtn');
const listViewBtn = document.getElementById('listViewBtn');
const gridView = document.getElementById('gridView');
const listView = document.getElementById('listView');
const showingCount = document.getElementById('showingCount');

function filterApplications() {
    const searchTerm = searchInput.value.toLowerCase();
    const status = statusFilter.value.toLowerCase();
    const jobId = jobFilter.value;
    const sort = sortFilter.value;
    let visibleCards = [];
    let visibleRows = [];

    allCards.forEach(card => {
        const cardStatus = card.dataset.status;
        const cardJobId = card.dataset.job;
        const cardText = card.textContent.toLowerCase();
        
        const matchesSearch = !searchTerm || cardText.includes(searchTerm);
        const matchesStatus = !status || cardStatus === status;
        const matchesJob = !jobId || cardJobId === jobId;
        
        if (matchesSearch && matchesStatus && matchesJob) {
            card.style.display = '';
            visibleCards.push(card);
        } else {
            card.style.display = 'none';
        }
    });

    allTableRows.forEach(row => {
        const rowStatus = row.dataset.status;
        const rowJobId = row.dataset.job;
        const rowText = row.textContent.toLowerCase();
        
        const matchesSearch = !searchTerm || rowText.includes(searchTerm);
        const matchesStatus = !status || rowStatus === status;
        const matchesJob = !jobId || rowJobId === jobId;
        
        if (matchesSearch && matchesStatus && matchesJob) {
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
    } else {
        visibleCards.sort((a, b) => new Date(b.dataset.created) - new Date(a.dataset.created));
        visibleRows.sort((a, b) => new Date(b.dataset.created) - new Date(a.dataset.created));
    }

    // Reorder DOM
    visibleCards.forEach(card => gridView.appendChild(card));
    visibleRows.forEach(row => document.getElementById('tableBody').appendChild(row));

    showingCount.textContent = visibleCards.length;
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

searchInput.addEventListener('input', filterApplications);
statusFilter.addEventListener('change', filterApplications);
jobFilter.addEventListener('change', filterApplications);
sortFilter.addEventListener('change', filterApplications);

// Initial filter
filterApplications();
</script>
@endsection
