@extends('layouts.employer')

@section('title', 'Edit Company Profile')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
            <div class="flex items-center gap-2 md:gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-teal-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-emerald-600 to-teal-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                        <i class="fas fa-building text-white text-xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 bg-clip-text text-transparent mb-1 md:mb-2">Edit Company Profile</h1>
                    <p class="text-gray-600 text-xs md:text-sm font-medium">Keep your profile up to date to attract candidates</p>
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
            <form action="{{ route('employer.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Company Logo Upload -->
                <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-image text-emerald-600 mr-2"></i>Company Logo
                    </h2>
                    
                    <div class="flex flex-col md:flex-row gap-6">
                        <!-- Current Logo -->
                        <div class="flex flex-col items-center">
                            <div class="w-32 h-32 rounded-lg bg-gradient-to-br from-emerald-400 to-teal-600 flex items-center justify-center overflow-hidden shadow-lg ring-4 ring-emerald-100 mb-3">
                                @if($profile && $profile->company_logo)
                                    <img src="{{ asset($profile->company_logo) }}" alt="Logo" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="w-full h-full bg-gradient-to-br from-emerald-400 to-teal-600 flex items-center justify-center hidden">
                                        <i class="fas fa-building text-white text-5xl"></i>
                                    </div>
                                @else
                                    <i class="fas fa-building text-white text-5xl"></i>
                                @endif
                            </div>
                            <p class="text-xs text-gray-600 text-center">Current Logo</p>
                        </div>

                        <!-- Upload Area -->
                        <div class="flex-1 flex flex-col justify-center">
                            <div class="rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 p-8 text-center transition hover:border-emerald-500 hover:bg-emerald-50 cursor-pointer">
                                <input type="file" name="company_logo" id="company_logo" accept="image/*" class="hidden" onchange="previewCompanyLogo(this)">
                                <label for="company_logo" class="cursor-pointer">
                                    <div class="text-4xl mb-3">🏢</div>
                                    <p class="text-sm font-medium text-gray-900">Click to upload or drag and drop</p>
                                    <p class="mt-1 text-xs text-gray-600">PNG, JPG, GIF (max 5MB)</p>
                                </label>
                            </div>
                            <div id="logo-preview-container" class="mt-4 hidden">
                                <img id="logo-preview-image" src="" alt="Preview" class="w-full h-auto rounded-lg shadow-md">
                                <button type="button" onclick="clearLogoPreview()" class="mt-2 w-full text-xs text-red-600 hover:text-red-700 font-medium">Clear Preview</button>
                            </div>
                            @error('company_logo')<p class="mt-2 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <!-- Company Information -->
                <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-building text-emerald-600 mr-2"></i>Company Information
                    </h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Company Name *</label>
                            <input type="text" name="company_name" value="{{ old('company_name', $profile->company_name ?? '') }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition" placeholder="Enter your company name">
                            @error('company_name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Industry *</label>
                                <select name="industry" required class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                                    <option value="">Select Industry</option>
                                    @foreach(['Technology', 'Finance', 'Healthcare', 'Education', 'Retail', 'Manufacturing', 'Agriculture', 'Hospitality', 'Transportation', 'Construction', 'Other'] as $industry)
                                        <option value="{{ $industry }}" {{ old('industry', $profile->industry ?? '') == $industry ? 'selected' : '' }}>{{ $industry }}</option>
                                    @endforeach
                                </select>
                                @error('industry')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tax ID / Registration Number</label>
                                <input type="text" name="tax_id" value="{{ old('tax_id', $profile->tax_id ?? '') }}" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition" placeholder="Enter your tax ID">
                                @error('tax_id')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-phone text-emerald-600 mr-2"></i>Contact Information
                    </h2>
                    
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                            @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition" placeholder="e.g., +256 700 123 456">
                            @error('phone')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Company Website</label>
                            <input type="url" name="company_website" value="{{ old('company_website', $profile->company_website ?? '') }}" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition" placeholder="https://www.example.com">
                            @error('company_website')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <!-- Company Description -->
                <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-file-alt text-emerald-600 mr-2"></i>About Company
                    </h2>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Company Description</label>
                        <textarea name="company_description" rows="6" placeholder="Tell candidates about your company, culture, values, and mission..." class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition resize-none">{{ old('company_description', $profile->company_description ?? '') }}</textarea>
                        <p class="mt-1 text-xs text-gray-600">Tell candidates about your company, culture, and values (max 2000 characters)</p>
                        @error('company_description')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between gap-4">
                    <a href="{{ route('employer.profile') }}" class="rounded-lg border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Cancel</a>
                    <button type="submit" class="rounded-lg bg-gradient-to-r from-emerald-600 to-teal-600 px-6 py-3 text-sm font-medium text-white hover:shadow-lg transition">Save Changes</button>
                </div>
            </form>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Company Logo Preview -->
            <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-image text-emerald-600 mr-2"></i>Company Logo
                </h3>
                <div class="w-full rounded-lg bg-gradient-to-br from-emerald-400 to-teal-600 flex items-center justify-center overflow-hidden shadow-lg ring-4 ring-emerald-100 aspect-square">
                    @if($profile && $profile->company_logo)
                        <img src="{{ asset($profile->company_logo) }}" alt="Logo" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="w-full h-full bg-gradient-to-br from-emerald-400 to-teal-600 flex items-center justify-center hidden">
                            <i class="fas fa-building text-white text-6xl"></i>
                        </div>
                    @else
                        <i class="fas fa-building text-white text-6xl"></i>
                    @endif
                </div>
                <p class="text-xs text-gray-600 text-center mt-3">This logo will appear on your profile and in search results</p>
            </div>

            <!-- Profile Completion -->
            <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-chart-pie text-emerald-600 mr-2"></i>Profile Completion
                </h3>
                <div class="space-y-3">
                    @php
                        $completionItems = [
                            ['label' => 'Company logo', 'completed' => $profile && $profile->company_logo],
                            ['label' => 'Company name', 'completed' => $profile && $profile->company_name],
                            ['label' => 'Industry', 'completed' => $profile && $profile->industry],
                            ['label' => 'Contact details', 'completed' => auth()->user()->email && auth()->user()->phone],
                            ['label' => 'Website', 'completed' => $profile && $profile->company_website],
                            ['label' => 'Company description', 'completed' => $profile && $profile->company_description],
                            ['label' => 'Tax ID', 'completed' => $profile && $profile->tax_id],
                        ];
                    @endphp
                    @foreach($completionItems as $item)
                    <div class="flex items-center gap-3">
                        <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full {{ $item['completed'] ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white' : 'border border-gray-300 bg-gray-50 text-gray-400' }}">
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
                        <span class="text-emerald-600 font-bold">•</span>
                        <span>Use a professional company logo</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-600 font-bold">•</span>
                        <span>Complete profiles get 3x more views</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-600 font-bold">•</span>
                        <span>Write a compelling company description</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-600 font-bold">•</span>
                        <span>Keep your contact information updated</span>
                    </li>
                </ul>
            </div>

            <!-- Verification Status -->
            <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-shield-alt text-emerald-600 mr-2"></i>Verification Status
                </h3>
                @if($profile && $profile->verified_by_admin)
                    <div class="flex items-center gap-3 p-3 bg-emerald-50 rounded-lg border border-emerald-200">
                        <i class="fas fa-check-circle text-emerald-600 text-xl"></i>
                        <div>
                            <p class="font-semibold text-emerald-900 text-sm">Verified</p>
                            <p class="text-xs text-emerald-700">Your company is verified by admin</p>
                        </div>
                    </div>
                @else
                    <div class="flex items-center gap-3 p-3 bg-yellow-50 rounded-lg border border-yellow-200">
                        <i class="fas fa-clock text-yellow-600 text-xl"></i>
                        <div>
                            <p class="font-semibold text-yellow-900 text-sm">Pending</p>
                            <p class="text-xs text-yellow-700">Awaiting admin verification</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function previewCompanyLogo(input) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('logo-preview-image').src = e.target.result;
            document.getElementById('logo-preview-container').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
}

function clearLogoPreview() {
    document.getElementById('company_logo').value = '';
    document.getElementById('logo-preview-container').classList.add('hidden');
}
</script>
@endsection
