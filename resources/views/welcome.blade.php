@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <section class="surface-card overflow-hidden">
        <div class="grid gap-0 lg:grid-cols-[1.08fr_0.92fr]">
            <div class="p-8 md:p-12">
                <p class="section-eyebrow">Online Job Application System</p>
                <h1 class="mt-5 max-w-2xl font-serif text-4xl leading-tight text-[color:var(--text)] md:text-6xl">
                    A modern recruitment workspace for every stage of the hiring journey.
                </h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-[color:var(--text2)]">
                    Register, publish jobs, submit applications, save opportunities, and monitor compliance from a single polished dashboard experience.
                </p>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a class="inline-flex items-center justify-center rounded-2xl bg-emerald-400 px-5 py-3 text-sm font-semibold text-[#1a1714] transition hover:bg-emerald-300" href="{{ route('jobs.index') }}">
                        Browse Jobs
                    </a>
                    <a class="inline-flex items-center justify-center rounded-2xl border border-[color:var(--border)] bg-[color:var(--surface2)] px-5 py-3 text-sm font-semibold text-[color:var(--text)] transition hover:bg-[color:var(--surface)]" href="{{ route('register') }}">
                        Get Started
                    </a>
                </div>

                <div class="mt-10 grid gap-4 sm:grid-cols-3">
                    <div class="rounded-3xl border border-[color:var(--border)] bg-[color:var(--surface2)] p-5">
                        <p class="text-3xl font-semibold text-[color:var(--text)]">Jobs</p>
                        <p class="mt-1 text-sm text-[color:var(--text2)]">Browse and post opportunities.</p>
                    </div>
                    <div class="rounded-3xl border border-[color:var(--border)] bg-[color:var(--surface2)] p-5">
                        <p class="text-3xl font-semibold text-[color:var(--text)]">Applications</p>
                        <p class="mt-1 text-sm text-[color:var(--text2)]">Track every submission in real time.</p>
                    </div>
                    <div class="rounded-3xl border border-[color:var(--border)] bg-[color:var(--surface2)] p-5">
                        <p class="text-3xl font-semibold text-[color:var(--text)]">Reports</p>
                        <p class="mt-1 text-sm text-[color:var(--text2)]">Keep the system compliance-ready.</p>
                    </div>
                </div>
            </div>

            <div class="border-t border-[color:var(--border)] bg-[color:var(--surface2)] p-8 lg:border-l lg:border-t-0 lg:p-10">
                <div class="rounded-[28px] border border-[color:var(--border)] bg-[color:var(--surface)] p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-[color:var(--text3)]">What you can do</p>
                    <div class="mt-6 space-y-4">
                        <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--surface2)] p-4">
                            <p class="font-semibold text-[color:var(--text)]">For job seekers</p>
                            <p class="mt-1 text-sm text-[color:var(--text2)]">Save jobs, upload CVs, and follow application status updates.</p>
                        </div>
                        <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--surface2)] p-4">
                            <p class="font-semibold text-[color:var(--text)]">For employers</p>
                            <p class="mt-1 text-sm text-[color:var(--text2)]">Create polished job posts and manage candidate pipelines.</p>
                        </div>
                        <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--surface2)] p-4">
                            <p class="font-semibold text-[color:var(--text)]">For admins</p>
                            <p class="mt-1 text-sm text-[color:var(--text2)]">Monitor users, logs, and regulatory reporting in one place.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
