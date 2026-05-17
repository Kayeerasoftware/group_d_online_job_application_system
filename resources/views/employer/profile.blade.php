@extends('layouts.employer')

@section('title', 'Company Profile')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
            <div class="flex items-center gap-2 md:gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-teal-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-emerald-600 to-teal-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                        <i class="fas fa-building text-white text-xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 bg-clip-text text-transparent mb-1 md:mb-2">Company Profile</h1>
                    <p class="text-gray-600 text-xs md:text-sm font-medium">Manage your professional information</p>
                </div>
            </div>
            <a href="{{ route('employer.profile.edit') }}" class="px-3 md:px-5 py-2 md:py-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-lg md:rounded-xl hover:shadow-lg transition-all duration-300 text-xs md:text-sm font-bold flex items-center justify-center gap-1 md:gap-2 transform hover:scale-105">
                <i class="fas fa-edit"></i><span class="hidden sm:inline">Edit Profile</span>
            </a>
        </div>
    </div>

    <!-- Profile Header Card -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 mb-6">
        <div class="h-32 bg-gradient-to-r from-emerald-500 to-teal-500"></div>
        <div class="px-6 pb-6">
            <div class="flex flex-col md:flex-row items-start md:items-end gap-4 -mt-16 mb-6">
                <div class="w-32 h-32 rounded-xl overflow-hidden bg-white shadow-lg border-4 border-white flex-shrink-0">
                    @if($profile && $profile->company_logo)
                        <img src="{{ asset($profile->company_logo) }}" alt="{{ $profile->company_name ?? 'Company Logo' }}" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="w-full h-full bg-gradient-to-br from-emerald-400 to-teal-600 flex items-center justify-center hidden">
                            <i class="fas fa-building text-white text-5xl"></i>
                        </div>
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-emerald-400 to-teal-600 flex items-center justify-center">
                            <i class="fas fa-building text-white text-5xl"></i>
                        </div>
                    @endif
                </div>
                <div class="flex-1">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900">{{ $profile?->company_name ?? 'Company Name' }}</h2>
                    <p class="text-lg text-gray-600 mt-1">{{ $profile?->industry ?? 'Industry not set' }}</p>
                    <p class="text-sm text-gray-500 mt-1">
                        @if($profile?->verified_by_admin)
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-medium">
                                <i class="fas fa-check-circle"></i>Verified
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-medium">
                                <i class="fas fa-clock"></i>Pending Verification
                            </span>
                        @endif
                    </p>
                </div>
            </div>

            <!-- Profile Completion -->
            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl p-4 border border-emerald-200">
                <div class="flex items-center justify-between mb-2">
                    <span class="font-semibold text-gray-900">Profile Completion</span>
                    <span class="text-lg font-bold text-emerald-600">{{ $profileCompletion }}%</span>
                </div>
                <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-emerald-600 to-teal-600 transition-all duration-500" style="width: {{ $profileCompletion }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Sections Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Contact Information -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-envelope text-emerald-600 mr-2"></i>Contact Information
                </h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Email</p>
                        <p class="text-gray-900 mt-1">{{ auth()->user()->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Phone</p>
                        <p class="text-gray-900 mt-1">{{ auth()->user()->phone ?? 'Not provided' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Website</p>
                        @if($profile?->company_website)
                            <a href="{{ $profile->company_website }}" target="_blank" class="text-emerald-600 hover:text-emerald-700 mt-1 inline-flex items-center gap-1">
                                {{ $profile->company_website }}
                                <i class="fas fa-external-link-alt text-xs"></i>
                            </a>
                        @else
                            <p class="text-gray-900 mt-1">Not provided</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Company Information -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-emerald-600 mr-2"></i>Company Information
                </h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Company Name</p>
                        <p class="text-gray-900 mt-1">{{ $profile?->company_name ?? 'Not provided' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Industry</p>
                        <p class="text-gray-900 mt-1">{{ $profile?->industry ?? 'Not provided' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Tax ID / Registration Number</p>
                        <p class="text-gray-900 mt-1">{{ $profile?->tax_id ?? 'Not provided' }}</p>
                    </div>
                </div>
            </div>

            <!-- Company Description -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-align-left text-emerald-600 mr-2"></i>About Company
                </h3>
                <p class="text-gray-900 leading-relaxed">
                    {{ $profile?->company_description ?? 'No description provided' }}
                </p>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Company Logo Preview -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-image text-emerald-600 mr-2"></i>Company Logo
                </h3>
                <div class="w-full rounded-lg bg-gradient-to-br from-emerald-400 to-teal-600 flex items-center justify-center overflow-hidden shadow-lg ring-4 ring-emerald-100 aspect-square">
                    @if($profile && $profile->company_logo)
                        <img src="{{ asset($profile->company_logo) }}" alt="Logo" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="w-full h-full bg-gradient-to-br from-emerald-400 to-teal-600 flex items-center justify-center hidden">
                            <i class="fas fa-building text-white text-6xl"></i>
                        </div>
                    @else
                        <i class="fas fa-building text-white text-6xl"></i>
                    @endif
                </div>
                <p class="text-xs text-gray-600 text-center mt-3">This logo will appear on your profile and in search results</p>
            </div>

            <!-- Account Status -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-shield-alt text-emerald-600 mr-2"></i>Account Status
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Status</span>
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                            <i class="fas fa-check-circle"></i>Active
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Member Since</span>
                        <span class="text-sm font-medium text-gray-900">{{ auth()->user()->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Last Updated</span>
                        <span class="text-sm font-medium text-gray-900">{{ auth()->user()->updated_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Verification</span>
                        @if($profile?->verified_by_admin)
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs font-medium">
                                <i class="fas fa-check-circle"></i>Verified
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">
                                <i class="fas fa-hourglass-half"></i>Pending
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-chart-bar text-emerald-600 mr-2"></i>Quick Stats
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                        <span class="text-sm text-gray-600">Active Jobs</span>
                        <span class="text-lg font-bold text-blue-600">{{ $activeJobs }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                        <span class="text-sm text-gray-600">Applications</span>
                        <span class="text-lg font-bold text-green-600">{{ $totalApplications }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                        <span class="text-sm text-gray-600">Shortlisted</span>
                        <span class="text-lg font-bold text-purple-600">{{ $shortlistedCount }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                        <span class="text-sm text-gray-600">Rejected</span>
                        <span class="text-lg font-bold text-red-600">{{ $rejectedCount }}</span>
                    </div>
                </div>
            </div>

            <!-- Application Status -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-tasks text-emerald-600 mr-2"></i>Application Status
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                            <span class="text-sm text-gray-600">Pending</span>
                        </div>
                        <span class="text-lg font-bold text-yellow-600">{{ $pendingCount }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-emerald-50 rounded-lg">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                            <span class="text-sm text-gray-600">Shortlisted</span>
                        </div>
                        <span class="text-lg font-bold text-emerald-600">{{ $shortlistedCount }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                            <span class="text-sm text-gray-600">Rejected</span>
                        </div>
                        <span class="text-lg font-bold text-red-600">{{ $rejectedCount }}</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-cog text-emerald-600 mr-2"></i>Actions
                </h3>
                <div class="space-y-2">
                    <a href="{{ route('employer.profile.edit') }}" class="block w-full px-4 py-2 text-center bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold text-sm">
                        <i class="fas fa-edit mr-1"></i>Edit Profile
                    </a>
                    <a href="{{ route('employer.dashboard') }}" class="block w-full px-4 py-2 text-center bg-white text-emerald-600 border border-emerald-200 rounded-lg hover:bg-emerald-50 transition-all duration-300 font-semibold text-sm">
                        <i class="fas fa-home mr-1"></i>Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
