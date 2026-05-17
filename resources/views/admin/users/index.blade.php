@extends('layouts.admin')

@section('title', 'Users Management')

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
                            <i class="fas fa-users text-white text-xl md:text-3xl"></i>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-blue-600 via-cyan-600 to-teal-600 bg-clip-text text-transparent mb-1 md:mb-2">Users</h1>
                        <p class="text-gray-600 text-xs md:text-sm font-medium">Manage all system users and their profiles</p>
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
                    <p class="text-blue-100 text-[8px] md:text-[10px] font-medium mb-0.5">Total Users</p>
                    <h3 class="text-base md:text-xl font-bold" id="totalCount">0</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-users text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-[8px] md:text-[10px] font-medium mb-0.5">Seekers</p>
                    <h3 class="text-base md:text-xl font-bold" id="seekerCount">0</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-user-tie text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-[8px] md:text-[10px] font-medium mb-0.5">Employers</p>
                    <h3 class="text-base md:text-xl font-bold" id="employerCount">0</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-building text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-100 text-[8px] md:text-[10px] font-medium mb-0.5">Active</p>
                    <h3 class="text-base md:text-xl font-bold" id="activeCount">0</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-check-circle text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-red-100 text-[8px] md:text-[10px] font-medium mb-0.5">Inactive</p>
                    <h3 class="text-base md:text-xl font-bold" id="inactiveCount">0</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-times-circle text-sm md:text-lg"></i>
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
                        <input type="text" id="searchInput" placeholder="Name, email..." class="w-full pl-8 pr-2 py-1.5 text-xs border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-white">
                    </div>
                    <div class="md:col-span-3 relative">
                        <i class="fas fa-user-tag absolute left-2.5 top-1/2 transform -translate-y-1/2 text-cyan-400 text-xs"></i>
                        <select id="roleInput" class="w-full pl-8 pr-2 py-1.5 text-xs border border-cyan-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all appearance-none bg-white">
                            <option value="">All Roles</option>
                            <option value="seeker">Seeker</option>
                            <option value="employer">Employer</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="md:col-span-2 relative">
                        <i class="fas fa-toggle-on absolute left-2.5 top-1/2 transform -translate-y-1/2 text-teal-400 text-xs"></i>
                        <select id="statusInput" class="w-full pl-8 pr-2 py-1.5 text-xs border border-teal-200 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all appearance-none bg-white">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="md:col-span-3 flex gap-1.5">
                        <button onclick="resetFilters()" class="flex-1 px-2 py-1.5 text-xs bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold">
                            <i class="fas fa-search mr-1"></i>Clear
                        </button>
                        <a href="{{ route('admin.users.index') }}" class="px-2 py-1.5 text-xs bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 rounded-lg hover:shadow-md transition-all duration-300 font-semibold">
                            <i class="fas fa-redo"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Count & View Toggle -->
    <div class="flex justify-between items-center mb-4">
        <p class="text-gray-600 font-semibold text-sm">Showing <span class="text-blue-600" id="showingCount">0</span> users</p>
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
        @forelse($users as $user)
        <div class="user-card bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border-l-4 border-blue-600 p-3 flex flex-col" data-user-id="{{ $user->id }}" data-role="{{ strtolower($user->role instanceof \App\Enums\UserRole ? $user->role->value : ($user->role ?? '')) }}" data-status="{{ $user->is_active ? 'active' : 'inactive' }}" data-name="{{ strtolower($user->name ?? '') }}" data-email="{{ strtolower($user->email ?? '') }}" data-date="{{ $user->created_at }}">
            <!-- Status Badge -->
            <div class="flex items-center justify-between gap-2 mb-2">
                @php
                    $roleColors = [
                        'seeker' => 'bg-purple-100 text-purple-800',
                        'employer' => 'bg-green-100 text-green-800',
                        'admin' => 'bg-red-100 text-red-800',
                    ];
                    $roleValue = $user->role instanceof \App\Enums\UserRole ? $user->role->value : ($user->role ?? '');
                    $roleClass = $roleColors[$roleValue] ?? 'bg-gray-100 text-gray-800';
                    $statusClass = $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                @endphp
                <span class="px-2 py-0.5 rounded-full text-xs font-semibold {{ $roleClass }}">
                    {{ ucfirst($roleValue) }}
                </span>
                <span class="px-2 py-0.5 rounded-full text-xs font-semibold {{ $statusClass }}">
                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>
            
            <!-- User Name with Picture -->
            <div class="mb-2 flex items-center gap-2">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-cyan-400 flex-shrink-0 overflow-hidden border-2 border-blue-200">
                    @if($user->profile_picture_url)
                        <img src="{{ $user->profile_picture_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-white font-bold text-sm">
                            {{ substr($user->name ?? 'U', 0, 1) }}
                        </div>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Name</p>
                    <h3 class="text-sm font-bold text-gray-900 line-clamp-1">{{ $user->name ?? 'N/A' }}</h3>
                </div>
            </div>
            
            <!-- Email -->
            <div class="mb-2">
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Email</p>
                <p class="text-xs text-gray-700 line-clamp-1">{{ $user->email ?? 'N/A' }}</p>
            </div>
            
            <!-- Progress Bar (Profile Completion) -->
            <div class="mb-2">
                <div class="flex justify-between items-center mb-1">
                    <p class="text-xs text-gray-600 font-semibold">Activity</p>
                    <span class="text-xs font-bold text-blue-600">{{ $user->jobs_count + $user->applications_count }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-blue-600 to-cyan-600 h-2 rounded-full transition-all duration-300" style="width: {{ min(($user->jobs_count + $user->applications_count) * 10, 100) }}%"></div>
                </div>
            </div>
            
            <!-- Details -->
            <div class="space-y-1 mb-2 pb-2 border-b border-gray-200 text-xs text-gray-600">
                <p><i class="fas fa-calendar mr-1.5 text-blue-600 w-3"></i>{{ $user->created_at->format('M d, Y') }}</p>
                <p><i class="fas fa-clock mr-1.5 text-blue-600 w-3"></i>{{ $user->updated_at->diffForHumans() }}</p>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex gap-2 flex-col">
                <a href="{{ route('admin.users.show', $user) }}" class="px-2 py-1.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded text-xs font-semibold hover:shadow-md transition text-center">
                    <i class="fas fa-eye mr-1"></i>View Profile
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <i class="fas fa-users text-gray-400 text-4xl mb-4 block"></i>
            <p class="text-gray-600">No users found</p>
        </div>
        @endforelse
    </div>

    <!-- Table View -->
    <div id="listView" class="hidden">
        <div class="overflow-x-auto bg-white rounded-lg shadow-md border border-gray-200">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Role</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Profile</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Joined</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="divide-y divide-gray-200">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition-colors user-table-row" data-user-id="{{ $user->id }}" data-role="{{ strtolower($user->role instanceof \App\Enums\UserRole ? $user->role->value : ($user->role ?? '')) }}" data-status="{{ $user->is_active ? 'active' : 'inactive' }}" data-name="{{ strtolower($user->name ?? '') }}" data-email="{{ strtolower($user->email ?? '') }}" data-date="{{ $user->created_at }}">
                        <td class="px-6 py-4 text-sm font-semibold text-gray-900 border-r border-gray-300 border-opacity-50">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-cyan-400 flex-shrink-0 overflow-hidden border-2 border-blue-200">
                                    @if($user->profile_picture_url)
                                        <img src="{{ $user->profile_picture_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-white font-bold text-sm">
                                            {{ substr($user->name ?? 'U', 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <span>{{ $user->name ?? 'N/A' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700 border-r border-gray-300 border-opacity-50">{{ $user->email ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm border-r border-gray-300 border-opacity-50">
                            @php
                                $roleColors = [
                                    'seeker' => 'bg-purple-100 text-purple-800',
                                    'employer' => 'bg-green-100 text-green-800',
                                    'admin' => 'bg-red-100 text-red-800',
                                ];
                                $roleValue = $user->role instanceof \App\Enums\UserRole ? $user->role->value : ($user->role ?? '');
                                $roleClass = $roleColors[$roleValue] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-2 py-1 rounded text-xs font-semibold {{ $roleClass }}">{{ ucfirst($roleValue) }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm border-r border-gray-300 border-opacity-50">
                            @php
                                $statusClass = $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                            @endphp
                            <span class="px-2 py-1 rounded text-xs font-semibold {{ $statusClass }}">{{ $user->is_active ? 'Active' : 'Inactive' }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm border-r border-gray-300 border-opacity-50">
                            <div class="flex items-center gap-2">
                                <div class="w-16 bg-gray-200 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-blue-600 to-cyan-600 h-2 rounded-full" style="width: {{ min(($user->jobs_count + $user->applications_count) * 10, 100) }}%"></div>
                                </div>
                                <span class="text-xs font-bold text-blue-600">{{ $user->jobs_count + $user->applications_count }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700 border-r border-gray-300 border-opacity-50">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.users.show', $user) }}" class="px-3 py-1 bg-blue-600 text-white rounded text-xs font-semibold hover:bg-blue-700 transition">
                                <i class="fas fa-eye mr-1"></i>View
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-600">No users found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
const allCards = document.querySelectorAll('.user-card');
const allRows = document.querySelectorAll('.user-table-row');
const searchInput = document.getElementById('searchInput');
const roleInput = document.getElementById('roleInput');
const statusInput = document.getElementById('statusInput');

function filterUsers() {
    const searchTerm = searchInput.value.toLowerCase();
    const role = roleInput.value.toLowerCase();
    const status = statusInput.value.toLowerCase();

    let visibleCards = [];
    let visibleRows = [];

    allCards.forEach(card => {
        const name = card.dataset.name;
        const email = card.dataset.email;
        const cardRole = card.dataset.role;
        const cardStatus = card.dataset.status;

        const matchesSearch = !searchTerm || name.includes(searchTerm) || email.includes(searchTerm);
        const matchesRole = !role || cardRole === role;
        const matchesStatus = !status || cardStatus === status;

        if (matchesSearch && matchesRole && matchesStatus) {
            card.style.display = '';
            visibleCards.push(card);
        } else {
            card.style.display = 'none';
        }
    });

    allRows.forEach(row => {
        const name = row.dataset.name;
        const email = row.dataset.email;
        const rowRole = row.dataset.role;
        const rowStatus = row.dataset.status;

        const matchesSearch = !searchTerm || name.includes(searchTerm) || email.includes(searchTerm);
        const matchesRole = !role || rowRole === role;
        const matchesStatus = !status || rowStatus === status;

        if (matchesSearch && matchesRole && matchesStatus) {
            row.style.display = '';
            visibleRows.push(row);
        } else {
            row.style.display = 'none';
        }
    });

    updateStats(visibleCards);
    document.getElementById('showingCount').textContent = visibleCards.length;
}

function updateStats(visibleUsers) {
    const total = visibleUsers.length;
    const seekers = visibleUsers.filter(u => u.dataset.role === 'seeker').length;
    const employers = visibleUsers.filter(u => u.dataset.role === 'employer').length;
    const active = visibleUsers.filter(u => u.dataset.status === 'active').length;
    const inactive = total - active;

    document.getElementById('totalCount').textContent = total;
    document.getElementById('seekerCount').textContent = seekers;
    document.getElementById('employerCount').textContent = employers;
    document.getElementById('activeCount').textContent = active;
    document.getElementById('inactiveCount').textContent = inactive;
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
    roleInput.value = '';
    statusInput.value = '';
    filterUsers();
}

searchInput.addEventListener('input', filterUsers);
roleInput.addEventListener('change', filterUsers);
statusInput.addEventListener('change', filterUsers);

filterUsers();
</script>
@endsection
