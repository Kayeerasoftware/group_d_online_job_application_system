@extends('layouts.employer')

@section('title', 'Settings')

@section('content')
<div class="bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-gray-600 to-gray-700 rounded-lg shadow-lg p-3 md:p-4 mb-4 md:mb-6">
        <div class="flex items-center justify-between gap-2">
            <div class="flex items-center gap-3 flex-1 min-w-0">
                <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl overflow-hidden bg-white shadow-lg flex-shrink-0 flex items-center justify-center">
                    <i class="fas fa-cog text-gray-600 text-2xl"></i>
                </div>
                <div class="min-w-0">
                    <h1 class="text-sm sm:text-lg md:text-2xl font-bold text-white truncate">Settings</h1>
                    <p class="text-gray-100 text-xs sm:text-sm mt-0.5 md:mt-1">Manage your account and preferences</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-gray-500 to-gray-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-gray-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Settings...</span>
    </div>

    <!-- Settings Navigation -->
    <div class="grid gap-6 lg:grid-cols-4">
        <!-- Sidebar Navigation -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md overflow-hidden sticky top-20">
                <nav class="divide-y divide-gray-200">
                    <a href="#account" class="sidebar-link block px-4 py-3 hover:bg-gray-50 transition font-semibold text-sm text-gray-900 border-l-4 border-gray-600 bg-gray-50 active-link" data-section="account">
                        <i class="fas fa-user mr-2"></i>Account
                    </a>
                    <a href="#notifications" class="sidebar-link block px-4 py-3 hover:bg-gray-50 transition font-semibold text-sm text-gray-600 border-l-4 border-transparent" data-section="notifications">
                        <i class="fas fa-bell mr-2"></i>Notifications
                    </a>
                    <a href="#privacy" class="sidebar-link block px-4 py-3 hover:bg-gray-50 transition font-semibold text-sm text-gray-600 border-l-4 border-transparent" data-section="privacy">
                        <i class="fas fa-lock mr-2"></i>Privacy
                    </a>
                    <a href="#billing" class="sidebar-link block px-4 py-3 hover:bg-gray-50 transition font-semibold text-sm text-gray-600 border-l-4 border-transparent" data-section="billing">
                        <i class="fas fa-credit-card mr-2"></i>Billing
                    </a>
                    <a href="#integrations" class="sidebar-link block px-4 py-3 hover:bg-gray-50 transition font-semibold text-sm text-gray-600 border-l-4 border-transparent" data-section="integrations">
                        <i class="fas fa-plug mr-2"></i>Integrations
                    </a>
                </nav>
            </div>
        </div>

        <!-- Settings Content -->
        <div class="lg:col-span-3 space-y-6">
            <!-- Account Settings -->
            <div id="account" class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-user text-gray-600 mr-3"></i>Account Settings
                </h2>

                <form class="space-y-6">
                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" value="{{ auth()->user()->email }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent" readonly>
                        <p class="text-xs text-gray-500 mt-1">Your email address is used for login and notifications</p>
                    </div>

                    <!-- Company Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                        <input type="text" value="{{ auth()->user()->employerProfile->company_name ?? '' }}" placeholder="Enter company name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" value="{{ auth()->user()->phone }}" placeholder="Enter phone number" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                    </div>

                    <!-- Location -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" value="{{ auth()->user()->employerProfile->location ?? '' }}" placeholder="Enter location" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                    </div>

                    <!-- Change Password -->
                    <div class="pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Change Password</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                                <input type="password" placeholder="Enter current password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                                <input type="password" placeholder="Enter new password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                                <input type="password" placeholder="Confirm new password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Save Button -->
                    <div class="flex gap-2 pt-6 border-t border-gray-200">
                        <button type="submit" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition font-semibold">
                            <i class="fas fa-save mr-2"></i>Save Changes
                        </button>
                        <button type="button" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>

            <!-- Notification Settings -->
            <div id="notifications" class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-bell text-orange-600 mr-3"></i>Notification Preferences
                </h2>

                <div class="space-y-4">
                    <!-- Email Notifications -->
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                        <div>
                            <p class="font-semibold text-gray-900">Email Notifications</p>
                            <p class="text-sm text-gray-600">Receive updates via email</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-gray-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-600"></div>
                        </label>
                    </div>

                    <!-- Application Notifications -->
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                        <div>
                            <p class="font-semibold text-gray-900">New Applications</p>
                            <p class="text-sm text-gray-600">Get notified when candidates apply</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-gray-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-600"></div>
                        </label>
                    </div>

                    <!-- Interview Reminders -->
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                        <div>
                            <p class="font-semibold text-gray-900">Interview Reminders</p>
                            <p class="text-sm text-gray-600">Remind me about upcoming interviews</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-gray-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-600"></div>
                        </label>
                    </div>

                    <!-- Messages -->
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                        <div>
                            <p class="font-semibold text-gray-900">Message Notifications</p>
                            <p class="text-sm text-gray-600">Get notified about new messages</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-gray-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-600"></div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Privacy Settings -->
            <div id="privacy" class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-lock text-blue-600 mr-3"></i>Privacy & Security
                </h2>

                <div class="space-y-4">
                    <!-- Profile Visibility -->
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                        <div>
                            <p class="font-semibold text-gray-900">Public Profile</p>
                            <p class="text-sm text-gray-600">Allow job seekers to view your profile</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-gray-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-600"></div>
                        </label>
                    </div>

                    <!-- Two-Factor Authentication -->
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                        <div>
                            <p class="font-semibold text-gray-900">Two-Factor Authentication</p>
                            <p class="text-sm text-gray-600">Add an extra layer of security</p>
                        </div>
                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold text-sm">
                            Enable
                        </button>
                    </div>

                    <!-- Active Sessions -->
                    <div class="p-4 border border-gray-200 rounded-lg">
                        <p class="font-semibold text-gray-900 mb-3">Active Sessions</p>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-900">Chrome on Windows</p>
                                    <p class="text-xs text-gray-500">Last active: 2 hours ago</p>
                                </div>
                                <button class="text-red-600 hover:text-red-700 text-sm font-semibold">
                                    Sign Out
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="bg-red-50 rounded-xl shadow-md p-6 border border-red-200">
                <h2 class="text-2xl font-bold text-red-900 mb-6 flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-600 mr-3"></i>Danger Zone
                </h2>

                <div class="space-y-4">
                    <button class="w-full px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">
                        <i class="fas fa-trash mr-2"></i>Delete Account
                    </button>
                    <p class="text-sm text-red-700">
                        <i class="fas fa-info-circle mr-2"></i>
                        Deleting your account is permanent and cannot be undone. All your data will be lost.
                    </p>
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

/* Sidebar Active State */
.sidebar-link {
    cursor: pointer;
    transition: all 0.3s ease;
}

.sidebar-link.active-link {
    background-color: #f0fdf4;
    color: #16a34a;
    border-left-color: #16a34a;
    font-weight: 700;
}

.sidebar-link.active-link i {
    color: #16a34a;
}

.sidebar-link:not(.active-link) {
    border-left-color: transparent;
    color: #4b5563;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebarLinks = document.querySelectorAll('.sidebar-link');
    
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all links
            sidebarLinks.forEach(l => l.classList.remove('active-link'));
            
            // Add active class to clicked link
            this.classList.add('active-link');
            
            // Smooth scroll to section
            const sectionId = this.getAttribute('href').substring(1);
            const section = document.getElementById(sectionId);
            if (section) {
                section.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
});
</script>
@endsection
