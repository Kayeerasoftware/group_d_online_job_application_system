@extends('layouts.regulator')

@section('title', 'Audit Logs')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Audit Logs</h1>
        <p class="text-gray-600 mt-2">Monitor system activity and compliance events</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl shadow-lg p-4 border border-purple-200 hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Logs</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1" id="totalCount">{{ $auditLogs->total() }}</h3>
                </div>
                <div class="bg-purple-500 rounded-full p-3 shadow-lg">
                    <i class="fas fa-history text-white text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-xl shadow-lg p-4 border border-red-200 hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Deletions</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1" id="deleteCount">0</h3>
                </div>
                <div class="bg-red-500 rounded-full p-3 shadow-lg">
                    <i class="fas fa-trash text-white text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl shadow-lg p-4 border border-orange-200 hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Suspensions</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1" id="suspendCount">0</h3>
                </div>
                <div class="bg-orange-500 rounded-full p-3 shadow-lg">
                    <i class="fas fa-ban text-white text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl shadow-lg p-4 border border-yellow-200 hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Flags</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1" id="flagCount">0</h3>
                </div>
                <div class="bg-yellow-500 rounded-full p-3 shadow-lg">
                    <i class="fas fa-flag text-white text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl shadow-lg p-4 border border-blue-200 hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Updates</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1" id="updateCount">0</h3>
                </div>
                <div class="bg-blue-500 rounded-full p-3 shadow-lg">
                    <i class="fas fa-edit text-white text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filters -->
    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
            <div class="md:col-span-4 relative">
                <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                <i class="fas fa-search absolute left-3 top-10 text-gray-400 text-sm"></i>
                <input type="text" id="searchInput" placeholder="Action, admin, reason..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
            </div>
            <div class="md:col-span-4 relative">
                <label class="block text-sm font-medium text-gray-700 mb-2">Filter by Action</label>
                <i class="fas fa-filter absolute left-3 top-10 text-gray-400 text-sm"></i>
                <select id="actionInput" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all appearance-none bg-white">
                    <option value="">All Actions</option>
                    <option value="delete">Delete</option>
                    <option value="suspend">Suspend</option>
                    <option value="flag">Flag</option>
                    <option value="update">Update</option>
                </select>
            </div>
            <div class="md:col-span-4 flex items-end gap-2">
                <button onclick="resetFilters()" class="flex-1 px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white rounded-lg font-medium transition shadow-md hover:shadow-lg">
                    <i class="fas fa-search mr-2"></i>Clear
                </button>
                <a href="{{ route('regulator.audit-logs') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-medium transition">
                    <i class="fas fa-redo"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Results Count -->
    <div class="flex justify-between items-center">
        <p class="text-gray-600 font-semibold">Showing <span class="text-amber-600" id="showingCount">{{ $auditLogs->count() }}</span> logs</p>
    </div>

    <!-- Audit Logs Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-amber-500 to-orange-600 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold">Action</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold">Target</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold">Administrator</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold">Reason</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold">IP Address</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold">Timestamp</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200" id="logsBody">
                    @forelse($auditLogs as $log)
                        <tr class="hover:bg-gray-50 transition log-row" data-action="{{ strtolower($log->action ?? '') }}" data-admin="{{ strtolower($log->admin?->name ?? '') }}">
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    @if(str_contains($log->action, 'delete')) bg-red-100 text-red-800
                                    @elseif(str_contains($log->action, 'suspend')) bg-orange-100 text-orange-800
                                    @elseif(str_contains($log->action, 'flag')) bg-yellow-100 text-yellow-800
                                    @elseif(str_contains($log->action, 'update')) bg-blue-100 text-blue-800
                                    @else bg-green-100 text-green-800
                                    @endif">
                                    {{ str_replace('_', ' ', ucfirst($log->action)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm">
                                    <p class="font-semibold text-gray-900">{{ class_basename($log->target_type) }}</p>
                                    <p class="text-gray-500 font-mono text-xs">#{{ $log->target_id }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-amber-400 to-orange-600 flex-shrink-0 overflow-hidden border border-amber-200">
                                        @if($log->admin?->profile_picture_url)
                                            <img src="{{ $log->admin->profile_picture_url }}" alt="{{ $log->admin->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-white font-bold text-xs">
                                                {{ substr($log->admin?->name ?? 'A', 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">{{ $log->admin?->name ?? 'System' }}</p>
                                        <p class="text-xs text-gray-500">{{ $log->admin?->email ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-700">{{ $log->reason ?? 'No reason provided' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-mono text-gray-600">{{ $log->ip_address ?? 'N/A' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm">
                                    <p class="font-semibold text-gray-900">{{ $log->created_at->format('M d, Y') }}</p>
                                    <p class="text-gray-500 text-xs">{{ $log->created_at->format('h:i A') }}</p>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-inbox text-gray-300 text-4xl mb-3"></i>
                                    <p class="text-gray-600 font-semibold">No audit logs found</p>
                                    <p class="text-gray-500 text-sm">System activity and compliance events will appear here</p>
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
        {{ $auditLogs->links() }}
    </div>
</div>

<script>
const allRows = document.querySelectorAll('.log-row');
const searchInput = document.getElementById('searchInput');
const actionInput = document.getElementById('actionInput');

function filterLogs() {
    const searchTerm = searchInput.value.toLowerCase();
    const action = actionInput.value.toLowerCase();

    let visibleRows = [];

    allRows.forEach(row => {
        const rowAction = row.dataset.action;
        const admin = row.dataset.admin;

        const matchesSearch = !searchTerm || rowAction.includes(searchTerm) || admin.includes(searchTerm);
        const matchesAction = !action || rowAction.includes(action);

        if (matchesSearch && matchesAction) {
            row.style.display = '';
            visibleRows.push(row);
        } else {
            row.style.display = 'none';
        }
    });

    updateStats(visibleRows);
    document.getElementById('showingCount').textContent = visibleRows.length;
}

function updateStats(visibleLogs) {
    const total = visibleLogs.length;
    const deletes = visibleLogs.filter(l => l.dataset.action.includes('delete')).length;
    const suspends = visibleLogs.filter(l => l.dataset.action.includes('suspend')).length;
    const flags = visibleLogs.filter(l => l.dataset.action.includes('flag')).length;
    const updates = visibleLogs.filter(l => l.dataset.action.includes('update')).length;

    document.getElementById('totalCount').textContent = total;
    document.getElementById('deleteCount').textContent = deletes;
    document.getElementById('suspendCount').textContent = suspends;
    document.getElementById('flagCount').textContent = flags;
    document.getElementById('updateCount').textContent = updates;
}

function resetFilters() {
    searchInput.value = '';
    actionInput.value = '';
    filterLogs();
}

searchInput.addEventListener('input', filterLogs);
actionInput.addEventListener('change', filterLogs);

filterLogs();
</script>
@endsection
