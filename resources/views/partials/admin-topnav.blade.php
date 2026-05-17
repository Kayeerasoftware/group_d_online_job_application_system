<nav class="topnav no-print fixed top-0 left-0 right-0 h-12 bg-gradient-to-r from-red-200 via-orange-200 to-yellow-200 dark:from-gray-800 dark:via-gray-700 dark:to-gray-800 backdrop-blur-xl border-b border-red-300 dark:border-gray-600 z-50 shadow-2xl ring-2 ring-gradient-to-r ring-from-red-400 ring-to-yellow-400 ring-opacity-80 shadow-red-500/30 dark:shadow-gray-900/30 transition-colors duration-300">
    <div class="nav-container flex items-center justify-between h-full px-6 max-w-full mx-auto">
        <div class="nav-left flex items-center gap-0">
            <button @click="sidebarOpen = !sidebarOpen" class="menu-toggle lg:hidden bg-gradient-to-br from-red-50 to-orange-50 border border-red-200 text-base text-red-600 cursor-pointer px-2 py-1.5 rounded-lg transition-all duration-300 hover:from-red-100 hover:to-orange-100 hover:-translate-y-0.5 hover:shadow-md">
                <i class="fas fa-bars"></i>
            </button>
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('MAK-JOBLINK log.png') }}" alt="JobLink Logo" class="logo-img h-10 w-auto object-contain drop-shadow-md transition-all duration-300 cursor-pointer hover:scale-105">
            </a>
            <div class="flex items-center px-3 py-1.5 bg-gradient-to-br from-red-50 to-orange-50 rounded-lg border border-red-200 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md hover:border-red-300" @click="showLogoModal = !showLogoModal" :class="showLogoModal ? 'ring-2 ring-red-400' : ''">
                <h2 class="m-0 bg-gradient-to-br from-red-600 to-orange-600 bg-clip-text text-transparent text-xs font-bold hidden md:block cursor-pointer">ADMIN PANEL</h2>
            </div>
        </div>

        <div class="nav-center flex-1 flex justify-center">
            <div class="flex items-center gap-2 font-bold text-sm tracking-tight px-6 py-1 rounded-xl border transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md cursor-pointer hidden lg:flex" style="background: linear-gradient(135deg, #fee2e2, #fed7aa); border-color: #dc2626;" @click="showAdminModal = !showAdminModal" :class="showAdminModal ? 'ring-2 ring-red-400' : ''">
                <div class="bg-white/20 p-0.5 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-shield-alt text-sm drop-shadow-md" style="color: #dc2626;"></i>
                </div>
                <span class="text-sm font-bold whitespace-nowrap" style="background: linear-gradient(135deg, #dc2626, #ea580c); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Admin Dashboard</span>
            </div>
        </div>

        <div class="nav-right flex items-center gap-2">
            <div class="relative" x-data="{
                showCalendar: false,
                currentTime: new Date(),
                currentMonth: new Date().getMonth(),
                currentYear: new Date().getFullYear(),
                getDaysInMonth(month, year) {
                    return new Date(year, month + 1, 0).getDate();
                },
                getFirstDayOfMonth(month, year) {
                    return new Date(year, month, 1).getDay();
                },
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                isToday(day) {
                    const today = new Date();
                    return day === today.getDate() && this.currentMonth === today.getMonth() && this.currentYear === today.getFullYear();
                }
            }" x-init="setInterval(() => { currentTime = new Date() }, 1000)">
                <button @click="showCalendar = !showCalendar" class="nav-btn relative flex items-center justify-center bg-gradient-to-br from-red-50 to-orange-50 border border-red-200 px-3 py-1.5 rounded-xl cursor-pointer transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md hover:border-red-300" title="Calendar" :class="showCalendar ? 'ring-2 ring-red-400' : ''">
                    <i class="fas fa-calendar-alt text-red-600 drop-shadow-md"></i>
                    <span class="bg-gradient-to-br from-red-600 to-orange-600 bg-clip-text text-transparent text-xs font-bold font-mono ml-2 hidden md:inline" x-text="currentTime.toLocaleDateString() + ' ' + currentTime.toLocaleTimeString()"></span>
                </button>
                <div x-show="showCalendar" @click.away="showCalendar = false" x-transition x-cloak class="fixed sm:absolute top-16 sm:top-full left-1/2 -translate-x-1/2 sm:left-auto sm:right-0 sm:translate-x-0 mt-0 sm:mt-3 w-[320px] bg-white rounded-xl shadow-2xl z-[100] overflow-hidden border-2 border-red-100">
                    <div class="px-4 py-2.5 bg-gradient-to-r from-red-500 to-orange-500 flex items-center justify-between">
                        <button @click="currentMonth = currentMonth === 0 ? (currentYear--, 11) : currentMonth - 1" class="text-white hover:bg-white/20 rounded-lg px-2 py-1 transition"><i class="fas fa-chevron-left text-xs"></i></button>
                        <h3 class="text-sm font-bold text-white" x-text="monthNames[currentMonth] + ' ' + currentYear"></h3>
                        <button @click="currentMonth = currentMonth === 11 ? (currentYear++, 0) : currentMonth + 1" class="text-white hover:bg-white/20 rounded-lg px-2 py-1 transition"><i class="fas fa-chevron-right text-xs"></i></button>
                    </div>
                    <div class="p-3">
                        <div class="grid grid-cols-7 gap-1 mb-2">
                            <div class="text-center text-xs font-bold text-gray-600">Su</div>
                            <div class="text-center text-xs font-bold text-gray-600">Mo</div>
                            <div class="text-center text-xs font-bold text-gray-600">Tu</div>
                            <div class="text-center text-xs font-bold text-gray-600">We</div>
                            <div class="text-center text-xs font-bold text-gray-600">Th</div>
                            <div class="text-center text-xs font-bold text-gray-600">Fr</div>
                            <div class="text-center text-xs font-bold text-gray-600">Sa</div>
                        </div>
                        <div class="grid grid-cols-7 gap-1">
                            <template x-for="blank in getFirstDayOfMonth(currentMonth, currentYear)" :key="'blank-' + blank">
                                <div class="h-9"></div>
                            </template>
                            <template x-for="day in getDaysInMonth(currentMonth, currentYear)" :key="day">
                                <div class="h-9 flex items-center justify-center text-xs rounded-lg cursor-pointer transition" :class="isToday(day) ? 'bg-gradient-to-br from-red-500 to-orange-500 text-white font-bold shadow-md' : 'hover:bg-red-50 text-gray-700'" x-text="day"></div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.audit-logs.index') }}" class="nav-btn relative flex items-center justify-center bg-gradient-to-br from-red-50 to-orange-50 border border-red-200 px-3 py-1.5 rounded-xl cursor-pointer transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md hover:border-red-300" title="Audit Logs">
                <i class="fas fa-history text-red-600 drop-shadow-md"></i>
            </a>
            <button @click="showProfileDropdown = !showProfileDropdown" class="flex items-center gap-2 px-3 py-1.5 rounded-xl cursor-pointer transition-all duration-300 bg-gradient-to-br from-red-50 to-orange-50 border border-red-200 hover:-translate-y-0.5 hover:shadow-md hover:border-red-300">
                <span class="bg-gradient-to-br from-red-600 to-orange-600 bg-clip-text text-transparent text-xs font-bold tracking-tight hidden lg:inline" x-text="'Welcome, ' + adminProfile.name">Welcome, Administrator</span>
                <i class="fas fa-chevron-down dropdown-arrow transition-all duration-300 text-red-600 text-xs drop-shadow-md hidden lg:inline" :class="showProfileDropdown ? 'rotate-180' : ''"></i>
                <div class="profile-avatar relative">
                    <template x-if="profilePicture">
                        <img :src="profilePicture" alt="Profile" class="w-6 h-6 rounded-full object-cover border-2 border-green-500 shadow-md transition-all duration-300">
                    </template>
                    <template x-if="!profilePicture">
                        <div class="w-6 h-6 rounded-full bg-gradient-to-br from-red-400 to-orange-500 flex items-center justify-center text-white text-xs font-bold border-2 border-green-500 shadow-md">
                            <span x-text="adminProfile.initials"></span>
                        </div>
                    </template>
                    <div class="status-indicator online absolute bottom-0 right-0 w-2 h-2 rounded-full border-2 border-white bg-gradient-to-br from-green-500 to-green-600 shadow-md animate-pulse"></div>
                </div>
            </button>
        </div>
    </div>
</nav>

<!-- Profile Dropdown -->
<div x-show="showProfileDropdown" @click.away="showProfileDropdown = false" x-transition class="fixed top-14 right-6 w-44 bg-white rounded-xl shadow-2xl z-40 border border-red-100 overflow-hidden" style="display: none;">
    <div class="absolute -top-2 right-6 w-4 h-4 bg-gradient-to-br from-red-500 to-orange-600 border-l border-t border-red-100 transform rotate-45"></div>
    
    <div class="pt-6 pb-3 px-3 text-center bg-gradient-to-br from-red-500 to-orange-600 relative">
        <div class="absolute inset-0 bg-black/5"></div>
        <div class="relative">
            <template x-if="profilePicture">
                <div class="w-16 h-16 rounded-full mx-auto mb-2 p-1 bg-white shadow-lg">
                    <img :src="profilePicture" alt="Profile" class="w-full h-full rounded-full object-cover">
                </div>
            </template>
            <template x-if="!profilePicture">
                <div class="w-16 h-16 rounded-full mx-auto mb-2 p-1 bg-white shadow-lg flex items-center justify-center bg-gradient-to-br from-red-400 to-orange-500 text-white text-2xl font-bold">
                    <span x-text="adminProfile.initials"></span>
                </div>
            </template>
            <p class="text-sm font-bold text-white truncate" x-text="adminProfile.name">Administrator</p>
            <p class="text-xs text-red-100">System Administrator</p>
        </div>
    </div>
    
    <div class="py-1.5">
        <a href="{{ route('admin.profile') }}" @click="showProfileDropdown = false" class="flex items-center gap-2 px-3 py-2 text-sm text-gray-700 hover:bg-red-50 transition group">
            <div class="w-7 h-7 rounded-lg bg-red-100 flex items-center justify-center group-hover:bg-red-200 transition">
                <i class="fas fa-user text-red-600 text-xs"></i>
            </div>
            <span class="font-medium text-xs">My Profile</span>
        </a>
        <a href="{{ route('admin.dashboard') }}" @click="showProfileDropdown = false" class="flex items-center gap-2 px-3 py-2 text-sm text-gray-700 hover:bg-red-50 transition group">
            <div class="w-7 h-7 rounded-lg bg-red-100 flex items-center justify-center group-hover:bg-red-200 transition">
                <i class="fas fa-home text-red-600 text-xs"></i>
            </div>
            <span class="font-medium text-xs">Dashboard</span>
        </a>
        <a href="{{ route('admin.users.index') }}" @click="showProfileDropdown = false" class="flex items-center gap-2 px-3 py-2 text-sm text-gray-700 hover:bg-orange-50 transition group">
            <div class="w-7 h-7 rounded-lg bg-orange-100 flex items-center justify-center group-hover:bg-orange-200 transition">
                <i class="fas fa-users text-orange-600 text-xs"></i>
            </div>
            <span class="font-medium text-xs">Users</span>
        </a>
        <div class="flex items-center justify-between px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-lg bg-gray-100 flex items-center justify-center transition">
                    <i class="fas fa-moon text-gray-600 text-xs" x-show="!darkMode"></i>
                    <i class="fas fa-sun text-yellow-500 text-xs" x-show="darkMode"></i>
                </div>
                <span class="font-medium text-xs" x-text="darkMode ? 'Light Mode' : 'Dark Mode'">Dark Mode</span>
            </div>
            <button @click="darkMode = !darkMode" class="relative inline-flex h-5 w-9 items-center rounded-full transition-colors" :class="darkMode ? 'bg-red-600' : 'bg-gray-300'">
                <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform" :class="darkMode ? 'translate-x-5' : 'translate-x-0.5'"></span>
            </button>
        </div>
    </div>
    
    <div class="border-t border-gray-100 p-1.5">
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="flex items-center gap-2 px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg transition w-full group">
                <div class="w-7 h-7 rounded-lg bg-red-100 flex items-center justify-center group-hover:bg-red-200 transition">
                    <i class="fas fa-sign-out-alt text-red-600 text-xs"></i>
                </div>
                <span class="font-medium text-xs">Logout</span>
            </button>
        </form>
    </div>
</div>

<div x-show="showLogoModal" x-transition @click.away="showLogoModal = false" x-cloak class="fixed top-12 left-0 right-0 bg-white border-b border-gray-200 shadow-xl z-[100] p-6">
    <div class="max-w-md mx-auto text-center">
        <img src="{{ asset('MAK-JOBLINK log.png') }}" alt="JobLink Logo" class="h-20 w-auto object-contain mx-auto mb-3 drop-shadow-lg">
        <h2 class="text-lg font-bold bg-gradient-to-br from-red-600 to-orange-600 bg-clip-text text-transparent mb-2">ADMIN PANEL</h2>
        <p class="text-sm text-gray-600 mb-1">System Administration & Moderation</p>
        <p class="text-xs text-gray-400">Manage users, jobs, reports, and system settings</p>
    </div>
</div>

<div x-show="showAdminModal" x-transition @click.away="showAdminModal = false" x-cloak class="fixed top-12 left-0 right-0 bg-white border-b border-gray-200 shadow-xl z-[100] p-6">
    <div class="max-w-md mx-auto text-center">
        <div class="w-16 h-16 mx-auto mb-3 bg-gradient-to-br from-red-400 to-orange-500 rounded-full flex items-center justify-center">
            <i class="fas fa-shield-alt text-white text-2xl"></i>
        </div>
        <h2 class="text-lg font-bold bg-gradient-to-br from-red-600 to-orange-600 bg-clip-text text-transparent mb-2">Admin Dashboard</h2>
        <p class="text-sm text-gray-600 mb-1">System Administration & Moderation</p>
        <p class="text-xs text-gray-400">Monitor and manage the entire platform</p>
    </div>
</div>
