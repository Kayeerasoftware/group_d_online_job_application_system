@extends('layouts.jobseeker')

@section('title', 'My Resume')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
            <div class="flex items-center gap-2 md:gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-red-600 to-pink-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-red-600 to-pink-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                        <i class="fas fa-file-pdf text-white text-xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-red-600 via-pink-600 to-orange-600 bg-clip-text text-transparent mb-1 md:mb-2">My Resume</h1>
                    <p class="text-gray-600 text-xs md:text-sm font-medium">Manage and upload your resume</p>
                </div>
            </div>
            <button class="px-3 md:px-5 py-2 md:py-2.5 bg-gradient-to-r from-red-600 to-pink-600 text-white rounded-lg md:rounded-xl hover:shadow-lg transition-all duration-300 text-xs md:text-sm font-bold flex items-center justify-center gap-1 md:gap-2 transform hover:scale-105">
                <i class="fas fa-upload"></i><span class="hidden sm:inline">Upload Resume</span>
            </button>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-green-500 to-green-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-green-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Resume...</span>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-3 mb-3 md:mb-4">
        <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-red-100 text-[8px] md:text-[10px] font-medium mb-0.5">Total Resumes</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $totalResumes ?? 3 }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-file-pdf text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-pink-100 text-[8px] md:text-[10px] font-medium mb-0.5">Active Resume</p>
                    <h3 class="text-base md:text-xl font-bold">1</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-check-circle text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-[8px] md:text-[10px] font-medium mb-0.5">Used In</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $usedInApplications ?? 24 }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-file-alt text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-100 text-[8px] md:text-[10px] font-medium mb-0.5">Last Updated</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $lastUpdated ?? '15 Dec' }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-calendar text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Resume -->
    <div class="bg-white rounded-xl shadow-xl p-6 border-l-4 border-green-600 mb-6">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Active Resume</h2>
                <p class="text-gray-600">This resume is being used for all your applications</p>
            </div>
            <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full font-semibold text-sm">Active</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Resume Preview -->
            <div class="md:col-span-2">
                <div class="bg-gray-100 rounded-lg p-6 h-96 flex items-center justify-center border-2 border-dashed border-gray-300">
                    <div class="text-center">
                        <i class="fas fa-file-pdf text-red-600 text-6xl mb-4"></i>
                        <p class="text-gray-600 font-semibold mb-2">Resume_2024.pdf</p>
                        <p class="text-sm text-gray-500">Uploaded on December 15, 2024</p>
                    </div>
                </div>
            </div>

            <!-- Resume Details -->
            <div class="space-y-4">
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600 font-semibold mb-1">File Name</p>
                    <p class="text-gray-900 font-semibold">Resume_2024.pdf</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600 font-semibold mb-1">File Size</p>
                    <p class="text-gray-900 font-semibold">2.4 MB</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600 font-semibold mb-1">Uploaded</p>
                    <p class="text-gray-900 font-semibold">December 15, 2024</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600 font-semibold mb-1">Used In</p>
                    <p class="text-gray-900 font-semibold">24 Applications</p>
                </div>
                <div class="flex gap-2">
                    <button class="flex-1 px-4 py-2 bg-gradient-to-r from-red-600 to-pink-600 text-white rounded-lg font-semibold hover:shadow-lg transition text-sm">
                        <i class="fas fa-download mr-2"></i>Download
                    </button>
                    <button class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition text-sm">
                        <i class="fas fa-eye mr-2"></i>Preview
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Resume Versions -->
    <div class="bg-white rounded-xl shadow-xl p-6 mb-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
            <i class="fas fa-history text-gray-600 mr-3"></i>Resume Versions
        </h2>

        <div class="space-y-4">
            <!-- Version 1 -->
            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-lg bg-red-100 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-file-pdf text-red-600 text-lg"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Resume_2024.pdf</p>
                            <p class="text-sm text-gray-600">Uploaded on December 15, 2024 • 2.4 MB</p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition text-sm">
                            <i class="fas fa-check mr-2"></i>Set Active
                        </button>
                        <button class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition text-sm">
                            <i class="fas fa-download mr-2"></i>Download
                        </button>
                        <button class="px-4 py-2 border border-red-300 text-red-600 rounded-lg font-semibold hover:bg-red-50 transition text-sm">
                            <i class="fas fa-trash mr-2"></i>Delete
                        </button>
                    </div>
                </div>
            </div>

            <!-- Version 2 -->
            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition opacity-75">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-lg bg-red-100 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-file-pdf text-red-600 text-lg"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Resume_2024_v2.pdf</p>
                            <p class="text-sm text-gray-600">Uploaded on December 10, 2024 • 2.3 MB</p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition text-sm">
                            <i class="fas fa-check mr-2"></i>Set Active
                        </button>
                        <button class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition text-sm">
                            <i class="fas fa-download mr-2"></i>Download
                        </button>
                        <button class="px-4 py-2 border border-red-300 text-red-600 rounded-lg font-semibold hover:bg-red-50 transition text-sm">
                            <i class="fas fa-trash mr-2"></i>Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload New Resume -->
    <div class="bg-white rounded-xl shadow-xl p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
            <i class="fas fa-cloud-upload-alt text-blue-600 mr-3"></i>Upload New Resume
        </h2>

        <div class="border-2 border-dashed border-gray-300 rounded-lg p-12 text-center hover:border-blue-500 transition cursor-pointer">
            <i class="fas fa-file-upload text-6xl text-gray-400 mb-4"></i>
            <p class="text-lg font-semibold text-gray-900 mb-2">Drag and drop your resume here</p>
            <p class="text-gray-600 mb-4">or click to browse</p>
            <p class="text-sm text-gray-500">Supported formats: PDF, DOC, DOCX (Max 5 MB)</p>
        </div>

        <div class="mt-6 space-y-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Resume Title (Optional)</label>
                <input type="text" placeholder="e.g., Senior Developer Resume" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
            </div>
            <div class="flex gap-2">
                <button class="flex-1 px-6 py-3 bg-gradient-to-r from-red-600 to-pink-600 text-white rounded-lg font-semibold hover:shadow-lg transition">
                    <i class="fas fa-upload mr-2"></i>Upload Resume
                </button>
                <button class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition">
                    <i class="fas fa-times mr-2"></i>Cancel
                </button>
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
