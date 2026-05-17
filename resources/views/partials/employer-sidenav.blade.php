<aside class="sidebar w-36 bg-gradient-to-b from-emerald-50 to-emerald-100 dark:from-gray-800 dark:to-gray-900 border-r border-emerald-200 dark:border-gray-700 fixed left-0 top-12 h-[calc(100vh-3rem)] overflow-hidden transition-all duration-300 z-10 flex flex-col"
       :class="[sidebarOpen ? 'translate-x-0' : '-translate-x-full', sidebarCollapsed ? 'collapsed' : '', 'lg:translate-x-0']"
       id="sidebar">

    <!-- Fixed Profile Section -->
    <div class="p-2 profile-section">
        <div class="p-3 border-b border-emerald-200 dark:border-gray-600 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-lg shadow-md">
            <div class="flex flex-col items-center py-2">
                <div class="w-14 h-14 rounded-full bg-white flex items-center justify-center mb-2 overflow-hidden cursor-pointer shadow-lg ring-2 ring-white ring-offset-2 ring-offset-emerald-500 hover:scale-105 transition-transform" @click="showProfileModal = true">
                    <img x-show="profilePicture" :src="profilePicture" alt="Profile" class="w-full h-full object-cover">
                    <i x-show="!profilePicture" class="fas fa-building text-emerald-600 text-xl"></i>
                </div>
                <p class="text-xs font-bold text-white text-center truncate" x-text="employerProfile.name">Employer</p>
                <p class="text-[10px] text-emerald-100">Employer Account</p>
            </div>
        </div>
        
        <div class="search-item relative mt-2 px-2 py-1.5 bg-white rounded-lg border border-gray-200 flex items-center gap-2 hover:border-emerald-400 transition">
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
        <nav class="space-y-1 sidebar-nav">
            @if(Route::has('employer.dashboard'))
            <a href="{{ route('employer.dashboard') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer {{ request()->routeIs('employer.dashboard') ? 'active' : '' }}" data-search="dashboard" @click="sidebarOpen = false">
                <i class="fas fa-home w-3 text-xs"></i><span>Dashboard</span>
            </a>
            @endif
            @if(Route::has('jobs.index'))
            <a href="{{ route('jobs.index', ['employer' => auth()->user()->id]) }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer {{ request()->routeIs('jobs.index') || request()->routeIs('jobs.create') || request()->routeIs('jobs.edit') || request()->routeIs('jobs.show') ? 'active' : '' }}" data-search="my jobs" @click="sidebarOpen = false">
                <i class="fas fa-briefcase w-3 text-xs"></i><span>My Jobs</span>
            </a>
            @endif
            @if(Route::has('employer.applications'))
            <a href="{{ route('employer.applications') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer {{ request()->routeIs('employer.applications') ? 'active' : '' }}" data-search="applications" @click="sidebarOpen = false">
                <i class="fas fa-inbox w-3 text-xs"></i><span>Applications</span>
            </a>
            @endif
            @if(Route::has('employer.all-employers'))
            <a href="{{ route('employer.all-employers') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer {{ request()->routeIs('employer.all-employers') ? 'active' : '' }}" data-search="all employers" @click="sidebarOpen = false">
                <i class="fas fa-users w-3 text-xs"></i><span>All Employers</span>
            </a>
            @endif
            @if(Route::has('employer.interviews'))
            <a href="{{ route('employer.interviews') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer {{ request()->routeIs('employer.interviews') ? 'active' : '' }}" data-search="interviews" @click="sidebarOpen = false">
                <i class="fas fa-calendar-check w-3 text-xs"></i><span>Interviews</span>
            </a>
            @endif
            @if(Route::has('employer.messages'))
            <a href="{{ route('employer.messages') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer {{ request()->routeIs('employer.messages') ? 'active' : '' }}" data-search="messages" @click="sidebarOpen = false">
                <i class="fas fa-envelope w-3 text-xs"></i><span>Messages</span>
            </a>
            @endif
            @if(Route::has('employer.profile'))
            <a href="{{ route('employer.profile') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer {{ request()->routeIs('employer.profile') || request()->routeIs('employer.profile.edit') ? 'active' : '' }}" data-search="company profile" @click="sidebarOpen = false">
                <i class="fas fa-building w-3 text-xs"></i><span>Company Profile</span>
            </a>
            @endif
            @if(Route::has('employer.notifications'))
            <a href="{{ route('employer.notifications') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer {{ request()->routeIs('employer.notifications') ? 'active' : '' }}" data-search="notifications" @click="sidebarOpen = false">
                <i class="fas fa-bell w-3 text-xs"></i><span>Notifications</span>
                <span x-show="notificationStats.unread > 0" class="ml-auto bg-red-500 text-white text-[10px] px-1.5 py-0.5 rounded-full nav-badge" x-text="notificationStats.unread"></span>
            </a>
            @endif
            @if(Route::has('employer.settings'))
            <a href="{{ route('employer.settings') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer {{ request()->routeIs('employer.settings') ? 'active' : '' }}" data-search="settings" @click="sidebarOpen = false">
                <i class="fas fa-cog w-3 text-xs"></i><span>Settings</span>
            </a>
            @endif
        </nav>

        <div class="mt-4 pt-4 border-t border-emerald-200">
            <p class="px-2 text-[10px] font-semibold text-gray-500 uppercase tracking-wider mb-2">Quick Actions</p>
            <nav class="space-y-1 quick-actions-nav">
                @if(Route::has('jobs.create'))
                <a href="{{ route('jobs.create') }}" class="w-full nav-item flex items-center space-x-2 px-2 py-2 rounded-lg text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition text-xs text-left cursor-pointer" data-search="post job">
                    <i class="fas fa-plus-circle text-emerald-500 w-3"></i><span>Post New Job</span>
                </a>
                @endif
                @if(Route::has('employer.applications'))
                <a href="{{ route('employer.applications') }}" class="w-full nav-item flex items-center space-x-2 px-2 py-2 rounded-lg text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition text-xs text-left cursor-pointer" data-search="view applications">
                    <i class="fas fa-inbox text-blue-500 w-3"></i><span>View Applications</span>
                </a>
                @endif
                @if(Route::has('employer.all-employers'))
                <a href="{{ route('employer.all-employers') }}" class="w-full nav-item flex items-center space-x-2 px-2 py-2 rounded-lg text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition text-xs text-left cursor-pointer" data-search="browse employers">
                    <i class="fas fa-users text-orange-500 w-3"></i><span>Browse Employers</span>
                </a>
                @endif
                @if(Route::has('employer.profile.edit'))
                <a href="{{ route('employer.profile.edit') }}" class="w-full nav-item flex items-center space-x-2 px-2 py-2 rounded-lg text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition text-xs text-left cursor-pointer" data-search="edit profile">
                    <i class="fas fa-edit text-purple-500 w-3"></i><span>Edit Profile</span>
                </a>
                @endif
            </nav>
        </div>
        <div class="pb-4"></div>
        </div>
    </div>
</aside>

<button class="sidebar-toggle hidden lg:block" @click="sidebarCollapsed = !sidebarCollapsed">
    <i class="fas fa-chevron-right"></i>
</button>
