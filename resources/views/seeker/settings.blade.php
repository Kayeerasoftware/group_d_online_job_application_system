@extends('layouts.jobseeker')

@section('title', 'Settings')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
            <div class="flex items-center gap-2 md:gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-gray-600 to-slate-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-gray-600 to-slate-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                        <i class="fas fa-cog text-white text-xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-gray-600 via-slate-600 to-gray-700 bg-clip-text text-transparent mb-1 md:mb-2">Settings</h1>
                    <p class="text-gray-600 text-xs md:text-sm font-medium">Manage your account preferences</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-green-500 to-green-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-green-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Settings...</span>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-3 mb-3 md:mb-4">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-[8px] md:text-[10px] font-medium mb-0.5">Active Sessions</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $activeSessions ?? 2 }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-laptop text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-[8px] md:text-[10px] font-medium mb-0.5">2FA Status</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $twoFAEnabled ? 'Enabled' : 'Disabled' }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-shield-alt text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-[8px] md:text-[10px] font-medium mb-0.5">Notifications</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $notificationsEnabled ? 'On' : 'Off' }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-bell text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-[8px] md:text-[10px] font-medium mb-0.5">Last Login</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $lastLogin ?? 'Today' }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-clock text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Sidebar Navigation -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-xl overflow-hidden border border-gray-100 sticky top-6">
                <nav class="space-y-1 p-4">
                    <a href="#security" class="block px-4 py-2 rounded-lg bg-blue-50 text-blue-600 font-semibold transition">
                        <i class="fas fa-lock mr-2"></i>Account Security
                    </a>
                    <a href="#notifications" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        <i class="fas fa-bell mr-2"></i>Notifications
                    </a>
                    <a href="#privacy" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        <i class="fas fa-eye mr-2"></i>Privacy
                    </a>
                    <a href="#appearance" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        <i class="fas fa-palette mr-2"></i>Appearance
                    </a>
                </nav>
            </div>
        </div>

        <!-- Settings Content -->
        <div class="lg:col-span-3 space-y-6">
            <!-- Account Security -->
            <div id="security" class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-lock text-blue-600 mr-3"></i>Account Security
                </h2>
                
                <div class="space-y-6">
                    <!-- Change Password -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Change Password</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Current Password</label>
                                <input type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
                                <input type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                                <input type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <button class="px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:shadow-lg transition font-semibold">
                                Update Password
                            </button>
                        </div>
                    </div>

                    <!-- Two-Factor Authentication -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Two-Factor Authentication</h3>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <p class="text-gray-700 font-medium">Add an extra layer of security to your account</p>
                                <p class="text-sm text-gray-500 mt-1">Requires a code from your phone when logging in</p>
                            </div>
                            <button class="px-6 py-2 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg hover:shadow-lg transition font-semibold whitespace-nowrap">
                                {{ $twoFAEnabled ? 'Disable' : 'Enable' }}
                            </button>
                        </div>
                    </div>

                    <!-- Active Sessions -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Active Sessions</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <div>
                                    <p class="font-semibold text-gray-900">Chrome on Windows</p>
                                    <p class="text-sm text-gray-500">Last active: 5 minutes ago</p>
                                </div>
                                <span class="text-xs bg-green-100 text-green-800 px-3 py-1 rounded-full font-semibold">Current</span>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <div>
                                    <p class="font-semibold text-gray-900">Safari on iPhone</p>
                                    <p class="text-sm text-gray-500">Last active: 2 hours ago</p>
                                </div>
                                <button class="text-red-600 hover:text-red-700 font-semibold text-sm transition">Sign Out</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notification Preferences -->
            <div id="notifications" class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-bell text-yellow-600 mr-3"></i>Notification Preferences
                </h2>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div>
                            <p class="font-semibold text-gray-900">Job Recommendations</p>
                            <p class="text-sm text-gray-600">Get notified about jobs matching your profile</p>
                        </div>
                        <input type="checkbox" checked class="w-5 h-5 text-blue-600 rounded cursor-pointer">
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div>
                            <p class="font-semibold text-gray-900">Application Updates</p>
                            <p class="text-sm text-gray-600">Receive updates on your applications</p>
                        </div>
                        <input type="checkbox" checked class="w-5 h-5 text-blue-600 rounded cursor-pointer">
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div>
                            <p class="font-semibold text-gray-900">Messages</p>
                            <p class="text-sm text-gray-600">Get notified when you receive new messages</p>
                        </div>
                        <input type="checkbox" checked class="w-5 h-5 text-blue-600 rounded cursor-pointer">
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div>
                            <p class="font-semibold text-gray-900">Interview Reminders</p>
                            <p class="text-sm text-gray-600">Get reminded about upcoming interviews</p>
                        </div>
                        <input type="checkbox" checked class="w-5 h-5 text-blue-600 rounded cursor-pointer">
                    </div>
                </div>
            </div>

            <!-- Privacy Settings -->
            <div id="privacy" class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-eye text-purple-600 mr-3"></i>Privacy Settings
                </h2>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div>
                            <p class="font-semibold text-gray-900">Profile Visibility</p>
                            <p class="text-sm text-gray-600">Allow employers to view your profile</p>
                        </div>
                        <input type="checkbox" checked class="w-5 h-5 text-blue-600 rounded cursor-pointer">
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div>
                            <p class="font-semibold text-gray-900">Show Email</p>
                            <p class="text-sm text-gray-600">Display your email on your profile</p>
                        </div>
                        <input type="checkbox" class="w-5 h-5 text-blue-600 rounded cursor-pointer">
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div>
                            <p class="font-semibold text-gray-900">Show Phone</p>
                            <p class="text-sm text-gray-600">Display your phone number on your profile</p>
                        </div>
                        <input type="checkbox" class="w-5 h-5 text-blue-600 rounded cursor-pointer">
                    </div>
                </div>
            </div>

            <!-- Appearance Settings -->
            <div id="appearance" class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-palette text-pink-600 mr-3"></i>Appearance
                </h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Theme</label>
                        <div class="flex gap-3">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="theme" value="light" checked class="w-4 h-4">
                                <span class="text-gray-700">Light</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="theme" value="dark" class="w-4 h-4">
                                <span class="text-gray-700">Dark</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="theme" value="auto" class="w-4 h-4">
                                <span class="text-gray-700">Auto</span>
                            </label>
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
