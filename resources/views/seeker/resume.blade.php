@extends('layouts.jobseeker')

@section('title', 'My Resume')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-red-600 to-pink-600 rounded-lg shadow-lg p-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">My Resume</h1>
                <p class="text-red-100">Manage and upload your resume</p>
            </div>
            <button class="px-6 py-3 bg-white text-red-600 rounded-lg font-semibold hover:bg-red-50 transition">
                <i class="fas fa-upload mr-2"></i>Upload New Resume
            </button>
        </div>
    </div>

    <!-- Active Resume -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-600">
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
                    <button class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition text-sm">
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
    <div class="bg-white rounded-xl shadow-lg p-6">
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

            <!-- Version 3 -->
            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition opacity-75">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-lg bg-red-100 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-file-pdf text-red-600 text-lg"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Resume_2024_v1.pdf</p>
                            <p class="text-sm text-gray-600">Uploaded on December 5, 2024 • 2.2 MB</p>
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
    <div class="bg-white rounded-xl shadow-lg p-6">
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
                <input type="text" placeholder="e.g., Senior Developer Resume" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="flex gap-2">
                <button class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                    <i class="fas fa-upload mr-2"></i>Upload Resume
                </button>
                <button class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition">
                    <i class="fas fa-times mr-2"></i>Cancel
                </button>
            </div>
        </div>
    </div>

    <!-- Resume Tips -->
    <div class="bg-blue-50 rounded-xl shadow-lg p-6 border-l-4 border-blue-600">
        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
            <i class="fas fa-lightbulb text-yellow-500 mr-3"></i>Resume Tips
        </h2>
        <ul class="space-y-3 text-gray-700">
            <li class="flex items-start gap-3">
                <i class="fas fa-check text-green-600 mt-1 flex-shrink-0"></i>
                <span>Keep your resume to 1-2 pages for easier reading</span>
            </li>
            <li class="flex items-start gap-3">
                <i class="fas fa-check text-green-600 mt-1 flex-shrink-0"></i>
                <span>Use clear formatting and consistent fonts</span>
            </li>
            <li class="flex items-start gap-3">
                <i class="fas fa-check text-green-600 mt-1 flex-shrink-0"></i>
                <span>Highlight relevant skills and achievements</span>
            </li>
            <li class="flex items-start gap-3">
                <i class="fas fa-check text-green-600 mt-1 flex-shrink-0"></i>
                <span>Include contact information and professional links</span>
            </li>
            <li class="flex items-start gap-3">
                <i class="fas fa-check text-green-600 mt-1 flex-shrink-0"></i>
                <span>Proofread for spelling and grammar errors</span>
            </li>
        </ul>
    </div>
</div>
@endsection
