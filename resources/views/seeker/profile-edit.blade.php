@extends('layouts.jobseeker')

@section('title', 'Edit Profile')

@section('content')
<div class="mb-6">
    <h1 class="font-serif text-3xl text-[color:var(--text)]">Edit Profile</h1>
    <p class="mt-1 text-sm text-[color:var(--text2)]">Keep your profile up to date to attract employers</p>
</div>

<div class="grid gap-6 lg:grid-cols-3">
    <div class="lg:col-span-2">
        <form action="{{ route('seeker.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--surface)] p-6">
                <h2 class="text-lg font-semibold text-[color:var(--text)] mb-4">Personal Information</h2>
                
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-[color:var(--text2)] mb-2">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required class="w-full rounded-xl border border-[color:var(--border)] bg-[color:var(--surface)] px-4 py-2.5 text-sm outline-none focus:border-[color:var(--accent)] transition">
                        @error('name')<p class="mt-1 text-xs text-[color:var(--red)]">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[color:var(--text2)] mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required class="w-full rounded-xl border border-[color:var(--border)] bg-[color:var(--surface)] px-4 py-2.5 text-sm outline-none focus:border-[color:var(--accent)] transition">
                        @error('email')<p class="mt-1 text-xs text-[color:var(--red)]">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[color:var(--text2)] mb-2">Phone Number</label>
                        <input type="tel" name="phone" value="{{ old('phone', $profile->phone ?? '') }}" class="w-full rounded-xl border border-[color:var(--border)] bg-[color:var(--surface)] px-4 py-2.5 text-sm outline-none focus:border-[color:var(--accent)] transition">
                        @error('phone')<p class="mt-1 text-xs text-[color:var(--red)]">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[color:var(--text2)] mb-2">Location</label>
                        <input type="text" name="location" value="{{ old('location', $profile->location ?? '') }}" placeholder="e.g., Kampala, Uganda" class="w-full rounded-xl border border-[color:var(--border)] bg-[color:var(--surface)] px-4 py-2.5 text-sm outline-none focus:border-[color:var(--accent)] transition">
                        @error('location')<p class="mt-1 text-xs text-[color:var(--red)]">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--surface)] p-6">
                <h2 class="text-lg font-semibold text-[color:var(--text)] mb-4">Professional Details</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-[color:var(--text2)] mb-2">Current Job Title</label>
                        <input type="text" name="job_title" value="{{ old('job_title', $profile->job_title ?? '') }}" placeholder="e.g., Software Engineer" class="w-full rounded-xl border border-[color:var(--border)] bg-[color:var(--surface)] px-4 py-2.5 text-sm outline-none focus:border-[color:var(--accent)] transition">
                        @error('job_title')<p class="mt-1 text-xs text-[color:var(--red)]">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-[color:var(--text2)] mb-2">Years of Experience</label>
                            <select name="experience_years" class="w-full rounded-xl border border-[color:var(--border)] bg-[color:var(--surface)] px-4 py-2.5 text-sm outline-none focus:border-[color:var(--accent)] transition">
                                <option value="">Select experience</option>
                                @for($i = 0; $i <= 20; $i++)
                                <option value="{{ $i }}" {{ old('experience_years', $profile->experience_years ?? '') == $i ? 'selected' : '' }}>{{ $i }} {{ $i == 1 ? 'year' : 'years' }}</option>
                                @endfor
                                <option value="20+" {{ old('experience_years', $profile->experience_years ?? '') == '20+' ? 'selected' : '' }}>20+ years</option>
                            </select>
                            @error('experience_years')<p class="mt-1 text-xs text-[color:var(--red)]">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-[color:var(--text2)] mb-2">Education Level</label>
                            <select name="education_level" class="w-full rounded-xl border border-[color:var(--border)] bg-[color:var(--surface)] px-4 py-2.5 text-sm outline-none focus:border-[color:var(--accent)] transition">
                                <option value="">Select level</option>
                                @foreach(['High School', 'Certificate', 'Diploma', 'Bachelor\'s Degree', 'Master\'s Degree', 'PhD'] as $level)
                                <option value="{{ $level }}" {{ old('education_level', $profile->education_level ?? '') == $level ? 'selected' : '' }}>{{ $level }}</option>
                                @endforeach
                            </select>
                            @error('education_level')<p class="mt-1 text-xs text-[color:var(--red)]">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[color:var(--text2)] mb-2">Skills (comma-separated)</label>
                        <input type="text" name="skills" value="{{ old('skills', $profile->skills ?? '') }}" placeholder="e.g., Laravel, Vue.js, MySQL, Project Management" class="w-full rounded-xl border border-[color:var(--border)] bg-[color:var(--surface)] px-4 py-2.5 text-sm outline-none focus:border-[color:var(--accent)] transition">
                        @error('skills')<p class="mt-1 text-xs text-[color:var(--red)]">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[color:var(--text2)] mb-2">Bio / Summary</label>
                        <textarea name="bio" rows="4" placeholder="Tell employers about yourself, your experience, and what you're looking for..." class="w-full rounded-xl border border-[color:var(--border)] bg-[color:var(--surface)] px-4 py-2.5 text-sm outline-none focus:border-[color:var(--accent)] transition resize-none">{{ old('bio', $profile->bio ?? '') }}</textarea>
                        @error('bio')<p class="mt-1 text-xs text-[color:var(--red)]">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--surface)] p-6">
                <h2 class="text-lg font-semibold text-[color:var(--text)] mb-4">CV / Resume</h2>
                
                @if($profile && $profile->cv_path)
                <div class="mb-4 flex items-center gap-3 rounded-xl border border-[color:var(--border)] bg-[color:var(--surface2)] p-4">
                    <span class="text-2xl">📄</span>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-[color:var(--text)]">Current CV</p>
                        <p class="text-xs text-[color:var(--text3)]">{{ basename($profile->cv_path) }}</p>
                    </div>
                    <a href="{{ Storage::url($profile->cv_path) }}" target="_blank" class="rounded-lg border border-[color:var(--border)] bg-[color:var(--surface)] px-3 py-1.5 text-xs font-medium text-[color:var(--text)] hover:bg-[color:var(--border)] transition">View</a>
                </div>
                @endif

                <div class="rounded-xl border-2 border-dashed border-[color:var(--border)] bg-[color:var(--surface2)] p-8 text-center transition hover:border-[color:var(--accent)] hover:bg-[color:var(--accent-light)] cursor-pointer">
                    <input type="file" name="cv" id="cv" accept=".pdf,.doc,.docx" class="hidden" onchange="document.getElementById('cv-label').textContent = this.files[0]?.name || 'Click to upload or drag and drop'">
                    <label for="cv" class="cursor-pointer">
                        <div class="text-4xl mb-3">📤</div>
                        <p class="text-sm font-medium text-[color:var(--text)]" id="cv-label">Click to upload or drag and drop</p>
                        <p class="mt-1 text-xs text-[color:var(--text3)]">PDF, DOC, or DOCX (max 5MB)</p>
                    </label>
                </div>
                @error('cv')<p class="mt-2 text-xs text-[color:var(--red)]">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center justify-between gap-4">
                <a href="{{ route('seeker.dashboard') }}" class="rounded-xl border border-[color:var(--border)] bg-[color:var(--surface2)] px-6 py-3 text-sm font-medium text-[color:var(--text)] hover:bg-[color:var(--border)] transition">Cancel</a>
                <button type="submit" class="rounded-xl bg-[color:var(--accent)] px-6 py-3 text-sm font-medium text-white hover:opacity-90 transition">Save Changes</button>
            </div>
        </form>
    </div>

    <div class="space-y-6">
        <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--surface)] p-5">
            <h3 class="font-semibold text-[color:var(--text)] mb-3">Profile Completion</h3>
            <div class="space-y-3">
                @php
                    $completionItems = [
                        ['label' => 'Personal info', 'completed' => auth()->user()->name && auth()->user()->email],
                        ['label' => 'Contact details', 'completed' => $profile && $profile->phone && $profile->location],
                        ['label' => 'Professional details', 'completed' => $profile && $profile->job_title && $profile->experience_years],
                        ['label' => 'Skills', 'completed' => $profile && $profile->skills],
                        ['label' => 'Bio', 'completed' => $profile && $profile->bio],
                        ['label' => 'CV uploaded', 'completed' => $profile && $profile->cv_path],
                    ];
                @endphp
                @foreach($completionItems as $item)
                <div class="flex items-center gap-3">
                    <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full {{ $item['completed'] ? 'bg-[color:var(--accent)] text-white' : 'border border-[color:var(--border)] bg-[color:var(--surface2)] text-[color:var(--text3)]' }}">
                        @if($item['completed'])✓@else·@endif
                    </div>
                    <span class="text-sm {{ $item['completed'] ? 'text-[color:var(--text)]' : 'text-[color:var(--text3)]' }}">{{ $item['label'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--surface)] p-5">
            <h3 class="font-semibold text-[color:var(--text)] mb-3">Tips</h3>
            <ul class="space-y-2 text-sm text-[color:var(--text2)]">
                <li class="flex items-start gap-2">
                    <span class="text-[color:var(--accent)]">•</span>
                    <span>Complete profiles get 3x more views from employers</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-[color:var(--accent)]">•</span>
                    <span>Keep your CV updated with recent experience</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-[color:var(--accent)]">•</span>
                    <span>List specific skills relevant to your target roles</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-[color:var(--accent)]">•</span>
                    <span>Write a clear bio highlighting your strengths</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
