@extends('layouts.app')

@section('title', 'Seeker Dashboard')

@section('content')
    <x-ui.page-header
        eyebrow="Seeker dashboard"
        title="Find your next role"
        description="Keep track of open jobs, saved roles, and application progress from one focused workspace."
    >
        <x-slot:actions>
            <a class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300" href="{{ route('jobs.index') }}">Browse jobs</a>
            <a class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-semibold text-slate-100 transition hover:bg-white/10" href="{{ route('applications.index') }}">View applications</a>
        </x-slot:actions>
    </x-ui.page-header>

    <div class="mt-8 grid gap-4 md:grid-cols-3">
        @foreach([
            ['Open jobs', $openJobs],
            ['Applications', $applicationCount],
            ['Saved jobs', $savedJobCount],
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
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Recent applications</p>
                <h2 class="mt-2 text-xl font-semibold text-white">Latest updates</h2>
            </div>
            <a href="{{ route('applications.index') }}" class="text-sm font-semibold text-cyan-300 transition hover:text-cyan-200">View all</a>
        </div>

        <div class="mt-5 overflow-hidden rounded-2xl border border-white/10">
            <table class="min-w-full divide-y divide-white/10 text-left text-sm">
                <tbody class="divide-y divide-white/10">
                    @forelse($recentApplications as $application)
                        <tr class="bg-slate-950/40">
                            <td class="px-4 py-4">
                                <p class="font-semibold text-white">{{ $application->job->title }}</p>
                                <p class="mt-1 text-sm text-slate-400">{{ $application->job->location }}</p>
                            </td>
                            <td class="px-4 py-4 text-right">
                                <x-ui.status-badge :value="$application->statusValue()" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-4 py-6 text-center text-slate-400" colspan="2">No applications yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-ui.panel>
@endsection
