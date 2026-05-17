@extends('layouts.admin')

@section('title', 'My Profile')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-4 md:mb-6">
        <div class="bg-gradient-to-br from-red-50 via-orange-50 to-yellow-50 rounded-2xl shadow-lg border border-red-100 p-6 md:p-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 md:gap-6">
                <div class="flex items-center gap-4 md:gap-6">
                    <!-- Profile Avatar -->
                    <div class="w-20 h-20 md:w-28 md:h-28 rounded-full bg-gradient-to-br from-red-400 to-orange-500 flex items-center justify-center text-white font-bold shadow-lg border-4 border-white flex-shrink-0">
                        @if(auth()->user()->profile_picture_url)
                            <img src="{{ auth()->user()->profile_picture_url }}" alt="{{ auth()->user()->name }}" class="w-full h-full rounded-full object-cover">
                        @else
                            <span class="text-2xl md:text-4xl">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                        @endif
                    </div>
                    
                    <!-- Profile Info -->
                    <div>
                        <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-red-600 via-orange-600 to-yellow-600 bg-clip-text text-transparent mb-1 md:mb-2">{{ auth()->user()->name }}</h1>
                        <p class="text-gray-600 text-sm md:text-base font-medium">System Administrator</p>
                        <p class="text-gray-500 text-xs md:text-sm mt-1">{{ auth()->user()->email }}</p>
                        <div class="flex gap-2 mt-3">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                <i class="fas fa-shield-alt mr-1"></i>Admin
                            </span>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>Active
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-col gap-2 w-full md:w-auto">
                    <a href="{{ route('admin.profile.edit') }}" class="px-4 py-2 bg-gradient-to-r from-red-600 to-orange-600 text-white rounded-lg hover:shadow-lg transition font-semibold text-sm text-center">
                        <i class="fas fa-edit mr-2"></i>Edit Profile
                    </a>
                    <button onclick="document.getElementById('changePasswordModal').classList.remove('hidden')" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:shadow-lg transition font-semibold text-sm text-center">
                        <i class="fas fa-key mr-2"></i>Change Password
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-3 mb-4 md:mb-6">
        <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-red-100 text-[8px] md:text-[10px] font-medium mb-0.5">Member Since</p>
                    <h3 class="text-base md:text-lg font-bold">{{ auth()->user()->created_at->format('M Y') }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-calendar text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-[8px] md:text-[10px] font-medium mb-0.5">Account Age</p>
                    <h3 class="text-base md:text-lg font-bold">{{ auth()->user()->created_at->diffInDays(now()) }} days</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-hourglass-end text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-100 text-[8px] md:text-[10px] font-medium mb-0.5">Last Login</p>
                    <h3 class="text-base md:text-lg font-bold">{{ auth()->user()->last_login_at?->format('M d') ?? 'Today' }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-sign-in-alt text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-[8px] md:text-[10px] font-medium mb-0.5">Status</p>
                    <h3 class="text-base md:text-lg font-bold">Active</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-check-circle text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Details Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Account Information -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">
                <i class="fas fa-user text-red-600 mr-2"></i>Account Information
            </h3>
            <div class="space-y-4">
                <div>
                    <p class="text-xs text-gray-600 font-semibold uppercase">Full Name</p>
                    <p class="text-gray-900 font-semibold mt-1">{{ auth()->user()->name }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-600 font-semibold uppercase">Email Address</p>
                    <p class="text-gray-900 font-semibold mt-1">{{ auth()->user()->email }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-600 font-semibold uppercase">Phone Number</p>
                    <p class="text-gray-900 font-semibold mt-1">{{ auth()->user()->phone ?? 'Not provided' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-600 font-semibold uppercase">Role</p>
                    <p class="text-gray-900 font-semibold mt-1">System Administrator</p>
                </div>
            </div>
        </div>

        <!-- Account Status -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">
                <i class="fas fa-info-circle text-blue-600 mr-2"></i>Account Status
            </h3>
            <div class="space-y-4">
                <div>
                    <p class="text-xs text-gray-600 font-semibold uppercase">Status</p>
                    <div class="mt-1">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1"></i>Active
                        </span>
                    </div>
                </div>
                <div>
                    <p class="text-xs text-gray-600 font-semibold uppercase">Member Since</p>
                    <p class="text-gray-900 font-semibold mt-1">{{ auth()->user()->created_at->format('F d, Y') }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-600 font-semibold uppercase">Last Updated</p>
                    <p class="text-gray-900 font-semibold mt-1">{{ auth()->user()->updated_at->format('F d, Y \a\t h:i A') }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-600 font-semibold uppercase">User ID</p>
                    <p class="text-gray-900 font-mono text-sm mt-1">#{{ auth()->user()->id }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity & Permissions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Admin Permissions -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">
                <i class="fas fa-lock text-purple-600 mr-2"></i>Admin Permissions
            </h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg border border-purple-200">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-users text-purple-600"></i>
                        <span class="text-sm font-semibold text-gray-700">User Management</span>
                    </div>
                    <i class="fas fa-check-circle text-green-600"></i>
                </div>
                <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg border border-purple-200">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-file-contract text-purple-600"></i>
                        <span class="text-sm font-semibold text-gray-700">Reports Management</span>
                    </div>
                    <i class="fas fa-check-circle text-green-600"></i>
                </div>
                <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg border border-purple-200">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-history text-purple-600"></i>
                        <span class="text-sm font-semibold text-gray-700">Audit Logs Access</span>
                    </div>
                    <i class="fas fa-check-circle text-green-600"></i>
                </div>
                <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg border border-purple-200">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-cog text-purple-600"></i>
                        <span class="text-sm font-semibold text-gray-700">System Settings</span>
                    </div>
                    <i class="fas fa-check-circle text-green-600"></i>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">
                <i class="fas fa-clock text-orange-600 mr-2"></i>Recent Activity
            </h3>
            <div class="space-y-3">
                <div class="p-3 border-l-4 border-orange-500 bg-orange-50 rounded">
                    <p class="text-sm font-semibold text-gray-900">Logged in</p>
                    <p class="text-xs text-gray-600 mt-1">{{ now()->format('F d, Y \a\t h:i A') }}</p>
                </div>
                <div class="p-3 border-l-4 border-blue-500 bg-blue-50 rounded">
                    <p class="text-sm font-semibold text-gray-900">Viewed Dashboard</p>
                    <p class="text-xs text-gray-600 mt-1">{{ now()->subHours(2)->format('F d, Y \a\t h:i A') }}</p>
                </div>
                <div class="p-3 border-l-4 border-green-500 bg-green-50 rounded">
                    <p class="text-sm font-semibold text-gray-900">Managed Users</p>
                    <p class="text-xs text-gray-600 mt-1">{{ now()->subHours(4)->format('F d, Y \a\t h:i A') }}</p>
                </div>
                <div class="p-3 border-l-4 border-purple-500 bg-purple-50 rounded">
                    <p class="text-sm font-semibold text-gray-900">Generated Report</p>
                    <p class="text-xs text-gray-600 mt-1">{{ now()->subDays(1)->format('F d, Y \a\t h:i A') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div id="changePasswordModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Change Password</h3>
        <form method="post" action="{{ route('admin.profile.password') }}" class="space-y-4">
            @csrf
            @method('put')
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Current Password</label>
                <input type="password" name="current_password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            
            <div class="flex gap-3 justify-end pt-4">
                <button type="button" onclick="document.getElementById('changePasswordModal').classList.add('hidden')" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">Update Password</button>
            </div>
        </form>
    </div>
</div>
@endsection
