@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <section class="overflow-hidden rounded-[32px] border border-white/10 bg-white/5 shadow-2xl shadow-cyan-950/10 backdrop-blur-xl">
        <div class="grid gap-0 lg:grid-cols-[1.15fr_0.85fr]">
            <div class="p-8 md:p-12">
                <p class="text-sm font-semibold uppercase tracking-[0.35em] text-cyan-300/80">Online Job Application System</p>
                <h1 class="mt-5 max-w-2xl text-4xl font-semibold leading-tight text-white md:text-6xl">
                    A modern recruitment workspace for every stage of the hiring journey.
                </h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300">
                    Register, publish jobs, submit applications, save opportunities, and monitor compliance from a single premium dashboard experience.
                </p>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300" href="{{ route('jobs.index') }}">
                        Browse Jobs
                    </a>
                    <a class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-semibold text-slate-100 transition hover:bg-white/10" href="{{ route('register') }}">
                        Get Started
                    </a>
                </div>

                <div class="mt-10 grid gap-4 sm:grid-cols-3">
                    <div class="rounded-3xl border border-white/10 bg-slate-950/70 p-5">
                        <p class="text-3xl font-semibold text-white">Jobs</p>
                        <p class="mt-1 text-sm text-slate-400">Browse and post opportunities.</p>
                    </div>
                    <div class="rounded-3xl border border-white/10 bg-slate-950/70 p-5">
                        <p class="text-3xl font-semibold text-white">Applications</p>
                        <p class="mt-1 text-sm text-slate-400">Track every submission in real time.</p>
                    </div>
                    <div class="rounded-3xl border border-white/10 bg-slate-950/70 p-5">
                        <p class="text-3xl font-semibold text-white">Reports</p>
                        <p class="mt-1 text-sm text-slate-400">Keep the system compliance-ready.</p>
                    </div>
                </div>
            </div>

            <div class="border-t border-white/10 bg-slate-950/50 p-8 lg:border-l lg:border-t-0 lg:p-10">
                <div class="rounded-[28px] border border-white/10 bg-slate-950/80 p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-cyan-300/70">What you can do</p>
                    <div class="mt-6 space-y-4">
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <p class="font-semibold text-white">For job seekers</p>
                            <p class="mt-1 text-sm text-slate-400">Save jobs, upload CVs, and follow application status updates.</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <p class="font-semibold text-white">For employers</p>
                            <p class="mt-1 text-sm text-slate-400">Create polished job posts and manage candidate pipelines.</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <p class="font-semibold text-white">For admins</p>
                            <p class="mt-1 text-sm text-slate-400">Monitor users, logs, and regulatory reporting in one place.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
