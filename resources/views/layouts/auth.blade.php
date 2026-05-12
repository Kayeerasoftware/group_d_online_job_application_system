<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Authentication')</title>
    @if (file_exists(public_path('hot')) || file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="joblink-theme min-h-screen overflow-x-hidden antialiased">
    <div class="joblink-canvas relative min-h-screen overflow-hidden">
        <div class="joblink-grid pointer-events-none absolute inset-0 opacity-70 [mask-image:linear-gradient(to_bottom,rgba(0,0,0,0.92),transparent)]"></div>
        <div class="pointer-events-none absolute -left-24 top-16 h-72 w-72 rounded-full bg-emerald-500/10 blur-3xl animate-float-slow"></div>
        <div class="pointer-events-none absolute -right-24 bottom-20 h-80 w-80 rounded-full bg-sky-500/10 blur-3xl animate-float-slow" style="animation-delay: -4s;"></div>

        <div class="relative mx-auto grid min-h-screen max-w-7xl gap-8 px-4 py-8 lg:grid-cols-[1.05fr_0.95fr] lg:px-6">
            <section class="app-chrome hidden flex-col justify-between overflow-hidden rounded-[32px] border border-white/10 bg-[#1a1714] p-8 shadow-2xl shadow-slate-950/30 backdrop-blur-xl lg:flex">
                <div class="relative">
                    <div class="absolute -left-10 top-8 h-28 w-28 rounded-full bg-emerald-400/10 blur-3xl"></div>
                    <div class="absolute right-0 top-24 h-36 w-36 rounded-full bg-sky-400/10 blur-3xl"></div>

                    <a href="{{ route('home') }}" class="inline-flex items-center gap-3 rounded-full border border-emerald-400/20 bg-emerald-400/10 px-4 py-2 text-sm font-semibold text-emerald-100">
                        <span class="flex h-2.5 w-2.5 rounded-full bg-emerald-300"></span>
                        Online Job Application System
                    </a>

                    <h1 class="mt-8 max-w-xl font-serif text-5xl leading-tight text-white">
                        A focused hiring workspace for seekers, employers, and admins.
                    </h1>
                    <p class="mt-5 max-w-xl text-lg leading-8 text-white/72">
                        Manage profiles, applications, jobs, notifications, and compliance from one polished dashboard built for clarity and speed.
                    </p>

                    <div class="mt-8 grid gap-4 sm:grid-cols-3">
                        <div class="rounded-3xl border border-white/10 bg-white/5 p-4">
                            <p class="text-3xl font-semibold text-white">3</p>
                            <p class="mt-1 text-sm text-white/55">Core roles</p>
                        </div>
                        <div class="rounded-3xl border border-white/10 bg-white/5 p-4">
                            <p class="text-3xl font-semibold text-white">24/7</p>
                            <p class="mt-1 text-sm text-white/55">Access</p>
                        </div>
                        <div class="rounded-3xl border border-white/10 bg-white/5 p-4">
                            <p class="text-3xl font-semibold text-white">Live</p>
                            <p class="mt-1 text-sm text-white/55">Workflow tracking</p>
                        </div>
                    </div>

                    <div class="mt-8 grid gap-4 rounded-[28px] border border-white/10 bg-white/5 p-5">
                        <div class="flex items-center justify-between gap-4">
                            <p class="text-xs uppercase tracking-[0.35em] text-white/55">What you can do</p>
                            <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-medium text-white/70">Clean workflow</span>
                        </div>

                        <div class="grid gap-3">
                            <div class="flex items-start gap-3 rounded-2xl border border-white/10 bg-[#221e1a] p-4">
                                <span class="mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-emerald-400/15 text-emerald-100 ring-1 ring-emerald-400/20">
                                    1
                                </span>
                                <div>
                                    <p class="font-semibold text-white">Create a profile</p>
                                    <p class="mt-1 text-sm text-white/60">Start with a simple account and move into your dashboard fast.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 rounded-2xl border border-white/10 bg-[#221e1a] p-4">
                                <span class="mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-emerald-400/15 text-emerald-100 ring-1 ring-emerald-400/20">
                                    2
                                </span>
                                <div>
                                    <p class="font-semibold text-white">Find or post roles</p>
                                    <p class="mt-1 text-sm text-white/60">Switch between seeker and employer flows without friction.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 rounded-2xl border border-white/10 bg-[#221e1a] p-4">
                                <span class="mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-emerald-400/15 text-emerald-100 ring-1 ring-emerald-400/20">
                                    3
                                </span>
                                <div>
                                    <p class="font-semibold text-white">Track progress</p>
                                    <p class="mt-1 text-sm text-white/60">Keep every application, approval, and notification in one place.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 grid gap-3 rounded-[28px] border border-white/10 bg-white/5 p-5">
                    <p class="text-xs uppercase tracking-[0.35em] text-white/55">Built for</p>
                    <div class="grid gap-3 md:grid-cols-3">
                        <div class="rounded-2xl border border-white/10 bg-[#221e1a] p-4">
                            <p class="font-semibold text-white">Job Seekers</p>
                            <p class="mt-1 text-sm text-white/60">Track applications and saved roles.</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-[#221e1a] p-4">
                            <p class="font-semibold text-white">Employers</p>
                            <p class="mt-1 text-sm text-white/60">Publish jobs and review candidates.</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-[#221e1a] p-4">
                            <p class="font-semibold text-white">Administrators</p>
                            <p class="mt-1 text-sm text-white/60">Monitor compliance and users.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="flex items-center justify-center">
                <div class="joblink-content w-full rounded-[32px] border border-white/10 bg-[rgba(255,255,255,0.92)] p-4 shadow-2xl shadow-slate-950/10 backdrop-blur-xl md:p-6 animate-fade-up">
                    <div class="mb-6 flex items-center justify-between gap-4">
                        <a href="{{ route('home') }}" class="inline-flex items-center gap-3 text-sm font-semibold text-[color:var(--text)]">
                            <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-400/15 text-emerald-200 ring-1 ring-emerald-400/30">JL</span>
                            <span>
                                <span class="block text-xs uppercase tracking-[0.35em] text-[color:var(--text3)]">Workspace</span>
                                <span class="block text-base font-semibold">Job App System</span>
                            </span>
                        </a>
                        <a href="{{ route('jobs.index') }}" class="rounded-full border border-[color:var(--border)] bg-[color:var(--surface2)] px-4 py-2 text-sm font-semibold text-[color:var(--text)] transition hover:bg-[color:var(--surface)]">
                            Browse Jobs
                        </a>
                    </div>

                    @include('partials.alerts')
                    @yield('content')
                </div>
            </section>
        </div>
    </div>
</body>
</html>
