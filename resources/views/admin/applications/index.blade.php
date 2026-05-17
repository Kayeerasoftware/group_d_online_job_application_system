@extends('layouts.admin')

@section('title', 'Applications Management')

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
                            <i class="fas fa-file-alt text-white text-xl md:text-3xl"></i>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-blue-600 via-cyan-600 to-teal-600 bg-clip-text text-transparent mb-1 md:mb-2">Applications</h1>
                        <p class="text-gray-600 text-xs md:text-sm font-medium">Track and manage all job applications</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-2 md:gap-3 mb-3 md:mb-4">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-[8px] md:text-[10px] font-medium mb-0.5">Total</p>
                    <h3 class="text-base md:text-xl font-bold" id="totalCount">0</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-list text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-100 text-[8px] md:text-[10px] font-medium mb-0.5">Pending</p>
                    <h3 class="text-base md:text-xl font-bold" id="pendingCount">0</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-clock text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-[8px] md:text-[10px] font-medium mb-0.5">Approved</p>
                    <h3 class="text-base md:text-xl font-bold" id="approvedCount">0</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-check text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-red-100 text-[8px] md:text-[10px] font-medium mb-0.5">Rejected</p>
                    <h3 class="text-base md:text-xl font-bold" id="rejectedCount">0</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-times text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-[8px] md:text-[10px] font-medium mb-0.5">Completion</p>
                    <h3 class="text-base md:text-xl font-bold" id="completionRate">0%</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-chart-pie text-sm md:text-lg"></i>
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
                        <input type="text" id="searchInput" placeholder="Seeker name, job title..." class="w-full pl-8 pr-2 py-1.5 text-xs border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-white">
                    </div>
                    <div class="md:col-span-3 relative">
                        <i class="fas fa-briefcase absolute left-2.5 top-1/2 transform -translate-y-1/2 text-cyan-400 text-xs"></i>
                        <select id="statusInput" class="w-full pl-8 pr-2 py-1.5 text-xs border border-cyan-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all appearance-none bg-white">
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="md:col-span-2 relative">
                        <i class="fas fa-calendar absolute left-2.5 top-1/2 transform -translate-y-1/2 text-teal-400 text-xs"></i>
                        <select id="dateInput" class="w-full pl-8 pr-2 py-1.5 text-xs border border-teal-200 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all appearance-none bg-white">
                            <option value="">All Time</option>
                            <option value="today">Today</option>
                            <option value="week">This Week</option>
                            <option value="month">This Month</option>
                        </select>
                    </div>
                    <div class="md:col-span-3 flex gap-1.5">
                        <button onclick="resetFilters()" class="flex-1 px-2 py-1.5 text-xs bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold">
                            <i class="fas fa-search mr-1"></i>Clear
                        </button>
                        <a href="{{ route('admin.applications.index') }}" class="px-2 py-1.5 text-xs bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 rounded-lg hover:shadow-md transition-all duration-300 font-semibold">
                            <i class="fas fa-redo"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Count & View Toggle -->
    <div class="flex justify-between items-center mb-4">
        <p class="text-gray-600 font-semibold text-sm">Showing <span class="text-blue-600" id="showingCount">0</span> applications</p>
        <div class="flex gap-2">
            <button onclick="switchView('grid')" id="gridViewBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold transition-all duration-300">
                <i class="fas fa-th mr-2"></i>Grid
            </button>
            <button onclick="switchView('list')" id="listViewBtn" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg font-semibold transition-all duration-300 hover:bg-gray-400">
                <i class="fas fa-list mr-2"></i>List
            </button>
        </div>
    </div>

    <!-- Grid View -->
    <div id="gridView" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
        @forelse($applications as $app)
        <div class="app-card bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border-l-4 border-blue-600 p-3 flex flex-col" data-app-id="{{ $app->id }}" data-status="{{ strtolower($app->status ?? '') }}" data-seeker="{{ strtolower($app->seeker?->name ?? '') }}" data-job="{{ strtolower($app->job?->title ?? '') }}" data-date="{{ $app->created_at }}">
            <!-- Status Badge -->
            <div class="flex items-center justify-between gap-2 mb-2">
                @php
                    $statusColors = [
                        'pending' => 'bg-yellow-100 text-yellow-800',
                        'approved' => 'bg-green-100 text-green-800',
                        'rejected' => 'bg-red-100 text-red-800',
                    ];
                    $statusClass = $statusColors[$app->status] ?? 'bg-gray-100 text-gray-800';
                @endphp
                <span class="px-2 py-0.5 rounded-full text-xs font-semibold {{ $statusClass }}">
                    {{ ucfirst($app->status) }}
                </span>
                <span class="text-xs text-gray-500">{{ $app->created_at->format('M d') }}</span>
            </div>
            
            <!-- Seeker Name -->
            <div class="mb-2">
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Seeker</p>
                <h3 class="text-sm font-bold text-gray-900 line-clamp-1">{{ $app->seeker?->name ?? 'N/A' }}</h3>
            </div>
            
            <!-- Job Title -->
            <div class="mb-2">
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Job</p>
                <p class="text-sm text-gray-700 font-semibold line-clamp-1">{{ $app->job?->title ?? 'N/A' }}</p>
            </div>
            
            <!-- Progress Bar -->
            <div class="mb-2">
                <div class="flex justify-between items-center mb-1">
                    <p class="text-xs text-gray-600 font-semibold">Progress</p>
                    <span class="text-xs font-bold text-blue-600" id="progress-{{ $app->id }}">0%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-blue-600 to-cyan-600 h-2 rounded-full transition-all duration-300" id="progressBar-{{ $app->id }}" style="width: 0%"></div>
                </div>
            </div>
            
            <!-- Details -->
            <div class="space-y-1 mb-2 pb-2 border-b border-gray-200 text-xs text-gray-600">
                <p><i class="fas fa-building mr-1.5 text-blue-600 w-3"></i>{{ $app->job?->employer?->employerProfile?->company_name ?? 'N/A' }}</p>
                <p><i class="fas fa-map-marker-alt mr-1.5 text-blue-600 w-3"></i>{{ $app->job?->location ?? 'N/A' }}</p>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex gap-2 flex-col">
                <a href="{{ route('admin.applications.show', $app) }}" class="px-2 py-1.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded text-xs font-semibold hover:shadow-md transition text-center">
                    <i class="fas fa-eye mr-1"></i>View Details
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <i class="fas fa-inbox text-gray-400 text-4xl mb-4 block"></i>
            <p class="text-gray-600">No applications found</p>
        </div>
        @endforelse
    </div>

    <!-- Table View -->
    <div id="listView" class="hidden">
        <div class="overflow-x-auto bg-white rounded-lg shadow-md border border-gray-200">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Seeker</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Job</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Company</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Progress</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Date</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="divide-y divide-gray-200">
                    @forelse($applications as $app)
                    <tr class="hover:bg-gray-50 transition-colors app-table-row" data-app-id="{{ $app->id }}" data-status="{{ strtolower($app->status ?? '') }}" data-seeker="{{ strtolower($app->seeker?->name ?? '') }}" data-job="{{ strtolower($app->job?->title ?? '') }}" data-date="{{ $app->created_at }}">
                        <td class="px-6 py-4 text-sm font-semibold text-gray-900 border-r border-gray-300 border-opacity-50">{{ $app->seeker?->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 border-r border-gray-300 border-opacity-50">{{ $app->job?->title ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 border-r border-gray-300 border-opacity-50">{{ $app->job?->employer?->employerProfile?->company_name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm border-r border-gray-300 border-opacity-50">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'approved' => 'bg-green-100 text-green-800',
                                    'rejected' => 'bg-red-100 text-red-800',
                                ];
                                $statusClass = $statusColors[$app->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-2 py-1 rounded text-xs font-semibold {{ $statusClass }}">{{ ucfirst($app->status) }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm border-r border-gray-300 border-opacity-50">
                            <div class="flex items-center gap-2">
                                <div class="w-16 bg-gray-200 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-blue-600 to-cyan-600 h-2 rounded-full" style="width: 0%"></div>
                                </div>
                                <span class="text-xs font-bold text-blue-600">0%</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700 border-r border-gray-300 border-opacity-50">{{ $app->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.applications.show', $app) }}" class="px-3 py-1 bg-blue-600 text-white rounded text-xs font-semibold hover:bg-blue-700 transition">
                                <i class="fas fa-eye mr-1"></i>View
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-600">No applications found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
const allCards = document.querySelectorAll('.app-card');
const allRows = document.querySelectorAll('.app-table-row');
const searchInput = document.getElementById('searchInput');
const statusInput = document.getElementById('statusInput');
const dateInput = document.getElementById('dateInput');

function filterApplications() {
    const searchTerm = searchInput.value.toLowerCase();
    const status = statusInput.value.toLowerCase();
    const dateFilter = dateInput.value;

    let visibleCards = [];
    let visibleRows = [];

    allCards.forEach(card => {
        const seeker = card.dataset.seeker;
        const job = card.dataset.job;
        const cardStatus = card.dataset.status;
        const cardDate = new Date(card.dataset.date);

        const matchesSearch = !searchTerm || seeker.includes(searchTerm) || job.includes(searchTerm);
        const matchesStatus = !status || cardStatus === status;
        const matchesDate = !dateFilter || checkDateFilter(cardDate, dateFilter);

        if (matchesSearch && matchesStatus && matchesDate) {
            card.style.display = '';
            visibleCards.push(card);
        } else {
            card.style.display = 'none';
        }
    });

    allRows.forEach(row => {
        const seeker = row.dataset.seeker;
        const job = row.dataset.job;
        const rowStatus = row.dataset.status;
        const rowDate = new Date(row.dataset.date);

        const matchesSearch = !searchTerm || seeker.includes(searchTerm) || job.includes(searchTerm);
        const matchesStatus = !status || rowStatus === status;
        const matchesDate = !dateFilter || checkDateFilter(rowDate, dateFilter);

        if (matchesSearch && matchesStatus && matchesDate) {
            row.style.display = '';
            visibleRows.push(row);
        } else {
            row.style.display = 'none';
        }
    });

    updateStats(visibleCards);
    document.getElementById('showingCount').textContent = visibleCards.length;
}

function checkDateFilter(date, filter) {
    const now = new Date();
    const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
    const cardDate = new Date(date.getFullYear(), date.getMonth(), date.getDate());

    switch(filter) {
        case 'today':
            return cardDate.getTime() === today.getTime();
        case 'week':
            const weekAgo = new Date(today);
            weekAgo.setDate(weekAgo.getDate() - 7);
            return cardDate >= weekAgo && cardDate <= today;
        case 'month':
            return cardDate.getMonth() === today.getMonth() && cardDate.getFullYear() === today.getFullYear();
        default:
            return true;
    }
}

function updateStats(visibleApps) {
    const total = visibleApps.length;
    const pending = visibleApps.filter(a => a.dataset.status === 'pending').length;
    const approved = visibleApps.filter(a => a.dataset.status === 'approved').length;
    const rejected = visibleApps.filter(a => a.dataset.status === 'rejected').length;
    const completion = total > 0 ? Math.round(((approved + rejected) / total) * 100) : 0;

    document.getElementById('totalCount').textContent = total;
    document.getElementById('pendingCount').textContent = pending;
    document.getElementById('approvedCount').textContent = approved;
    document.getElementById('rejectedCount').textContent = rejected;
    document.getElementById('completionRate').textContent = completion + '%';
}

function switchView(view) {
    const gridView = document.getElementById('gridView');
    const listView = document.getElementById('listView');
    const gridViewBtn = document.getElementById('gridViewBtn');
    const listViewBtn = document.getElementById('listViewBtn');

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
    statusInput.value = '';
    dateInput.value = '';
    filterApplications();
}

searchInput.addEventListener('input', filterApplications);
statusInput.addEventListener('change', filterApplications);
dateInput.addEventListener('change', filterApplications);

filterApplications();
</script>
@endsection
