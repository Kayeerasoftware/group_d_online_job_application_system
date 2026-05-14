<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Login')</title>
    @if (file_exists(public_path('hot')) || file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="@yield('body-class', 'auth-shell auth-shell--login') min-h-screen antialiased">
    @php
        $headerVariant = 'login';
        $navItems = [
            ['label' => 'Home', 'href' => route('home'), 'active' => request()->routeIs('home')],
            ['label' => 'Browse Jobs', 'href' => route('jobs.index'), 'active' => request()->routeIs('jobs.index')],
            ['label' => 'Sign Up', 'href' => route('register'), 'active' => request()->routeIs('register')],
        ];
        $headerAction = [
            'label' => 'Create account',
            'href' => route('register'),
            'variant' => 'solid',
        ];
    @endphp

    <div class="auth-frame">
        @include('partials.auth-header', compact('headerVariant', 'navItems', 'headerAction'))

        <main class="auth-main @yield('main-class', '')">
            @include('partials.alerts')
            @yield('content')
        </main>
    </div>
</body>
</html>
