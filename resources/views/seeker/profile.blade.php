@extends('layouts.jobseeker')

@section('title', 'My Profile')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
            <div class="flex items-center gap-2 md:gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-teal-600 to-cyan-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-teal-600 to-cyan-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                        <i class="fas fa-user text-white text-xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-teal-600 via-cyan-600 to-blue-600 bg-clip-text text-transparent mb-1 md:mb-2">My Profile</h1>
                    <p class="text-gray-600 text-xs md:text-sm font-medium">Manage your professional information</p>
                </div>
            </div>
            <a href="{{ route('seeker.profile.edit') }}" class="px-3 md:px-5 py-2 md:py-2.5 bg-gradient-to-r from-teal-600 to-cyan-600 text-white rounded-lg md:rounded-xl hover:shadow-lg transition-all duration-300 text-xs md:text-sm font-bold flex items-center justify-center gap-1 md:gap-2 transform hover:scale-105">
                <i class="fas fa-edit"></i><span class="hidden sm:inline">Edit Profile</span>
            </a>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-green-500 to-green-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-green-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Profile...</span>
    </div>

    <!-- Profile Header Card -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 mb-6">
        <div class="h-32 bg-gradient-to-r from-teal-500 to-cyan-500"></div>
        <div class="px-6 pb-6">
            <div class="flex flex-col md:flex-row items-start md:items-end gap-4 -mt-16 mb-6">
                <div class="w-32 h-32 rounded-xl overflow-hidden bg-white shadow-lg border-4 border-white">
                    <img src="{{ auth()->user()->profile_picture_url ?? 'https://via.placeholder.com/128' }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                </div>
                <div class="flex-1">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900">{{ auth()->user()->name }}</h2>
                    <p class="text-lg text-gray-600 mt-1">{{ auth()->user()->jobSeekerProfile->job_title ?? 'Job Seeker' }}</p>
                    <p class="text-sm text-gray-500 mt-1">{{ auth()->user()->jobSeekerProfile->location ?? 'Location not set' }}</p>
                </div>
            </div>

            <!-- Profile Completion -->
            <div class="bg-gradient-to-r from-teal-50 to-cyan-50 rounded-xl p-4 border border-teal-200">
                <div class="flex items-center justify-between mb-2">
                    <span class="font-semibold text-gray-900">Profile Completion</span>
                    <span class="text-lg font-bold text-teal-600">{{ $profileCompletion }}%</span>
                </div>
                <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-teal-600 to-cyan-600 transition-all duration-500" style="width: {{ $profileCompletion }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Sections Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Contact Information -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-envelope text-teal-600 mr-2"></i>Contact Information
                </h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Email</p>
                        <p class="text-gray-900 mt-1">{{ auth()->user()->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Phone</p>
                        <p class="text-gray-900 mt-1">{{ auth()->user()->jobSeekerProfile->phone ?? 'Not provided' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Location</p>
                        <p class="text-gray-900 mt-1">{{ auth()->user()->jobSeekerProfile->location ?? 'Not provided' }}</p>
                    </div>
                </div>
            </div>

            <!-- Professional Information -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-briefcase text-teal-600 mr-2"></i>Professional Information
                </h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Job Title</p>
                        <p class="text-gray-900 mt-1">{{ auth()->user()->jobSeekerProfile->job_title ?? 'Not provided' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Experience Level</p>
                        <p class="text-gray-900 mt-1">{{ auth()->user()->jobSeekerProfile->experience_level ?? 'Not provided' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Bio</p>
                        <p class="text-gray-900 mt-1">{{ auth()->user()->jobSeekerProfile->bio ?? 'Not provided' }}</p>
                    </div>
                </div>
            </div>

            <!-- Skills -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-star text-teal-600 mr-2"></i>Skills
                </h3>
                @if($skills && count($skills) > 0)
                <div class="flex flex-wrap gap-2">
                    @foreach($skills as $skill)
                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-teal-100 text-teal-800 rounded-full text-sm font-medium">
                        {{ $skill }}
                    </span>
                    @endforeach
                </div>
                @else
                <p class="text-gray-600">No skills added yet</p>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Account Status -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-shield-alt text-teal-600 mr-2"></i>Account Status
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Status</span>
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                            <i class="fas fa-check-circle"></i>Active
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Member Since</span>
                        <span class="text-sm font-medium text-gray-900">{{ auth()->user()->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Last Updated</span>
                        <span class="text-sm font-medium text-gray-900">{{ auth()->user()->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-chart-bar text-teal-600 mr-2"></i>Quick Stats
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                        <span class="text-sm text-gray-600">Applications</span>
                        <span class="text-lg font-bold text-blue-600">{{ $applicationCount }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                        <span class="text-sm text-gray-600">Shortlisted</span>
                        <span class="text-lg font-bold text-green-600">{{ $shortlistedCount }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                        <span class="text-sm text-gray-600">Interviews</span>
                        <span class="text-lg font-bold text-purple-600">{{ $interviewCount }}</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-cog text-teal-600 mr-2"></i>Actions
                </h3>
                <div class="space-y-2">
                    <a href="{{ route('seeker.profile.edit') }}" class="block w-full px-4 py-2 text-center bg-gradient-to-r from-teal-600 to-cyan-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold text-sm">
                        <i class="fas fa-edit mr-1"></i>Edit Profile
                    </a>
                    <a href="{{ route('seeker.resume') }}" class="block w-full px-4 py-2 text-center bg-white text-teal-600 border border-teal-200 rounded-lg hover:bg-teal-50 transition-all duration-300 font-semibold text-sm">
                        <i class="fas fa-file-pdf mr-1"></i>Manage Resume
                    </a>
                    <a href="{{ route('seeker.settings') }}" class="block w-full px-4 py-2 text-center bg-white text-teal-600 border border-teal-200 rounded-lg hover:bg-teal-50 transition-all duration-300 font-semibold text-sm">
                        <i class="fas fa-sliders-h mr-1"></i>Settings
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
