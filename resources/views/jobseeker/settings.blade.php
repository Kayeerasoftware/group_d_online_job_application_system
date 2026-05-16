@extends('layouts.jobseeker')

@section('title', 'Settings')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-gray-700 to-gray-900 rounded-lg shadow-lg p-6">
        <div>
            <h1 class="text-3xl font-bold text-white mb-2">Settings</h1>
            <p class="text-gray-300">Manage your account preferences and security</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Settings Menu -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-lg p-4 sticky top-24">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Settings</h3>
                <nav class="space-y-2">
                    <button onclick="showSection('account')" class="w-full text-left px-4 py-2 rounded-lg bg-blue-50 text-blue-600 font-semibold transition" id="btn-account">
                        <i class="fas fa-user mr-2"></i>Account
                    </button>
                    <button onclick="showSection('security')" class="w-full text-left px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100 font-semibold transition" id="btn-security">
                        <i class="fas fa-lock mr-2"></i>Security
                    </button>
                    <button onclick="showSection('notifications')" class="w-full text-left px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100 font-semibold transition" id="btn-notifications">
                        <i class="fas fa-bell mr-2"></i>Notifications
                    </button>
                    <button onclick="showSection('privacy')" class="w-full text-left px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100 font-semibold transition" id="btn-privacy">
                        <i class="fas fa-shield-alt mr-2"></i>Privacy
                    </button>
                </nav>
            </div>
        </div>

        <!-- Settings Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Account Settings -->
            <div id="section-account" class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-user text-blue-600 mr-2"></i>Account Settings
                </h2>
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                        <input type="text" value="{{ auth()->user()->name }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                        <input type="email" value="{{ auth()->user()->email }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" value="{{ auth()->user()->phone ?? '' }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                    </div>
                    <div class="pt-4">
                        <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>

            <!-- Security Settings -->
            <div id="section-security" class="bg-white rounded-xl shadow-lg p-6 hidden">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-lock text-green-600 mr-2"></i>Security Settings
                </h2>
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Current Password</label>
                        <input type="password" placeholder="Enter your current password" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
                        <input type="password" placeholder="Enter new password" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                        <input type="password" placeholder="Confirm new password" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none transition">
                    </div>
                    <div class="pt-4">
                        <button type="submit" class="px-6 py-2.5 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition">
                            Update Password
                        </button>
                    </div>
                </form>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Two-Factor Authentication</h3>
                    <p class="text-gray-600 mb-4">Add an extra layer of security to your account</p>
                    <button class="px-6 py-2.5 border border-green-600 text-green-600 rounded-lg font-semibold hover:bg-green-50 transition">
                        <i class="fas fa-shield-alt mr-2"></i>Enable 2FA
                    </button>
                </div>
            </div>

            <!-- Notification Settings -->
            <div id="section-notifications" class="bg-white rounded-xl shadow-lg p-6 hidden">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-bell text-orange-600 mr-2"></i>Notification Preferences
                </h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-semibold text-gray-900">Job Recommendations</p>
                            <p class="text-sm text-gray-600">Get notified about jobs matching your profile</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-600"></div>
                        </label>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-semibold text-gray-900">Application Updates</p>
                            <p class="text-sm text-gray-600">Get notified when your applications are reviewed</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-600"></div>
                        </label>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-semibold text-gray-900">Interview Invitations</p>
                            <p class="text-sm text-gray-600">Get notified about interview invitations</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-600"></div>
                        </label>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-semibold text-gray-900">Messages from Employers</p>
                            <p class="text-sm text-gray-600">Get notified when employers send you messages</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-600"></div>
                        </label>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-semibold text-gray-900">Weekly Digest</p>
                            <p class="text-sm text-gray-600">Receive a weekly summary of opportunities</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-600"></div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Privacy Settings -->
            <div id="section-privacy" class="bg-white rounded-xl shadow-lg p-6 hidden">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-shield-alt text-purple-600 mr-2"></i>Privacy Settings
                </h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-semibold text-gray-900">Profile Visibility</p>
                            <p class="text-sm text-gray-600">Allow employers to view your profile</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
                        </label>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-semibold text-gray-900">Show Contact Information</p>
                            <p class="text-sm text-gray-600">Display your phone and email on your profile</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
                        </label>
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Danger Zone</h3>
                        <button class="px-6 py-2.5 border border-red-600 text-red-600 rounded-lg font-semibold hover:bg-red-50 transition">
                            <i class="fas fa-trash-alt mr-2"></i>Delete Account
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showSection(section) {
    // Hide all sections
    document.querySelectorAll('[id^="section-"]').forEach(el => {
        el.classList.add('hidden');
    });
    
    // Remove active state from all buttons
    document.querySelectorAll('[id^="btn-"]').forEach(btn => {
        btn.classList.remove('bg-blue-50', 'text-blue-600');
        btn.classList.add('text-gray-700', 'hover:bg-gray-100');
    });
    
    // Show selected section
    document.getElementById('section-' + section).classList.remove('hidden');
    
    // Add active state to button
    document.getElementById('btn-' + section).classList.remove('text-gray-700', 'hover:bg-gray-100');
    document.getElementById('btn-' + section).classList.add('bg-blue-50', 'text-blue-600');
}
</script>
@endsection
