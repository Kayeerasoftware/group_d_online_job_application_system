@extends('layouts.app')

@section('title', 'Edit Seeker Profile')

@section('content')
    <x-ui.page-header
        eyebrow="Seeker profile"
        title="Edit your profile"
        description="Update your location, education, resume, and skills so employers can read your profile faster."
    />

    <form class="mt-6 grid gap-6 lg:grid-cols-[1.1fr_0.9fr]" method="post" action="{{ route('seeker.profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('put')

        <x-ui.panel tone="inset" class="p-5 md:p-6">
            <div class="grid gap-5 md:grid-cols-2">
                <div class="space-y-2">
                    <label class="block text-xs uppercase tracking-[0.3em] text-slate-500" for="location">Location</label>
                    <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" id="location" name="location" value="{{ old('location', $profile->location) }}">
                </div>
                <div class="space-y-2">
                    <label class="block text-xs uppercase tracking-[0.3em] text-slate-500" for="education_level">Education level</label>
                    <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" id="education_level" name="education_level" value="{{ old('education_level', $profile->education_level) }}">
                </div>
                <div class="space-y-2">
                    <label class="block text-xs uppercase tracking-[0.3em] text-slate-500" for="years_experience">Years experience</label>
                    <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" id="years_experience" name="years_experience" type="number" min="0" value="{{ old('years_experience', $profile->years_experience) }}">
                </div>
                <div class="space-y-2">
                    <label class="block text-xs uppercase tracking-[0.3em] text-slate-500" for="date_of_birth">Date of birth</label>
                    <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" id="date_of_birth" name="date_of_birth" type="date" value="{{ old('date_of_birth', optional($profile->date_of_birth)->format('Y-m-d')) }}">
                </div>
                <div class="space-y-2 md:col-span-2">
                    <label class="block text-xs uppercase tracking-[0.3em] text-slate-500" for="gender">Gender</label>
                    <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" id="gender" name="gender" value="{{ old('gender', $profile->gender) }}">
                </div>
                <div class="space-y-2 md:col-span-2">
                    <label class="block text-xs uppercase tracking-[0.3em] text-slate-500" for="skills">Skills</label>
                    <textarea class="min-h-40 w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 placeholder:text-slate-500 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" id="skills" name="skills" rows="4" placeholder="Comma separated or JSON">{{ old('skills', is_array($profile->skills) ? implode(', ', $profile->skills) : $profile->skills) }}</textarea>
                </div>
            </div>
        </x-ui.panel>

        <div class="space-y-6">
            <x-ui.panel tone="soft" class="p-5 md:p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Resume upload</p>
                <div class="mt-4 space-y-2">
                    <label class="block text-xs uppercase tracking-[0.3em] text-slate-500" for="resume_path">Resume</label>
                    <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 file:mr-4 file:rounded-full file:border-0 file:bg-cyan-400 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-slate-950 hover:file:bg-cyan-300" id="resume_path" name="resume_path" type="file">
                </div>
            </x-ui.panel>

            <x-ui.panel tone="soft" class="p-5 md:p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Profile tips</p>
                <ul class="mt-4 space-y-3 text-sm leading-7 text-slate-300">
                    <li>Keep skills concise and relevant to the roles you are targeting.</li>
                    <li>Upload a current resume so employers can review your latest experience.</li>
                    <li>Use one format for skills if you expect frequent updates.</li>
                </ul>
            </x-ui.panel>

            <div class="flex items-center justify-end">
                <button class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300" type="submit">Save profile</button>
            </div>
        </div>
    </form>
@endsection
