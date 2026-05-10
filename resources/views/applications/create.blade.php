@extends('layouts.app')

@section('title', 'Apply')

@section('content')
    <x-ui.page-header
        eyebrow="Seeker workspace"
        title="Apply for a job"
        description="{{ $job ? 'You are applying for '.$job->title.'. Keep the cover letter focused and the upload polished.' : 'Choose a role and complete your application in a structured, distraction-free layout.' }}"
    />

    <form class="mt-6 grid gap-6 lg:grid-cols-[1.2fr_0.8fr]" method="post" action="{{ route('applications.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="job_id" value="{{ $job?->id }}">

        <x-ui.panel tone="inset" class="p-5 md:p-6">
            <div class="space-y-2">
                <label class="block text-xs uppercase tracking-[0.3em] text-slate-500" for="cover_letter">Cover letter</label>
                <textarea class="min-h-[22rem] w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 placeholder:text-slate-500 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" name="cover_letter" id="cover_letter" rows="10" placeholder="Write a short message introducing your skills and why you are a good fit.">{{ old('cover_letter') }}</textarea>
            </div>
        </x-ui.panel>

        <div class="space-y-6">
            <x-ui.panel tone="inset" class="p-5 md:p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Documents</p>
                <div class="mt-4 space-y-2">
                    <label class="block text-xs uppercase tracking-[0.3em] text-slate-500" for="cv_path">CV / Resume</label>
                    <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 file:mr-4 file:rounded-full file:border-0 file:bg-cyan-400 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-slate-950 hover:file:bg-cyan-300" id="cv_path" name="cv_path" type="file">
                    <p class="text-xs text-slate-500">Accepted formats: PDF, DOC, DOCX.</p>
                </div>
            </x-ui.panel>

            @if($job)
                <x-ui.panel tone="soft" class="p-5 md:p-6">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Applying for</p>
                    <div class="mt-4 space-y-3 text-sm text-slate-300">
                        <p class="text-lg font-semibold text-white">{{ $job->title }}</p>
                        <p>{{ $job->location }}</p>
                        <p>{{ $job->statusValue() }}</p>
                        <p>Deadline: {{ optional($job->deadline)->format('Y-m-d') }}</p>
                    </div>
                </x-ui.panel>
            @endif

            <div class="flex items-center justify-end">
                <button class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300" type="submit">
                    Submit application
                </button>
            </div>
        </div>
    </form>
@endsection
