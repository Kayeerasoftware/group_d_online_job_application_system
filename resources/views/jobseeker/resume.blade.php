@extends('layouts.jobseeker')

@section('title', 'Resumes & Cover Letters')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-green-600 to-emerald-600 rounded-lg shadow-lg p-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Resumes & Cover Letters</h1>
                <p class="text-green-100">Manage your application documents</p>
            </div>
            <button class="px-6 py-3 bg-white text-green-600 rounded-lg font-semibold hover:bg-gray-100 transition" title="Upload resume feature coming soon">
                <i class="fas fa-plus mr-2"></i>Add New
            </button>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-6">
        <div class="h-full bg-gradient-to-r from-green-500 to-green-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-green-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Resumes...</span>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-3 mb-6">
        <!-- Total Resumes -->
        <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-green-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-green-500 to-green-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-file-pdf text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Resumes</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">0</h3>
                </div>
            </div>
        </div>

        <!-- Cover Letters -->
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-blue-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-file-word text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Cover Letters</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">0</h3>
                </div>
            </div>
        </div>

        <!-- Default Resume -->
        <div class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-purple-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-check-circle text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Default</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">Set</h3>
                </div>
            </div>
        </div>

        <!-- Last Updated -->
        <div class="bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-orange-200">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-2 md:p-2.5 rounded-lg shadow">
                    <i class="fas fa-calendar text-white text-base md:text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Updated</p>
                    <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">Never</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="bg-white rounded-xl shadow-lg p-4">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('seeker.resume') }}" class="px-4 py-2 rounded-lg font-semibold transition {{ !request('tab') || request('tab') === 'resumes' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                <i class="fas fa-file-pdf mr-2"></i>Resumes
            </a>
            <a href="{{ route('seeker.resume', ['tab' => 'cover-letters']) }}" class="px-4 py-2 rounded-lg font-semibold transition {{ request('tab') === 'cover-letters' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                <i class="fas fa-file-word mr-2"></i>Cover Letters
            </a>
        </div>
    </div>

    <!-- Resumes Section -->
    @if(!request('tab') || request('tab') === 'resumes')
    <div class="space-y-4">
        <div class="bg-white rounded-xl shadow-lg p-12 text-center">
            <i class="fas fa-file-pdf text-6xl text-gray-300 mb-4 block"></i>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">No resumes yet</h3>
            <p class="text-gray-600 mb-6">Upload your resume to start applying for jobs</p>
            <button class="inline-block px-6 py-3 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition" title="Upload resume feature coming soon">
                <i class="fas fa-plus mr-2"></i>Upload Resume
            </button>
        </div>
    </div>
    @endif

    <!-- Cover Letters Section -->
    @if(request('tab') === 'cover-letters')
    <div class="space-y-4">
        <div class="bg-white rounded-xl shadow-lg p-12 text-center">
            <i class="fas fa-file-word text-6xl text-gray-300 mb-4 block"></i>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">No cover letters yet</h3>
            <p class="text-gray-600 mb-6">Create cover letters to personalize your applications</p>
            <button class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition" title="Create cover letter feature coming soon">
                <i class="fas fa-plus mr-2"></i>Create Cover Letter
            </button>
        </div>
    </div>
    @endif
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
