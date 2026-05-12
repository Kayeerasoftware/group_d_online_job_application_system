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
<body class="joblink-theme min-h-screen overflow-x-hidden antialiased">
    <div class="joblink-canvas relative min-h-screen overflow-hidden">
        <div class="joblink-grid pointer-events-none absolute inset-0 opacity-70 [mask-image:linear-gradient(to_bottom,rgba(0,0,0,0.88),transparent)]"></div>
        <div class="pointer-events-none absolute -left-24 top-24 h-72 w-72 rounded-full bg-emerald-500/10 blur-3xl animate-float-slow"></div>
        <div class="pointer-events-none absolute -right-28 top-1/2 h-80 w-80 rounded-full bg-sky-500/10 blur-3xl animate-float-slow" style="animation-delay: -4s;"></div>

        @include('partials.topbar')
        @if (safe_auth_check())
            @include('partials.sidebar')
        @endif

        <main class="app-main relative z-10 mx-auto max-w-7xl px-4 pb-12 pt-6 md:px-6 md:pb-16 md:pt-8 animate-fade-up {{ safe_auth_check() ? 'md:pl-72 xl:pl-80' : '' }}">
            <div class="joblink-content">
                @include('partials.alerts')
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
