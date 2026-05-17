@extends('layouts.employer')

@section('title', 'Create Job')

@section('content')
<div class="space-y-6 p-3 md:p-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg shadow-lg p-6">
        <div class="flex items-center gap-4">
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                <div class="relative bg-gradient-to-br from-blue-600 to-cyan-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                    <i class="fas fa-plus text-white text-xl md:text-3xl"></i>
                </div>
            </div>
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-white">Create Job Posting</h1>
                <p class="text-blue-100 text-sm mt-1">Post a new job listing</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
        <form action="{{ route('jobs.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Job Title -->
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Job Title *</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="e.g., Senior Software Engineer">
                @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Location -->
            <div>
                <label for="location" class="block text-sm font-semibold text-gray-700 mb-2">Location *</label>
                <input type="text" id="location" name="location" value="{{ old('location') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="e.g., Kampala, Uganda">
                @error('location')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Job Type -->
            <div>
                <label for="job_type" class="block text-sm font-semibold text-gray-700 mb-2">Job Type *</label>
                <select id="job_type" name="job_type" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Select Job Type</option>
                    <option value="full-time" {{ old('job_type') === 'full-time' ? 'selected' : '' }}>Full-time</option>
                    <option value="part-time" {{ old('job_type') === 'part-time' ? 'selected' : '' }}>Part-time</option>
                    <option value="contract" {{ old('job_type') === 'contract' ? 'selected' : '' }}>Contract</option>
                    <option value="freelance" {{ old('job_type') === 'freelance' ? 'selected' : '' }}>Freelance</option>
                    <option value="internship" {{ old('job_type') === 'internship' ? 'selected' : '' }}>Internship</option>
                </select>
                @error('job_type')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Job Description *</label>
                <textarea id="description" name="description" required rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Describe the job role, responsibilities, and what you're looking for...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Requirements -->
            <div>
                <label for="requirements" class="block text-sm font-semibold text-gray-700 mb-2">Requirements *</label>
                <textarea id="requirements" name="requirements" required rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="List the required skills, experience, and qualifications...">{{ old('requirements') }}</textarea>
                @error('requirements')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Salary Range -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="salary_min" class="block text-sm font-semibold text-gray-700 mb-2">Minimum Salary (UGX)</label>
                    <input type="number" id="salary_min" name="salary_min" value="{{ old('salary_min') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="e.g., 1000000">
                    @error('salary_min')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="salary_max" class="block text-sm font-semibold text-gray-700 mb-2">Maximum Salary (UGX)</label>
                    <input type="number" id="salary_max" name="salary_max" value="{{ old('salary_max') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="e.g., 3000000">
                    @error('salary_max')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Deadline -->
            <div>
                <label for="deadline" class="block text-sm font-semibold text-gray-700 mb-2">Application Deadline</label>
                <input type="datetime-local" id="deadline" name="deadline" value="{{ old('deadline') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('deadline')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex gap-3 pt-6 border-t border-gray-200">
                <button type="submit" class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition flex items-center justify-center gap-2">
                    <i class="fas fa-check"></i>Post Job
                </button>
                <a href="{{ route('jobs.index') }}" class="flex-1 px-6 py-3 bg-gray-200 text-gray-800 rounded-lg font-semibold hover:bg-gray-300 transition text-center flex items-center justify-center gap-2">
                    <i class="fas fa-times"></i>Cancel
                </a>
            </div>
        </form>
    </div>

    <!-- Help Section -->
    <div class="bg-blue-50 rounded-xl shadow-lg p-6 border border-blue-200">
        <h3 class="text-lg font-bold text-blue-900 mb-4 flex items-center">
            <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>Tips for Better Job Postings
        </h3>
        <ul class="space-y-3 text-sm text-blue-800">
            <li class="flex gap-2">
                <i class="fas fa-check-circle text-green-600 flex-shrink-0 mt-0.5"></i>
                <span>Write a clear and detailed job description</span>
            </li>
            <li class="flex gap-2">
                <i class="fas fa-check-circle text-green-600 flex-shrink-0 mt-0.5"></i>
                <span>List specific skills and qualifications required</span>
            </li>
            <li class="flex gap-2">
                <i class="fas fa-check-circle text-green-600 flex-shrink-0 mt-0.5"></i>
                <span>Include a competitive salary range</span>
            </li>
            <li class="flex gap-2">
                <i class="fas fa-check-circle text-green-600 flex-shrink-0 mt-0.5"></i>
                <span>Set a reasonable application deadline</span>
            </li>
        </ul>
    </div>
</div>
@endsection
