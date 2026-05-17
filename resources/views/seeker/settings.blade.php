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
                    <p class="text-gray-600 text-xs md:text-sm font-medium">Manage your account preferences and security</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Messages -->
    @if (session('status'))
    <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700">
        <i class="fas fa-check-circle mr-2"></i>{{ session('status') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg text-red-700">
        <i class="fas fa-exclamation-circle mr-2"></i>
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-green-500 to-green-600 rounded-full animate-slide-right"></div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-3 mb-3 md:mb-4">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-[8px] md:text-[10px] font-medium mb-0.5">Active Sessions</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $activeSessions }}</h3>
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
                    <h3 class="text-base md:text-xl font-bold">{{ $user->two_factor_enabled ? 'Enabled' : 'Disabled' }}</h3>
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
                    <h3 class="text-base md:text-xl font-bold">{{ $user->notifications_enabled ? 'On' : 'Off' }}</h3>
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
                    <h3 class="text-base md:text-xl font-bold text-xs">{{ $lastLogin }}</h3>
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
                        <form action="{{ route('seeker.settings.password') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Current Password</label>
                                <input type="password" name="current_password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('current_password') border-red-500 @enderror" required>
                                @error('current_password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
                                <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-500 @enderror" required>
                                @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            </div>
                            <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:shadow-lg transition font-semibold">
                                Update Password
                            </button>
                        </form>
                    </div>

                    <!-- Two-Factor Authentication -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Two-Factor Authentication</h3>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <p class="text-gray-700 font-medium">Add an extra layer of security to your account</p>
                                <p class="text-sm text-gray-500 mt-1">Requires a code from your phone when logging in</p>
                            </div>
                            <form action="{{ $user->two_factor_enabled ? route('seeker.settings.two-factor.disable') : route('seeker.settings.two-factor.enable') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg hover:shadow-lg transition font-semibold whitespace-nowrap">
                                    {{ $user->two_factor_enabled ? 'Disable' : 'Enable' }}
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Active Sessions -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Active Sessions</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <div>
                                    <p class="font-semibold text-gray-900">Current Session</p>
                                    <p class="text-sm text-gray-500">{{ request()->header('User-Agent') ? 'Browser Session' : 'Active' }}</p>
                                </div>
                                <span class="text-xs bg-green-100 text-green-800 px-3 py-1 rounded-full font-semibold">Active</span>
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
                
                <form action="{{ route('seeker.settings.notifications') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div>
                            <p class="font-semibold text-gray-900">Job Recommendations</p>
                            <p class="text-sm text-gray-600">Get notified about jobs matching your profile</p>
                        </div>
                        <input type="checkbox" name="job_recommendations" value="1" {{ $user->job_recommendations ? 'checked' : '' }} class="w-5 h-5 text-blue-600 rounded cursor-pointer">
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div>
                            <p class="font-semibold text-gray-900">Application Updates</p>
                            <p class="text-sm text-gray-600">Receive updates on your applications</p>
                        </div>
                        <input type="checkbox" name="application_updates" value="1" {{ $user->application_updates ? 'checked' : '' }} class="w-5 h-5 text-blue-600 rounded cursor-pointer">
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div>
                            <p class="font-semibold text-gray-900">Messages</p>
                            <p class="text-sm text-gray-600">Get notified when you receive new messages</p>
                        </div>
                        <input type="checkbox" name="message_notifications" value="1" {{ $user->message_notifications ? 'checked' : '' }} class="w-5 h-5 text-blue-600 rounded cursor-pointer">
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div>
                            <p class="font-semibold text-gray-900">Interview Reminders</p>
                            <p class="text-sm text-gray-600">Get reminded about upcoming interviews</p>
                        </div>
                        <input type="checkbox" name="interview_reminders" value="1" {{ $user->interview_reminders ? 'checked' : '' }} class="w-5 h-5 text-blue-600 rounded cursor-pointer">
                    </div>
                    <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:shadow-lg transition font-semibold">
                        Save Preferences
                    </button>
                </form>
            </div>

            <!-- Privacy Settings -->
            <div id="privacy" class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-eye text-purple-600 mr-3"></i>Privacy Settings
                </h2>
                
                <form action="{{ route('seeker.settings.privacy') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div>
                            <p class="font-semibold text-gray-900">Profile Visibility</p>
                            <p class="text-sm text-gray-600">Allow employers to view your profile</p>
                        </div>
                        <input type="checkbox" name="profile_visible" value="1" {{ $user->profile_visible ? 'checked' : '' }} class="w-5 h-5 text-blue-600 rounded cursor-pointer">
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div>
                            <p class="font-semibold text-gray-900">Show Email</p>
                            <p class="text-sm text-gray-600">Display your email on your profile</p>
                        </div>
                        <input type="checkbox" name="show_email" value="1" {{ $user->show_email ? 'checked' : '' }} class="w-5 h-5 text-blue-600 rounded cursor-pointer">
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div>
                            <p class="font-semibold text-gray-900">Show Phone</p>
                            <p class="text-sm text-gray-600">Display your phone number on your profile</p>
                        </div>
                        <input type="checkbox" name="show_phone" value="1" {{ $user->show_phone ? 'checked' : '' }} class="w-5 h-5 text-blue-600 rounded cursor-pointer">
                    </div>
                    <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:shadow-lg transition font-semibold">
                        Save Settings
                    </button>
                </form>
            </div>

            <!-- Appearance Settings -->
            <div id="appearance" class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-palette text-pink-600 mr-3"></i>Appearance
                </h2>
                
                <form action="{{ route('seeker.settings.appearance') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Theme</label>
                        <div class="flex gap-3">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="theme" value="light" {{ $user->theme === 'light' ? 'checked' : '' }} class="w-4 h-4">
                                <span class="text-gray-700">Light</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="theme" value="dark" {{ $user->theme === 'dark' ? 'checked' : '' }} class="w-4 h-4">
                                <span class="text-gray-700">Dark</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="theme" value="auto" {{ $user->theme === 'auto' ? 'checked' : '' }} class="w-4 h-4">
                                <span class="text-gray-700">Auto</span>
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:shadow-lg transition font-semibold">
                        Save Appearance
                    </button>
                </form>
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
</style>
@endsection
