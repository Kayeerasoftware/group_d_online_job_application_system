@extends('layouts.jobseeker')

@section('title', 'Apply for Job')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg shadow-lg p-6">
        <h1 class="text-3xl font-bold text-white mb-2">Apply for a Job</h1>
        <p class="text-blue-100">{{ $job ? 'You are applying for ' . $job->title . '. Keep your cover letter focused and professional.' : 'Choose a role and complete your application.' }}</p>
    </div>

    <!-- Application Form -->
    <form method="post" action="{{ route('seeker.applications.store') }}" enctype="multipart/form-data" class="grid gap-6 lg:grid-cols-3">
        @csrf
        <input type="hidden" name="job_id" value="{{ $job?->id }}">

        <!-- Main Form Section -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Cover Letter -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-pen-fancy text-blue-600 mr-3"></i>Cover Letter
                </h2>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Your Message</label>
                    <textarea 
                        name="cover_letter" 
                        rows="10"
                        placeholder="Write a short message introducing your skills and why you are a good fit for this position. Keep it professional and concise."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                    >{{ old('cover_letter') }}</textarea>
                    @error('cover_letter')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-sm text-gray-500 mt-2">Tip: Personalize your cover letter for each application to increase your chances.</p>
                </div>
            </div>

            <!-- Documents Section -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-file-upload text-blue-600 mr-3"></i>Documents
                </h2>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">CV / Resume</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-500 transition cursor-pointer">
                        <input 
                            type="file" 
                            name="cv_path" 
                            accept=".pdf,.doc,.docx"
                            id="cv_upload"
                            class="hidden"
                        >
                        <label for="cv_upload" class="cursor-pointer">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3 block"></i>
                            <p class="text-gray-700 font-semibold">Click to upload or drag and drop</p>
                            <p class="text-sm text-gray-500 mt-1">PDF, DOC, or DOCX (Max 5MB)</p>
                        </label>
                    </div>
                    @error('cv_path')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Job Details -->
            @if($job)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-briefcase text-blue-600 mr-2"></i>Job Details
                </h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Position</p>
                        <p class="text-lg font-bold text-gray-900 mt-1">{{ $job->title }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Company</p>
                        <p class="text-lg font-bold text-gray-900 mt-1">{{ $job->employer?->employerProfile?->company_name ?? $job->employer?->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Location</p>
                        <p class="text-lg font-bold text-gray-900 mt-1">{{ $job->location }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Status</p>
                        <p class="text-lg font-bold text-gray-900 mt-1">{{ $job->statusValue() }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Application Deadline</p>
                        <p class="text-lg font-bold text-gray-900 mt-1">{{ optional($job->deadline)->format('F d, Y') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Application Tips -->
            <div class="bg-blue-50 rounded-xl shadow-lg p-6 border border-blue-200">
                <h3 class="text-lg font-bold text-blue-900 mb-4 flex items-center">
                    <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>Tips
                </h3>
                <ul class="space-y-3 text-sm text-blue-800">
                    <li class="flex gap-2">
                        <i class="fas fa-check-circle text-green-600 flex-shrink-0 mt-0.5"></i>
                        <span>Personalize your cover letter</span>
                    </li>
                    <li class="flex gap-2">
                        <i class="fas fa-check-circle text-green-600 flex-shrink-0 mt-0.5"></i>
                        <span>Highlight relevant skills</span>
                    </li>
                    <li class="flex gap-2">
                        <i class="fas fa-check-circle text-green-600 flex-shrink-0 mt-0.5"></i>
                        <span>Use a professional resume</span>
                    </li>
                    <li class="flex gap-2">
                        <i class="fas fa-check-circle text-green-600 flex-shrink-0 mt-0.5"></i>
                        <span>Proofread before submitting</span>
                    </li>
                </ul>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <button 
                    type="submit"
                    class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition flex items-center justify-center gap-2"
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
    // Drag and drop for CV upload
    const cvUpload = document.getElementById('cv_upload');
    const uploadArea = cvUpload.parentElement.parentElement;

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, () => {
            uploadArea.classList.add('border-blue-500', 'bg-blue-50');
        });
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, () => {
            uploadArea.classList.remove('border-blue-500', 'bg-blue-50');
        });
    });

    uploadArea.addEventListener('drop', (e) => {
        const dt = e.dataTransfer;
        const files = dt.files;
        cvUpload.files = files;
    });
</script>
@endsection
