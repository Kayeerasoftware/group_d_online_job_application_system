<aside class="sidebar w-36 bg-gradient-to-b from-blue-50 to-blue-100 dark:from-gray-800 dark:to-gray-900 border-r border-blue-200 dark:border-gray-700 fixed left-0 top-12 h-[calc(100vh-3rem)] overflow-hidden transition-all duration-300 lg:translate-x-0 z-10 flex flex-col"
       :class="[sidebarOpen ? 'translate-x-0' : '-translate-x-full', sidebarCollapsed ? 'collapsed' : '']"
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
        
        <div class="nav-item search-item relative mt-2 px-2 py-1.5 bg-white rounded-lg border border-gray-200 flex items-center gap-2 hover:border-blue-400 transition">
            <i class="fas fa-search text-gray-400 text-xs" @click="if(sidebarCollapsed) { sidebarCollapsed = false; }"></i>
            <input type="text" x-model="sidebarSearch" placeholder="Search..." class="flex-1 bg-transparent border-none outline-none text-xs text-gray-700 placeholder-gray-400">
            <button x-show="sidebarSearch" @click="sidebarSearch = ''" class="text-gray-400 hover:text-gray-600 transition">
                <i class="fas fa-times text-xs"></i>
            </button>
        </div>
    </div>

    <!-- Scrollable Content -->
    <div class="flex-1 scrollable-content overflow-y-auto">
        <div class="p-2">
            <!-- Main Navigation -->
            <nav class="space-y-0 sidebar-nav">
                <a href="{{ route('seeker.dashboard') }}" class="nav-item-link @if(request()->routeIs('seeker.dashboard')) active @endif" @click="sidebarOpen = false">
                    <i class="fas fa-home w-4 text-center"></i><span>Dashboard</span>
                </a>
                <a href="{{ route('seeker.profile') }}" class="nav-item-link @if(request()->routeIs('seeker.profile') || request()->routeIs('seeker.profile.edit')) active @endif" @click="sidebarOpen = false">
                    <i class="fas fa-user w-4 text-center"></i><span>My Profile</span>
                </a>
                <a href="{{ route('seeker.browse-jobs') }}" class="nav-item-link @if(request()->routeIs('seeker.browse-jobs')) active @endif" @click="sidebarOpen = false">
                    <i class="fas fa-search w-4 text-center"></i><span>Browse Jobs</span>
                </a>
                <a href="{{ route('seeker.applications') }}" class="nav-item-link @if(request()->routeIs('seeker.applications')) active @endif" @click="sidebarOpen = false">
                    <i class="fas fa-file-alt w-4 text-center"></i><span>Applications</span>
                </a>
                <a href="{{ route('seeker.saved-jobs') }}" class="nav-item-link @if(request()->routeIs('seeker.saved-jobs')) active @endif" @click="sidebarOpen = false">
                    <i class="fas fa-bookmark w-4 text-center"></i><span>Saved Jobs</span>
                </a>
                <a href="{{ route('seeker.resume') }}" class="nav-item-link @if(request()->routeIs('seeker.resume')) active @endif" @click="sidebarOpen = false">
                    <i class="fas fa-file-pdf w-4 text-center"></i><span>Resume</span>
                </a>
                <a href="{{ route('seeker.interviews') }}" class="nav-item-link @if(request()->routeIs('seeker.interviews')) active @endif" @click="sidebarOpen = false">
                    <i class="fas fa-calendar-check w-4 text-center"></i><span>Interviews</span>
                </a>
                <a href="{{ route('seeker.messages') }}" class="nav-item-link @if(request()->routeIs('seeker.messages')) active @endif" @click="sidebarOpen = false">
                    <i class="fas fa-envelope w-4 text-center"></i><span>Messages</span>
                </a>
                <a href="{{ route('seeker.notifications') }}" class="nav-item-link relative @if(request()->routeIs('seeker.notifications')) active @endif" @click="sidebarOpen = false">
                    <i class="fas fa-bell w-4 text-center"></i><span>Notifications</span>
                    <span x-show="notificationStats.unread > 0" class="absolute top-1 right-1 bg-red-500 text-white text-[9px] px-1 py-0.5 rounded-full font-bold animate-pulse" x-text="notificationStats.unread"></span>
                </a>
                <a href="{{ route('seeker.settings') }}" class="nav-item-link @if(request()->routeIs('seeker.settings')) active @endif" @click="sidebarOpen = false">
                    <i class="fas fa-cog w-4 text-center"></i><span>Settings</span>
                </a>
            </nav>

            <!-- Quick Actions Section -->
            <div class="mt-4 pt-4 border-t border-blue-200 dark:border-gray-600">
                <p class="px-3 text-[10px] font-bold text-gray-600 dark:text-gray-400 uppercase tracking-wider mb-1">Quick Actions</p>
                <div class="space-y-0 quick-actions-nav">
                    <a href="{{ route('jobs.index') }}" class="quick-action-link" @click="sidebarOpen = false">
                        <i class="fas fa-plus-circle text-green-500 w-4 text-center"></i><span>Apply to Job</span>
                    </a>
                    <a href="{{ route('seeker.profile.edit') }}" class="quick-action-link" @click="sidebarOpen = false">
                        <i class="fas fa-upload text-purple-500 w-4 text-center"></i><span>Upload Resume</span>
                    </a>
                    <a href="{{ route('seeker.notifications') }}" class="quick-action-link" @click="sidebarOpen = false">
                        <i class="fas fa-headset text-indigo-500 w-4 text-center"></i><span>Get Support</span>
                    </a>
                </div>
            </div>
            <div class="pb-4"></div>
        </div>
    </div>
</aside>

<button class="sidebar-toggle hidden lg:block" @click="sidebarCollapsed = !sidebarCollapsed" title="Toggle sidebar">
    <i class="fas fa-chevron-right"></i>
</button>
