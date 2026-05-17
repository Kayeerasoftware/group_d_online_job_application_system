@extends('layouts.admin')

@section('title', 'Compliance Reports')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-4 md:mb-6">
        <div class="bg-gradient-to-br from-red-50 via-orange-50 to-yellow-50 rounded-2xl shadow-lg border border-red-100 p-6 md:p-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
                <div class="flex items-center gap-2 md:gap-4">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-red-600 to-orange-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                        <div class="relative bg-gradient-to-br from-red-600 to-orange-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                            <i class="fas fa-file-contract text-white text-xl md:text-3xl"></i>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-red-600 via-orange-600 to-yellow-600 bg-clip-text text-transparent mb-1 md:mb-2">Compliance Reports</h1>
                        <p class="text-gray-600 text-xs md:text-sm font-medium">Create and review regulatory summaries for job activity</p>
                    </div>
                </div>
                <a href="{{ route('admin.reports.create') }}" class="px-4 md:px-6 py-2 md:py-3 bg-gradient-to-r from-red-600 to-orange-600 text-white rounded-lg hover:shadow-lg transition font-semibold text-sm md:text-base">
                    <i class="fas fa-plus mr-2"></i>Generate Report
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-3 mb-3 md:mb-4">
        <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-red-100 text-[8px] md:text-[10px] font-medium mb-0.5">Total Reports</p>
                    <h3 class="text-base md:text-xl font-bold" id="totalCount">0</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-file-contract text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-100 text-[8px] md:text-[10px] font-medium mb-0.5">Draft</p>
                    <h3 class="text-base md:text-xl font-bold" id="draftCount">0</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-edit text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-[8px] md:text-[10px] font-medium mb-0.5">Submitted</p>
                    <h3 class="text-base md:text-xl font-bold" id="submittedCount">0</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-check-circle text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-[8px] md:text-[10px] font-medium mb-0.5">Archived</p>
                    <h3 class="text-base md:text-xl font-bold" id="archivedCount">0</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-archive text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filters -->
    <div class="bg-gradient-to-br from-red-50 via-orange-50 to-yellow-50 rounded-2xl shadow-lg border border-red-100 overflow-hidden mb-4">
        <div class="bg-white/60 backdrop-blur-sm p-3">
            <div class="bg-white/80 rounded-xl p-2.5 border border-red-100">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-2">
                    <div class="md:col-span-4 relative">
                        <i class="fas fa-search absolute left-2.5 top-1/2 transform -translate-y-1/2 text-red-400 text-xs"></i>
                        <input type="text" id="searchInput" placeholder="Report type..." class="w-full pl-8 pr-2 py-1.5 text-xs border border-red-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all bg-white">
                    </div>
                    <div class="md:col-span-4 relative">
                        <i class="fas fa-filter absolute left-2.5 top-1/2 transform -translate-y-1/2 text-orange-400 text-xs"></i>
                        <select id="statusInput" class="w-full pl-8 pr-2 py-1.5 text-xs border border-orange-200 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all appearance-none bg-white">
                            <option value="">All Status</option>
                            <option value="draft">Draft</option>
                            <option value="submitted">Submitted</option>
                            <option value="archived">Archived</option>
                        </select>
                    </div>
                    <div class="md:col-span-4 flex gap-1.5">
                        <button onclick="resetFilters()" class="flex-1 px-2 py-1.5 text-xs bg-gradient-to-r from-red-600 to-orange-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold">
                            <i class="fas fa-search mr-1"></i>Clear
                        </button>
                        <a href="{{ route('admin.reports.index') }}" class="px-2 py-1.5 text-xs bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 rounded-lg hover:shadow-md transition-all duration-300 font-semibold">
                            <i class="fas fa-redo"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Count -->
    <div class="flex justify-between items-center mb-4">
        <p class="text-gray-600 font-semibold text-sm">Showing <span class="text-red-600" id="showingCount">0</span> reports</p>
    </div>

    <!-- Reports Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-red-600 to-orange-600 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold">Report Type</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold">Period</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold">Author</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold">Created</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200" id="reportsBody">
                    @forelse($reports as $report)
                        <tr class="hover:bg-gray-50 transition report-row" data-type="{{ strtolower($report->report_type ?? '') }}" data-status="{{ strtolower($report->statusValue() ?? '') }}">
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $report->report_type }}</p>
                                    <p class="text-sm text-gray-500">Compliance review</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-700">
                                    {{ optional($report->date_range_start)->format('M d, Y') }} to {{ optional($report->date_range_end)->format('M d, Y') }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-red-400 to-orange-400 flex-shrink-0 overflow-hidden border border-red-200">
                                        @if($report->author?->profile_picture_url)
                                            <img src="{{ $report->author->profile_picture_url }}" alt="{{ $report->author->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-white font-bold text-xs">
                                                {{ substr($report->author?->name ?? 'S', 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                    <span class="text-sm text-gray-700">{{ $report->author?->name ?? 'System' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    @if($report->statusValue() === 'draft') bg-yellow-100 text-yellow-800
                                    @elseif($report->statusValue() === 'submitted') bg-green-100 text-green-800
                                    @else bg-blue-100 text-blue-800
                                    @endif">
                                    {{ ucfirst($report->statusValue()) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-700">{{ $report->created_at->format('M d, Y') }}</p>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.reports.show', $report) }}" class="px-3 py-2 text-sm font-semibold text-blue-600 hover:bg-blue-50 rounded-lg transition">
                                        <i class="fas fa-eye mr-1"></i>View
                                    </a>
                                    <a href="{{ route('admin.reports.download', $report) }}" class="px-3 py-2 text-sm font-semibold text-green-600 hover:bg-green-50 rounded-lg transition">
                                        <i class="fas fa-download mr-1"></i>Download
                                    </a>
                                    @if($report->statusValue() === 'draft')
                                    <form method="post" action="{{ route('admin.reports.submit', $report) }}" class="inline">
                                        @csrf
                                        @method('patch')
                                        <button type="submit" class="px-3 py-2 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 rounded-lg transition">
                                            <i class="fas fa-check mr-1"></i>Submit
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-file-contract text-gray-300 text-4xl mb-3"></i>
                                    <p class="text-gray-600 font-semibold">No reports yet</p>
                                    <p class="text-gray-500 text-sm mb-4">Generate the first compliance report to populate this dashboard</p>
                                    <a href="{{ route('admin.reports.create') }}" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">
                                        <i class="fas fa-plus mr-2"></i>Create Report
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $reports->links() }}
    </div>
</div>

<script>
const allRows = document.querySelectorAll('.report-row');
const searchInput = document.getElementById('searchInput');
const statusInput = document.getElementById('statusInput');

function filterReports() {
    const searchTerm = searchInput.value.toLowerCase();
    const status = statusInput.value.toLowerCase();

    let visibleRows = [];

    allRows.forEach(row => {
        const type = row.dataset.type;
        const rowStatus = row.dataset.status;

        const matchesSearch = !searchTerm || type.includes(searchTerm);
        const matchesStatus = !status || rowStatus === status;

        if (matchesSearch && matchesStatus) {
            row.style.display = '';
            visibleRows.push(row);
        } else {
            row.style.display = 'none';
        }
    });

    updateStats(visibleRows);
    document.getElementById('showingCount').textContent = visibleRows.length;
}

function updateStats(visibleReports) {
    const total = visibleReports.length;
    const draft = visibleReports.filter(r => r.dataset.status === 'draft').length;
    const submitted = visibleReports.filter(r => r.dataset.status === 'submitted').length;
    const archived = total - draft - submitted;

    document.getElementById('totalCount').textContent = total;
    document.getElementById('draftCount').textContent = draft;
    document.getElementById('submittedCount').textContent = submitted;
    document.getElementById('archivedCount').textContent = archived;
}

function resetFilters() {
    searchInput.value = '';
    statusInput.value = '';
    filterReports();
}

searchInput.addEventListener('input', filterReports);
statusInput.addEventListener('change', filterReports);

filterReports();
</script>
@endsection
