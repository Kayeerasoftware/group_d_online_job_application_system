@extends('layouts.admin')

@section('title', 'Edit Profile')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
            <div class="flex items-center gap-2 md:gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-red-600 to-orange-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-red-600 to-orange-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                        <i class="fas fa-user-edit text-white text-xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-red-600 via-orange-600 to-yellow-600 bg-clip-text text-transparent mb-1 md:mb-2">Edit Profile</h1>
                    <p class="text-gray-600 text-xs md:text-sm font-medium">Update your administrator account information</p>
                </div>
            </div>
            <a href="{{ route('admin.profile') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold text-sm">
                <i class="fas fa-arrow-left mr-2"></i>Back
            </a>
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

    @if (session('status'))
        <div class="mb-4 rounded-lg bg-green-50 border border-green-200 p-4">
            <p class="text-sm font-medium text-green-800"><i class="fas fa-check-circle mr-2"></i>{{ session('status') }}</p>
        </div>
    @endif

    <!-- Main Content -->
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2">
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Profile Picture Upload -->
                <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-image text-red-600 mr-2"></i>Profile Picture
                    </h2>
                    
                    <div class="flex flex-col md:flex-row gap-6">
                        <!-- Current Picture -->
                        <div class="flex flex-col items-center">
                            <div class="w-32 h-32 rounded-full bg-gradient-to-br from-red-400 to-orange-600 flex items-center justify-center overflow-hidden shadow-lg ring-4 ring-red-100 mb-3">
                                @if(auth()->user()->profile_picture_url)
                                    <img src="{{ auth()->user()->profile_picture_url }}" alt="Profile" class="w-full h-full object-cover">
                                @else
                                    <span class="text-white font-bold text-4xl">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                                @endif
                            </div>
                            <p class="text-xs text-gray-600 text-center">Current Picture</p>
                        </div>

                        <!-- Upload Area -->
                        <div class="flex-1 flex flex-col justify-center">
                            <div class="rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 p-8 text-center transition hover:border-red-500 hover:bg-red-50 cursor-pointer">
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
                        <i class="fas fa-user text-red-600 mr-2"></i>Personal Information
                    </h2>
                    
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition">
                            @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition">
                            @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition">
                            @error('phone')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                            <input type="text" value="System Administrator" disabled class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm bg-gray-50 text-gray-600">
                        </div>
                    </div>
                </div>

                <!-- Account Security -->
                <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-lock text-red-600 mr-2"></i>Account Security
                    </h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                            <input type="password" name="current_password" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition" placeholder="Enter your current password">
                            @error('current_password')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                                <input type="password" name="password" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition" placeholder="Leave blank to keep current">
                                @error('password')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition" placeholder="Confirm new password">
                            </div>
                        </div>

                        <div class="rounded-lg bg-blue-50 border border-blue-200 p-4">
                            <p class="text-sm text-blue-800">
                                <i class="fas fa-info-circle mr-2"></i>
                                <strong>Password Requirements:</strong> Minimum 8 characters. Leave blank if you don't want to change your password.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between gap-4">
                    <a href="{{ route('admin.profile') }}" class="rounded-lg border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Cancel</a>
                    <button type="submit" class="rounded-lg bg-gradient-to-r from-red-600 to-orange-600 px-6 py-3 text-sm font-medium text-white hover:shadow-lg transition">
                        <i class="fas fa-save mr-2"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Profile Picture Preview -->
            <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-user-circle text-red-600 mr-2"></i>Profile Picture
                </h3>
                <div class="w-full rounded-lg bg-gradient-to-br from-red-400 to-orange-600 flex items-center justify-center overflow-hidden shadow-lg ring-4 ring-red-100 aspect-square">
                    @if(auth()->user()->profile_picture_url)
                        <img src="{{ auth()->user()->profile_picture_url }}" alt="Profile" class="w-full h-full object-cover">
                    @else
                        <span class="text-white font-bold text-6xl">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                    @endif
                </div>
                <p class="text-xs text-gray-600 text-center mt-3">This picture will appear on your admin profile and in the system</p>
            </div>

            <!-- Account Information -->
            <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-red-600 mr-2"></i>Account Information
                </h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">User ID</p>
                        <p class="text-gray-900 font-mono text-sm mt-1">#{{ auth()->user()->id }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Role</p>
                        <p class="text-gray-900 font-semibold mt-1">System Administrator</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Member Since</p>
                        <p class="text-gray-900 font-semibold mt-1">{{ auth()->user()->created_at->format('F d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Last Updated</p>
                        <p class="text-gray-900 font-semibold mt-1">{{ auth()->user()->updated_at->format('F d, Y \a\t h:i A') }}</p>
                    </div>
                </div>
            </div>

            <!-- Tips -->
            <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>Tips
                </h3>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-start gap-2">
                        <span class="text-red-600 font-bold">•</span>
                        <span>Use a professional profile picture</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-red-600 font-bold">•</span>
                        <span>Keep your email address current</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-red-600 font-bold">•</span>
                        <span>Update your password regularly</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-red-600 font-bold">•</span>
                        <span>Verify your phone number</span>
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
