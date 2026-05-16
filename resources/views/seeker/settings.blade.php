@extends('layouts.jobseeker')

@section('title', 'Settings')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-gray-600 to-gray-800 rounded-lg shadow-lg p-6">
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Settings</h1>
        <p class="text-gray-200">Manage your account preferences</p>
    </div>

    <!-- Settings Tabs -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Sidebar Navigation -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <nav class="space-y-1 p-4">
                    <a href="#" class="block px-4 py-2 rounded-lg bg-blue-50 text-blue-600 font-semibold">
                        <i class="fas fa-lock mr-2\"></i>Account Security
                    </a>
                    <a href="#" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        <i class="fas fa-bell mr-2\"></i>Notifications
                    </a>
                    <a href="#" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        <i class="fas fa-eye mr-2\"></i>Privacy
                    </a>
                    <a href="#" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        <i class="fas fa-palette mr-2\"></i>Appearance
                    </a>
                </nav>
            </div>
        </div>

        <!-- Settings Content -->
        <div class="lg:col-span-3 space-y-6">
            <!-- Account Security -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-lock text-blue-600 mr-3\"></i>Account Security
                </h2>
                
                <div class="space-y-6">
                    <!-- Change Password -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Change Password</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Current Password</label>
                                <input type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
                                <input type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                                <input type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                            </div>
                            <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">
                                Update Password
                            </button>
                        </div>
                    </div>

                    <!-- Two-Factor Authentication -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Two-Factor Authentication</h3>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-700">Add an extra layer of security to your account</p>
                                <p class="text-sm text-gray-500 mt-1">Requires a code from your phone when logging in</p>
                            </div>
                            <button class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold">
                                Enable
                            </button>
                        </div>
                    </div>

                    <!-- Active Sessions -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Active Sessions</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="font-semibold text-gray-900">Chrome on Windows</p>
                                    <p class="text-sm text-gray-500">Last active: 5 minutes ago</p>
                                </div>
                                <span class="text-xs bg-green-100 text-green-800 px-3 py-1 rounded-full">Current</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="font-semibold text-gray-900">Safari on iPhone</p>
                                    <p class="text-sm text-gray-500">Last active: 2 hours ago</p>
                                </div>
                                <button class="text-red-600 hover:text-red-700 font-semibold text-sm">Sign Out</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notification Preferences -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-bell text-yellow-600 mr-3\"></i>Notification Preferences
                </h2>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-semibold text-gray-900">Job Recommendations</p>
                            <p class="text-sm text-gray-600">Get notified about jobs matching your profile</p>
                        </div>
                        <input type="checkbox" checked class="w-5 h-5 text-blue-600 rounded">
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-semibold text-gray-900">Application Updates</p>
                            <p class="text-sm text-gray-600">Receive updates on your applications</p>
                        </div>
                        <input type="checkbox" checked class="w-5 h-5 text-blue-600 rounded">
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-semibold text-gray-900">Messages</p>
                            <p class="text-sm text-gray-600">Get notified when you receive new messages</p>
                        </div>
                        <input type="checkbox" checked class="w-5 h-5 text-blue-600 rounded">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
