<div class="space-y-4 md:space-y-6" x-data="{ activeTab: 'overview' }">
    <!-- Welcome Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg shadow-lg p-3 md:p-4">
        <div class="flex items-center justify-between gap-2">
            <div class="flex items-center gap-3 flex-1 min-w-0">
                <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl overflow-hidden bg-white shadow-lg flex-shrink-0">
                    <img src="{{ auth()->user()->profile_picture_url ?? asset('images/default-avatar.svg') }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                </div>
                <div class="min-w-0">
                    <h1 class="text-sm sm:text-lg md:text-2xl font-bold text-white truncate">Welcome, <span class="text-black text-base sm:text-xl md:text-3xl">{{ auth()->user()->name }}</span> <span class="text-blue-200 font-normal text-xs sm:text-sm md:text-lg">(Job Seeker)</span> 👋</h1>
                    <p class="text-blue-100 text-xs sm:text-sm mt-0.5 md:mt-1">Track your job applications and career progress...</p>
                </div>
            </div>
            <div class="bg-white/20 backdrop-blur-sm rounded-lg px-2 py-1 sm:px-3 sm:py-1.5 md:px-4 md:py-2 text-right flex-shrink-0">
                <p class="text-white text-xs sm:text-sm font-semibold whitespace-nowrap">{{ now()->format('l, F d, Y') }}</p>
                <p class="text-blue-100 text-xs mt-0.5 whitespace-nowrap">{{ now()->format('h:i A') }}</p>
            </div>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-green-500 to-green-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-green-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Dashboard data...</span>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-3">
        <!-- Total Applications -->
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-blue-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-file-alt text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Applications</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $stats['applications'] }} <span class="text-xs text-green-600 font-medium">+{{ $stats['applications_this_week'] }}</span></h3>
                </div>
            </div>
        </div>

        <!-- Shortlisted -->
        <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-green-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-green-500 to-green-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-check-circle text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Shortlisted</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $stats['shortlisted'] }} <span class="text-xs text-gray-500 font-medium">Interviews</span></h3>
                </div>
            </div>
        </div>

        <!-- Saved Jobs -->
        <div class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-purple-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-bookmark text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Saved Jobs</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $stats['saved_jobs'] }} <span class="text-xs text-yellow-600 font-medium">{{ $stats['closing_soon'] }} closing</span></h3>
                </div>
            </div>
        </div>

        <!-- Profile Completion -->
        <div class="bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-orange-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-user text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Profile</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $profileCompletion }}% <span class="text-xs text-gray-500 font-medium">Complete</span></h3>
                </div>
            </div>
        </div>

        <!-- Profile Views -->
        <div class="bg-gradient-to-r from-indigo-50 to-indigo-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-indigo-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-eye text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Profile Views</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $stats['profile_views'] }} <span class="text-xs text-gray-500 font-medium">Last 30d</span></h3>
                </div>
            </div>
        </div>

        <!-- Notifications -->
        <div class="bg-gradient-to-r from-pink-50 to-pink-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-pink-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-pink-500 to-pink-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-bell text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Notifications</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $unreadNotifications }} <span class="text-xs text-red-600 font-medium">Unread</span></h3>
                </div>
            </div>
        </div>

        <!-- Rejection Rate -->
        <div class="bg-gradient-to-r from-teal-50 to-teal-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-teal-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-teal-500 to-teal-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-chart-pie text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Success Rate</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $stats['applications'] > 0 ? round(($stats['shortlisted'] / $stats['applications']) * 100) : 0 }}% <span class="text-xs text-gray-500 font-medium">Shortlist</span></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section with Tabs -->
    <div class="bg-white rounded-xl shadow-xl p-6">
        <div class="flex flex-col sm:flex-row sm:flex-wrap items-start sm:items-center justify-between gap-2 mb-6 border-b pb-4">
            <div class="flex flex-wrap gap-2">
                <button @click="activeTab = 'overview'" :class="activeTab === 'overview' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'" class="px-4 py-2 rounded-lg font-semibold transition">
                    <i class="fas fa-chart-line mr-2"></i>Overview
                </button>
                <button @click="activeTab = 'applications'" :class="activeTab === 'applications' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'" class="px-4 py-2 rounded-lg font-semibold transition">
                    <i class="fas fa-file-alt mr-2"></i>Applications
                </button>
                <button @click="activeTab = 'jobs'" :class="activeTab === 'jobs' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'" class="px-4 py-2 rounded-lg font-semibold transition">
                    <i class="fas fa-briefcase mr-2"></i>Jobs
                </button>
            </div>
            <div class="flex items-center gap-2 sm:gap-3 w-full sm:w-auto">
                <span id="analyticsLabel" class="text-xs sm:text-sm font-semibold text-gray-700 whitespace-nowrap">Analytics for <span id="yearText">{{ now()->year }}</span></span>
                <select id="yearFilter" class="px-2 sm:px-4 py-1.5 sm:py-2 border border-gray-300 rounded-lg font-semibold text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-xs sm:text-sm">
                    @for($year = 2024; $year <= 2034; $year++)
                        <option value="{{ $year }}" {{ $year == now()->year ? 'selected' : '' }}>{{ $year }}</option>
                    @endfor
                    <option value="all">All Years</option>
                </select>
            </div>
        </div>

        <!-- Overview Tab -->
        <div x-show="activeTab === 'overview'" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="h-80 relative">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Application Trends</h3>
                <canvas id="trendChart"></canvas>
            </div>
            <div class="h-80 relative">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Application Status Distribution</h3>
                <canvas id="statusChart"></canvas>
            </div>
        </div>

        <!-- Applications Tab -->
        <div x-show="activeTab === 'applications'" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="h-80 relative">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Applications by Status</h3>
                <canvas id="applicationStatusChart"></canvas>
            </div>
            <div class="h-80 relative">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Application Timeline</h3>
                <canvas id="timelineChart"></canvas>
            </div>
        </div>

        <!-- Jobs Tab -->
        <div x-show="activeTab === 'jobs'" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="h-80 relative">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Jobs by Category</h3>
                <canvas id="categoryChart"></canvas>
            </div>
            <div class="h-80 relative">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Saved vs Applied</h3>
                <canvas id="savedVsAppliedChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Applications -->
        <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-800 flex items-center">
                    <i class="fas fa-file-alt text-blue-600 mr-2"></i>Recent Applications
                </h3>
                <a href="#applications" class="text-blue-600 text-sm hover:underline font-semibold">View All →</a>
            </div>
            <div class="space-y-3">
                @forelse($recentApplications as $application)
                <a href="{{ route('applications.show', $application) }}" class="flex items-center space-x-3 p-3 hover:bg-blue-50 rounded-lg transition cursor-pointer">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center shadow-lg ring-2 ring-blue-500 ring-offset-2">
                        <i class="fas fa-briefcase text-white text-lg"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ $application->job->title }}</p>
                        <p class="text-xs text-gray-500">{{ $application->job->company_name }} • {{ $application->created_at->diffForHumans() }}</p>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400"></i>
                </a>
                @empty
                <p class="text-gray-500 text-sm text-center py-8">No recent applications</p>
                @endforelse
            </div>
        </div>

        <!-- Shortlisted Jobs -->
        <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-800 flex items-center">
                    <i class="fas fa-check-circle text-green-600 mr-2"></i>Shortlisted
                </h3>
                <a href="#applications" class="text-blue-600 text-sm hover:underline font-semibold">View All →</a>
            </div>
            <div class="space-y-3">
                @forelse($recentApplications->where('status', 'shortlisted') as $application)
                <div class="flex items-center justify-between p-3 hover:bg-green-50 rounded-lg transition cursor-pointer">
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-900">{{ $application->job->title }}</p>
                        <p class="text-xs text-gray-500">{{ $application->job->company_name }}</p>
                    </div>
                    <span class="px-3 py-1 text-xs rounded-full font-semibold bg-green-100 text-green-800">
                        Shortlisted
                    </span>
                </div>
                @empty
                <p class="text-gray-500 text-sm text-center py-8">No shortlisted applications</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Notifications -->
        <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-800 flex items-center">
                    <i class="fas fa-bell text-orange-600 mr-2"></i>Recent Notifications
                </h3>
                <a href="#notifications" class="text-blue-600 text-sm hover:underline font-semibold">View All →</a>
            </div>
            <div class="space-y-3">
                @forelse($recentNotifications as $notification)
                <div class="flex items-center justify-between p-3 hover:bg-orange-50 rounded-lg transition cursor-pointer">
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-900">{{ $notification->title }}</p>
                        <p class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                    @if(!$notification->read_at)
                    <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                    @endif
                </div>
                @empty
                <p class="text-gray-500 text-sm text-center py-8">No recent notifications</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
