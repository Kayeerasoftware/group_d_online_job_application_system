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

        <main class="relative mx-auto flex min-h-screen w-full max-w-3xl items-center justify-center px-4 py-8 md:px-6">
            <section class="w-full rounded-[32px] border border-white/10 bg-slate-950/90 p-4 shadow-2xl shadow-cyan-950/20 backdrop-blur-xl md:p-6 animate-fade-up">
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
            </section>
        </main>
    </div>
</body>
</html>
