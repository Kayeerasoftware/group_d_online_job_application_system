@extends('layouts.app')

@section('title', 'Edit Application')

@section('content')
    <x-ui.page-header
        eyebrow="Application editor"
        title="Edit application"
        description="Adjust the review status or private notes without losing the original application context."
    />

    <x-ui.panel tone="surface" class="mt-6 p-6 md:p-8">
        <div class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
            <div class="space-y-6">
                <x-ui.panel tone="inset" class="p-5 md:p-6">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Submission</p>
                    <div class="mt-4 space-y-4 text-sm leading-8 text-slate-300">
                        <p><span class="text-slate-500">Job:</span> {{ $application->job->title }}</p>
                        <p><span class="text-slate-500">Applicant:</span> {{ $application->seeker->name }}</p>
                        <p><span class="text-slate-500">Applied at:</span> {{ optional($application->applied_date)->format('Y-m-d H:i') }}</p>
                        <p class="whitespace-pre-line">{{ $application->cover_letter }}</p>
                    </div>
                </x-ui.panel>
            </div>

            <x-ui.panel tone="inset" class="p-5 md:p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Review status</p>
                <div class="mt-3">
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Current status</p>
                    <div class="mt-2">
                        <x-ui.status-badge :value="$application->statusValue()" />
                    </div>
                </div>
                <div class="mt-4">
                    @include('applications._status-form')
                </div>
            </x-ui.panel>
        </div>
    </x-ui.panel>
@endsection
