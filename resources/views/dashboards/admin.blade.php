@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <x-ui.page-header
        eyebrow="Admin command center"
        title="Monitor the whole system"
        description="Track users, jobs, applications, reports, and flagged content from a single operational view."
    >
        <x-slot:actions>
            <a class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300" href="{{ route('admin.users.index') }}">Manage users</a>
            <a class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-semibold text-slate-100 transition hover:bg-white/10" href="{{ route('admin.reports.index') }}">View reports</a>
            <a class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-semibold text-slate-100 transition hover:bg-white/10" href="{{ route('admin.system.index') }}">System health</a>
        </x-slot:actions>
    </x-ui.page-header>

    <div class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-5">
        @foreach([
            ['Users', $userCount],
            ['Jobs', $jobCount],
            ['Applications', $applicationCount],
            ['Reports', $reportCount],
            ['Flagged', $flaggedJobs],
        ] as [$label, $value])
            <div class="rounded-[28px] border border-white/10 bg-slate-950/60 p-5">
                <p class="text-xs uppercase tracking-[0.35em] text-slate-500">{{ $label }}</p>
                <p class="mt-2 text-3xl font-semibold text-white">{{ $value }}</p>
            </div>
        @endforeach
    </div>
@endsection
