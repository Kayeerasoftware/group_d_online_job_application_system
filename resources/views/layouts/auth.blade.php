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
<body class="min-h-screen bg-slate-950 text-slate-100 antialiased">
    <div class="relative min-h-screen overflow-hidden bg-[radial-gradient(circle_at_top_left,_rgba(34,211,238,0.18),_transparent_28%),radial-gradient(circle_at_bottom_right,_rgba(14,165,233,0.12),_transparent_32%),linear-gradient(180deg,#020617_0%,#0f172a_100%)]">
        <div class="pointer-events-none absolute -left-24 top-16 h-72 w-72 rounded-full bg-cyan-400/10 blur-3xl animate-float-slow"></div>
        <div class="pointer-events-none absolute -right-24 bottom-20 h-80 w-80 rounded-full bg-sky-400/10 blur-3xl animate-float-slow" style="animation-delay: -4s;"></div>
        <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(to_right,rgba(148,163,184,0.05)_1px,transparent_1px),linear-gradient(to_bottom,rgba(148,163,184,0.05)_1px,transparent_1px)] bg-[size:3rem_3rem] [mask-image:linear-gradient(to_bottom,rgba(0,0,0,0.9),transparent)]"></div>

        <div class="relative mx-auto grid min-h-screen max-w-7xl gap-10 px-4 py-8 lg:grid-cols-[1.1fr_0.9fr] lg:px-6">
            <section class="hidden flex-col justify-between overflow-hidden rounded-[32px] border border-white/10 bg-slate-950/80 p-8 shadow-2xl shadow-cyan-950/10 backdrop-blur-xl lg:flex">
                <div class="relative">
                    <div class="absolute -left-10 top-8 h-28 w-28 rounded-full bg-cyan-400/10 blur-3xl"></div>
                    <div class="absolute right-0 top-24 h-36 w-36 rounded-full bg-sky-400/10 blur-3xl"></div>

                    <a href="{{ route('home') }}" class="inline-flex items-center gap-3 rounded-full border border-cyan-400/20 bg-cyan-400/10 px-4 py-2 text-sm font-semibold text-cyan-200">
                        <span class="flex h-2.5 w-2.5 rounded-full bg-cyan-400"></span>
                        Online Job Application System
                    </a>

                    <h1 class="mt-8 max-w-xl text-5xl font-semibold leading-tight text-white">
                        A focused hiring workspace for seekers, employers, and admins.
                    </h1>
                    <p class="mt-5 max-w-xl text-lg leading-8 text-slate-300">
                        Manage profiles, applications, jobs, notifications, and compliance from one polished dashboard built for clarity and speed.
                    </p>

                    <div class="mt-8 grid gap-4 sm:grid-cols-3">
                        <div class="rounded-3xl border border-white/10 bg-slate-950/70 p-4">
                            <p class="text-3xl font-semibold text-white">3</p>
                            <p class="mt-1 text-sm text-slate-400">Core roles</p>
                        </div>
                        <div class="rounded-3xl border border-white/10 bg-slate-950/70 p-4">
                            <p class="text-3xl font-semibold text-white">24/7</p>
                            <p class="mt-1 text-sm text-slate-400">Access</p>
                        </div>
                        <div class="rounded-3xl border border-white/10 bg-slate-950/70 p-4">
                            <p class="text-3xl font-semibold text-white">Live</p>
                            <p class="mt-1 text-sm text-slate-400">Workflow tracking</p>
                        </div>
                    </div>

                    <div class="mt-8 grid gap-4 rounded-[28px] border border-white/10 bg-slate-950/70 p-5">
                        <div class="flex items-center justify-between gap-4">
                            <p class="text-xs uppercase tracking-[0.35em] text-cyan-300/80">What you can do</p>
                            <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-medium text-slate-300">Clean workflow</span>
                        </div>

                        <div class="grid gap-3">
                            <div class="flex items-start gap-3 rounded-2xl border border-white/10 bg-white/5 p-4">
                                <span class="mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-cyan-400/15 text-cyan-200 ring-1 ring-cyan-400/20">
                                    1
                                </span>
                                <div>
                                    <p class="font-semibold text-white">Create a profile</p>
                                    <p class="mt-1 text-sm text-slate-400">Start with a simple account and move into your dashboard fast.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 rounded-2xl border border-white/10 bg-white/5 p-4">
                                <span class="mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-cyan-400/15 text-cyan-200 ring-1 ring-cyan-400/20">
                                    2
                                </span>
                                <div>
                                    <p class="font-semibold text-white">Find or post roles</p>
                                    <p class="mt-1 text-sm text-slate-400">Switch between seeker and employer flows without friction.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 rounded-2xl border border-white/10 bg-white/5 p-4">
                                <span class="mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-cyan-400/15 text-cyan-200 ring-1 ring-cyan-400/20">
                                    3
                                </span>
                                <div>
                                    <p class="font-semibold text-white">Track progress</p>
                                    <p class="mt-1 text-sm text-slate-400">Keep every application, approval, and notification in one place.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 grid gap-3 rounded-[28px] border border-white/10 bg-slate-950/70 p-5">
                    <p class="text-xs uppercase tracking-[0.35em] text-cyan-300/80">Built for</p>
                    <div class="grid gap-3 md:grid-cols-3">
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <p class="font-semibold text-white">Job Seekers</p>
                            <p class="mt-1 text-sm text-slate-400">Track applications and saved roles.</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <p class="font-semibold text-white">Employers</p>
                            <p class="mt-1 text-sm text-slate-400">Publish jobs and review candidates.</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <p class="font-semibold text-white">Administrators</p>
                            <p class="mt-1 text-sm text-slate-400">Monitor compliance and users.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="flex items-center justify-center">
                <div class="w-full rounded-[32px] border border-white/10 bg-slate-950/85 p-4 shadow-2xl shadow-cyan-950/20 backdrop-blur-xl md:p-6 animate-fade-up">
                    <div class="mb-6 flex items-center justify-between gap-4">
                        <a href="{{ route('home') }}" class="inline-flex items-center gap-3 text-sm font-semibold text-slate-100">
                            <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-cyan-400/15 text-cyan-200 ring-1 ring-cyan-400/30">JA</span>
                            <span>
                                <span class="block text-xs uppercase tracking-[0.35em] text-cyan-300/70">Workspace</span>
                                <span class="block text-base">Job App System</span>
                            </span>
                        </a>
                        <a href="{{ route('jobs.index') }}" class="rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-200 transition hover:bg-white/10">
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
