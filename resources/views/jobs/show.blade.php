@extends('layouts.app')

@section('title', 'Job Details')

@section('content')
    <x-ui.panel tone="surface" class="p-6 md:p-8">
        <x-ui.page-header
            eyebrow="Job details"
            title="{{ $job->title }}"
            description="{{ $job->description }}"
        >
            <x-slot:actions>
                @auth
                    @if(auth()->user()->isSeeker() && ! $applied)
                        <a class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-4 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300" href="{{ route('applications.create', ['job' => $job->id]) }}">
                            Apply now
                        </a>
                    @endif
                    @if(auth()->user()->isSeeker())
                        <form method="post" action="{{ route('seeker.saved-jobs.store', $job) }}">
                            @csrf
                            <button class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm font-semibold text-slate-100 transition hover:bg-white/10" type="submit">
                                {{ $saved ? 'Saved' : 'Save job' }}
                            </button>
                        </form>
                    @endif
                    @if((auth()->user()->isEmployer() && auth()->id() === $job->employer_id) || auth()->user()->isAdmin())
                        <a class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm font-semibold text-slate-100 transition hover:bg-white/10" href="{{ route('jobs.edit', $job) }}">
                            Edit
                        </a>
                        <button
                            type="button"
                            class="inline-flex items-center justify-center rounded-2xl border border-rose-500/30 bg-rose-500/10 px-4 py-3 text-sm font-semibold text-rose-200 transition hover:bg-rose-500/20"
                            data-modal-open="delete-job-{{ $job->id }}"
                        >
                            Delete
                        </button>
                    @endif
                @else
                    <a class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-4 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300" href="{{ route('register') }}">
                        Register to apply
                    </a>
                @endauth
            </x-slot:actions>
        </x-ui.page-header>

        <div class="mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-[28px] border border-white/10 bg-slate-950/60 p-5">
                <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Location</p>
                <p class="mt-2 text-base font-semibold text-white">{{ $job->location }}</p>
            </div>
            <div class="rounded-[28px] border border-white/10 bg-slate-950/60 p-5">
                <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Type</p>
                <p class="mt-2 text-base font-semibold text-white">{{ $job->job_type instanceof \App\Enums\JobType ? $job->job_type->value : $job->job_type }}</p>
            </div>
            <div class="rounded-[28px] border border-white/10 bg-slate-950/60 p-5">
                <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Status</p>
                <p class="mt-2 text-base font-semibold text-white">{{ $job->statusValue() }}</p>
            </div>
            <div class="rounded-[28px] border border-white/10 bg-slate-950/60 p-5">
                <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Deadline</p>
                <p class="mt-2 text-base font-semibold text-white">{{ optional($job->deadline)->format('Y-m-d') }}</p>
            </div>
        </div>

        <div class="mt-8 grid gap-6 lg:grid-cols-[1.4fr_0.9fr]">
            <div class="space-y-6">
                <x-ui.panel tone="inset" class="p-5 md:p-6">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Overview</p>
                    <div class="mt-4 grid gap-4 sm:grid-cols-3">
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <p class="text-[10px] uppercase tracking-[0.3em] text-slate-500">Salary range</p>
                            <p class="mt-2 text-lg font-semibold text-white">UGX {{ number_format((float) $job->salary_min) }} - UGX {{ number_format((float) $job->salary_max) }}</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <p class="text-[10px] uppercase tracking-[0.3em] text-slate-500">Views</p>
                            <p class="mt-2 text-lg font-semibold text-white">{{ number_format($job->views_count ?? 0) }}</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <p class="text-[10px] uppercase tracking-[0.3em] text-slate-500">Applications</p>
                            <p class="mt-2 text-lg font-semibold text-white">{{ number_format($job->applications_count ?? 0) }}</p>
                        </div>
                    </div>
                </x-ui.panel>

                <x-ui.panel tone="inset" class="p-5 md:p-6">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Description</p>
                    <p class="mt-4 text-sm leading-8 text-slate-300">{{ $job->description }}</p>
                </x-ui.panel>

                <x-ui.panel tone="inset" class="p-5 md:p-6">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Requirements</p>
                    <p class="mt-4 whitespace-pre-line text-sm leading-8 text-slate-300">{{ $job->requirements }}</p>
                </x-ui.panel>
            </div>

            <div class="space-y-6">
                <x-ui.panel tone="inset" class="p-5 md:p-6">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Employer</p>
                    <div class="mt-4 space-y-2 text-sm text-slate-300">
                        <p><span class="text-slate-500">Company:</span> {{ $job->employer?->employerProfile?->company_name ?? $job->employer?->name }}</p>
                        <p><span class="text-slate-500">Location:</span> {{ $job->location }}</p>
                        <p><span class="text-slate-500">Deadline:</span> {{ optional($job->deadline)->format('Y-m-d') }}</p>
                    </div>
                </x-ui.panel>

                @auth
                    @if(auth()->user()->isAdmin())
                        <x-ui.panel tone="warning" class="p-5 md:p-6">
                            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-200/80">Admin moderation</p>
                            <p class="mt-3 text-sm leading-7 text-amber-50/90">
                                Flag this posting if it contains discriminatory or non-compliant language. The record will stay visible, but the moderation action will be logged.
                            </p>

                            <form class="mt-4 space-y-4" method="post" action="{{ route('admin.jobs.flag', $job) }}">
                                @csrf
                                <textarea
                                    class="min-h-28 w-full rounded-2xl border border-amber-300/20 bg-slate-950/80 px-4 py-3 text-sm text-slate-100 placeholder:text-slate-500 outline-none transition focus:border-amber-300/50 focus:ring-2 focus:ring-amber-300/20"
                                    name="reason"
                                    placeholder="Optional moderation reason"
                                ></textarea>
                                <button class="inline-flex items-center justify-center rounded-2xl bg-amber-300 px-4 py-3 text-sm font-semibold text-slate-950 transition hover:bg-amber-200" type="submit">
                                    Flag job
                                </button>
                            </form>
                        </x-ui.panel>
                    @endif
                @endauth
            </div>
        </div>
    </x-ui.panel>

    <x-ui.modal
        id="delete-job-{{ $job->id }}"
        title="Delete this job?"
        description="This removes the listing from the portal and may affect existing applications."
    >
        <form method="post" action="{{ route('jobs.destroy', $job) }}" class="flex items-center justify-end gap-3">
            @csrf
            @method('delete')
            <button type="button" class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm font-semibold text-slate-100 transition hover:bg-white/10" data-modal-close>
                Cancel
            </button>
            <button type="submit" class="rounded-2xl border border-rose-500/30 bg-rose-500/10 px-4 py-3 text-sm font-semibold text-rose-200 transition hover:bg-rose-500/20">
                Delete job
            </button>
        </form>
    </x-ui.modal>
@endsection
