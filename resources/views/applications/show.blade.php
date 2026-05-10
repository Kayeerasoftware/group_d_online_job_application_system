@extends('layouts.app')

@section('title', 'Application Details')

@section('content')
    <x-ui.panel tone="surface" class="p-6 md:p-8">
        <x-ui.page-header
            eyebrow="Application details"
            title="{{ $application->job->title }}"
            description="Track the submission, update the review status, and keep the candidate thread organized."
        >
            <x-slot:actions>
                <x-ui.status-badge :value="$application->statusValue()" />
            </x-slot:actions>
        </x-ui.page-header>

        <div class="mt-8 grid gap-6 lg:grid-cols-[1.4fr_0.8fr]">
            <div class="space-y-6">
                <x-ui.panel tone="inset" class="p-5 md:p-6">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Cover letter</p>
                    <p class="mt-4 whitespace-pre-line text-sm leading-8 text-slate-300">{{ $application->cover_letter }}</p>
                </x-ui.panel>

                <x-ui.panel tone="inset" class="p-5 md:p-6">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Application timeline</p>
                    <div class="mt-4 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <p class="text-[10px] uppercase tracking-[0.3em] text-slate-500">Applicant</p>
                            <p class="mt-2 text-sm font-semibold text-white">{{ $application->seeker->name }}</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <p class="text-[10px] uppercase tracking-[0.3em] text-slate-500">Applied at</p>
                            <p class="mt-2 text-sm font-semibold text-white">{{ optional($application->applied_date)->format('Y-m-d H:i') }}</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <p class="text-[10px] uppercase tracking-[0.3em] text-slate-500">CV</p>
                            <p class="mt-2 text-sm font-semibold text-white">{{ $application->cv_path }}</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <p class="text-[10px] uppercase tracking-[0.3em] text-slate-500">Job</p>
                            <p class="mt-2 text-sm font-semibold text-white">{{ $application->job->location }}</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <p class="text-[10px] uppercase tracking-[0.3em] text-slate-500">Status</p>
                            <div class="mt-2">
                                <x-ui.status-badge :value="$application->statusValue()" />
                            </div>
                        </div>
                    </div>
                </x-ui.panel>
            </div>

            <div class="space-y-6">
                <x-ui.panel tone="inset" class="p-5 md:p-6">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Quick facts</p>
                    <div class="mt-4 space-y-3 text-sm text-slate-300">
                        <p><span class="text-slate-500">Employer:</span> {{ $application->job->employer?->employerProfile?->company_name ?? $application->job->employer?->name }}</p>
                        <p><span class="text-slate-500">Job type:</span> {{ $application->job->job_type instanceof \App\Enums\JobType ? $application->job->job_type->value : $application->job->job_type }}</p>
                        <div class="flex items-center gap-2">
                            <span class="text-slate-500">Status:</span>
                            <x-ui.status-badge :value="$application->statusValue()" />
                        </div>
                    </div>
                </x-ui.panel>

                <x-ui.panel tone="inset" class="p-5 md:p-6">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Review status</p>
                    <div class="mt-4">
                        @include('applications._status-form')
                    </div>
                </x-ui.panel>
            </div>
        </div>
    </x-ui.panel>
@endsection
