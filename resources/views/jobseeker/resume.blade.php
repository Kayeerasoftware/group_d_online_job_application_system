@extends('layouts.jobseeker')

@section('title', 'My Resume')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-red-600 to-pink-600 rounded-lg shadow-lg p-6">
        <div>
            <h1 class="text-3xl font-bold text-white mb-2">My Resume</h1>
            <p class="text-red-100">Manage your CV and resume documents</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Current Resume -->
            @if($profile && $profile->cv_path)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-file-pdf text-red-600 mr-2"></i>Current Resume
                </h2>
                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <div class="text-4xl text-red-600">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-900">{{ basename($profile->cv_path) }}</p>
                        <p class="text-sm text-gray-600">Uploaded on {{ $profile->updated_at->format('M d, Y') }}</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ Storage::url($profile->cv_path) }}" target="_blank" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition text-sm">
                            <i class="fas fa-download mr-1"></i>Download
                        </a>
                        <a href="{{ route('seeker.profile.edit') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition text-sm">
                            <i class="fas fa-edit mr-1"></i>Replace
                        </a>
                    </div>
                </div>
            </div>
            @else
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-file-pdf text-red-600 mr-2"></i>No Resume Uploaded
                </h2>
                <p class="text-gray-600 mb-4">Upload your resume to make it easier for employers to review your qualifications.</p>
                <a href="{{ route('seeker.profile.edit') }}" class="inline-block px-6 py-3 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition">
                    <i class="fas fa-upload mr-2"></i>Upload Resume
                </a>
            </div>
            @endif

            <!-- Resume Tips -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>Resume Tips
                </h2>
                <div class="space-y-3">
                    <div class="flex gap-3">
                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-sm font-bold">✓</div>
                        <div>
                            <p class="font-semibold text-gray-900">Keep it concise</p>
                            <p class="text-sm text-gray-600">Limit your resume to 1-2 pages for easier reading</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-sm font-bold">✓</div>
                        <div>
                            <p class="font-semibold text-gray-900">Use clear formatting</p>
                            <p class="text-sm text-gray-600">Use bullet points and clear sections for better readability</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-sm font-bold">✓</div>
                        <div>
                            <p class="font-semibold text-gray-900">Highlight achievements</p>
                            <p class="text-sm text-gray-600">Focus on accomplishments and measurable results</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-sm font-bold">✓</div>
                        <div>
                            <p class="font-semibold text-gray-900">Tailor for each job</p>
                            <p class="text-sm text-gray-600">Customize your resume for each position you apply to</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-sm font-bold">✓</div>
                        <div>
                            <p class="font-semibold text-gray-900">Proofread carefully</p>
                            <p class="text-sm text-gray-600">Check for spelling and grammar errors before uploading</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Resume Stats -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Resume Stats</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Profile Views</span>
                        <span class="text-2xl font-bold text-blue-600">{{ $profile->views_count ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Applications</span>
                        <span class="text-2xl font-bold text-green-600">{{ auth()->user()->applications()->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Interviews</span>
                        <span class="text-2xl font-bold text-orange-600">{{ auth()->user()->applications()->where('status', 'interview')->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- File Requirements -->
            <div class="bg-blue-50 rounded-xl shadow-lg p-6 border border-blue-200">
                <h3 class="text-lg font-bold text-blue-900 mb-4">
                    <i class="fas fa-info-circle mr-2"></i>File Requirements
                </h3>
                <ul class="space-y-2 text-sm text-blue-800">
                    <li><strong>Formats:</strong> PDF, DOC, DOCX</li>
                    <li><strong>Max Size:</strong> 5 MB</li>
                    <li><strong>Recommended:</strong> PDF format</li>
                    <li><strong>Naming:</strong> Use your full name</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
