<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Online Job Application System')</title>
    @if (file_exists(public_path('hot')) || file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="min-h-screen overflow-x-hidden bg-slate-950 text-slate-100 antialiased">
    <div class="relative min-h-screen overflow-hidden bg-[radial-gradient(circle_at_top_left,_rgba(34,211,238,0.16),_transparent_30%),radial-gradient(circle_at_top_right,_rgba(14,165,233,0.10),_transparent_28%),linear-gradient(180deg,#020617_0%,#0f172a_45%,#020617_100%)]">
        <div class="pointer-events-none absolute -left-24 top-24 h-72 w-72 rounded-full bg-cyan-400/10 blur-3xl animate-float-slow"></div>
        <div class="pointer-events-none absolute -right-28 top-1/2 h-80 w-80 rounded-full bg-sky-400/10 blur-3xl animate-float-slow" style="animation-delay: -4s;"></div>
        <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(to_right,rgba(148,163,184,0.06)_1px,transparent_1px),linear-gradient(to_bottom,rgba(148,163,184,0.06)_1px,transparent_1px)] bg-[size:3rem_3rem] [mask-image:linear-gradient(to_bottom,rgba(0,0,0,0.85),transparent)]"></div>

        @include('partials.topbar')
        @auth
            @include('partials.sidebar')
        @endauth

        <main class="relative z-10 mx-auto max-w-7xl px-4 pb-12 pt-6 md:px-6 md:pb-16 md:pt-8 animate-fade-up {{ auth()->check() ? 'md:pl-72 xl:pl-80' : '' }}">
            
        @include('partials.alerts')
        @yield('content')
        </main>
    </div>
</body>
</html>
