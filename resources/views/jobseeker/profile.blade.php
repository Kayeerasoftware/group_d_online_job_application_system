@extends('layouts.jobseeker')

@section('title', 'My Profile')

@section('content')
<div class="space-y-6">
    <!-- Profile Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg shadow-lg p-6">
        <div class="flex flex-col md:flex-row items-center gap-6">
            <div class="w-24 h-24 md:w-32 md:h-32 rounded-full overflow-hidden bg-white shadow-lg flex-shrink-0">
                <img src="{{ auth()->user()->profile_picture_url ?? asset('images/default-avatar.svg') }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
            </div>
            <div class="flex-1 text-center md:text-left">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">{{ auth()->user()->name }}</h1>
                <p class="text-blue-100 text-lg mb-4">{{ auth()->user()->email }}</p>
                <div class="flex flex-wrap gap-3 justify-center md:justify-start">
                    <a href="{{ route('seeker.profile.edit') }}" class="px-6 py-2 bg-white text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition">
                        <i class="fas fa-edit mr-2"></i>Edit Profile
                    </a>
                    <button class="px-6 py-2 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                        <i class="fas fa-download mr-2"></i>Download Resume
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Stats -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 md:gap-4">
        <div class="bg-white rounded-lg shadow-md p-4 text-center">
            <p class="text-3xl font-bold text-blue-600">85%</p>
            <p class="text-sm text-gray-600 mt-1">Profile Complete</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 text-center">
            <p class="text-3xl font-bold text-green-600">342</p>
            <p class="text-sm text-gray-600 mt-1">Profile Views</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 text-center">
            <p class="text-3xl font-bold text-purple-600">12</p>
            <p class="text-sm text-gray-600 mt-1">Applications</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 text-center">
            <p class="text-3xl font-bold text-orange-600">3</p>
            <p class="text-sm text-gray-600 mt-1">Interviews</p>
        </div>
    </div>

    <!-- Profile Information -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Personal Information -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-user-circle text-blue-600 mr-3"></i>Personal Information
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-sm font-semibold text-gray-600">Full Name</label>
                    <p class="text-lg text-gray-900 mt-1">{{ auth()->user()->name }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Email</label>
                    <p class="text-lg text-gray-900 mt-1">{{ auth()->user()->email }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Phone</label>
                    <p class="text-lg text-gray-900 mt-1">{{ auth()->user()->phone ?? 'Not provided' }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-600">Location</label>
                    <p class="text-lg text-gray-900 mt-1">{{ auth()->user()->jobSeekerProfile?->location ?? 'Not provided' }}</p>
                </div>
                <div class="md:col-span-2">
                    <label class="text-sm font-semibold text-gray-600">Bio</label>
                    <p class="text-lg text-gray-900 mt-1">{{ auth()->user()->jobSeekerProfile?->bio ?? 'No bio added yet' }}</p>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-lightning-bolt text-yellow-500 mr-2"></i>Quick Actions
            </h2>
            <div class="space-y-3">
                <a href="{{ route('seeker.profile.edit') }}" class="block w-full px-4 py-3 bg-blue-50 text-blue-600 rounded-lg font-semibold hover:bg-blue-100 transition text-center">
                    <i class="fas fa-edit mr-2"></i>Edit Profile
                </a>
                <a href="{{ route('seeker.resume') }}" class="block w-full px-4 py-3 bg-green-50 text-green-600 rounded-lg font-semibold hover:bg-green-100 transition text-center">
                    <i class="fas fa-file-pdf mr-2"></i>Manage Resume
                </a>
                <a href="{{ route('seeker.settings') }}" class="block w-full px-4 py-3 bg-purple-50 text-purple-600 rounded-lg font-semibold hover:bg-purple-100 transition text-center">
                    <i class="fas fa-cog mr-2"></i>Settings
                </a>
                <a href="{{ route('seeker.notifications') }}" class="block w-full px-4 py-3 bg-orange-50 text-orange-600 rounded-lg font-semibold hover:bg-orange-100 transition text-center">
                    <i class="fas fa-bell mr-2"></i>Notifications
                </a>
            </div>
        </div>
    </div>

    <!-- Skills & Experience -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Skills -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-star text-yellow-500 mr-2"></i>Skills
            </h2>
            @if(auth()->user()->jobSeekerProfile?->skills)
            <div class="flex flex-wrap gap-2">
                @foreach(explode(',', auth()->user()->jobSeekerProfile->skills) as $skill)
                <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">{{ trim($skill) }}</span>
                @endforeach
            </div>
            @else
            <p class="text-gray-600 mb-4">No skills added yet</p>
            @endif
            <a href="{{ route('seeker.profile.edit') }}" class="mt-4 inline-block text-blue-600 font-semibold hover:underline">
                <i class="fas fa-plus mr-1"></i>Add Skills
            </a>
        </div>

        <!-- Experience -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-briefcase text-purple-600 mr-2"></i>Experience
            </h2>
            @if(auth()->user()->jobSeekerProfile?->experience_years)
            <div class="space-y-4">
                <div class="border-l-4 border-purple-600 pl-4">
                    <p class="font-semibold text-gray-900">{{ auth()->user()->jobSeekerProfile->job_title ?? 'Job Title' }}</p>
                    <p class="text-sm text-gray-600">{{ auth()->user()->jobSeekerProfile->experience_years }} years of experience</p>
                </div>
            </div>
            @else
            <p class="text-gray-600 mb-4">No experience added yet</p>
            @endif
            <a href="{{ route('seeker.profile.edit') }}" class="mt-4 inline-block text-blue-600 font-semibold hover:underline">
                <i class="fas fa-plus mr-1"></i>Add Experience
            </a>
        </div>
    </div>

    <!-- Education -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-graduation-cap text-indigo-600 mr-2"></i>Education
        </h2>
        @if(auth()->user()->jobSeekerProfile?->education_level)
        <div class="space-y-4">
            <div class="border-l-4 border-indigo-600 pl-4">
                <p class="font-semibold text-gray-900">{{ auth()->user()->jobSeekerProfile->education_level }}</p>
            </div>
        </div>
        @else
        <p class="text-gray-600 mb-4">No education added yet</p>
        @endif
        <a href="{{ route('seeker.profile.edit') }}" class="mt-4 inline-block text-blue-600 font-semibold hover:underline">
            <i class="fas fa-plus mr-1"></i>Add Education
        </a>
    </div>
</div>
@endsection
