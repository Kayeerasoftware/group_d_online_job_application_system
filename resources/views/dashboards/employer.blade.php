@extends('layouts.employer')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Welcome Header -->
    <div class="bg-gradient-to-r from-emerald-600 to-teal-600 rounded-lg shadow-lg p-3 md:p-4 mb-4 md:mb-6">
        <div class="flex items-center justify-between gap-2">
            <div class="flex items-center gap-3 flex-1 min-w-0">
                <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl overflow-hidden bg-white shadow-lg flex-shrink-0">
                    <img src="{{ auth()->user()->profile_picture_url ?? 'https://via.placeholder.com/56' }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                </div>
                <div class="min-w-0">
                    <h1 class="text-sm sm:text-lg md:text-2xl font-bold text-white truncate">Welcome, <span class="text-emerald-200 text-base sm:text-xl md:text-3xl">{{ auth()->user()->name }}</span> 👋</h1>
                    <p class="text-emerald-100 text-xs sm:text-sm mt-0.5 md:mt-1">Manage your job postings and applications</p>
                </div>
            </div>
            <div class="bg-white/20 backdrop-blur-sm rounded-lg px-2 py-1 sm:px-3 sm:py-1.5 md:px-4 md:py-2 text-right flex-shrink-0">
                <p class="text-white text-xs sm:text-sm font-semibold whitespace-nowrap">{{ now()->format('l, F d, Y') }}</p>
                <p class="text-emerald-100 text-xs mt-0.5 whitespace-nowrap">{{ now()->format('h:i A') }}</p>
            </div>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-green-500 to-green-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-green-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Dashboard data...</span>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-3 mb-4 md:mb-6">
        <!-- Active Jobs -->
        <div class="bg-gradient-to-r from-emerald-50 to-emerald-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-emerald-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-briefcase text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Active Jobs</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">8 <span class="text-xs text-green-600 font-medium">+2</span></h3>
                </div>
            </div>
        </div>

        <!-- Total Applications -->
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-blue-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-file-alt text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Applications</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">156 <span class="text-xs text-blue-600 font-medium">+24</span></h3>
                </div>
            </div>
        </div>

        <!-- Pending Review -->
        <div class="bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-yellow-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-hourglass-half text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Pending</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">23 <span class="text-xs text-yellow-600 font-medium">Review</span></h3>
                </div>
            </div>
        </div>

        <!-- Interviews Scheduled -->
        <div class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-purple-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-calendar-check text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Interviews</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">5 <span class="text-xs text-purple-600 font-medium">This week</span></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            <!-- Recent Applications -->
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="fas fa-file-alt text-emerald-600 mr-2"></i>Recent Applications
                    </h3>
                    <a href="{{ route('employer.applications') }}" class="text-emerald-600 text-sm hover:underline font-semibold">View All →</a>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 hover:bg-emerald-50 rounded-lg transition cursor-pointer border border-gray-100">
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-900">John Doe</p>
                            <p class="text-xs text-gray-500">Senior Laravel Developer • 2 hours ago</p>
                        </div>
                        <span class="px-3 py-1 text-xs rounded-full font-semibold bg-yellow-100 text-yellow-800">Pending</span>
                    </div>
                    <div class="flex items-center justify-between p-3 hover:bg-emerald-50 rounded-lg transition cursor-pointer border border-gray-100">
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-900">Jane Smith</p>
                            <p class="text-xs text-gray-500">UI/UX Designer • 5 hours ago</p>
                        </div>
                        <span class="px-3 py-1 text-xs rounded-full font-semibold bg-green-100 text-green-800">Accepted</span>
                    </div>
                    <div class="flex items-center justify-between p-3 hover:bg-emerald-50 rounded-lg transition cursor-pointer border border-gray-100">
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-900">Mike Johnson</p>
                            <p class="text-xs text-gray-500">DevOps Engineer • 1 day ago</p>
                        </div>
                        <span class="px-3 py-1 text-xs rounded-full font-semibold bg-red-100 text-red-800">Rejected</span>
                    </div>
                </div>
            </div>

            <!-- Top Performing Jobs -->
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="fas fa-chart-line text-emerald-600 mr-2"></i>Top Performing Jobs
                    </h3>
                    <a href="{{ route('jobs.index') }}" class="text-emerald-600 text-sm hover:underline font-semibold">View All →</a>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 hover:bg-emerald-50 rounded-lg transition border border-gray-100">
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-900">Senior Laravel Developer</p>
                            <p class="text-xs text-gray-500"><i class="fas fa-eye text-emerald-600 mr-1"></i>342 views • <i class="fas fa-file-alt text-emerald-600 mr-1"></i>28 applications</p>
                        </div>
                        <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center">
                            <span class="text-emerald-600 font-bold">1</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between p-3 hover:bg-emerald-50 rounded-lg transition border border-gray-100">
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-900">UI/UX Designer</p>
                            <p class="text-xs text-gray-500"><i class="fas fa-eye text-emerald-600 mr-1"></i>287 views • <i class="fas fa-file-alt text-emerald-600 mr-1"></i>19 applications</p>
                        </div>
                        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                            <span class="text-blue-600 font-bold">2</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between p-3 hover:bg-emerald-50 rounded-lg transition border border-gray-100">
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-900">DevOps Engineer</p>
                            <p class="text-xs text-gray-500"><i class="fas fa-eye text-emerald-600 mr-1"></i>156 views • <i class="fas fa-file-alt text-emerald-600 mr-1"></i>12 applications</p>
                        </div>
                        <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center">
                            <span class="text-purple-600 font-bold">3</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Company Card -->
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition text-center">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 font-serif text-2xl text-white shadow-lg">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <h3 class="mt-3 font-semibold text-gray-800">{{ auth()->user()->name }}</h3>
                <p class="text-sm text-gray-600">Employer Account</p>
                <div class="mt-3">
                    <div class="h-1.5 w-full overflow-hidden rounded-full bg-gray-200">
                        <div class="h-full rounded-full bg-gradient-to-r from-emerald-600 to-teal-600" style="width: 75%"></div>
                    </div>
                    <p class="mt-1 text-xs text-gray-600 font-medium">Profile 75% complete</p>
                </div>
                <a href="{{ route('employer.profile.edit') }}" class="mt-4 block w-full px-4 py-2 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold text-sm">
                    <i class="fas fa-edit mr-2"></i>Edit Profile
                </a>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-lightning-bolt text-emerald-600 mr-2"></i>Quick Actions
                </h3>
                <div class="space-y-2">
                    <a href="{{ route('jobs.create') }}" class="flex items-center gap-3 p-3 hover:bg-emerald-50 rounded-lg transition border border-gray-100 cursor-pointer">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center">
                            <i class="fas fa-plus text-emerald-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Post New Job</p>
                            <p class="text-xs text-gray-500">Create a job posting</p>
                        </div>
                    </a>
                    <a href="{{ route('employer.applications') }}" class="flex items-center gap-3 p-3 hover:bg-blue-50 rounded-lg transition border border-gray-100 cursor-pointer">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-inbox text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Review Applications</p>
                            <p class="text-xs text-gray-500">Check pending apps</p>
                        </div>
                    </a>
                    <a href="{{ route('employer.interviews') }}" class="flex items-center gap-3 p-3 hover:bg-purple-50 rounded-lg transition border border-gray-100 cursor-pointer">
                        <div class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center">
                            <i class="fas fa-calendar-check text-purple-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Schedule Interview</p>
                            <p class="text-xs text-gray-500">Manage interviews</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recent Notifications -->
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="fas fa-bell text-orange-600 mr-2"></i>Notifications
                    </h3>
                    <a href="{{ route('employer.notifications') }}" class="text-emerald-600 text-sm hover:underline font-semibold">View All →</a>
                </div>
                <div class="space-y-3">
                    <div class="flex items-start gap-3 p-3 hover:bg-orange-50 rounded-lg transition border border-gray-100">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-blue-100">
                            <i class="fas fa-envelope text-blue-600"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900">New Application</p>
                            <p class="text-xs text-gray-500">5 minutes ago</p>
                        </div>
                        <span class="h-2 w-2 shrink-0 rounded-full bg-blue-600"></span>
                    </div>
                    <div class="flex items-start gap-3 p-3 hover:bg-orange-50 rounded-lg transition border border-gray-100">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-purple-100">
                            <i class="fas fa-calendar-check text-purple-600"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900">Interview Reminder</p>
                            <p class="text-xs text-gray-500">2 hours ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes slide-right {
    0% { width: 0%; }
    100% { width: 100%; }
}
.animate-slide-right {
    animation: slide-right 5s ease-out forwards;
}
@keyframes slide-text {
    0% { left: 0%; opacity: 1; }
    95% { opacity: 1; }
    100% { left: 100%; opacity: 0; }
}
.animate-slide-text {
    animation: slide-text 5s ease-out forwards;
}
</style>
@endsection
