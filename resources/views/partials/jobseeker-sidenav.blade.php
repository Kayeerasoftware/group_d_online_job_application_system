<aside class="sidebar w-36 bg-gradient-to-b from-blue-50 to-blue-100 dark:from-gray-800 dark:to-gray-900 border-r border-blue-200 dark:border-gray-700 fixed left-0 top-12 h-[calc(100vh-3rem)] overflow-hidden transition-all duration-300 lg:translate-x-0 z-10 flex flex-col"
       :class="[sidebarOpen ? 'translate-x-0' : '-translate-x-full', sidebarCollapsed ? 'collapsed' : '']"
       id="sidebar">

    <!-- Fixed Profile Section -->
    <div class="p-2 profile-section">
        <div class="p-2 border-b border-blue-200">
            <div class="flex flex-col items-center py-3">
                <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-2 overflow-hidden cursor-pointer" @click="showProfileModal = true">
                    <img x-show="profilePicture" :src="profilePicture" alt="Profile" class="w-full h-full object-cover">
                    <i x-show="!profilePicture" class="fas fa-user text-blue-600 text-2xl"></i>
                </div>
                <p class="text-xs font-semibold text-gray-800 text-center" x-text="seekerProfile.name">Job Seeker</p>
                <p class="text-[10px] text-gray-500">Job Seeker</p>
            </div>
        </div>
        
        <div class="nav-item search-item relative">
            <i class="fas fa-search text-gray-500 text-xs" @click="if(sidebarCollapsed) { sidebarCollapsed = false; }"></i>
            <input type="text" x-model="sidebarSearch" placeholder="Search menu..." class="flex-1 bg-transparent border-none outline-none text-xs text-gray-700 placeholder-gray-500 ml-2">
            <button x-show="sidebarSearch" @click="sidebarSearch = ''" class="text-gray-400 hover:text-gray-600 transition ml-2">
                <i class="fas fa-times text-xs"></i>
            </button>
        </div>
    </div>

    <!-- Scrollable Content -->
    <div class="flex-1 scrollable-content overflow-y-auto">
        <div class="p-2">
        <nav class="space-y-1 sidebar-nav">
            <a href="{{ route('seeker.dashboard') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer" :class="request()->routeIs('seeker.dashboard') ? 'bg-green-100 text-green-700' : 'text-gray-700 hover:bg-green-50 hover:text-green-600'" :style="request()->routeIs('seeker.dashboard') ? 'background-color: rgba(34, 197, 94, 0.8); color: rgb(21, 128, 61);' : ''" @click="sidebarOpen = false">
                <i class="fas fa-home w-3 text-xs"></i><span>Dashboard</span>
            </a>
            <a href="{{ route('seeker.profile') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer" :class="request()->routeIs('seeker.profile') ? 'bg-green-100 text-green-700' : 'text-gray-700 hover:bg-green-50 hover:text-green-600'" :style="request()->routeIs('seeker.profile') ? 'background-color: rgba(34, 197, 94, 0.8); color: rgb(21, 128, 61);' : ''" @click="sidebarOpen = false">
                <i class="fas fa-user w-3 text-xs"></i><span>My Profile</span>
            </a>
            <a href="{{ route('seeker.browse-jobs') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer" :class="request()->routeIs('seeker.browse-jobs') ? 'bg-green-100 text-green-700' : 'text-gray-700 hover:bg-green-50 hover:text-green-600'" :style="request()->routeIs('seeker.browse-jobs') ? 'background-color: rgba(34, 197, 94, 0.8); color: rgb(21, 128, 61);' : ''" @click="sidebarOpen = false">
                <i class="fas fa-search w-3 text-xs"></i><span>Browse Jobs</span>
            </a>
            <a href="{{ route('seeker.applications') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer" :class="request()->routeIs('seeker.applications') ? 'bg-green-100 text-green-700' : 'text-gray-700 hover:bg-green-50 hover:text-green-600'" :style="request()->routeIs('seeker.applications') ? 'background-color: rgba(34, 197, 94, 0.8); color: rgb(21, 128, 61);' : ''" @click="sidebarOpen = false">
                <i class="fas fa-file-alt w-3 text-xs"></i><span>My Applications</span>
            </a>
            <a href="{{ route('seeker.saved-jobs') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer" :class="request()->routeIs('seeker.saved-jobs') ? 'bg-green-100 text-green-700' : 'text-gray-700 hover:bg-green-50 hover:text-green-600'" :style="request()->routeIs('seeker.saved-jobs') ? 'background-color: rgba(34, 197, 94, 0.8); color: rgb(21, 128, 61);' : ''" @click="sidebarOpen = false">
                <i class="fas fa-bookmark w-3 text-xs"></i><span>Saved Jobs</span>
            </a>
            <a href="{{ route('seeker.resume') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer" :class="request()->routeIs('seeker.resume') ? 'bg-green-100 text-green-700' : 'text-gray-700 hover:bg-green-50 hover:text-green-600'" :style="request()->routeIs('seeker.resume') ? 'background-color: rgba(34, 197, 94, 0.8); color: rgb(21, 128, 61);' : ''" @click="sidebarOpen = false">
                <i class="fas fa-file-pdf w-3 text-xs"></i><span>My Resume</span>
            </a>
            <a href="{{ route('seeker.interviews') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer" :class="request()->routeIs('seeker.interviews') ? 'bg-green-100 text-green-700' : 'text-gray-700 hover:bg-green-50 hover:text-green-600'" :style="request()->routeIs('seeker.interviews') ? 'background-color: rgba(34, 197, 94, 0.8); color: rgb(21, 128, 61);' : ''" @click="sidebarOpen = false">
                <i class="fas fa-calendar-check w-3 text-xs"></i><span>Interviews</span>
            </a>
            <a href="{{ route('seeker.messages') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer" :class="request()->routeIs('seeker.messages') ? 'bg-green-100 text-green-700' : 'text-gray-700 hover:bg-green-50 hover:text-green-600'" :style="request()->routeIs('seeker.messages') ? 'background-color: rgba(34, 197, 94, 0.8); color: rgb(21, 128, 61);' : ''" @click="sidebarOpen = false">
                <i class="fas fa-envelope w-3 text-xs"></i><span>Messages</span>
            </a>
            <a href="{{ route('seeker.notifications') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer" :class="request()->routeIs('seeker.notifications') ? 'bg-green-100 text-green-700' : 'text-gray-700 hover:bg-green-50 hover:text-green-600'" :style="request()->routeIs('seeker.notifications') ? 'background-color: rgba(34, 197, 94, 0.8); color: rgb(21, 128, 61);' : ''" @click="sidebarOpen = false">
                <i class="fas fa-bell w-3 text-xs"></i><span>Notifications</span>
                <span x-show="notificationStats.unread > 0" class="ml-auto bg-red-500 text-white text-[10px] px-1.5 py-0.5 rounded-full nav-badge" x-text="notificationStats.unread"></span>
            </a>
            <a href="{{ route('seeker.settings') }}" class="nav-item flex items-center space-x-2 px-2 py-2 rounded-lg transition text-xs cursor-pointer" :class="request()->routeIs('seeker.settings') ? 'bg-green-100 text-green-700' : 'text-gray-700 hover:bg-green-50 hover:text-green-600'" :style="request()->routeIs('seeker.settings') ? 'background-color: rgba(34, 197, 94, 0.8); color: rgb(21, 128, 61);' : ''" @click="sidebarOpen = false">
                <i class="fas fa-cog w-3 text-xs"></i><span>Settings</span>
            </a>
        </nav>

        <div class="mt-4 pt-4 border-t border-blue-200">
            <p class="px-2 text-[10px] font-semibold text-gray-500 uppercase tracking-wider mb-2">Quick Actions</p>
            <nav class="space-y-1">
                <a href="{{ route('jobs.index') }}" class="w-full nav-item flex items-center space-x-2 px-2 py-2 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition text-xs text-left cursor-pointer">
                    <i class="fas fa-plus-circle text-green-500 w-3"></i><span>Apply to Job</span>
                </a>
                <a href="{{ route('seeker.profile.edit') }}" class="w-full nav-item flex items-center space-x-2 px-2 py-2 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition text-xs text-left cursor-pointer">
                    <i class="fas fa-upload text-purple-500 w-3"></i><span>Upload Resume</span>
                </a>
                <a href="{{ route('seeker.notifications') }}" class="w-full nav-item flex items-center space-x-2 px-2 py-2 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition text-xs text-left cursor-pointer">
                    <i class="fas fa-headset text-blue-500 w-3"></i><span>Get Support</span>
                </a>
            </nav>
        </div>
        <div class="pb-4"></div>
    </div>
    </div>
</aside>

<button class="sidebar-toggle hidden lg:block" @click="sidebarCollapsed = !sidebarCollapsed">
    <i class="fas fa-chevron-right"></i>
</button>
