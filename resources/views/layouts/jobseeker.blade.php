<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Job Seeker Dashboard') - Job Application System</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/nav.css') }}" rel="stylesheet">
    <link href="{{ asset('css/seeker-dashboard.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body::-webkit-scrollbar { display: none; }
        [x-cloak] { display: none !important; }
    </style>
    <script>
        tailwind.config = { darkMode: 'class' }
    </script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('darkMode', {
                on: localStorage.getItem('darkMode') === 'true',
                toggle() {
                    this.on = !this.on;
                    localStorage.setItem('darkMode', this.on);
                    document.documentElement.classList.toggle('dark', this.on);
                }
            });

            document.documentElement.classList.toggle('dark', Alpine.store('darkMode').on);
        });
    </script>
    @stack('styles')
</head>
@php
    $currentUser = auth()->user();
@endphp
<body class="bg-gray-50" style="overflow-y: auto; overflow-x: hidden; scrollbar-width: none;" x-data="{ 
    sidebarOpen: false,
    sidebarCollapsed: false,
    showProfileModal: false,
    showProfileDropdown: false,
    showLogoModal: false,
    showSeekerModal: false,
    showCalendarModal: false,
    darkMode: false,
    sidebarSearch: '',
    notificationStats: {
        unread: 0
    },
    seekerProfile: {
        id: {{ Js::from($currentUser->id) }},
        name: {{ Js::from($currentUser->name ?? 'Job Seeker') }},
        role: 'Job Seeker',
        email: {{ Js::from($currentUser->email ?? 'seeker@example.com') }},
        phone: {{ Js::from($currentUser->phone ?? '+256 700 000 000') }}
    },
    profilePicture: {{ Js::from($currentUser->profile_picture_url ?? null) }}
}">
    @include('partials.jobseeker-topnav')
    @include('partials.jobseeker-sidenav')

    <div class="main-content transition-all duration-300" :class="sidebarCollapsed ? 'lg:ml-20' : 'lg:ml-36'" style="margin-top: 3rem; background-color: #f9fafb;">
        <div style="max-width: 100%; padding: 24px 12px;">
            @yield('content')
        </div>
    </div>
    
    @stack('scripts')
</body>
</html>
