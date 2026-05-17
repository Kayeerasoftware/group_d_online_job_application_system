<aside class="sidebar admin-sidebar w-36 bg-gradient-to-b from-red-50 to-orange-100 dark:from-gray-800 dark:to-gray-900 border-r border-red-200 dark:border-gray-700 fixed left-0 top-12 h-[calc(100vh-3rem)] overflow-hidden transition-all duration-300 z-10 flex flex-col"
       :class="[sidebarOpen ? 'translate-x-0' : '-translate-x-full', sidebarCollapsed ? 'collapsed' : '', 'lg:translate-x-0']"
       id="sidebar">

    <!-- Fixed Profile Section -->
    <div class="p-2 profile-section bg-white border-b border-red-200">
        <a href="{{ route('admin.profile') }}" class="block p-3 bg-gradient-to-r from-red-500 to-orange-600 rounded-lg shadow-md hover:shadow-lg transition">
            <div class="flex flex-col items-center py-2">
                <!-- Profile Avatar -->
                <div class="w-14 h-14 rounded-full bg-white flex items-center justify-center mb-3 overflow-hidden cursor-pointer shadow-lg ring-2 ring-white ring-offset-2 ring-offset-red-500 hover:scale-105 transition-transform">
                    @if(auth()->user()->profile_picture_url)
                        <img src="{{ auth()->user()->profile_picture_url }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-red-400 to-orange-600 flex items-center justify-center">
                            <span class="text-white font-bold text-lg">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                        </div>
                    @endif
                </div>
                
                <!-- Profile Info -->
                <p class="text-xs font-bold text-white text-center truncate w-full">{{ auth()->user()->name }}</p>
                <p class="text-[10px] text-red-100 text-center">Administrator</p>
                
                <!-- Profile Email -->
                <p class="text-[9px] text-red-50 text-center truncate w-full mt-1">{{ auth()->user()->email }}</p>
            </div>
        </a>
        
        <!-- Search Box -->
        <div class="search-item relative mt-2 px-2 py-1.5 bg-white rounded-lg border border-gray-200 flex items-center gap-2 hover:border-red-400 transition">
            <i class="fas fa-search text-gray-400 text-xs" @click="if(sidebarCollapsed) { sidebarCollapsed = false; }"></i>
            <input type="text" x-model="sidebarSearch" @input="document.querySelectorAll('#sidebar .sidebar-nav .nav-item, #sidebar .quick-actions-nav .nav-item').forEach(item => { const text = item.getAttribute('data-search'); item.style.display = text && text.toLowerCase().includes(sidebarSearch.toLowerCase()) ? 'flex' : 'none'; }); if(sidebarSearch === '') document.querySelectorAll('#sidebar .sidebar-nav .nav-item, #sidebar .quick-actions-nav .nav-item').forEach(item => item.style.display = 'flex');" placeholder="Search..." class="flex-1 bg-transparent border-none outline-none text-xs text-gray-700 placeholder-gray-400">
            <button x-show="sidebarSearch" @click="sidebarSearch = ''; document.querySelectorAll('#sidebar .sidebar-nav .nav-item, #sidebar .quick-actions-nav .nav-item').forEach(item => item.style.display = 'flex');" class="text-gray-400 hover:text-gray-600 transition">
                <i class="fas fa-times text-xs"></i>
            </button>
        </div>
    </div>

    <!-- Scrollable Content -->
    <div class="flex-1 scrollable-content overflow-y-auto">
        <div class="p-2">
            <!-- Main Navigation -->
            <nav class="space-y-1 sidebar-nav">
                <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer text-gray-700 hover:bg-red-100 hover:text-red-700 {{ request()->routeIs('admin.dashboard') ? 'bg-red-200 text-red-800 font-semibold' : '' }}" data-search="dashboard" @click="sidebarOpen = false">
                    <i class="fas fa-home w-3 text-xs"></i><span>Dashboard</span>
                </a>
                <a href="{{ route('admin.profile') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer text-gray-700 hover:bg-red-100 hover:text-red-700 {{ request()->routeIs('admin.profile') ? 'bg-red-200 text-red-800 font-semibold' : '' }}" data-search="profile my account" @click="sidebarOpen = false">
                    <i class="fas fa-user w-3 text-xs"></i><span>My Profile</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer text-gray-700 hover:bg-red-100 hover:text-red-700 {{ request()->routeIs('admin.users.*') ? 'bg-red-200 text-red-800 font-semibold' : '' }}" data-search="users manage" @click="sidebarOpen = false">
                    <i class="fas fa-users w-3 text-xs"></i><span>Manage Users</span>
                </a>
                <a href="{{ route('admin.reports.index') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer text-gray-700 hover:bg-red-100 hover:text-red-700 {{ request()->routeIs('admin.reports.*') ? 'bg-red-200 text-red-800 font-semibold' : '' }}" data-search="reports compliance" @click="sidebarOpen = false">
                    <i class="fas fa-file-contract w-3 text-xs"></i><span>Reports</span>
                </a>
                <a href="{{ route('admin.audit-logs.index') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer text-gray-700 hover:bg-red-100 hover:text-red-700 {{ request()->routeIs('admin.audit-logs.*') ? 'bg-red-200 text-red-800 font-semibold' : '' }}" data-search="audit logs history" @click="sidebarOpen = false">
                    <i class="fas fa-history w-3 text-xs"></i><span>Audit Logs</span>
                </a>
                <a href="{{ route('admin.system.index') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer text-gray-700 hover:bg-red-100 hover:text-red-700 {{ request()->routeIs('admin.system.*') ? 'bg-red-200 text-red-800 font-semibold' : '' }}" data-search="system settings" @click="sidebarOpen = false">
                    <i class="fas fa-cog w-3 text-xs"></i><span>System</span>
                </a>
            </nav>

            <!-- Quick Actions Section -->
            <div class="mt-4 pt-4 border-t border-red-200 dark:border-gray-600">
                <p class="px-2 text-[10px] font-semibold text-gray-600 uppercase tracking-wider mb-2">Quick Actions</p>
                <nav class="space-y-1 quick-actions-nav">
                    <a href="{{ route('admin.profile') }}" class="w-full nav-item flex items-center space-x-2 px-2 py-2 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition text-xs text-left cursor-pointer" data-search="edit profile">
                        <i class="fas fa-user-edit text-blue-500 w-3"></i><span>Edit Profile</span>
                    </a>
                    <a href="{{ route('admin.reports.create') }}" class="w-full nav-item flex items-center space-x-2 px-2 py-2 rounded-lg text-gray-700 hover:bg-green-100 hover:text-green-700 transition text-xs text-left cursor-pointer" data-search="create report">
                        <i class="fas fa-plus-circle text-green-500 w-3"></i><span>New Report</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="w-full nav-item flex items-center space-x-2 px-2 py-2 rounded-lg text-gray-700 hover:bg-purple-100 hover:text-purple-700 transition text-xs text-left cursor-pointer" data-search="view users">
                        <i class="fas fa-search text-purple-500 w-3"></i><span>Search Users</span>
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="w-full nav-item flex items-center space-x-2 px-2 py-2 rounded-lg text-gray-700 hover:bg-orange-100 hover:text-orange-700 transition text-xs text-left cursor-pointer" data-search="system health">
                        <i class="fas fa-heartbeat text-orange-500 w-3"></i><span>System Health</span>
                    </a>
                </nav>
            </div>
            <div class="pb-4"></div>
        </div>
    </div>
</aside>

<button class="sidebar-toggle hidden lg:block" @click="sidebarCollapsed = !sidebarCollapsed" title="Toggle sidebar">
    <i class="fas fa-chevron-right"></i>
</button>
