@extends('layouts.jobseeker')

@section('title', 'Notifications')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-orange-600 to-red-600 rounded-lg shadow-lg p-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Notifications</h1>
                <p class="text-orange-100">Stay updated with your job search</p>
            </div>
            <button class="px-6 py-3 bg-white text-orange-600 rounded-lg font-semibold hover:bg-orange-50 transition">
                <i class="fas fa-check-double mr-2"></i>Mark All as Read
            </button>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="bg-white rounded-xl shadow-lg p-4">
        <div class="flex flex-wrap gap-2">
            <button class="px-4 py-2 bg-orange-600 text-white rounded-lg font-semibold">All</button>
            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition">Applications</button>
            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition">Interviews</button>
            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition">Messages</button>
            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition">System</button>
        </div>
    </div>

    <!-- Notifications List -->
    <div class="space-y-4">
        <!-- Unread Notification -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-600 hover:shadow-xl transition">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-check-circle text-white text-lg"></i>
                </div>
                <div class="flex-1">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">You've been shortlisted!</h3>
                            <p class="text-gray-600 mt-1">Congratulations! Tech Innovations Inc. has shortlisted your application for the Senior React Developer position.</p>
                            <p class="text-sm text-gray-500 mt-3">
                                <i class="fas fa-clock mr-2"></i>2 hours ago
                            </p>
                        </div>
                        <span class="w-3 h-3 rounded-full bg-orange-600 flex-shrink-0 mt-1"></span>
                    </div>
                    <div class="mt-4 flex gap-2">
                        <button class="px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition text-sm">
                            <i class="fas fa-eye mr-2"></i>View Details
                        </button>
                        <button class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition text-sm">
                            <i class="fas fa-check mr-2"></i>Mark as Read
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Unread Notification -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-600 hover:shadow-xl transition">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-calendar-check text-white text-lg"></i>
                </div>
                <div class="flex-1">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Interview Scheduled</h3>
                            <p class="text-gray-600 mt-1">Your interview with Digital Innovations Ltd. has been scheduled for December 30, 2024 at 10:00 AM EST.</p>
                            <p class="text-sm text-gray-500 mt-3">
                                <i class="fas fa-clock mr-2"></i>5 hours ago
                            </p>
                        </div>
                        <span class="w-3 h-3 rounded-full bg-orange-600 flex-shrink-0 mt-1"></span>
                    </div>
                    <div class="mt-4 flex gap-2">
                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition text-sm">
                            <i class="fas fa-calendar mr-2"></i>Add to Calendar
                        </button>
                        <button class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition text-sm">
                            <i class="fas fa-check mr-2"></i>Mark as Read
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Unread Notification -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-600 hover:shadow-xl transition">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-envelope text-white text-lg"></i>
                </div>
                <div class="flex-1">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">New Message from Recruiter</h3>
                            <p class="text-gray-600 mt-1">Sarah Johnson from Tech Innovations Inc. sent you a message about your application.</p>
                            <p class="text-sm text-gray-500 mt-3">
                                <i class="fas fa-clock mr-2"></i>1 day ago
                            </p>
                        </div>
                        <span class="w-3 h-3 rounded-full bg-orange-600 flex-shrink-0 mt-1"></span>
                    </div>
                    <div class="mt-4 flex gap-2">
                        <button class="px-4 py-2 bg-purple-600 text-white rounded-lg font-semibold hover:bg-purple-700 transition text-sm">
                            <i class="fas fa-reply mr-2"></i>Reply
                        </button>
                        <button class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition text-sm">
                            <i class="fas fa-check mr-2"></i>Mark as Read
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Read Notification -->
        <div class="bg-gray-50 rounded-xl shadow-lg p-6 border-l-4 border-gray-300 hover:shadow-xl transition opacity-75">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-gray-400 to-gray-600 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-info-circle text-white text-lg"></i>
                </div>
                <div class="flex-1">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Profile Completion Reminder</h3>
                            <p class="text-gray-600 mt-1">Complete your profile to increase your chances of getting hired. You're 85% done!</p>
                            <p class="text-sm text-gray-500 mt-3">
                                <i class="fas fa-clock mr-2"></i>2 days ago
                            </p>
                        </div>
                    </div>
                    <div class="mt-4 flex gap-2">
                        <button class="px-4 py-2 bg-gray-600 text-white rounded-lg font-semibold hover:bg-gray-700 transition text-sm">
                            <i class="fas fa-edit mr-2"></i>Complete Profile
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Read Notification -->
        <div class="bg-gray-50 rounded-xl shadow-lg p-6 border-l-4 border-gray-300 hover:shadow-xl transition opacity-75">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-gray-400 to-gray-600 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-briefcase text-white text-lg"></i>
                </div>
                <div class="flex-1">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">New Job Recommendations</h3>
                            <p class="text-gray-600 mt-1">We found 5 new jobs matching your profile. Check them out now!</p>
                            <p class="text-sm text-gray-500 mt-3">
                                <i class="fas fa-clock mr-2"></i>3 days ago
                            </p>
                        </div>
                    </div>
                    <div class="mt-4 flex gap-2">
                        <button class="px-4 py-2 bg-gray-600 text-white rounded-lg font-semibold hover:bg-gray-700 transition text-sm">
                            <i class="fas fa-search mr-2"></i>Browse Jobs
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Read Notification -->
        <div class="bg-gray-50 rounded-xl shadow-lg p-6 border-l-4 border-gray-300 hover:shadow-xl transition opacity-75">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-gray-400 to-gray-600 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-times-circle text-white text-lg"></i>
                </div>
                <div class="flex-1">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Application Status Update</h3>
                            <p class="text-gray-600 mt-1">Unfortunately, Enterprise Systems Co. has decided to move forward with other candidates.</p>
                            <p class="text-sm text-gray-500 mt-3">
                                <i class="fas fa-clock mr-2"></i>1 week ago
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
