<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sign Up')</title>
    @if (file_exists(public_path('hot')) || file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="@yield('body-class', 'auth-shell auth-shell--signup') min-h-screen antialiased">
    @php
        $headerRole = request()->query('role');
        $isRegisterForm = in_array($headerRole, ['seeker', 'employer'], true);
        $headerVariant = $isRegisterForm ? 'register-form' : 'signup-choice';
        $navItems = [
            ['label' => 'Home', 'href' => route('home'), 'active' => request()->routeIs('home')],
            ['label' => 'Browse Jobs', 'href' => route('jobs.index'), 'active' => request()->routeIs('jobs.index')],
            ['label' => 'Sign In', 'href' => route('login'), 'active' => request()->routeIs('login')],
            ['label' => 'Sign Up', 'href' => route('register'), 'active' => request()->routeIs('register')],
        ];
        $roleItems = $isRegisterForm
            ? [
                ['label' => 'Seeker', 'href' => route('register', ['role' => 'seeker']), 'active' => $headerRole === 'seeker'],
                ['label' => 'Employer', 'href' => route('register', ['role' => 'employer']), 'active' => $headerRole === 'employer'],
            ]
            : [];
        $roleNavLabel = 'Role';
        $headerAction = [
            'label' => 'Sign in',
            'href' => route('login'),
            'variant' => 'outline',
        ];
    @endphp
    <div class="auth-frame">
        @include('partials.auth-header', compact('headerVariant', 'navItems', 'roleItems', 'roleNavLabel', 'headerAction'))

        <main class="auth-main @yield('main-class', '')">
            @include('partials.alerts')
            @yield('content')
        </main>
    </div>
</body>
</html>
