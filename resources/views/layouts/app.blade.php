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
    @if (request()->routeIs('home'))
        <div class="joblink-canvas relative flex min-h-screen flex-col overflow-hidden bg-[#fffdd0]">
            <div class="joblink-grid pointer-events-none absolute inset-0 opacity-70 [mask-image:linear-gradient(to_bottom,rgba(0,0,0,0.88),transparent)] hidden"></div>
            <div class="pointer-events-none absolute -left-24 top-24 h-72 w-72 rounded-full bg-emerald-500/10 blur-3xl animate-float-slow hidden"></div>
            <div class="pointer-events-none absolute -right-28 top-1/2 h-80 w-80 rounded-full bg-sky-500/10 blur-3xl animate-float-slow hidden" style="animation-delay: -4s;"></div>

            @php
                $headerVariant = 'login';
                $headerLayout = 'full';
                $headerCenterLabel = 'Online Job Application System';
                $headerClass = 'auth-header--home';
                $headerRightLines = [
                    'Unified hiring platform',
                    'Search, apply, post, and review roles',
                    'Built for seekers, employers, and admins',
                ];
            @endphp

            @include('partials.auth-header', compact('headerVariant', 'headerLayout', 'headerCenterLabel', 'headerClass', 'headerRightLines'))

            <main class="app-main relative z-10 flex-1 w-full px-4 pb-12 pt-6 md:px-6 md:pb-16 md:pt-8 animate-fade-up">
                @include('partials.alerts')

                <div class="joblink-content w-full">
                    @yield('content')
                </div>
            </main>
        </div>
    @else
        <div class="joblink-canvas relative min-h-screen overflow-hidden bg-[#fffdd0]">
            <div class="joblink-grid pointer-events-none absolute inset-0 opacity-70 [mask-image:linear-gradient(to_bottom,rgba(0,0,0,0.88),transparent)] hidden"></div>
            <div class="pointer-events-none absolute -left-24 top-24 h-72 w-72 rounded-full bg-emerald-500/10 blur-3xl animate-float-slow hidden"></div>
            <div class="pointer-events-none absolute -right-28 top-1/2 h-80 w-80 rounded-full bg-sky-500/10 blur-3xl animate-float-slow hidden" style="animation-delay: -4s;"></div>

            @include('partials.topbar')
            @if (safe_auth_check())
                @include('partials.sidebar')
            @endif

            <main class="app-main relative z-10 mx-auto max-w-7xl px-4 pb-12 pt-6 md:px-6 md:pb-16 md:pt-8 animate-fade-up {{ safe_auth_check() ? 'md:pl-72 xl:pl-80' : '' }}">
                @include('partials.alerts')

                <div class="joblink-content">
                    @yield('content')
                </div>
            </main>
        </div>
    @endif
</body>
</html>
