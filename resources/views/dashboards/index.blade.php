@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <x-ui.page-header
        eyebrow="Dashboard hub"
        title="Choose your workspace"
        description="Your role-based dashboard lives in the seeker, employer, and admin areas. Use the sidebar to move quickly between them."
    />

    <div class="mt-8 grid gap-4 md:grid-cols-3">
        <a href="{{ route('seeker.dashboard') }}" class="rounded-[28px] border border-white/10 bg-slate-950/70 p-5 transition hover:-translate-y-1 hover:bg-white/5">
            <p class="inline-flex rounded-full border border-cyan-400/20 bg-cyan-400/10 px-3 py-1 text-[0.7rem] font-semibold uppercase tracking-[0.25em] text-cyan-200">Seeker</p>
            <p class="mt-3 text-lg font-semibold text-white">Browse jobs, track applications, and manage saved roles.</p>
        </a>
        <a href="{{ route('employer.dashboard') }}" class="rounded-[28px] border border-white/10 bg-slate-950/70 p-5 transition hover:-translate-y-1 hover:bg-white/5">
            <p class="inline-flex rounded-full border border-cyan-400/20 bg-cyan-400/10 px-3 py-1 text-[0.7rem] font-semibold uppercase tracking-[0.25em] text-cyan-200">Employer</p>
            <p class="mt-3 text-lg font-semibold text-white">Post jobs, review candidates, and keep the hiring pipeline moving.</p>
        </a>
        <a href="{{ route('admin.dashboard') }}" class="rounded-[28px] border border-white/10 bg-slate-950/70 p-5 transition hover:-translate-y-1 hover:bg-white/5">
            <p class="inline-flex rounded-full border border-cyan-400/20 bg-cyan-400/10 px-3 py-1 text-[0.7rem] font-semibold uppercase tracking-[0.25em] text-cyan-200">Admin</p>
            <p class="mt-3 text-lg font-semibold text-white">Review users, audit logs, and compliance reports.</p>
        </a>
    </div>
@endsection
