@extends('layouts.jobseeker')

@section('title', 'My Resume')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-teal-600 to-cyan-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-teal-600 to-cyan-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                        <i class="fas fa-file-pdf text-white text-xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">My Resume</h1>
                    <p class="text-gray-600 text-sm font-medium">Manage and upload your resume</p>
                </div>
            </div>
            <a href="#upload-section" class="px-5 py-2.5 bg-gradient-to-r from-teal-600 to-cyan-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 text-sm font-bold flex items-center justify-center gap-2">
                <i class="fas fa-upload"></i>Upload Resume
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-teal-600">
            <p class="text-xs text-gray-600 font-semibold uppercase">Total Resumes</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $profile?->cv_path ? 1 : 0 }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-green-500">
            <p class="text-xs text-gray-600 font-semibold uppercase">Active</p>
            <p class="text-2xl font-bold text-green-600 mt-1">{{ $profile?->cv_path ? 1 : 0 }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-blue-500">
            <p class="text-xs text-gray-600 font-semibold uppercase">Used In</p>
            <p class="text-2xl font-bold text-blue-600 mt-1">{{ auth()->user()->applications()->count() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-orange-500">
            <p class="text-xs text-gray-600 font-semibold uppercase">Last Updated</p>
            <p class="text-2xl font-bold text-orange-600 mt-1">{{ $profile?->updated_at?->format('M d') ?? 'N/A' }}</p>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            <!-- Active Resume -->
            @if($profile?->cv_path)
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="fas fa-file-pdf text-teal-600 mr-2"></i>Active Resume
                    </h3>
                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold bg-green-100 text-green-800">
                        <i class="fas fa-check-circle mr-1"></i>Active
                    </span>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-lg bg-teal-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-file-pdf text-teal-600 text-lg"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Resume</p>
                                <p class="text-xs text-gray-600">{{ $profile?->updated_at?->format('M d, Y') ?? 'Not set' }}</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ asset($profile->cv_path) }}" download class="px-3 py-2 bg-teal-600 text-white rounded-lg text-xs font-semibold hover:bg-teal-700 transition">
                                <i class="fas fa-download mr-1"></i>Download
                            </a>
                            <a href="{{ asset($profile->cv_path) }}" target="_blank" class="px-3 py-2 bg-white text-teal-600 border border-teal-200 rounded-lg text-xs font-semibold hover:bg-teal-50 transition">
                                <i class="fas fa-eye mr-1"></i>Preview
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="fas fa-file-pdf text-teal-600 mr-2"></i>Active Resume
                    </h3>
                </div>
                <div class="text-center py-8">
                    <i class="fas fa-file-pdf text-4xl text-gray-300 mb-3 block"></i>
                    <p class="text-gray-600">No resume uploaded yet</p>
                    <p class="text-sm text-gray-500 mt-1">Upload a resume to get started</p>
                </div>
            </div>
            @endif

            <!-- Upload New Resume -->
            <div id="upload-section" class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-cloud-upload-alt text-teal-600 mr-2"></i>Upload New Resume
                </h3>
                
                <form action="{{ route('seeker.resume.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    
                    <div class="border-2 border-dashed border-teal-300 rounded-lg p-8 text-center hover:border-teal-500 transition cursor-pointer bg-teal-50/50" onclick="document.getElementById('resumeInput').click()">
                        <i class="fas fa-file-upload text-5xl text-teal-400 mb-3 block"></i>
                        <p class="text-lg font-semibold text-gray-900 mb-1">Drag and drop your resume here</p>
                        <p class="text-gray-600 text-sm">or click to browse</p>
                        <p class="text-xs text-gray-500 mt-2">Supported formats: PDF, DOC, DOCX (Max 5 MB)</p>
                        <input type="file" id="resumeInput" name="cv" accept=".pdf,.doc,.docx" class="hidden" onchange="updateFileName(this)">
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gray-700 mb-2">Selected File</p>
                        <p id="fileName" class="text-sm text-gray-600 px-4 py-2 bg-gray-50 rounded-lg border border-gray-200">No file selected</p>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="flex-1 px-4 py-2.5 bg-gradient-to-r from-teal-600 to-cyan-600 text-white rounded-lg font-semibold hover:shadow-lg transition-all duration-300 text-sm">
                            <i class="fas fa-upload mr-2"></i>Upload Resume
                        </button>
                        <button type="reset" class="flex-1 px-4 py-2.5 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition text-sm">
                            <i class="fas fa-times mr-2"></i>Clear
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Resume Info -->
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-teal-600 mr-2"></i>Resume Info
                </h3>
                <div class="space-y-3">
                    <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                        <p class="text-xs text-gray-600 font-semibold uppercase mb-1">Status</p>
                        @if($profile?->cv_path)
                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                <i class="fas fa-check-circle"></i>Active
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-semibold">
                                <i class="fas fa-circle"></i>Not Set
                            </span>
                        @endif
                    </div>
                    <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                        <p class="text-xs text-gray-600 font-semibold uppercase mb-1">Last Updated</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $profile?->updated_at?->format('M d, Y') ?? 'Never' }}</p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                        <p class="text-xs text-gray-600 font-semibold uppercase mb-1">Used In Applications</p>
                        <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->applications()->count() }}</p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                        <p class="text-xs text-gray-600 font-semibold uppercase mb-1">File Format</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $profile?->cv_path ? strtoupper(pathinfo($profile->cv_path, PATHINFO_EXTENSION)) : 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Tips -->
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>Tips
                </h3>
                <div class="space-y-3 text-sm">
                    <div class="flex gap-2">
                        <i class="fas fa-check text-green-600 flex-shrink-0 mt-0.5"></i>
                        <p class="text-gray-700">Keep your resume updated regularly</p>
                    </div>
                    <div class="flex gap-2">
                        <i class="fas fa-check text-green-600 flex-shrink-0 mt-0.5"></i>
                        <p class="text-gray-700">Use PDF format for better compatibility</p>
                    </div>
                    <div class="flex gap-2">
                        <i class="fas fa-check text-green-600 flex-shrink-0 mt-0.5"></i>
                        <p class="text-gray-700">Keep file size under 5 MB</p>
                    </div>
                    <div class="flex gap-2">
                        <i class="fas fa-check text-green-600 flex-shrink-0 mt-0.5"></i>
                        <p class="text-gray-700">Include relevant keywords</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-lightning-bolt text-teal-600 mr-2"></i>Quick Actions
                </h3>
                <div class="space-y-2">
                    @if($profile?->cv_path)
                    <a href="{{ asset($profile->cv_path) }}" download class="flex items-center gap-3 p-3 hover:bg-teal-50 rounded-lg transition border border-gray-100 cursor-pointer">
                        <div class="w-8 h-8 rounded-lg bg-teal-100 flex items-center justify-center">
                            <i class="fas fa-download text-teal-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Download Resume</p>
                            <p class="text-xs text-gray-500">Save to your device</p>
                        </div>
                    </a>
                    <a href="{{ asset($profile->cv_path) }}" target="_blank" class="flex items-center gap-3 p-3 hover:bg-blue-50 rounded-lg transition border border-gray-100 cursor-pointer">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-eye text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Preview Resume</p>
                            <p class="text-xs text-gray-500">View in browser</p>
                        </div>
                    </a>
                    @endif
                    <a href="{{ route('seeker.profile.edit') }}" class="flex items-center gap-3 p-3 hover:bg-purple-50 rounded-lg transition border border-gray-100 cursor-pointer">
                        <div class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center">
                            <i class="fas fa-edit text-purple-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Edit Profile</p>
                            <p class="text-xs text-gray-500">Update your info</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updateFileName(input) {
    const fileName = document.getElementById('fileName');
    if (input.files && input.files[0]) {
        fileName.textContent = input.files[0].name + ' (' + (input.files[0].size / 1024 / 1024).toFixed(2) + ' MB)';
    } else {
        fileName.textContent = 'No file selected';
    }
}
</script>
@endsection
