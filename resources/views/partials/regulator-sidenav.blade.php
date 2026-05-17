<aside class="sidebar regulator-sidebar w-36 bg-gradient-to-b from-amber-50 to-orange-100 dark:from-gray-800 dark:to-gray-900 border-r border-amber-200 dark:border-gray-700 fixed left-0 top-12 h-[calc(100vh-3rem)] overflow-hidden transition-all duration-300 z-10 flex flex-col"
       :class="[sidebarOpen ? 'translate-x-0' : '-translate-x-full', sidebarCollapsed ? 'collapsed' : '', 'lg:translate-x-0']"
       id="sidebar">

    <!-- Fixed Profile Section -->
    <div class="p-2 profile-section">
        <div class="p-3 border-b border-amber-200 dark:border-gray-600 bg-gradient-to-r from-amber-500 to-orange-600 rounded-lg shadow-md">
            <div class="flex flex-col items-center py-2">
                <div class="w-14 h-14 rounded-full bg-white flex items-center justify-center mb-2 overflow-hidden cursor-pointer shadow-lg ring-2 ring-white ring-offset-2 ring-offset-amber-500 hover:scale-105 transition-transform" @click="showProfileModal = true">
                    @if(auth()->user()->profile_picture_url)
                        <img src="{{ auth()->user()->profile_picture_url }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-amber-400 to-orange-600 flex items-center justify-center">
                            <i class="fas fa-shield-alt text-white text-xl"></i>
                        </div>
                    @endif
                </div>
                <p class="text-xs font-bold text-white text-center truncate" x-text="regulatorProfile.name">{{ auth()->user()->name }}</p>
                <p class="text-[10px] text-amber-100">Regulatory Officer</p>
            </div>
        </div>
        
        <div class="search-item relative mt-2 px-2 py-1.5 bg-white rounded-lg border border-gray-200 flex items-center gap-2 hover:border-amber-400 transition">
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
                <a href="{{ route('regulator.dashboard') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer {{ request()->routeIs('regulator.dashboard') ? 'active' : '' }}" data-search="dashboard" @click="sidebarOpen = false">
                    <i class="fas fa-home w-3 text-xs"></i><span>Dashboard</span>
                </a>
                <a href="{{ route('regulator.profile') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer {{ request()->routeIs('regulator.profile') || request()->routeIs('regulator.profile.edit') ? 'active' : '' }}" data-search="profile" @click="sidebarOpen = false">
                    <i class="fas fa-user w-3 text-xs"></i><span>My Profile</span>
                </a>
                <a href="{{ route('regulator.compliance.index') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer {{ request()->routeIs('regulator.compliance.*') ? 'active' : '' }}" data-search="compliance" @click="sidebarOpen = false">
                    <i class="fas fa-file-alt w-3 text-xs"></i><span>Compliance</span>
                </a>
                <a href="{{ route('regulator.audit-logs') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer {{ request()->routeIs('regulator.audit-logs') ? 'active' : '' }}" data-search="audit logs" @click="sidebarOpen = false">
                    <i class="fas fa-history w-3 text-xs"></i><span>Audit Logs</span>
                </a>
                <a href="{{ route('regulator.system-monitoring') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer {{ request()->routeIs('regulator.system-monitoring') ? 'active' : '' }}" data-search="system monitoring" @click="sidebarOpen = false">
                    <i class="fas fa-chart-line w-3 text-xs"></i><span>System Monitor</span>
                </a>
            </nav>

            <!-- Quick Actions Section -->
            <div class="mt-4 pt-4 border-t border-amber-200 dark:border-gray-600">
                <p class="px-2 text-[10px] font-semibold text-gray-500 uppercase tracking-wider mb-2">Quick Actions</p>
                <nav class="space-y-1 quick-actions-nav">
                    <a href="{{ route('regulator.compliance.index') }}" class="w-full nav-item flex items-center space-x-2 px-2 py-2 rounded-lg text-gray-700 hover:bg-amber-50 hover:text-amber-600 transition text-xs text-left cursor-pointer" data-search="view reports">
                        <i class="fas fa-file-pdf text-amber-500 w-3"></i><span>View Reports</span>
                    </a>
                    <a href="{{ route('regulator.audit-logs') }}" class="w-full nav-item flex items-center space-x-2 px-2 py-2 rounded-lg text-gray-700 hover:bg-amber-50 hover:text-amber-600 transition text-xs text-left cursor-pointer" data-search="activity logs">
                        <i class="fas fa-list text-orange-500 w-3"></i><span>Activity Logs</span>
                    </a>
                    <a href="{{ route('regulator.system-monitoring') }}" class="w-full nav-item flex items-center space-x-2 px-2 py-2 rounded-lg text-gray-700 hover:bg-amber-50 hover:text-amber-600 transition text-xs text-left cursor-pointer" data-search="system health">
                        <i class="fas fa-heartbeat text-red-500 w-3"></i><span>System Health</span>
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
