@extends('layouts.app')

@section('title', 'Applicant Dashboard')

@section('content')
    <section class="rounded-[32px] border border-white/10 bg-white/5 p-6 shadow-2xl shadow-slate-950/20 backdrop-blur-xl md:p-8 animate-fade-up">
        <p class="text-sm font-semibold uppercase tracking-[0.35em] text-cyan-300/80">Applicant workspace</p>
        <h1 class="mt-3 text-3xl font-semibold text-white">Applicant dashboard</h1>
        <p class="mt-3 text-sm leading-7 text-slate-400">A compact entry point into the seeker view of the system, with shortcuts to job discovery and application tracking.</p>
        <div class="mt-6 grid gap-4 sm:grid-cols-2">
            <a class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300" href="{{ route('jobs.index') }}">Browse Jobs</a>
            <a class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-semibold text-slate-100 transition hover:bg-white/10" href="{{ route('applications.index') }}">My Applications</a>
        </div>
    </section>
@endsection
