@extends('layouts.app')

@section('title', 'Job Applications')

@section('content')
    <section class="rounded-[32px] border border-white/10 bg-white/5 p-6 shadow-2xl shadow-slate-950/20 backdrop-blur-xl md:p-8 animate-fade-up">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.35em] text-cyan-300/80">Employer view</p>
                <h1 class="mt-3 text-3xl font-semibold text-white">Applications for this job</h1>
                <p class="mt-3 text-sm leading-7 text-slate-400">Open the main applications area to review candidates, status updates, and notes.</p>
            </div>
            <a href="{{ route('applications.index') }}" class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300">
                View all applications
            </a>
        </div>
    </section>
@endsection
