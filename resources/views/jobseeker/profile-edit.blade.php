@extends('layouts.jobseeker')

@section('title', 'Edit Profile')

@section('content')
@php
    $user = auth()->user();
    $profile = $profile ?? $user->jobSeekerProfile;
    $skillsValue = old('skills', is_array($profile?->skills) ? implode(', ', $profile->skills) : ($profile?->skills ?? ''));
    $resumeName = $profile?->resume_path ? basename($profile->resume_path) : null;
    $hasExperience = !is_null($profile?->years_experience);
    $skillsCount = collect(explode(',', (string) $skillsValue))
        ->map(fn ($skill) => trim((string) $skill))
        ->filter()
        ->count();

    $completionFields = [
        !blank($user->name),
        !blank($user->email),
        !blank($user->phone),
        !blank($profile?->location),
        !blank($profile?->education_level),
        $hasExperience,
        !blank($skillsValue),
        !blank($profile?->resume_path),
    ];

    $profileCompletion = (int) round(collect($completionFields)->filter()->count() / max(count($completionFields), 1) * 100);
    $identityScore = (int) round(collect([$user->name, $user->email, $user->phone])->filter()->count() / 3 * 100);
    $careerScore = (int) round(collect([$profile?->location, $profile?->education_level, $hasExperience ? $profile?->years_experience : null])->filter(fn ($value) => !blank($value))->count() / 3 * 100);
    $skillsScore = min(100, $skillsCount * 20);
    $resumeScore = $resumeName ? 100 : 0;
@endphp

<div class="space-y-6 md:space-y-8">
    <!-- Header Section -->
    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-gradient-to-br from-blue-50 via-white to-slate-50 shadow-lg">
        <div class="grid gap-6 p-6 lg:grid-cols-[1fr_1fr] lg:p-8">
            <!-- Left: Title & Description -->
            <div class="flex flex-col justify-center gap-4">
                <div class="inline-flex w-fit items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-blue-700">
                    <span class="h-2 w-2 rounded-full bg-blue-500"></span>
                    Profile Studio
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-slate-900 sm:text-4xl">Build Your Professional Profile</h1>
                    <p class="mt-2 text-slate-600">Complete your profile to increase visibility to employers and improve your chances of landing your dream job.</p>
                </div>
            </div>

            <!-- Right: Quick Stats -->
            <div class="grid grid-cols-3 gap-3">
                <div class="rounded-xl border border-slate-200 bg-white p-4 text-center shadow-sm">
                    <p class="text-xs font-semibold uppercase text-slate-500">Completion</p>
                    <p class="mt-2 text-2xl font-bold text-slate-900">{{ $profileCompletion }}%</p>
                    <div class="mt-2 h-1.5 rounded-full bg-slate-100">
                        <div class="h-full rounded-full bg-gradient-to-r from-blue-500 to-blue-600" style="width: {{ $profileCompletion }}%"></div>
                    </div>
                </div>
                <div class="rounded-xl border border-slate-200 bg-white p-4 text-center shadow-sm">
                    <p class="text-xs font-semibold uppercase text-slate-500">Skills</p>
                    <p class="mt-2 text-2xl font-bold text-slate-900">{{ $skillsCount }}</p>
                    <p class="mt-2 text-xs text-slate-500">Added</p>
                </div>
                <div class="rounded-xl border border-slate-200 bg-white p-4 text-center shadow-sm">
                    <p class="text-xs font-semibold uppercase text-slate-500">Resume</p>
                    <p class="mt-2 text-2xl font-bold text-slate-900">{{ $resumeName ? '✓' : '○' }}</p>
                    <p class="mt-2 text-xs text-slate-500">{{ $resumeName ? 'Uploaded' : 'Pending' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Form -->
    <form method="post" action="{{ route('seeker.profile.update') }}" enctype="multipart/form-data" class="grid gap-6 lg:grid-cols-[1fr_360px]">
        @csrf
        @method('put')

        <div class="space-y-6">
            <!-- Contact Information Section -->
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-lg">
                <div class="border-b border-slate-100 bg-gradient-to-r from-blue-50 to-blue-100 px-6 py-5">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-blue-500 text-white">
                            <i class="fas fa-user"></i>
                        </span>
                        <div>
                            <h2 class="text-lg font-semibold text-slate-900">Contact Information</h2>
                            <p class="text-sm text-slate-600">Your basic contact details</p>
                        </div>
                    </div>
                </div>

                <div class="grid gap-5 p-6 md:grid-cols-2">
                    <div class="space-y-2">
                        <label class="text-xs font-semibold uppercase tracking-wider text-slate-600">Full Name</label>
                        <input
                            type="text"
                            value="{{ $user->name }}"
                            disabled
                            class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600 cursor-not-allowed"
                        >
                        <p class="text-xs text-slate-500">Managed in account settings</p>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-semibold uppercase tracking-wider text-slate-600">Email</label>
                        <input
                            type="email"
                            value="{{ $user->email }}"
                            disabled
                            class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600 cursor-not-allowed"
                        >
                        <p class="text-xs text-slate-500">Managed in account settings</p>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-semibold uppercase tracking-wider text-slate-600">Phone</label>
                        <input
                            type="tel"
                            value="{{ $user->phone ?? 'Not set' }}"
                            disabled
                            class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600 cursor-not-allowed"
                        >
                        <p class="text-xs text-slate-500">Managed in account settings</p>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-semibold uppercase tracking-wider text-slate-600">Location</label>
                        <input
                            type="text"
                            name="location"
                            value="{{ old('location', $profile?->location) }}"
                            placeholder="e.g., Kampala, Uganda"
                            class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-400 focus:ring-2 focus:ring-blue-100"
                        >
                        @error('location')
                            <p class="text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            <!-- Career Information Section -->
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-lg">
                <div class="border-b border-slate-100 bg-gradient-to-r from-purple-50 to-purple-100 px-6 py-5">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-purple-500 text-white">
                            <i class="fas fa-briefcase"></i>
                        </span>
                        <div>
                            <h2 class="text-lg font-semibold text-slate-900">Career Information</h2>
                            <p class="text-sm text-slate-600">Your professional background</p>
                        </div>
                    </div>
                </div>

                <div class="grid gap-5 p-6 md:grid-cols-2">
                    <div class="space-y-2">
                        <label class="text-xs font-semibold uppercase tracking-wider text-slate-600">Education Level</label>
                        <input
                            type="text"
                            name="education_level"
                            value="{{ old('education_level', $profile?->education_level) }}"
                            placeholder="e.g., Bachelor's in Computer Science"
                            class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-400 focus:ring-2 focus:ring-blue-100"
                        >
                        @error('education_level')
                            <p class="text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-semibold uppercase tracking-wider text-slate-600">Years of Experience</label>
                        <input
                            type="number"
                            name="years_experience"
                            min="0"
                            max="70"
                            value="{{ old('years_experience', $profile?->years_experience) }}"
                            placeholder="e.g., 5"
                            class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-400 focus:ring-2 focus:ring-blue-100"
                        >
                        @error('years_experience')
                            <p class="text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            <!-- Personal Information Section -->
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-lg">
                <div class="border-b border-slate-100 bg-gradient-to-r from-amber-50 to-amber-100 px-6 py-5">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-amber-500 text-white">
                            <i class="fas fa-calendar"></i>
                        </span>
                        <div>
                            <h2 class="text-lg font-semibold text-slate-900">Personal Information</h2>
                            <p class="text-sm text-slate-600">Additional personal details</p>
                        </div>
                    </div>
                </div>

                <div class="grid gap-5 p-6 md:grid-cols-2">
                    <div class="space-y-2">
                        <label class="text-xs font-semibold uppercase tracking-wider text-slate-600">Date of Birth</label>
                        <input
                            type="date"
                            name="date_of_birth"
                            value="{{ old('date_of_birth', optional($profile?->date_of_birth)->format('Y-m-d')) }}"
                            class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-blue-400 focus:ring-2 focus:ring-blue-100"
                        >
                        @error('date_of_birth')
                            <p class="text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-semibold uppercase tracking-wider text-slate-600">Gender</label>
                        <select
                            name="gender"
                            class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-blue-400 focus:ring-2 focus:ring-blue-100"
                        >
                            <option value="">Select gender</option>
                            <option value="male" {{ old('gender', $profile?->gender) === 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $profile?->gender) === 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender', $profile?->gender) === 'other' ? 'selected' : '' }}>Other</option>
                            <option value="prefer_not_to_say" {{ old('gender', $profile?->gender) === 'prefer_not_to_say' ? 'selected' : '' }}>Prefer not to say</option>
                        </select>
                        @error('gender')
                            <p class="text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            <!-- Skills Section -->
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-lg">
                <div class="border-b border-slate-100 bg-gradient-to-r from-green-50 to-green-100 px-6 py-5">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-green-500 text-white">
                            <i class="fas fa-star"></i>
                        </span>
                        <div>
                            <h2 class="text-lg font-semibold text-slate-900">Professional Skills</h2>
                            <p class="text-sm text-slate-600">Highlight your key competencies</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-4 p-6">
                    <div class="space-y-2">
                        <label class="text-xs font-semibold uppercase tracking-wider text-slate-600">Skills List</label>
                        <textarea
                            name="skills"
                            rows="6"
                            placeholder="Enter skills separated by commas&#10;e.g., Laravel, Vue.js, MySQL, Project Management, Team Leadership"
                            class="w-full rounded-lg border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-400 focus:ring-2 focus:ring-blue-100"
                        >{{ $skillsValue }}</textarea>
                        <div class="flex items-center justify-between">
                            <p class="text-xs text-slate-500">Use commas to separate skills. Be specific and relevant to your target roles.</p>
                            <span class="text-xs font-semibold text-slate-600">{{ $skillsCount }} skills</span>
                        </div>
                        @error('skills')
                            <p class="text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    @if($skillsCount > 0)
                        <div class="rounded-lg bg-blue-50 p-4 border border-blue-200">
                            <p class="text-xs font-semibold text-blue-900 mb-2">Your Skills:</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach(collect(explode(',', $skillsValue))->map(fn($s) => trim($s))->filter() as $skill)
                                    <span class="inline-flex items-center gap-1 rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700">
                                        {{ $skill }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </section>

            <!-- Resume Section -->
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-lg">
                <div class="border-b border-slate-100 bg-gradient-to-r from-red-50 to-red-100 px-6 py-5">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-red-500 text-white">
                            <i class="fas fa-file-pdf"></i>
                        </span>
                        <div>
                            <h2 class="text-lg font-semibold text-slate-900">Resume/CV</h2>
                            <p class="text-sm text-slate-600">Upload your latest resume</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-4 p-6" x-data="{ resumeName: @js($resumeName) }">
                    <label
                        for="resume_upload"
                        class="group flex cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-slate-300 bg-slate-50 px-6 py-8 text-center transition hover:border-blue-400 hover:bg-blue-50"
                    >
                        <input
                            id="resume_upload"
                            type="file"
                            name="resume_path"
                            accept=".pdf,.doc,.docx"
                            class="hidden"
                            @change="resumeName = $event.target.files[0]?.name || resumeName"
                        >
                        <span class="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100 text-blue-600 group-hover:scale-110 transition">
                            <i class="fas fa-cloud-upload-alt text-xl"></i>
                        </span>
                        <span class="mt-3 text-sm font-semibold text-slate-900">Click to upload or drag and drop</span>
                        <span class="mt-1 text-xs text-slate-500">PDF, DOC, or DOCX (max 5MB)</span>
                        <span class="mt-3 text-xs font-medium text-blue-600" x-text="resumeName ? `Selected: ${resumeName}` : 'No file selected'"></span>
                    </label>

                    @if ($resumeName)
                        <div class="flex items-start gap-3 rounded-lg border border-green-200 bg-green-50 p-4">
                            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-green-100 text-green-600 flex-shrink-0">
                                <i class="fas fa-check-circle"></i>
                            </span>
                            <div>
                                <p class="text-sm font-semibold text-green-900">Current Resume</p>
                                <p class="text-xs text-green-700 mt-1">{{ $resumeName }}</p>
                            </div>
                        </div>
                    @endif

                    @error('resume_path')
                        <p class="text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </section>
        </div>

        <!-- Sidebar -->
        <aside class="space-y-6 lg:sticky lg:top-6 h-fit">
            <!-- Profile Completion Guide -->
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-lg">
                <div class="border-b border-slate-100 bg-gradient-to-r from-emerald-50 to-emerald-100 px-5 py-4">
                    <div class="flex items-center gap-2">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-500 text-white text-sm">
                            <i class="fas fa-lightbulb"></i>
                        </span>
                        <h3 class="font-semibold text-slate-900">Completion Guide</h3>
                    </div>
                </div>

                <div class="space-y-4 p-5">
                    <div>
                        <div class="mb-2 flex items-center justify-between text-sm">
                            <span class="font-medium text-slate-700">Overall Progress</span>
                            <span class="font-bold text-slate-900">{{ $profileCompletion }}%</span>
                        </div>
                        <div class="h-2 overflow-hidden rounded-full bg-slate-100">
                            <div class="h-full rounded-full bg-gradient-to-r from-emerald-400 to-blue-500" style="width: {{ $profileCompletion }}%"></div>
                        </div>
                    </div>

                    <ul class="space-y-2 text-sm text-slate-600">
                        <li class="flex gap-2">
                            <i class="fas fa-check-circle mt-0.5 text-emerald-500 flex-shrink-0"></i>
                            <span>Add your location and experience</span>
                        </li>
                        <li class="flex gap-2">
                            <i class="fas fa-check-circle mt-0.5 text-emerald-500 flex-shrink-0"></i>
                            <span>List 5+ relevant skills</span>
                        </li>
                        <li class="flex gap-2">
                            <i class="fas fa-check-circle mt-0.5 text-emerald-500 flex-shrink-0"></i>
                            <span>Upload your latest resume</span>
                        </li>
                        <li class="flex gap-2">
                            <i class="fas fa-check-circle mt-0.5 text-emerald-500 flex-shrink-0"></i>
                            <span>Review and save changes</span>
                        </li>
                    </ul>
                </div>
            </section>

            <!-- Profile Snapshot -->
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-gradient-to-br from-slate-900 to-slate-800 text-white shadow-lg">
                <div class="px-5 py-4 border-b border-slate-700">
                    <h3 class="font-semibold">Profile Snapshot</h3>
                </div>
                <div class="space-y-2 p-5 text-sm">
                    <div class="flex items-center justify-between rounded-lg bg-white/10 px-3 py-2">
                        <span class="text-slate-300">Location</span>
                        <span class="font-semibold">{{ $profile?->location ?? '—' }}</span>
                    </div>
                    <div class="flex items-center justify-between rounded-lg bg-white/10 px-3 py-2">
                        <span class="text-slate-300">Experience</span>
                        <span class="font-semibold">{{ $hasExperience ? ($profile->years_experience == 1 ? '1 year' : $profile->years_experience . ' yrs') : '—' }}</span>
                    </div>
                    <div class="flex items-center justify-between rounded-lg bg-white/10 px-3 py-2">
                        <span class="text-slate-300">Skills</span>
                        <span class="font-semibold">{{ $skillsCount }}</span>
                    </div>
                    <div class="flex items-center justify-between rounded-lg bg-white/10 px-3 py-2">
                        <span class="text-slate-300">Resume</span>
                        <span class="font-semibold">{{ $resumeName ? '✓' : '—' }}</span>
                    </div>
                </div>
            </section>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <button
                    type="submit"
                    class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700 active:scale-95"
                >
                    <i class="fas fa-save"></i>
                    Save Changes
                </button>
                <a
                    href="{{ route('seeker.profile') }}"
                    class="w-full inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                >
                    <i class="fas fa-arrow-left"></i>
                    Back to Profile
                </a>
            </div>
        </aside>
    </form>
</div>

<style>
    input:disabled, textarea:disabled {
        @apply cursor-not-allowed opacity-75;
    }
</style>
@endsection
