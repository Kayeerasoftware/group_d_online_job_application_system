@extends('layouts.jobseeker')

@section('title', 'Apply for Job')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Page Header -->
    <div class="mb-6">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('seeker.browse-jobs') }}" class="text-teal-600 hover:text-teal-700 flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>Back to Jobs
            </a>
        </div>
        <div class="bg-gradient-to-r from-teal-600 to-cyan-600 rounded-2xl shadow-lg p-6 md:p-8">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Apply for a Job</h1>
            <p class="text-teal-100">{{ $job ? 'You are applying for ' . $job->title . '. Keep your cover letter focused and professional.' : 'Choose a role and complete your application.' }}</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">
            <p class="text-sm font-medium text-red-800 mb-2">Please fix the following errors:</p>
            <ul class="list-disc list-inside text-sm text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Application Form -->
    <form method="post" action="{{ route('seeker.applications.store') }}" enctype="multipart/form-data" class="grid gap-6 lg:grid-cols-3">
        @csrf
        <input type="hidden" name="job_id" value="{{ $job?->id }}">

        <!-- Main Form Section -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Cover Letter -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-pen-fancy text-teal-600 mr-3"></i>Cover Letter
                </h2>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Your Message *</label>
                    <textarea 
                        name="cover_letter" 
                        rows="10"
                        placeholder="Write a short message introducing your skills and why you are a good fit for this position. Keep it professional and concise."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent outline-none transition resize-none"
                        required
                    >{{ old('cover_letter') }}</textarea>
                    @error('cover_letter')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <div class="flex justify-between items-center mt-2">
                        <p class="text-sm text-gray-500">Tip: Personalize your cover letter for each application to increase your chances.</p>
                        <span class="text-xs text-gray-400" id="char-count">0 / 2000</span>
                    </div>
                </div>
            </div>

            <!-- Documents Section -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-file-upload text-teal-600 mr-3"></i>Documents
                </h2>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">CV / Resume</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-teal-500 hover:bg-teal-50 transition cursor-pointer" id="upload-area">
                        <input 
                            type="file" 
                            name="cv_path" 
                            accept=".pdf,.doc,.docx"
                            id="cv_upload"
                            class="hidden"
                        >
                        <label for="cv_upload" class="cursor-pointer block">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3 block"></i>
                            <p class="text-gray-700 font-semibold">Click to upload or drag and drop</p>
                            <p class="text-sm text-gray-500 mt-1">PDF, DOC, or DOCX (Max 5MB)</p>
                        </label>
                        <div id="file-info" class="mt-4 hidden">
                            <p class="text-sm text-teal-600 font-medium" id="file-name"></p>
                            <button type="button" onclick="clearFile()" class="text-xs text-red-600 hover:text-red-700 font-medium mt-2">Remove File</button>
                        </div>
                    </div>
                    @error('cv_path')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-2">You can also use the CV from your profile if you have one uploaded.</p>
                </div>
            </div>

            <!-- Profile CV Option -->
            @if($userProfile && $userProfile->cv_path)
            <div class="bg-teal-50 rounded-xl border border-teal-200 p-6">
                <h3 class="text-lg font-bold text-teal-900 mb-3 flex items-center">
                    <i class="fas fa-check-circle text-teal-600 mr-2"></i>Use Profile CV
                </h3>
                <p class="text-sm text-teal-800 mb-3">You have a CV uploaded in your profile. You can use it for this application or upload a different one above.</p>
                <div class="flex items-center gap-3 bg-white rounded-lg p-3 border border-teal-200">
                    <i class="fas fa-file-pdf text-red-600 text-lg"></i>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">{{ basename($userProfile->cv_path) }}</p>
                        <p class="text-xs text-gray-500">From your profile</p>
                    </div>
                    <a href="{{ asset($userProfile->cv_path) }}" target="_blank" class="text-xs text-teal-600 hover:text-teal-700 font-medium">View</a>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Job Details -->
            @if($job)
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-briefcase text-teal-600 mr-2"></i>Job Details
                </h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Position</p>
                        <p class="text-lg font-bold text-gray-900 mt-1">{{ $job->title }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Company</p>
                        <p class="text-lg font-bold text-gray-900 mt-1">{{ $job->employer?->employerProfile?->company_name ?? $job->employer?->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Location</p>
                        <p class="text-lg font-bold text-gray-900 mt-1">{{ $job->location }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Job Type</p>
                        <p class="text-lg font-bold text-gray-900 mt-1">{{ $job->job_type ?? 'Not specified' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Salary Range</p>
                        <p class="text-lg font-bold text-gray-900 mt-1">{{ $job->salary_range ?? 'Competitive' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Deadline</p>
                        <p class="text-lg font-bold text-gray-900 mt-1">{{ optional($job->deadline)->format('F d, Y') ?? 'No deadline' }}</p>
                    </div>
                </div>
            </div>
            @else
            <div class="bg-yellow-50 rounded-xl border border-yellow-200 p-6">
                <p class="text-sm text-yellow-800">No job selected. Please go back and select a job to apply for.</p>
            </div>
            @endif

            <!-- Application Tips -->
            <div class="bg-gradient-to-br from-teal-50 to-cyan-50 rounded-xl shadow-lg p-6 border border-teal-200">
                <h3 class="text-lg font-bold text-teal-900 mb-4 flex items-center">
                    <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>Tips for Success
                </h3>
                <ul class="space-y-3 text-sm text-teal-800">
                    <li class="flex gap-2">
                        <i class="fas fa-check-circle text-green-600 flex-shrink-0 mt-0.5"></i>
                        <span>Personalize your cover letter for this specific job</span>
                    </li>
                    <li class="flex gap-2">
                        <i class="fas fa-check-circle text-green-600 flex-shrink-0 mt-0.5"></i>
                        <span>Highlight relevant skills and experience</span>
                    </li>
                    <li class="flex gap-2">
                        <i class="fas fa-check-circle text-green-600 flex-shrink-0 mt-0.5"></i>
                        <span>Use a professional, up-to-date resume</span>
                    </li>
                    <li class="flex gap-2">
                        <i class="fas fa-check-circle text-green-600 flex-shrink-0 mt-0.5"></i>
                        <span>Proofread everything before submitting</span>
                    </li>
                    <li class="flex gap-2">
                        <i class="fas fa-check-circle text-green-600 flex-shrink-0 mt-0.5"></i>
                        <span>Apply early - don't wait until the deadline</span>
                    </li>
                </ul>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <button 
                    type="submit"
                    class="w-full px-6 py-3 bg-gradient-to-r from-teal-600 to-cyan-600 text-white rounded-lg font-semibold hover:shadow-lg transition flex items-center justify-center gap-2"
                >
                    <i class="fas fa-paper-plane"></i>Submit Application
                </button>
                <a 
                    href="{{ route('seeker.browse-jobs') }}"
                    class="w-full px-6 py-3 bg-gray-200 text-gray-800 rounded-lg font-semibold hover:bg-gray-300 transition flex items-center justify-center gap-2"
                >
                    <i class="fas fa-times"></i>Cancel
                </a>
            </div>
        </div>
    </form>
</div>

<script>
// Character counter for cover letter
const coverLetterTextarea = document.querySelector('textarea[name="cover_letter"]');
const charCount = document.getElementById('char-count');

if (coverLetterTextarea) {
    coverLetterTextarea.addEventListener('input', function() {
        charCount.textContent = this.value.length + ' / 2000';
    });
    // Initialize on page load
    charCount.textContent = coverLetterTextarea.value.length + ' / 2000';
}

// File upload handling
const cvUpload = document.getElementById('cv_upload');
const uploadArea = document.getElementById('upload-area');
const fileInfo = document.getElementById('file-info');
const fileName = document.getElementById('file-name');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    uploadArea.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    uploadArea.addEventListener(eventName, () => {
        uploadArea.classList.add('border-teal-500', 'bg-teal-50');
    });
});

['dragleave', 'drop'].forEach(eventName => {
    uploadArea.addEventListener(eventName, () => {
        uploadArea.classList.remove('border-teal-500', 'bg-teal-50');
    });
});

uploadArea.addEventListener('drop', (e) => {
    const dt = e.dataTransfer;
    const files = dt.files;
    cvUpload.files = files;
    updateFileInfo();
});

cvUpload.addEventListener('change', updateFileInfo);

function updateFileInfo() {
    if (cvUpload.files.length > 0) {
        const file = cvUpload.files[0];
        fileName.textContent = '✓ ' + file.name + ' (' + (file.size / 1024).toFixed(2) + ' KB)';
        fileInfo.classList.remove('hidden');
    } else {
        fileInfo.classList.add('hidden');
    }
}

function clearFile() {
    cvUpload.value = '';
    fileInfo.classList.add('hidden');
}
</script>
@endsection
