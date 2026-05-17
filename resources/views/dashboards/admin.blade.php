@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Welcome Header -->
    <div class="bg-gradient-to-r from-red-600 to-orange-600 rounded-lg shadow-lg p-3 md:p-4 mb-4 md:mb-6">
        <div class="flex items-center justify-between gap-2">
            <div class="flex items-center gap-3 flex-1 min-w-0">
                <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl overflow-hidden bg-white shadow-lg flex-shrink-0">
                    <img src="{{ auth()->user()->profile_picture_url ?? 'https://via.placeholder.com/56' }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                </div>
                <div class="min-w-0">
                    <h1 class="text-sm sm:text-lg md:text-2xl font-bold text-white truncate">Welcome, <span class="text-red-200 text-base sm:text-xl md:text-3xl">{{ auth()->user()->name }}</span> 🛡️</h1>
                    <p class="text-red-100 text-xs sm:text-sm mt-0.5 md:mt-1">System Administration & Moderation</p>
                </div>
            </div>
            <div class="bg-white/20 backdrop-blur-sm rounded-lg px-2 py-1 sm:px-3 sm:py-1.5 md:px-4 md:py-2 text-right flex-shrink-0">
                <p class="text-white text-xs sm:text-sm font-semibold whitespace-nowrap">{{ now()->format('l, F d, Y') }}</p>
                <p class="text-red-100 text-xs mt-0.5 whitespace-nowrap">{{ now()->format('h:i A') }}</p>
            </div>
        </div>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-2 md:gap-3 mb-4 md:mb-6">
        <!-- Total Users -->
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-blue-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-users text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Users</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $userCount }}</h3>
                </div>
            </div>
        </div>

        <!-- Active Jobs -->
        <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-green-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-green-500 to-green-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-briefcase text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Jobs</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $jobCount }}</h3>
                </div>
            </div>
        </div>

        <!-- Applications -->
        <div class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-purple-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-file-alt text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Applications</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $applicationCount }}</h3>
                </div>
            </div>
        </div>

        <!-- Reports -->
        <div class="bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-orange-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-file-contract text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Reports</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $reportCount }}</h3>
                </div>
            </div>
        </div>

        <!-- Flagged Jobs -->
        <div class="bg-gradient-to-r from-red-50 to-red-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-red-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-red-500 to-red-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-flag text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Flagged</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $flaggedJobs }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-bolt text-yellow-600 mr-2"></i>Quick Actions
                </h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    <a href="{{ route('admin.users.index') }}" class="flex flex-col items-center justify-center p-4 rounded-lg border-2 border-blue-200 hover:border-blue-400 hover:bg-blue-50 transition">
                        <i class="fas fa-users text-blue-600 text-2xl mb-2"></i>
                        <span class="text-xs font-semibold text-gray-700 text-center">Manage Users</span>
                    </a>
                    <a href="{{ route('admin.reports.index') }}" class="flex flex-col items-center justify-center p-4 rounded-lg border-2 border-orange-200 hover:border-orange-400 hover:bg-orange-50 transition">
                        <i class="fas fa-file-contract text-orange-600 text-2xl mb-2"></i>
                        <span class="text-xs font-semibold text-gray-700 text-center">View Reports</span>
                    </a>
                    <a href="{{ route('admin.audit-logs.index') }}" class="flex flex-col items-center justify-center p-4 rounded-lg border-2 border-purple-200 hover:border-purple-400 hover:bg-purple-50 transition">
                        <i class="fas fa-history text-purple-600 text-2xl mb-2"></i>
                        <span class="text-xs font-semibold text-gray-700 text-center">Audit Logs</span>
                    </a>
                    <a href="{{ route('admin.system.index') }}" class="flex flex-col items-center justify-center p-4 rounded-lg border-2 border-green-200 hover:border-green-400 hover:bg-green-50 transition">
                        <i class="fas fa-cog text-green-600 text-2xl mb-2"></i>
                        <span class="text-xs font-semibold text-gray-700 text-center">System</span>
                    </a>
                    <a href="{{ route('admin.reports.create') }}" class="flex flex-col items-center justify-center p-4 rounded-lg border-2 border-red-200 hover:border-red-400 hover:bg-red-50 transition">
                        <i class="fas fa-plus-circle text-red-600 text-2xl mb-2"></i>
                        <span class="text-xs font-semibold text-gray-700 text-center">New Report</span>
                    </a>
                    <a href="{{ route('home') }}" class="flex flex-col items-center justify-center p-4 rounded-lg border-2 border-gray-200 hover:border-gray-400 hover:bg-gray-50 transition">
                        <i class="fas fa-home text-gray-600 text-2xl mb-2"></i>
                        <span class="text-xs font-semibold text-gray-700 text-center">Home</span>
                    </a>
                </div>
            </div>

            <!-- System Status -->
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-heartbeat text-green-600 mr-2"></i>System Status
                </h2>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg border border-green-200">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-green-600"></i>
                            <span class="text-sm font-semibold text-gray-700">Database</span>
                        </div>
                        <span class="px-3 py-1 text-xs rounded-full font-semibold bg-green-100 text-green-800">Operational</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg border border-green-200">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-green-600"></i>
                            <span class="text-sm font-semibold text-gray-700">API Server</span>
                        </div>
                        <span class="px-3 py-1 text-xs rounded-full font-semibold bg-green-100 text-green-800">Operational</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg border border-green-200">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-green-600"></i>
                            <span class="text-sm font-semibold text-gray-700">File Storage</span>
                        </div>
                        <span class="px-3 py-1 text-xs rounded-full font-semibold bg-green-100 text-green-800">Operational</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Admin Info Card -->
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition text-center">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-red-500 to-orange-600 font-serif text-2xl text-white shadow-lg">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="mt-3 font-semibold text-gray-800">{{ auth()->user()->name }}</h3>
                <p class="text-sm text-gray-600">System Administrator</p>
                <div class="mt-4 space-y-2">
                    <a href="{{ route('admin.users.index') }}" class="block w-full px-4 py-2 bg-gradient-to-r from-red-600 to-orange-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold text-sm">
                        <i class="fas fa-users mr-2"></i>Manage Users
                    </a>
                    <a href="{{ route('admin.audit-logs.index') }}" class="block w-full px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold text-sm">
                        <i class="fas fa-history mr-2"></i>View Logs
                    </a>
                </div>
            </div>

            <!-- Pending Tasks -->
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-tasks text-blue-600 mr-2"></i>Pending Tasks
                </h3>
                <div class="space-y-3">
                    <div class="flex items-start gap-3 p-3 hover:bg-blue-50 rounded-lg transition border border-gray-100">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-blue-100">
                            <i class="fas fa-file-contract text-blue-600 text-xs"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900">{{ $pendingReports ?? 0 }} Draft Reports</p>
                            <p class="text-xs text-gray-500">Awaiting submission</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 p-3 hover:bg-orange-50 rounded-lg transition border border-gray-100">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-orange-100">
                            <i class="fas fa-flag text-orange-600 text-xs"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900">{{ $flaggedJobs }} Flagged Jobs</p>
                            <p class="text-xs text-gray-500">Require review</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
