@extends('layouts.jobseeker')

@section('title', 'My Profile')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-lg shadow-lg p-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-20 h-20 rounded-full overflow-hidden bg-white shadow-lg flex-shrink-0">
                    <img src="{{ auth()->user()->profile_picture_url ?? 'https://via.placeholder.com/80' }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white">{{ auth()->user()->name }}</h1>
                    <p class="text-indigo-100">Job Seeker</p>
                </div>
            </div>
            <a href="{{ route('seeker.profile.edit') }}" class="px-6 py-3 bg-white text-indigo-600 rounded-lg font-semibold hover:bg-gray-100 transition">
                <i class="fas fa-edit mr-2"></i>Edit Profile
            </a>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-6">
        <div class="h-full bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-indigo-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Profile...</span>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-3 mb-6">
        <!-- Profile Completion -->
        <div class="bg-gradient-to-r from-indigo-50 to-indigo-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-indigo-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-chart-pie text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Completion</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">0%</h3>
                </div>
            </div>
        </div>

        <!-- Experience -->
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-blue-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-briefcase text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Experience</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">0</h3>
                </div>
            </div>
        </div>

        <!-- Education -->
        <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-green-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-green-500 to-green-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-graduation-cap text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Education</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">0</h3>
                </div>
            </div>
        </div>

        <!-- Skills -->
        <div class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-purple-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-star text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Skills</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">0</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Completion -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-lg font-bold text-gray-900 mb-4">Profile Completion</h2>
        <div class="space-y-4">
            <div>
                <div class="flex justify-between items-center mb-2">
                    <p class="text-sm font-semibold text-gray-700">Overall Progress</p>
                    <p class="text-sm font-bold text-indigo-600">0%</p>
                </div>
                <div class="h-3 w-full overflow-hidden rounded-full bg-gray-200">
                    <div class="h-full rounded-full bg-gradient-to-r from-indigo-600 to-blue-600 transition-all duration-500" style="width: 0%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Profile Info -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column -->
        <div class="lg:col-span-2 space-y-6">
            <!-- About -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-user text-indigo-600 mr-2"></i>About
                </h2>
                <p class="text-gray-700 leading-relaxed">No bio added yet</p>
            </div>

            <!-- Experience -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-bold text-gray-900 flex items-center">
                        <i class="fas fa-briefcase text-indigo-600 mr-2"></i>Experience
                    </h2>
                    <a href="{{ route('seeker.profile.edit') }}" class="text-indigo-600 text-sm hover:underline font-semibold">Edit</a>
                </div>
                <p class="text-gray-600 text-sm">No experience added yet</p>
            </div>

            <!-- Education -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-bold text-gray-900 flex items-center">
                        <i class="fas fa-graduation-cap text-indigo-600 mr-2"></i>Education
                    </h2>
                    <a href="{{ route('seeker.profile.edit') }}" class="text-indigo-600 text-sm hover:underline font-semibold">Edit</a>
                </div>
                <p class="text-gray-600 text-sm">No education added yet</p>
            </div>
        </div>

        <!-- Right Column -->
        <div class="space-y-6">
            <!-- Contact Info -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-phone text-indigo-600 mr-2"></i>Contact
                </h2>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-600 font-semibold">Email</p>
                        <p class="text-gray-900">{{ auth()->user()->email }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-semibold">Phone</p>
                        <p class="text-gray-900">Not provided</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-semibold">Location</p>
                        <p class="text-gray-900">Not provided</p>
                    </div>
                </div>
            </div>

            <!-- Skills -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-bold text-gray-900 flex items-center">
                        <i class="fas fa-star text-indigo-600 mr-2"></i>Skills
                    </h2>
                    <a href="{{ route('seeker.profile.edit') }}" class="text-indigo-600 text-sm hover:underline font-semibold">Edit</a>
                </div>
                <p class="text-gray-600 text-sm">No skills added yet</p>
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
