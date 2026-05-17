@extends('layouts.jobseeker')

@section('title', 'Saved Jobs')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-teal-600 to-cyan-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-teal-600 to-cyan-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                        <i class="fas fa-bookmark text-white text-xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Saved Jobs</h1>
                    <p class="text-gray-600 text-sm font-medium">Your collection of interesting job opportunities</p>
                </div>
            </div>
            <a href="{{ route('seeker.browse-jobs') }}" class="px-5 py-2.5 bg-gradient-to-r from-teal-600 to-cyan-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 text-sm font-bold flex items-center justify-center gap-2">
                <i class="fas fa-search"></i>Browse Jobs
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-teal-600">
            <p class="text-xs text-gray-600 font-semibold uppercase">Total Saved</p>
            <p class="text-2xl font-bold text-gray-900 mt-1" id="totalCount">{{ $savedJobs->count() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-orange-500">
            <p class="text-xs text-gray-600 font-semibold uppercase">Closing Soon</p>
            <p class="text-2xl font-bold text-orange-600 mt-1" id="closingSoonCount">{{ $closingSoon }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-green-500">
            <p class="text-xs text-gray-600 font-semibold uppercase">Active</p>
            <p class="text-2xl font-bold text-green-600 mt-1" id="activeCount">{{ $activeJobs }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-blue-500">
            <p class="text-xs text-gray-600 font-semibold uppercase">Applied</p>
            <p class="text-2xl font-bold text-blue-600 mt-1" id="appliedCount">0</p>
        </div>
    </div>

    <!-- Search & Filters -->
    <div class="bg-gradient-to-br from-teal-50 via-cyan-50 to-blue-50 rounded-2xl shadow-lg border border-teal-100 overflow-hidden mb-6">
        <div class="bg-white/60 backdrop-blur-sm p-3">
            <div class="bg-white/80 rounded-xl p-2.5 border border-teal-100">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-2">
                    <div class="md:col-span-4 relative">
                        <i class="fas fa-search absolute left-2.5 top-1/2 transform -translate-y-1/2 text-teal-400 text-xs"></i>
                        <input type="text" id="searchInput" placeholder="Job title, keywords..." class="w-full pl-8 pr-2 py-1.5 text-xs border border-teal-200 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all bg-white">
                    </div>
                    <div class="md:col-span-3 relative">
                        <i class="fas fa-map-marker-alt absolute left-2.5 top-1/2 transform -translate-y-1/2 text-cyan-400 text-xs"></i>
                        <input type="text" id="locationInput" placeholder="Location..." class="w-full pl-8 pr-2 py-1.5 text-xs border border-cyan-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all bg-white">
                    </div>
                    <div class="md:col-span-2 relative">
                        <i class="fas fa-filter absolute left-2.5 top-1/2 transform -translate-y-1/2 text-blue-400 text-xs"></i>
                        <select id="statusFilter" class="w-full pl-8 pr-2 py-1.5 text-xs border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all appearance-none bg-white">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="closing">Closing Soon</option>
                            <option value="closed">Closed</option>
                        </select>
                    </div>
                    <div class="md:col-span-3 flex gap-1.5">
                        <button onclick="filterSavedJobs()" class="flex-1 px-2 py-1.5 text-xs bg-gradient-to-r from-teal-600 to-cyan-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold">
                            <i class="fas fa-search mr-1"></i>Search
                        </button>
                        <a href="{{ route('seeker.saved-jobs') }}" class="px-2 py-1.5 text-xs bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 rounded-lg hover:shadow-md transition-all duration-300 font-semibold">
                            <i class="fas fa-redo"></i>
                        </a>
                    </div>
                </div>
                <div class="mt-2 flex justify-end">
                    <div class="text-xs font-semibold text-teal-600">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <span>Sort By:</span>
                            <select id="sortFilter" class="px-2 py-1 border border-teal-200 rounded-lg text-xs focus:ring-2 focus:ring-teal-500 focus:border-transparent bg-white">
                                <option value="newest">Newest First</option>
                                <option value="oldest">Oldest First</option>
                                <option value="closing">Closing Soon</option>
                            </select>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Count & View Toggle -->
    <div class="flex justify-between items-center mb-4">
        <p class="text-gray-600 font-semibold text-sm">Showing <span class="text-teal-600" id="showingCount">{{ $savedJobs->count() }}</span> saved jobs</p>
        <div class="flex gap-2">
            <button onclick="switchView('grid')" id="gridViewBtn" class="px-4 py-2 bg-teal-600 text-white rounded-lg font-semibold transition-all duration-300">
                <i class="fas fa-th mr-2"></i>Grid View
            </button>
            <button onclick="switchView('list')" id="listViewBtn" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg font-semibold transition-all duration-300 hover:bg-gray-400">
                <i class="fas fa-list mr-2"></i>List View
            </button>
        </div>
    </div>

    <!-- Grid View -->
    <div id="gridView" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($savedJobs as $savedJob)
        <div class="saved-job-card bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border-l-4 border-teal-600 p-4 flex flex-col" data-status="{{ $savedJob->job->deadline <= now() ? 'closed' : (now()->diffInDays($savedJob->job->deadline) <= 7 ? 'closing' : 'active') }}" data-created="{{ $savedJob->created_at }}">
            <!-- Status Badge -->
            <div class="flex items-center justify-between gap-2 mb-3">
                @php
                    $daysUntilDeadline = now()->diffInDays($savedJob->job->deadline, false);
                @endphp
                @if($daysUntilDeadline <= 0)
                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold bg-red-100 text-red-800">
                        <i class="fas fa-circle text-xs mr-1.5"></i>Closed
                    </span>
                @elseif($daysUntilDeadline <= 7)
                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold bg-orange-100 text-orange-800">
                        <i class="fas fa-circle text-xs mr-1.5"></i>Closing Soon
                    </span>
                @else
                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold bg-green-100 text-green-800">
                        <i class="fas fa-circle text-xs mr-1.5"></i>Active
                    </span>
                @endif
                <form action="{{ route('seeker.saved-jobs.destroy', $savedJob) }}" method="POST" class="inline" onsubmit="return confirm('Remove from saved jobs?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700 transition text-sm">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </div>

            <!-- Job Title -->
            <div class="mb-2">
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Job</p>
                <h3 class="text-sm font-bold text-gray-900 line-clamp-2">{{ $savedJob->job->title }}</h3>
            </div>

            <!-- Company -->
            <div class="mb-2">
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Company</p>
                <p class="text-sm text-gray-700 font-semibold line-clamp-1">{{ $savedJob->job->employer?->employerProfile?->company_name ?? $savedJob->job->employer?->name ?? 'N/A' }}</p>
            </div>

            <!-- Details -->
            <div class="space-y-1 mb-3 pb-3 border-b border-gray-200 text-xs text-gray-600 flex-grow">
                <p><i class="fas fa-map-marker-alt mr-1.5 text-teal-600 w-3"></i>{{ $savedJob->job->location ?? 'Remote' }}</p>
                <p><i class="fas fa-briefcase mr-1.5 text-teal-600 w-3"></i>{{ ucfirst($savedJob->job->job_type?->value ?? 'Full-time') }}</p>
                <p><i class="fas fa-calendar mr-1.5 text-teal-600 w-3"></i>Saved {{ $savedJob->created_at->format('M d, Y') }}</p>
            </div>

            <!-- Deadline Info -->
            <div class="mb-3 pb-3 border-b border-gray-200">
                <p class="text-xs text-gray-600 font-semibold uppercase mb-1">Deadline</p>
                <p class="text-xs text-gray-700">
                    @if($daysUntilDeadline <= 0)
                        <span class="text-red-600 font-semibold">Closed</span>
                    @else
                        <span class="text-gray-700">{{ $daysUntilDeadline }} days left</span>
                    @endif
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-2">
                <a href="{{ route('jobs.show', $savedJob->job) }}" class="flex-1 px-3 py-2 bg-gradient-to-r from-teal-600 to-cyan-600 text-white rounded-lg text-xs font-semibold hover:shadow-md transition text-center">
                    <i class="fas fa-eye mr-1"></i>View Job
                </a>
                <a href="{{ route('seeker.applications.create', ['job_id' => $savedJob->job->id]) }}" class="flex-1 px-3 py-2 bg-white text-teal-600 border border-teal-200 rounded-lg text-xs font-semibold hover:bg-teal-50 transition text-center">
                    <i class="fas fa-paper-plane mr-1"></i>Apply
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white rounded-lg shadow-md p-12 text-center border border-gray-200">
            <i class="fas fa-bookmark text-5xl text-gray-300 mb-4 block"></i>
            <p class="text-lg font-semibold text-gray-900 mb-2">No saved jobs yet</p>
            <p class="text-gray-600 mb-4">Start saving jobs to keep track of opportunities that interest you</p>
            <a href="{{ route('seeker.browse-jobs') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-teal-600 text-white rounded-lg font-semibold hover:bg-teal-700 transition">
                <i class="fas fa-search"></i>Browse Jobs
            </a>
        </div>
        @endforelse
    </div>

    <!-- List View -->
    <div id="listView" class="hidden">
        <div class="overflow-x-auto bg-white rounded-lg shadow-md border border-gray-200">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-teal-600 to-cyan-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Job Title</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Company</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Location</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Deadline</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="divide-y divide-gray-200">
                    @forelse($savedJobs as $savedJob)
                    <tr class="hover:bg-gray-50 transition-colors saved-job-table-row" data-status="{{ $savedJob->job->deadline <= now() ? 'closed' : (now()->diffInDays($savedJob->job->deadline) <= 7 ? 'closing' : 'active') }}" data-created="{{ $savedJob->created_at }}">
                        <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $savedJob->job->title }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $savedJob->job->employer?->employerProfile?->company_name ?? $savedJob->job->employer?->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $savedJob->job->location ?? 'Remote' }}</td>
                        <td class="px-6 py-4 text-sm">
                            @php
                                $daysUntilDeadline = now()->diffInDays($savedJob->job->deadline, false);
                            @endphp
                            @if($daysUntilDeadline <= 0)
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold bg-red-100 text-red-800">Closed</span>
                            @elseif($daysUntilDeadline <= 7)
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold bg-orange-100 text-orange-800">{{ $daysUntilDeadline }} days</span>
                            @else
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold bg-green-100 text-green-800">{{ $daysUntilDeadline }} days</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <a href="{{ route('jobs.show', $savedJob->job) }}" class="px-3 py-1 bg-teal-600 text-white rounded text-xs font-semibold hover:bg-teal-700 transition inline-block">
                                <i class="fas fa-eye mr-1"></i>View
                            </a>
                            <form action="{{ route('seeker.saved-jobs.destroy', $savedJob) }}" method="POST" class="inline" onsubmit="return confirm('Remove from saved jobs?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded text-xs font-semibold hover:bg-red-700 transition">
                                    <i class="fas fa-trash-alt mr-1"></i>Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <i class="fas fa-bookmark text-4xl text-gray-300 mb-3 block"></i>
                            <p class="text-gray-600">No saved jobs yet</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($savedJobs->hasPages())
    <div class="mt-8 flex justify-center">
        {{ $savedJobs->links() }}
    </div>
    @endif
</div>

<script>
const allCards = document.querySelectorAll('.saved-job-card');
const allTableRows = document.querySelectorAll('.saved-job-table-row');
const searchInput = document.getElementById('searchInput');
const locationInput = document.getElementById('locationInput');
const statusFilter = document.getElementById('statusFilter');
const sortFilter = document.getElementById('sortFilter');
const gridViewBtn = document.getElementById('gridViewBtn');
const listViewBtn = document.getElementById('listViewBtn');
const gridView = document.getElementById('gridView');
const listView = document.getElementById('listView');
const showingCount = document.getElementById('showingCount');

function filterSavedJobs() {
    const searchTerm = searchInput.value.toLowerCase();
    const locationTerm = locationInput.value.toLowerCase();
    const status = statusFilter.value.toLowerCase();
    const sort = sortFilter.value;
    let visibleCards = [];
    let visibleRows = [];

    allCards.forEach(card => {
        const cardStatus = card.dataset.status;
        const jobTitle = card.textContent.toLowerCase();
        const location = card.textContent.toLowerCase();
        
        const matchesSearch = !searchTerm || jobTitle.includes(searchTerm);
        const matchesLocation = !locationTerm || location.includes(locationTerm);
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
        const rowText = row.textContent.toLowerCase();
        
        const matchesSearch = !searchTerm || rowText.includes(searchTerm);
        const matchesLocation = !locationTerm || rowText.includes(locationTerm);
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
    } else if (sort === 'closing') {
        visibleCards.sort((a, b) => a.dataset.status === 'closing' ? -1 : 1);
        visibleRows.sort((a, b) => a.dataset.status === 'closing' ? -1 : 1);
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
        gridViewBtn.classList.add('bg-teal-600', 'text-white');
        gridViewBtn.classList.remove('bg-gray-300', 'text-gray-700');
        listViewBtn.classList.remove('bg-teal-600', 'text-white');
        listViewBtn.classList.add('bg-gray-300', 'text-gray-700');
    } else {
        listView.classList.remove('hidden');
        gridView.classList.add('hidden');
        listViewBtn.classList.add('bg-teal-600', 'text-white');
        listViewBtn.classList.remove('bg-gray-300', 'text-gray-700');
        gridViewBtn.classList.remove('bg-teal-600', 'text-white');
        gridViewBtn.classList.add('bg-gray-300', 'text-gray-700');
    }
}

searchInput.addEventListener('input', filterSavedJobs);
locationInput.addEventListener('input', filterSavedJobs);
statusFilter.addEventListener('change', filterSavedJobs);
sortFilter.addEventListener('change', filterSavedJobs);

// Initial filter
filterSavedJobs();
</script>
@endsection
