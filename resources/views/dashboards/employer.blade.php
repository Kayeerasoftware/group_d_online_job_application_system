@extends('layouts.app')

@section('title', 'Employer Dashboard')

@section('content')
    <x-ui.page-header
        eyebrow="Employer dashboard"
        title="Recruit with clarity"
        description="Use one compact workspace to watch posting performance, review applications, and continue hiring."
    >
        <x-slot:actions>
            <a class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300" href="{{ route('jobs.create') }}">Post a job</a>
            <a class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-semibold text-slate-100 transition hover:bg-white/10" href="{{ route('applications.index') }}">View applications</a>
        </x-slot:actions>
    </x-ui.page-header>

    <div class="mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-5">
        @foreach([
            ['My jobs', $jobCount],
            ['Applications', $applicationCount],
            ['Views', $totalViews],
            ['Conversion', $conversionRate.'%'],
            ['Shortlisted', $shortlistedCount],
        ] as [$label, $value])
            <div class="rounded-[28px] border border-white/10 bg-slate-950/60 p-5">
                <p class="text-xs uppercase tracking-[0.35em] text-slate-500">{{ $label }}</p>
                <p class="mt-2 text-3xl font-semibold text-white">{{ $value }}</p>
            </div>
        @endforeach
    </div>

    <x-ui.panel tone="inset" class="mt-8 p-5 md:p-6">
        <div class="flex items-center justify-between gap-3">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Recent jobs</p>
                <h2 class="mt-2 text-xl font-semibold text-white">Latest postings</h2>
            </div>
            <a href="{{ route('jobs.index') }}" class="text-sm font-semibold text-cyan-300 transition hover:text-cyan-200">View all</a>
        </div>

        <div class="mt-5 overflow-hidden rounded-2xl border border-white/10">
            <table class="min-w-full divide-y divide-white/10 text-left text-sm">
                <tbody class="divide-y divide-white/10">
                    @forelse($jobs as $job)
                        <tr class="bg-slate-950/40">
                            <td class="px-4 py-4">
                                <a href="{{ route('jobs.show', $job) }}" class="font-semibold text-white transition hover:text-cyan-300">{{ $job->title }}</a>
                                <p class="mt-1 text-sm text-slate-400">{{ $job->location }}</p>
                            </td>
                            <td class="px-4 py-4 text-slate-300">{{ $job->applications_count }} applications</td>
                            <td class="px-4 py-4 text-right">
                                <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-semibold uppercase tracking-[0.25em] text-slate-200">{{ $job->statusValue() }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-4 py-6 text-center text-slate-400" colspan="3">No jobs posted yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-ui.panel>
@endsection
