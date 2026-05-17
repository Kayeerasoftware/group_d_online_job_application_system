@extends('layouts.regulator')

@section('title', 'Edit Profile')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
            <div class="flex items-center gap-2 md:gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-amber-600 to-orange-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-amber-600 to-orange-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                        <i class="fas fa-user-edit text-white text-xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-amber-600 via-orange-600 to-red-600 bg-clip-text text-transparent mb-1 md:mb-2">Edit Profile</h1>
                    <p class="text-gray-600 text-xs md:text-sm font-medium">Update your regulatory account information</p>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-50 border border-red-200 p-4">
            <p class="text-sm font-medium text-red-800 mb-2">Please fix the following errors:</p>
            <ul class="list-disc list-inside text-sm text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-50 border border-green-200 p-4">
            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Main Content -->
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2">
            <form action="{{ route('regulator.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Profile Picture Upload -->
                <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-image text-amber-600 mr-2"></i>Profile Picture
                    </h2>
                    
                    <div class="flex flex-col md:flex-row gap-6">
                        <!-- Current Picture -->
                        <div class="flex flex-col items-center">
                            <div class="w-32 h-32 rounded-full bg-gradient-to-br from-amber-400 to-orange-600 flex items-center justify-center overflow-hidden shadow-lg ring-4 ring-amber-100 mb-3">
                                @if(auth()->user()->profile_picture_url)
                                    <img src="{{ auth()->user()->profile_picture_url }}" alt="Profile" class="w-full h-full object-cover">
                                @else
                                    <i class="fas fa-shield-alt text-white text-5xl"></i>
                                @endif
                            </div>
                            <p class="text-xs text-gray-600 text-center">Current Picture</p>
                        </div>

                        <!-- Upload Area -->
                        <div class="flex-1 flex flex-col justify-center">
                            <div class="rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 p-8 text-center transition hover:border-amber-500 hover:bg-amber-50 cursor-pointer">
                                <input type="file" name="profile_picture" id="profile_picture" accept="image/*" class="hidden" onchange="previewProfilePicture(this)">
                                <label for="profile_picture" class="cursor-pointer">
                                    <div class="text-4xl mb-3">📸</div>
                                    <p class="text-sm font-medium text-gray-900">Click to upload or drag and drop</p>
                                    <p class="mt-1 text-xs text-gray-600">PNG, JPG, GIF (max 2MB)</p>
                                </label>
                            </div>
                            <div id="preview-container" class="mt-4 hidden">
                                <img id="preview-image" src="" alt="Preview" class="w-full h-auto rounded-lg shadow-md">
                                <button type="button" onclick="clearPreview()" class="mt-2 w-full text-xs text-red-600 hover:text-red-700 font-medium">Clear Preview</button>
                            </div>
                            @error('profile_picture')<p class="mt-2 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <!-- Personal Information -->
                <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-user text-amber-600 mr-2"></i>Personal Information
                    </h2>
                    
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition">
                            @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition">
                            @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition">
                            @error('phone')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                            <input type="text" name="department" value="{{ old('department', '') }}" placeholder="e.g., Compliance, Audit" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition">
                            @error('department')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <!-- Professional Details -->
                <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-briefcase text-amber-600 mr-2"></i>Professional Details
                    </h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Job Title</label>
                            <input type="text" name="job_title" value="{{ old('job_title', '') }}" placeholder="e.g., Regulatory Officer" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition">
                            @error('job_title')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Years of Experience</label>
                                <select name="years_experience" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition">
                                    <option value="">Select experience</option>
                                    @for($i = 0; $i <= 30; $i++)
                                        <option value="{{ $i }}">{{ $i }} {{ $i == 1 ? 'year' : 'years' }}</option>
                                    @endfor
                                    <option value="30+">30+ years</option>
                                </select>
                                @error('years_experience')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Education Level</label>
                                <select name="education_level" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition">
                                    <option value="">Select level</option>
                                    @foreach(['High School', 'Certificate', 'Diploma', 'Bachelor\'s Degree', 'Master\'s Degree', 'PhD'] as $level)
                                        <option value="{{ $level }}">{{ $level }}</option>
                                    @endforeach
                                </select>
                                @error('education_level')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Specializations (comma-separated)</label>
                            <input type="text" name="specializations" value="{{ old('specializations', '') }}" placeholder="e.g., Compliance, Risk Management, Audit" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition">
                            @error('specializations')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Bio / Summary</label>
                            <textarea name="bio" rows="4" placeholder="Tell about your regulatory expertise and focus areas..." class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition resize-none">{{ old('bio', '') }}</textarea>
                            @error('bio')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between gap-4">
                    <a href="{{ route('regulator.profile') }}" class="rounded-lg border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Cancel</a>
                    <button type="submit" class="rounded-lg bg-gradient-to-r from-amber-600 to-orange-600 px-6 py-3 text-sm font-medium text-white hover:shadow-lg transition">Save Changes</button>
                </div>
            </form>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Profile Picture Preview -->
            <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-user-circle text-amber-600 mr-2"></i>Profile Picture
                </h3>
                <div class="w-full rounded-lg bg-gradient-to-br from-amber-400 to-orange-600 flex items-center justify-center overflow-hidden shadow-lg ring-4 ring-amber-100 aspect-square">
                    @if(auth()->user()->profile_picture_url)
                        <img src="{{ auth()->user()->profile_picture_url }}" alt="Profile" class="w-full h-full object-cover">
                    @else
                        <i class="fas fa-shield-alt text-white text-6xl"></i>
                    @endif
                </div>
                <p class="text-xs text-gray-600 text-center mt-3">This picture will appear on your regulatory profile</p>
            </div>

            <!-- Tips -->
            <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>Tips
                </h3>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-start gap-2">
                        <span class="text-amber-600 font-bold">•</span>
                        <span>Use a professional profile picture</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-amber-600 font-bold">•</span>
                        <span>Keep your information up to date</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-amber-600 font-bold">•</span>
                        <span>List your specializations clearly</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-amber-600 font-bold">•</span>
                        <span>Provide a comprehensive bio</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
function previewProfilePicture(input) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-image').src = e.target.result;
            document.getElementById('preview-container').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
}

function clearPreview() {
    document.getElementById('profile_picture').value = '';
    document.getElementById('preview-container').classList.add('hidden');
}
</script>
@endsection
