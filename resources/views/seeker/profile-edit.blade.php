@extends('layouts.jobseeker')

@section('title', 'Edit Profile')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
            <div class="flex items-center gap-2 md:gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-teal-600 to-cyan-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-teal-600 to-cyan-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                        <i class="fas fa-user-edit text-white text-xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-teal-600 via-cyan-600 to-blue-600 bg-clip-text text-transparent mb-1 md:mb-2">Edit Profile</h1>
                    <p class="text-gray-600 text-xs md:text-sm font-medium">Keep your profile up to date to attract employers</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-green-500 to-green-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-green-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Profile...</span>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-3 mb-3 md:mb-4">
        <div class="bg-gradient-to-br from-teal-500 to-teal-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-teal-100 text-[8px] md:text-[10px] font-medium mb-0.5">Profile Views</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $profileViews ?? 156 }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-eye text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-cyan-100 text-[8px] md:text-[10px] font-medium mb-0.5">Profile Completion</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $profileCompletion ?? 75 }}%</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-chart-pie text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-[8px] md:text-[10px] font-medium mb-0.5">Job Matches</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $jobMatches ?? 42 }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-briefcase text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-[8px] md:text-[10px] font-medium mb-0.5">Last Updated</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $lastUpdated ?? 'Today' }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-calendar text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2">
            <form action="{{ route('seeker.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Personal Information -->
                <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-user text-teal-600 mr-2"></i>Personal Information
                    </h2>
                    
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition">
                            @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition">
                            @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" name="phone" value="{{ old('phone', $profile->phone ?? '') }}" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition">
                            @error('phone')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                            <input type="text" name="location" value="{{ old('location', $profile->location ?? '') }}" placeholder="e.g., Kampala, Uganda" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition">
                            @error('location')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <!-- Professional Details -->
                <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-briefcase text-teal-600 mr-2"></i>Professional Details
                    </h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Current Job Title</label>
                            <input type="text" name="job_title" value="{{ old('job_title', $profile->job_title ?? '') }}" placeholder="e.g., Software Engineer" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition">
                            @error('job_title')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Years of Experience</label>
                                <select name="experience_years" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition">
                                    <option value="">Select experience</option>
                                    @for($i = 0; $i <= 20; $i++)
                                    <option value="{{ $i }}" {{ old('experience_years', $profile->experience_years ?? '') == $i ? 'selected' : '' }}>{{ $i }} {{ $i == 1 ? 'year' : 'years' }}</option>
                                    @endfor
                                    <option value="20+" {{ old('experience_years', $profile->experience_years ?? '') == '20+' ? 'selected' : '' }}>20+ years</option>
                                </select>
                                @error('experience_years')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Education Level</label>
                                <select name="education_level" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition">
                                    <option value="">Select level</option>
                                    @foreach(['High School', 'Certificate', 'Diploma', 'Bachelor\'s Degree', 'Master\'s Degree', 'PhD'] as $level)
                                    <option value="{{ $level }}" {{ old('education_level', $profile->education_level ?? '') == $level ? 'selected' : '' }}>{{ $level }}</option>
                                    @endforeach
                                </select>
                                @error('education_level')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Skills (comma-separated)</label>
                            <input type="text" name="skills" value="{{ old('skills', $profile->skills ?? '') }}" placeholder="e.g., Laravel, Vue.js, MySQL, Project Management" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition">
                            @error('skills')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Bio / Summary</label>
                            <textarea name="bio" rows="4" placeholder="Tell employers about yourself, your experience, and what you're looking for..." class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition resize-none">{{ old('bio', $profile->bio ?? '') }}</textarea>
                            @error('bio')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <!-- CV / Resume -->
                <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-file-pdf text-teal-600 mr-2"></i>CV / Resume
                    </h2>
                    
                    @if($profile && $profile->cv_path)
                    <div class="mb-4 flex items-center gap-3 rounded-lg border border-gray-200 bg-gray-50 p-4">
                        <span class="text-2xl">📄</span>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Current CV</p>
                            <p class="text-xs text-gray-600">{{ basename($profile->cv_path) }}</p>
                        </div>
                        <a href="{{ Storage::url($profile->cv_path) }}" target="_blank" class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-50 transition">View</a>
                    </div>
                    @endif

                    <div class="rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 p-8 text-center transition hover:border-teal-500 hover:bg-teal-50 cursor-pointer">
                        <input type="file" name="cv" id="cv" accept=".pdf,.doc,.docx" class="hidden" onchange="document.getElementById('cv-label').textContent = this.files[0]?.name || 'Click to upload or drag and drop'">
                        <label for="cv" class="cursor-pointer">
                            <div class="text-4xl mb-3">📤</div>
                            <p class="text-sm font-medium text-gray-900" id="cv-label">Click to upload or drag and drop</p>
                            <p class="mt-1 text-xs text-gray-600">PDF, DOC, or DOCX (max 5MB)</p>
                        </label>
                    </div>
                    @error('cv')<p class="mt-2 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between gap-4">
                    <a href="{{ route('seeker.dashboard') }}" class="rounded-lg border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Cancel</a>
                    <button type="submit" class="rounded-lg bg-gradient-to-r from-teal-600 to-cyan-600 px-6 py-3 text-sm font-medium text-white hover:shadow-lg transition">Save Changes</button>
                </div>
            </form>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Profile Completion -->
            <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-chart-pie text-teal-600 mr-2"></i>Profile Completion
                </h3>
                <div class="space-y-3">
                    @php
                        $completionItems = [
                            ['label' => 'Personal info', 'completed' => auth()->user()->name && auth()->user()->email],
                            ['label' => 'Contact details', 'completed' => $profile && $profile->phone && $profile->location],
                            ['label' => 'Professional details', 'completed' => $profile && $profile->job_title && $profile->experience_years],
                            ['label' => 'Skills', 'completed' => $profile && $profile->skills],
                            ['label' => 'Bio', 'completed' => $profile && $profile->bio],
                            ['label' => 'CV uploaded', 'completed' => $profile && $profile->cv_path],
                        ];
                    @endphp
                    @foreach($completionItems as $item)
                    <div class="flex items-center gap-3">
                        <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full {{ $item['completed'] ? 'bg-gradient-to-r from-teal-600 to-cyan-600 text-white' : 'border border-gray-300 bg-gray-50 text-gray-400' }}">
                            @if($item['completed'])<i class="fas fa-check text-xs"></i>@else·@endif
                        </div>
                        <span class="text-sm {{ $item['completed'] ? 'text-gray-900 font-medium' : 'text-gray-600' }}">{{ $item['label'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Tips -->
            <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>Tips
                </h3>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-start gap-2">
                        <span class="text-teal-600 font-bold">•</span>
                        <span>Complete profiles get 3x more views from employers</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-teal-600 font-bold">•</span>
                        <span>Keep your CV updated with recent experience</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-teal-600 font-bold">•</span>
                        <span>List specific skills relevant to your target roles</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-teal-600 font-bold">•</span>
                        <span>Write a clear bio highlighting your strengths</span>
                    </li>
                </ul>
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
