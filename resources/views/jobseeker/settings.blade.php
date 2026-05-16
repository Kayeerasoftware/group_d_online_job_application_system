@extends('layouts.jobseeker')

@section('title', 'Settings')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-gray-700 to-gray-900 rounded-lg shadow-lg p-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Settings</h1>
                <p class="text-gray-300">Manage your account and preferences</p>
            </div>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-6">
        <div class="h-full bg-gradient-to-r from-gray-500 to-gray-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-gray-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Settings...</span>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-3 mb-6">
        <!-- Account Status -->
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-gray-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-gray-500 to-gray-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-user-check text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Status</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">Active</h3>
                </div>
            </div>
        </div>

        <!-- Notifications -->
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-blue-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-bell text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Notifications</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">Enabled</h3>
                </div>
            </div>
        </div>

        <!-- Privacy -->
        <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-green-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-green-500 to-green-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-lock text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Privacy</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">Public</h3>
                </div>
            </div>
        </div>

        <!-- Security -->
        <div class="bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-orange-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-shield-alt text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">2FA</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">Disabled</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Tabs -->
    <div class="bg-white rounded-xl shadow-lg p-4">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('seeker.settings') }}" class="px-4 py-2 rounded-lg font-semibold transition {{ !request('tab') || request('tab') === 'account' ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                <i class="fas fa-user-cog mr-2"></i>Account
            </a>
            <a href="{{ route('seeker.settings', ['tab' => 'notifications']) }}" class="px-4 py-2 rounded-lg font-semibold transition {{ request('tab') === 'notifications' ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                <i class="fas fa-bell mr-2"></i>Notifications
            </a>
            <a href="{{ route('seeker.settings', ['tab' => 'privacy']) }}" class="px-4 py-2 rounded-lg font-semibold transition {{ request('tab') === 'privacy' ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                <i class="fas fa-lock mr-2"></i>Privacy
            </a>
            <a href="{{ route('seeker.settings', ['tab' => 'security']) }}" class="px-4 py-2 rounded-lg font-semibold transition {{ request('tab') === 'security' ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                <i class="fas fa-shield-alt mr-2"></i>Security
            </a>
        </div>
    </div>

    <!-- Account Settings -->
    @if(!request('tab') || request('tab') === 'account')
    <div class="space-y-6">
        <!-- Change Email -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-envelope text-gray-700 mr-2"></i>Email Address
            </h2>
            <form action="#" method="POST" class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Current Email</label>
                    <input type="email" value="{{ auth()->user()->email }}" disabled class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-600">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">New Email</label>
                    <input type="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-800 focus:border-transparent outline-none transition">
                </div>
                <button type="submit" class="px-6 py-2 bg-gray-800 text-white rounded-lg font-semibold hover:bg-gray-900 transition">
                    Update Email
                </button>
            </form>
        </div>

        <!-- Change Password -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-key text-gray-700 mr-2"></i>Password
            </h2>
            <form action="#" method="POST" class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Current Password</label>
                    <input type="password" name="current_password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-800 focus:border-transparent outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
                    <input type="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-800 focus:border-transparent outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-800 focus:border-transparent outline-none transition">
                </div>
                <button type="submit" class="px-6 py-2 bg-gray-800 text-white rounded-lg font-semibold hover:bg-gray-900 transition">
                    Update Password
                </button>
            </form>
        </div>

        <!-- Delete Account -->
        <div class="bg-red-50 rounded-xl shadow-lg p-6 border border-red-200">
            <h2 class="text-lg font-bold text-red-900 mb-4 flex items-center">
                <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i>Danger Zone
            </h2>
            <p class="text-sm text-red-800 mb-4">Deleting your account is permanent and cannot be undone. All your data will be lost.</p>
            <button class="px-6 py-2 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition" title="Delete account feature coming soon">
                <i class="fas fa-trash mr-2"></i>Delete Account
            </button>
        </div>
    </div>
    @endif

    <!-- Notification Settings -->
    @if(request('tab') === 'notifications')
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
            <i class="fas fa-bell text-gray-700 mr-2"></i>Notification Preferences
        </h2>
        <form action="#" method="POST" class="space-y-4">
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-semibold text-gray-900">Application Updates</p>
                        <p class="text-sm text-gray-600">Get notified when your applications are reviewed</p>
                    </div>
                    <input type="checkbox" name="notify_application_updates" checked class="w-5 h-5 text-gray-800 rounded">
                </div>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-semibold text-gray-900">Interview Invitations</p>
                        <p class="text-sm text-gray-600">Get notified about interview invitations</p>
                    </div>
                    <input type="checkbox" name="notify_interviews" checked class="w-5 h-5 text-gray-800 rounded">
                </div>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-semibold text-gray-900">Job Recommendations</p>
                        <p class="text-sm text-gray-600">Get notified about jobs matching your profile</p>
                    </div>
                    <input type="checkbox" name="notify_job_recommendations" checked class="w-5 h-5 text-gray-800 rounded">
                </div>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-semibold text-gray-900">Messages</p>
                        <p class="text-sm text-gray-600">Get notified about new messages</p>
                    </div>
                    <input type="checkbox" name="notify_messages" checked class="w-5 h-5 text-gray-800 rounded">
                </div>
            </div>
            <button type="submit" class="px-6 py-2 bg-gray-800 text-white rounded-lg font-semibold hover:bg-gray-900 transition">
                Save Preferences
            </button>
        </form>
    </div>
    @endif

    <!-- Privacy Settings -->
    @if(request('tab') === 'privacy')
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
            <i class="fas fa-eye-slash text-gray-700 mr-2"></i>Privacy Settings
        </h2>
        <form action="#" method="POST" class="space-y-4">
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-semibold text-gray-900">Profile Visibility</p>
                        <p class="text-sm text-gray-600">Allow employers to view your profile</p>
                    </div>
                    <select name="profile_visibility" class="px-3 py-1 border border-gray-300 rounded-lg">
                        <option value="public">Public</option>
                        <option value="private">Private</option>
                    </select>
                </div>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-semibold text-gray-900">Show Profile in Search</p>
                        <p class="text-sm text-gray-600">Appear in employer searches</p>
                    </div>
                    <input type="checkbox" name="show_in_search" checked class="w-5 h-5 text-gray-800 rounded">
                </div>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-semibold text-gray-900">Allow Direct Messages</p>
                        <p class="text-sm text-gray-600">Employers can message you directly</p>
                    </div>
                    <input type="checkbox" name="allow_direct_messages" checked class="w-5 h-5 text-gray-800 rounded">
                </div>
            </div>
            <button type="submit" class="px-6 py-2 bg-gray-800 text-white rounded-lg font-semibold hover:bg-gray-900 transition">
                Save Privacy Settings
            </button>
        </form>
    </div>
    @endif

    <!-- Security Settings -->
    @if(request('tab') === 'security')
    <div class="space-y-6">
        <!-- Two-Factor Authentication -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-shield-alt text-gray-700 mr-2"></i>Two-Factor Authentication
            </h2>
            <p class="text-gray-600 mb-4">Add an extra layer of security to your account</p>
            <button class="px-6 py-2 bg-gray-800 text-white rounded-lg font-semibold hover:bg-gray-900 transition" title="2FA feature coming soon">
                Enable 2FA
            </button>
        </div>

        <!-- Active Sessions -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-laptop text-gray-700 mr-2"></i>Active Sessions
            </h2>
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div>
                    <p class="font-semibold text-gray-900">Current Session</p>
                    <p class="text-sm text-gray-600">This browser</p>
                </div>
                <span class="px-3 py-1 bg-green-100 text-green-700 rounded text-sm font-semibold">Current</span>
            </div>
        </div>
    </div>
    @endif
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
