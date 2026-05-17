@extends('layouts.jobseeker')

@section('title', 'My Applications')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-teal-600 to-cyan-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-teal-600 to-cyan-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                        <i class="fas fa-file-alt text-white text-xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">My Applications</h1>
                    <p class="text-gray-600 text-sm font-medium">Track and manage your job applications</p>
                </div>
            </div>
            <a href="{{ route('seeker.browse-jobs') }}" class="px-5 py-2.5 bg-gradient-to-r from-teal-600 to-cyan-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 text-sm font-bold flex items-center justify-center gap-2">
                <i class="fas fa-search"></i>Browse Jobs
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-3 mb-6">
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-teal-600">
            <p class="text-xs text-gray-600 font-semibold uppercase">Total</p>
            <p class="text-2xl font-bold text-gray-900 mt-1" id="totalCount">{{ $applications->count() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-yellow-500">
            <p class="text-xs text-gray-600 font-semibold uppercase">Pending</p>
            <p class="text-2xl font-bold text-yellow-600 mt-1" id="pendingCount">{{ $applications->filter(fn($a) => $a->status->value === 'pending')->count() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-blue-500">
            <p class="text-xs text-gray-600 font-semibold uppercase">Reviewed</p>
            <p class="text-2xl font-bold text-blue-600 mt-1" id="reviewedCount">{{ $applications->filter(fn($a) => $a->status->value === 'reviewed')->count() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-green-500">
            <p class="text-xs text-gray-600 font-semibold uppercase">Shortlisted</p>
            <p class="text-2xl font-bold text-green-600 mt-1" id="shortlistedCount">{{ $applications->filter(fn($a) => $a->status->value === 'shortlisted')->count() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-red-500">
            <p class="text-xs text-gray-600 font-semibold uppercase">Rejected</p>
            <p class="text-2xl font-bold text-red-600 mt-1" id="rejectedCount">{{ $applications->filter(fn($a) => $a->status->value === 'rejected')->count() }}</p>
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
                            <option value="pending">Pending</option>
                            <option value="reviewed">Reviewed</option>
                            <option value="shortlisted">Shortlisted</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="md:col-span-3 flex gap-1.5">
                        <button onclick="filterApplications()" class="flex-1 px-2 py-1.5 text-xs bg-gradient-to-r from-teal-600 to-cyan-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold">
                            <i class="fas fa-search mr-1"></i>Search
                        </button>
                        <a href="{{ route('seeker.applications') }}" class="px-2 py-1.5 text-xs bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 rounded-lg hover:shadow-md transition-all duration-300 font-semibold">
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
                            </select>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Count & View Toggle -->
    <div class="flex justify-between items-center mb-4">
        <p class="text-gray-600 font-semibold text-sm">Showing <span class="text-teal-600" id="showingCount">{{ $applications->count() }}</span> applications</p>
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
        @forelse($applications as $application)
        <div class="application-card bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border-l-4 border-teal-600 p-4 flex flex-col" data-status="{{ $application->status->value }}" data-created="{{ $application->created_at }}">
            <!-- Status Badge -->
            <div class="flex items-center justify-between gap-2 mb-3">
                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold
                    @if($application->status->value === 'pending') bg-yellow-100 text-yellow-800
                    @elseif($application->status->value === 'reviewed') bg-blue-100 text-blue-800
                    @elseif($application->status->value === 'shortlisted') bg-green-100 text-green-800
                    @elseif($application->status->value === 'rejected') bg-red-100 text-red-800
                    @endif">
                    <i class="fas fa-circle text-xs mr-1.5"></i>
                    {{ ucfirst($application->status->value) }}
                </span>
            </div>

            <!-- Job Title -->
            <div class="mb-2">
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Job</p>
                <h3 class="text-sm font-bold text-gray-900 line-clamp-2">{{ $application->job->title }}</h3>
            </div>

            <!-- Company -->
            <div class="mb-2">
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Company</p>
                <p class="text-sm text-gray-700 font-semibold line-clamp-1">{{ $application->job->employer?->employerProfile?->company_name ?? $application->job->employer?->name ?? 'N/A' }}</p>
            </div>

            <!-- Details -->
            <div class="space-y-1 mb-3 pb-3 border-b border-gray-200 text-xs text-gray-600 flex-grow">
                <p><i class="fas fa-map-marker-alt mr-1.5 text-teal-600 w-3"></i>{{ $application->job->location }}</p>
                <p><i class="fas fa-calendar mr-1.5 text-teal-600 w-3"></i>Applied {{ $application->created_at->format('M d, Y') }}</p>
                @if($application->job->job_type)
                <p><i class="fas fa-briefcase mr-1.5 text-teal-600 w-3"></i>{{ ucfirst($application->job->job_type->value) }}</p>
                @endif
            </div>

            <!-- Cover Letter Preview -->
            @if($application->cover_letter)
            <div class="mb-3 pb-3 border-b border-gray-200">
                <p class="text-xs text-gray-600 font-semibold uppercase mb-1">Cover Letter</p>
                <p class="text-xs text-gray-700 line-clamp-2">{{ $application->cover_letter }}</p>
            </div>
            @endif

            <!-- Action Button -->
            <a href="{{ route('seeker.applications.show', $application) }}" class="px-3 py-2 bg-gradient-to-r from-teal-600 to-cyan-600 text-white rounded-lg text-xs font-semibold hover:shadow-md transition text-center">
                <i class="fas fa-eye mr-1"></i>View Details
            </a>
        </div>
        @empty
        <div class="col-span-full bg-white rounded-lg shadow-md p-12 text-center border border-gray-200">
            <i class="fas fa-inbox text-5xl text-gray-300 mb-4 block"></i>
            <p class="text-lg font-semibold text-gray-900 mb-2">No applications yet</p>
            <p class="text-gray-600 mb-4">Start by browsing available jobs and submitting your applications</p>
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
                        <th class="px-6 py-3 text-left text-sm font-semibold">Applied</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="divide-y divide-gray-200">
                    @forelse($applications as $application)
                    <tr class="hover:bg-gray-50 transition-colors application-table-row" data-status="{{ $application->status->value }}" data-created="{{ $application->created_at }}">
                        <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $application->job->title }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $application->job->employer?->employerProfile?->company_name ?? $application->job->employer?->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $application->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold
                                @if($application->status->value === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($application->status->value === 'reviewed') bg-blue-100 text-blue-800
                                @elseif($application->status->value === 'shortlisted') bg-green-100 text-green-800
                                @elseif($application->status->value === 'rejected') bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($application->status->value) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('seeker.applications.show', $application) }}" class="px-3 py-1 bg-teal-600 text-white rounded text-xs font-semibold hover:bg-teal-700 transition">
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
const locationInput = document.getElementById('locationInput');
const statusFilter = document.getElementById('statusFilter');
const sortFilter = document.getElementById('sortFilter');
const gridViewBtn = document.getElementById('gridViewBtn');
const listViewBtn = document.getElementById('listViewBtn');
const gridView = document.getElementById('gridView');
const listView = document.getElementById('listView');
const showingCount = document.getElementById('showingCount');

function filterApplications() {
    const searchTerm = searchInput.value.toLowerCase();
    const locationTerm = locationInput.value.toLowerCase();
    const status = statusFilter.value.toLowerCase();
    const sort = sortFilter.value;
    let visibleCards = [];
    let visibleRows = [];

    allCards.forEach(card => {
        const cardStatus = card.dataset.status;
        const jobTitle = card.textContent.toLowerCase();
        const company = card.textContent.toLowerCase();
        const location = card.textContent.toLowerCase();
        
        const matchesSearch = !searchTerm || jobTitle.includes(searchTerm) || company.includes(searchTerm);
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

searchInput.addEventListener('input', filterApplications);
locationInput.addEventListener('input', filterApplications);
statusFilter.addEventListener('change', filterApplications);
sortFilter.addEventListener('change', filterApplications);

// Initial filter
filterApplications();
</script>
@endsection
