@extends('layouts.employer')

@section('title', 'Company Profile')

@section('content')
<div class="bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-teal-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-emerald-600 to-teal-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                        <i class="fas fa-building text-white text-xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 bg-clip-text text-transparent mb-1 md:mb-2">Company Profile</h1>
                    <p class="text-gray-600 text-xs md:text-sm font-medium">Manage your company information</p>
                </div>
            </div>
            <a href="{{ route('employer.profile.edit') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-medium">
                <i class="fas fa-edit mr-2"></i>Edit Profile
            </a>
        </div>
    </div>

    <!-- Profile Completion -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-emerald-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Profile...</span>
    </div>

    <!-- Profile Completion Card -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6 border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold text-gray-900">Profile Completion</h2>
            <span class="text-2xl font-bold text-emerald-600">75%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-3">
            <div class="bg-gradient-to-r from-emerald-500 to-teal-500 h-3 rounded-full" style="width: 75%"></div>
        </div>
        <p class="text-sm text-gray-600 mt-3">Complete your profile to attract more candidates</p>
    </div>

    <!-- Company Information -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-emerald-600 mr-2"></i>Basic Information
                </h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Company Name</label>
                        <p class="text-gray-900 font-semibold">Tech Solutions Ltd</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Industry</label>
                        <p class="text-gray-900 font-semibold">Information Technology</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Company Size</label>
                        <p class="text-gray-900 font-semibold">50-100 employees</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Founded Year</label>
                        <p class="text-gray-900 font-semibold">2015</p>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-phone text-emerald-600 mr-2"></i>Contact Information
                </h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <p class="text-gray-900 font-semibold">contact@techsolutions.com</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <p class="text-gray-900 font-semibold">+256 700 123 456</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                        <a href="#" class="text-emerald-600 hover:text-emerald-700 font-semibold">www.techsolutions.com</a>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                        <p class="text-gray-900 font-semibold">Kampala, Uganda</p>
                    </div>
                </div>
            </div>

            <!-- Company Description -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-align-left text-emerald-600 mr-2"></i>About Company
                </h2>
                <p class="text-gray-700 leading-relaxed">
                    Tech Solutions Ltd is a leading software development company specializing in web and mobile applications. 
                    We have been delivering innovative solutions to businesses across various industries for over 8 years. 
                    Our team is passionate about creating high-quality software that drives business growth.
                </p>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Company Logo -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-image text-emerald-600 mr-2"></i>Company Logo
                </h3>
                <div class="w-full h-40 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-building text-emerald-600 text-4xl"></i>
                </div>
                <p class="text-sm text-gray-600 text-center">No logo uploaded</p>
            </div>

            <!-- Quick Stats -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-chart-bar text-emerald-600 mr-2"></i>Quick Stats
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center pb-3 border-b">
                        <span class="text-gray-600">Active Jobs</span>
                        <span class="font-bold text-emerald-600">5</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b">
                        <span class="text-gray-600">Total Applications</span>
                        <span class="font-bold text-emerald-600">42</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b">
                        <span class="text-gray-600">Interviews Scheduled</span>
                        <span class="font-bold text-emerald-600">8</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Profile Views</span>
                        <span class="font-bold text-emerald-600">156</span>
                    </div>
                </div>
            </div>

            <!-- Social Links -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-share-alt text-emerald-600 mr-2"></i>Social Links
                </h3>
                <div class="space-y-2">
                    <a href="#" class="flex items-center gap-2 text-emerald-600 hover:text-emerald-700 font-medium">
                        <i class="fab fa-linkedin"></i>LinkedIn
                    </a>
                    <a href="#" class="flex items-center gap-2 text-emerald-600 hover:text-emerald-700 font-medium">
                        <i class="fab fa-twitter"></i>Twitter
                    </a>
                    <a href="#" class="flex items-center gap-2 text-emerald-600 hover:text-emerald-700 font-medium">
                        <i class="fab fa-facebook"></i>Facebook
                    </a>
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
