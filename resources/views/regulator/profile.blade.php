@extends('layouts.regulator')

@section('title', 'My Profile')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">My Profile</h1>
        <p class="text-gray-600 mt-2">Manage your regulator account information</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition">
                <div class="text-center mb-6">
                    @if($user->profile_picture_url)
                        <img src="{{ $user->profile_picture_url }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-full mx-auto object-cover border-4 border-amber-500 shadow-lg">
                    @else
                        <div class="w-24 h-24 bg-gradient-to-br from-amber-400 to-orange-600 rounded-full mx-auto flex items-center justify-center text-white text-3xl font-bold border-4 border-amber-500 shadow-lg">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                <h2 class="text-xl font-semibold text-gray-900 text-center">{{ $user->name }}</h2>
                <p class="text-amber-600 text-center mt-1 font-medium">Regulatory Officer</p>
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600">Email</p>
                    <p class="text-gray-900 font-medium break-all">{{ $user->email }}</p>
                </div>
                <div class="mt-4">
                    <p class="text-sm text-gray-600">Member Since</p>
                    <p class="text-gray-900 font-medium">{{ $user->created_at->format('M d, Y') }}</p>
                </div>
                <a href="{{ route('regulator.profile.edit') }}" class="block w-full mt-6 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-medium py-2 px-4 rounded-lg text-center transition shadow-md hover:shadow-lg">
                    <i class="fas fa-edit mr-2"></i>Edit Profile
                </a>
            </div>
        </div>

        <!-- Profile Information -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-user-circle text-amber-500"></i>
                    Profile Information
                </h3>
                <div class="space-y-4">
                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <p class="text-sm text-gray-600 font-medium">Full Name</p>
                        <p class="text-gray-900 font-semibold mt-1">{{ $user->name }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <p class="text-sm text-gray-600 font-medium">Email Address</p>
                        <p class="text-gray-900 font-semibold mt-1 break-all">{{ $user->email }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <p class="text-sm text-gray-600 font-medium">Role</p>
                        <p class="text-gray-900 font-semibold mt-1">
                            <span class="inline-flex items-center gap-2">
                                <i class="fas fa-shield-alt text-amber-500"></i>
                                Regulatory Officer
                            </span>
                        </p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <p class="text-sm text-gray-600 font-medium">Account Status</p>
                        <p class="text-gray-900 font-semibold mt-1">
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-bold
                                @if($user->is_active) bg-green-100 text-green-800
                                @else bg-red-100 text-red-800
                                @endif">
                                <i class="fas @if($user->is_active) fa-check-circle @else fa-times-circle @endif"></i>
                                @if($user->is_active) Active @else Inactive @endif
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Security Section -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-lock text-red-500"></i>
                    Security
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div>
                            <p class="font-medium text-gray-900">Password</p>
                            <p class="text-sm text-gray-600">Last changed {{ $user->updated_at->format('M d, Y') }}</p>
                        </div>
                        <a href="{{ route('regulator.profile.edit') }}" class="text-amber-600 hover:text-amber-900 font-medium flex items-center gap-1 transition">
                            <i class="fas fa-edit"></i>
                            Change
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
