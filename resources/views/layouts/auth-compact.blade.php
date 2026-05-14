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

        @php
            $compactHeaderAction = [
                'label' => 'Browse Jobs',
                'href' => route('jobs.index'),
            ];
        @endphp

        <main class="relative mx-auto flex min-h-screen w-full max-w-3xl items-center justify-center px-4 py-8 md:px-6">
            <section class="joblink-content w-full rounded-[32px] border border-white/10 bg-[rgba(255,255,255,0.92)] p-4 shadow-2xl shadow-slate-950/10 backdrop-blur-xl md:p-6 animate-fade-up">
                <div class="mb-6 flex items-center justify-between gap-4">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-3 text-sm font-semibold text-[color:var(--text)]">
                        <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-400/15 text-emerald-200 ring-1 ring-emerald-400/30">JL</span>
                        <span>
                            <span class="block text-xs uppercase tracking-[0.35em] text-[color:var(--text3)]">Workspace</span>
                            <span class="block text-base font-semibold">Job App System</span>
                        </span>
                    </a>
                    <a href="{{ $compactHeaderAction['href'] }}" class="rounded-full border border-[color:var(--border)] bg-[color:var(--surface2)] px-4 py-2 text-sm font-semibold text-[color:var(--text)] transition hover:bg-[color:var(--surface)]">
                        {{ $compactHeaderAction['label'] }}
                    </a>
                </div>

                @include('partials.alerts')
                @yield('content')
            </section>
        </main>
    </div>
</body>
</html>
