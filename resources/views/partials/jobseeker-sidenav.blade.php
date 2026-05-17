<aside class="sidebar seeker-sidebar w-36 bg-gradient-to-b from-blue-50 to-blue-100 dark:from-gray-800 dark:to-gray-900 border-r border-blue-200 dark:border-gray-700 fixed left-0 top-12 h-[calc(100vh-3rem)] overflow-hidden transition-all duration-300 z-10 flex flex-col"
       :class="[sidebarOpen ? 'translate-x-0' : '-translate-x-full', sidebarCollapsed ? 'collapsed' : '', 'lg:translate-x-0']"
       id="sidebar">

    <!-- Fixed Profile Section -->
    <div class="p-2 profile-section">
        <div class="p-3 border-b border-blue-200 dark:border-gray-600 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg shadow-md">
            <div class="flex flex-col items-center py-2">
                <div class="w-14 h-14 rounded-full bg-white flex items-center justify-center mb-2 overflow-hidden cursor-pointer shadow-lg ring-2 ring-white ring-offset-2 ring-offset-blue-500 hover:scale-105 transition-transform" @click="showProfileModal = true">
                    @if(auth()->user()->profile_picture_url)
                        <img src="{{ auth()->user()->profile_picture_url }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                            <i class="fas fa-user text-white text-xl"></i>
                        </div>
                    @endif
                </div>
                <p class="text-xs font-bold text-white text-center truncate" x-text="seekerProfile.name">{{ auth()->user()->name }}</p>
                <p class="text-[10px] text-blue-100">Job Seeker</p>
            </div>
        </div>
        
        <div class="search-item relative mt-2 px-2 py-1.5 bg-white rounded-lg border border-gray-200 flex items-center gap-2 hover:border-blue-400 transition">
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
                <a href="{{ route('seeker.dashboard') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer {{ request()->routeIs('seeker.dashboard') ? 'active' : '' }}" data-search="dashboard" @click="sidebarOpen = false">
                    <i class="fas fa-home w-3 text-xs"></i><span>Dashboard</span>
                </a>
                <a href="{{ route('seeker.profile') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer {{ request()->routeIs('seeker.profile') || request()->routeIs('seeker.profile.edit') ? 'active' : '' }}" data-search="profile" @click="sidebarOpen = false">
                    <i class="fas fa-user w-3 text-xs"></i><span>My Profile</span>
                </a>
                <a href="{{ route('seeker.browse-jobs') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer {{ request()->routeIs('seeker.browse-jobs') ? 'active' : '' }}" data-search="browse jobs" @click="sidebarOpen = false">
                    <i class="fas fa-search w-3 text-xs"></i><span>Browse Jobs</span>
                </a>
                <a href="{{ route('seeker.applications') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer {{ request()->routeIs('seeker.applications') ? 'active' : '' }}" data-search="applications" @click="sidebarOpen = false">
                    <i class="fas fa-file-alt w-3 text-xs"></i><span>Applications</span>
                </a>
                <a href="{{ route('seeker.saved-jobs') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer {{ request()->routeIs('seeker.saved-jobs') ? 'active' : '' }}" data-search="saved jobs" @click="sidebarOpen = false">
                    <i class="fas fa-bookmark w-3 text-xs"></i><span>Saved Jobs</span>
                </a>
                <a href="{{ route('seeker.resume') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer {{ request()->routeIs('seeker.resume') ? 'active' : '' }}" data-search="resume" @click="sidebarOpen = false">
                    <i class="fas fa-file-pdf w-3 text-xs"></i><span>Resume</span>
                </a>
                <a href="{{ route('seeker.interviews') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer {{ request()->routeIs('seeker.interviews') ? 'active' : '' }}" data-search="interviews" @click="sidebarOpen = false">
                    <i class="fas fa-calendar-check w-3 text-xs"></i><span>Interviews</span>
                </a>
                <a href="{{ route('seeker.messages') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer {{ request()->routeIs('seeker.messages') ? 'active' : '' }}" data-search="messages" @click="sidebarOpen = false">
                    <i class="fas fa-envelope w-3 text-xs"></i><span>Messages</span>
                </a>
                <a href="{{ route('seeker.notifications') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer {{ request()->routeIs('seeker.notifications') ? 'active' : '' }}" data-search="notifications" @click="sidebarOpen = false">
                    <i class="fas fa-bell w-3 text-xs"></i><span>Notifications</span>
                    <span x-show="notificationStats.unread > 0" class="ml-auto bg-red-500 text-white text-[10px] px-1.5 py-0.5 rounded-full nav-badge" x-text="notificationStats.unread"></span>
                </a>
                <a href="{{ route('seeker.settings') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer {{ request()->routeIs('seeker.settings') ? 'active' : '' }}" data-search="settings" @click="sidebarOpen = false">
                    <i class="fas fa-cog w-3 text-xs"></i><span>Settings</span>
                </a>
            </nav>

            <!-- Quick Actions Section -->
            <div class="mt-4 pt-4 border-t border-blue-200 dark:border-gray-600">
                <p class="px-2 text-[10px] font-semibold text-gray-500 uppercase tracking-wider mb-2">Quick Actions</p>
                <nav class="space-y-1 quick-actions-nav">
                    <a href="{{ route('jobs.index') }}" class="w-full nav-item flex items-center space-x-2 px-2 py-2 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition text-xs text-left cursor-pointer" data-search="apply job">
                        <i class="fas fa-plus-circle text-green-500 w-3"></i><span>Apply to Job</span>
                    </a>
                    <a href="{{ route('seeker.profile.edit') }}" class="w-full nav-item flex items-center space-x-2 px-2 py-2 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition text-xs text-left cursor-pointer" data-search="upload resume">
                        <i class="fas fa-upload text-purple-500 w-3"></i><span>Upload Resume</span>
                    </a>
                    <a href="{{ route('seeker.notifications') }}" class="w-full nav-item flex items-center space-x-2 px-2 py-2 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition text-xs text-left cursor-pointer" data-search="support">
                        <i class="fas fa-headset text-indigo-500 w-3"></i><span>Get Support</span>
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
