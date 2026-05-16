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
    <div class="auth-frame">
        @php
            $headerVariant = 'login';
            $headerLayout = 'full';
            $headerCenterLabel = 'Online Job Application System';
            $headerRightLines = [
                'Sign in as seeker or employer',
                'Seekers apply and track progress',
                'Employers post roles and review candidates',
            ];
        @endphp

        @include('partials.auth-header', compact('headerVariant', 'headerLayout', 'headerCenterLabel', 'headerRightLines'))

        <main class="auth-main @yield('main-class', '')">
            @yield('content')
        </main>
    </div>
</body>
</html>
