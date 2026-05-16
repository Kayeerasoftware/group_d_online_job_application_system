<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Register')</title>
    @if (file_exists(public_path('hot')) || file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="@yield('body-class', 'auth-shell auth-shell--login') min-h-screen antialiased">
    <div class="auth-frame">
        @php
            $headerVariant = 'register';
            $headerLayout = 'full';
            $headerCenterLabel = 'Online Job Application System';
            $headerRightLines = [
                'Create a seeker or employer account',
                'Build your profile once and use it everywhere',
                'Apply, post, and manage hiring in one place',
            ];
        @endphp

        @include('partials.auth-header', compact('headerVariant', 'headerLayout', 'headerCenterLabel', 'headerRightLines'))

        <main class="auth-main @yield('main-class', '')">
            @yield('content')
        </main>
    </div>
</body>
</html>
