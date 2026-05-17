@extends('layouts.employer')

@section('title', 'Edit Company Profile')

@section('content')
<div class="bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
            <div class="flex items-center gap-2 md:gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-teal-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-emerald-600 to-teal-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                        <i class="fas fa-edit text-white text-xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 bg-clip-text text-transparent mb-1 md:mb-2">Edit Company Profile</h1>
                    <p class="text-gray-600 text-xs md:text-sm font-medium">Update your company information</p>
                </div>
            </div>
            <a href="{{ route('employer.profile') }}" class="px-3 md:px-5 py-2 md:py-2.5 bg-gradient-to-r from-gray-600 to-gray-700 text-white rounded-lg md:rounded-xl hover:shadow-lg transition-all duration-300 text-xs md:text-sm font-bold flex items-center justify-center gap-1 md:gap-2">
                <i class="fas fa-arrow-left"></i><span class="hidden sm:inline">Back</span>
            </a>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-green-500 to-green-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-green-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Form...</span>
    </div>

    <!-- Edit Form -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <form method="POST" action="{{ route('employer.profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Profile Picture -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-image text-emerald-600 mr-2"></i>Profile Picture
                    </h3>
                    <div class="flex items-center gap-4">
                        <div class="w-24 h-24 rounded-lg overflow-hidden bg-gray-200 flex items-center justify-center">
                            <img src="{{ auth()->user()->profile_picture_url ?? 'https://via.placeholder.com/96' }}" alt="Profile" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <input type="file" name="profile_picture" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                            <p class="text-xs text-gray-500 mt-2">JPG, PNG or GIF (Max 5MB)</p>
                        </div>
                    </div>
                </div>

                <!-- Company Information -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-building text-emerald-600 mr-2"></i>Company Information
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Company Name *</label>
                            <input type="text" name="company_name" value="{{ auth()->user()->employerProfile->company_name ?? '' }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Industry *</label>
                            <select name="industry" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all appearance-none bg-white">
                                <option value="">Select Industry</option>
                                <option value="technology" {{ (auth()->user()->employerProfile->industry ?? '') == 'technology' ? 'selected' : '' }}>Technology</option>
                                <option value="finance" {{ (auth()->user()->employerProfile->industry ?? '') == 'finance' ? 'selected' : '' }}>Finance</option>
                                <option value="healthcare" {{ (auth()->user()->employerProfile->industry ?? '') == 'healthcare' ? 'selected' : '' }}>Healthcare</option>
                                <option value="education" {{ (auth()->user()->employerProfile->industry ?? '') == 'education' ? 'selected' : '' }}>Education</option>
                                <option value="retail" {{ (auth()->user()->employerProfile->industry ?? '') == 'retail' ? 'selected' : '' }}>Retail</option>
                                <option value="manufacturing" {{ (auth()->user()->employerProfile->industry ?? '') == 'manufacturing' ? 'selected' : '' }}>Manufacturing</option>
                                <option value="other" {{ (auth()->user()->employerProfile->industry ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Company Size *</label>
                            <select name="company_size" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all appearance-none bg-white">
                                <option value="">Select Company Size</option>
                                <option value="1-10" {{ (auth()->user()->employerProfile->company_size ?? '') == '1-10' ? 'selected' : '' }}>1-10 employees</option>
                                <option value="11-50" {{ (auth()->user()->employerProfile->company_size ?? '') == '11-50' ? 'selected' : '' }}>11-50 employees</option>
                                <option value="51-200" {{ (auth()->user()->employerProfile->company_size ?? '') == '51-200' ? 'selected' : '' }}>51-200 employees</option>
                                <option value="201-500" {{ (auth()->user()->employerProfile->company_size ?? '') == '201-500' ? 'selected' : '' }}>201-500 employees</option>
                                <option value="500+" {{ (auth()->user()->employerProfile->company_size ?? '') == '500+' ? 'selected' : '' }}>500+ employees</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Location *</label>
                            <input type="text" name="location" value="{{ auth()->user()->employerProfile->location ?? '' }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-phone text-emerald-600 mr-2"></i>Contact Information
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                            <input type="email" name="email" value="{{ auth()->user()->email }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <input type="tel" name="phone" value="{{ auth()->user()->employerProfile->phone ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                            <input type="url" name="website" value="{{ auth()->user()->employerProfile->website ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                        </div>
                    </div>
                </div>

                <!-- Company Description -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-file-alt text-emerald-600 mr-2"></i>About Company
                    </h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Company Description</label>
                        <textarea name="description" rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all resize-none">{{ auth()->user()->employerProfile->description ?? '' }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Tell candidates about your company, culture, and values</p>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex gap-3">
                    <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold">
                        <i class="fas fa-save mr-2"></i>Save Changes
                    </button>
                    <a href="{{ route('employer.profile') }}" class="flex-1 px-6 py-3 bg-white text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition-all duration-300 font-semibold text-center">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>

        <!-- Sidebar Info -->
        <div class="space-y-6">
            <!-- Tips -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-lightbulb text-yellow-600 mr-2"></i>Tips
                </h3>
                <ul class="space-y-3 text-sm text-gray-600">
                    <li class="flex gap-2">
                        <i class="fas fa-check text-emerald-600 flex-shrink-0 mt-0.5"></i>
                        <span>Use a professional company logo as your profile picture</span>
                    </li>
                    <li class="flex gap-2">
                        <i class="fas fa-check text-emerald-600 flex-shrink-0 mt-0.5"></i>
                        <span>Write a compelling company description to attract talent</span>
                    </li>
                    <li class="flex gap-2">
                        <i class="fas fa-check text-emerald-600 flex-shrink-0 mt-0.5"></i>
                        <span>Keep your contact information up to date</span>
                    </li>
                    <li class="flex gap-2">
                        <i class="fas fa-check text-emerald-600 flex-shrink-0 mt-0.5"></i>
                        <span>Complete all fields for better visibility</span>
                    </li>
                </ul>
            </div>

            <!-- Required Fields -->
            <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-200">
                <p class="text-sm text-emerald-900 font-medium">
                    <i class="fas fa-info-circle mr-2"></i>Fields marked with * are required
                </p>
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
