@php
    $user = safe_auth_user();
    $initials = collect(preg_split('/\s+/', trim($user?->name ?? 'U')) ?: ['U'])
        ->filter()
        ->map(fn ($part) => mb_substr($part, 0, 1))
        ->take(2)
        ->implode('');

    $links = [
        ['label' => 'Dashboard', 'route' => 'dashboard', 'active' => 'dashboard', 'icon' => 'dashboard'],
        ['label' => 'Members', 'route' => 'jobs.index', 'active' => 'jobs.*', 'icon' => 'members'],
        ['label' => 'Loans', 'route' => 'jobs.index', 'active' => 'jobs.*', 'icon' => 'loans'],
    ];

    if ($user?->isSeeker()) {
        $links = [
            ['label' => 'Dashboard', 'route' => 'seeker.dashboard', 'active' => 'seeker.dashboard', 'icon' => 'dashboard'],
            ['label' => 'Browse Jobs', 'route' => 'seeker.browse-jobs', 'active' => 'seeker.browse-jobs', 'icon' => 'members'],
            ['label' => 'Applications', 'route' => 'seeker.applications', 'active' => 'seeker.applications', 'icon' => 'loans'],
            ['label' => 'Saved Jobs', 'route' => 'seeker.saved-jobs', 'active' => 'seeker.saved-jobs', 'icon' => 'applications'],
            ['label' => 'Resume', 'route' => 'seeker.resume', 'active' => 'seeker.resume', 'icon' => 'fundraising'],
            ['label' => 'Interviews', 'route' => 'seeker.interviews', 'active' => 'seeker.interviews', 'icon' => 'transactions'],
            ['label' => 'Messages', 'route' => 'seeker.messages', 'active' => 'seeker.messages', 'icon' => 'financial'],
            ['label' => 'Notifications', 'route' => 'seeker.notifications', 'active' => 'seeker.notifications', 'icon' => 'projects'],
            ['label' => 'Profile', 'route' => 'seeker.profile', 'active' => 'seeker.profile', 'icon' => 'users'],
            ['label' => 'Settings', 'route' => 'seeker.settings', 'active' => 'seeker.settings', 'icon' => 'settings'],
        ];
    }
@endphp

<div data-sidebar-backdrop class="fixed inset-0 z-30 hidden bg-slate-900/50 backdrop-blur-sm md:hidden"></div>

<aside
    data-sidebar
    class="fixed inset-y-0 left-0 z-40 w-64 -translate-x-full border-r border-slate-200 bg-slate-100 transition-transform duration-300 md:translate-x-0"
>
    <div class="flex h-full flex-col">
        <div class="flex items-center justify-between border-b border-slate-200 bg-white px-4 py-3">
            <button
                type="button"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 transition hover:bg-slate-100 md:hidden"
                data-sidebar-close
                aria-label="Close navigation menu"
            >
                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto px-3 py-4">
            <div class="mb-4 flex items-center gap-3 rounded-lg bg-white p-3 shadow-sm">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-300 text-sm font-bold text-slate-700">
                    {{ $initials }}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="truncate text-sm font-semibold text-slate-900">{{ $user?->name }}</p>
                    <p class="truncate text-xs text-slate-500">{{ $user?->roleValue() }}</p>
                </div>
            </div>

            <div class="mb-3 rounded-lg bg-white px-3 py-2 shadow-sm">
                <div class="flex items-center gap-2 text-slate-400">
                    <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" placeholder="Search menu..." class="w-full border-0 bg-transparent text-sm text-slate-600 placeholder-slate-400 focus:outline-none">
                </div>
            </div>

            <nav class="space-y-1">
                @foreach($links as $link)
                    <a
                        href="{{ route($link['route']) }}"
                        @class([
                            'flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition',
                            'bg-blue-600 text-white' => request()->routeIs($link['active']),
                            'text-slate-700 hover:bg-white' => !request()->routeIs($link['active']),
                        ])
                    >
                        @if($link['icon'] === 'dashboard')
                            <svg viewBox="0 0 24 24" class="h-5 w-5" fill="currentColor"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>
                        @elseif($link['icon'] === 'members')
                            <svg viewBox="0 0 24 24" class="h-5 w-5" fill="currentColor"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                        @elseif($link['icon'] === 'loans')
                            <svg viewBox="0 0 24 24" class="h-5 w-5" fill="currentColor"><path d="M20 6h-2.18c.11-.31.18-.65.18-1a2.996 2.996 0 00-5.5-1.65l-.5.67-.5-.68C10.96 2.54 10.05 2 9 2 7.34 2 6 3.34 6 5c0 .35.07.69.18 1H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-5-2c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM9 4c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm11 15H4v-2h16v2zm0-5H4V8h5.08L7 10.83 8.62 12 11 8.76l1-1.36 1 1.36L15.38 12 17 10.83 14.92 8H20v6z"/></svg>
                        @elseif($link['icon'] === 'applications')
                            <svg viewBox="0 0 24 24" class="h-5 w-5" fill="currentColor"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z"/></svg>
                        @elseif($link['icon'] === 'fundraising')
                            <svg viewBox="0 0 24 24" class="h-5 w-5" fill="currentColor"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                        @elseif($link['icon'] === 'transactions')
                            <svg viewBox="0 0 24 24" class="h-5 w-5" fill="currentColor"><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg>
                        @elseif($link['icon'] === 'financial')
                            <svg viewBox="0 0 24 24" class="h-5 w-5" fill="currentColor"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg>
                        @elseif($link['icon'] === 'projects')
                            <svg viewBox="0 0 24 24" class="h-5 w-5" fill="currentColor"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/></svg>
                        @elseif($link['icon'] === 'users')
                            <svg viewBox="0 0 24 24" class="h-5 w-5" fill="currentColor"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                        @else
                            <svg viewBox="0 0 24 24" class="h-5 w-5" fill="currentColor"><path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58c.18-.14.23-.41.12-.61l-1.92-3.32c-.12-.22-.37-.29-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94L14.4 2.81c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.22-.08-.47 0-.59.22L2.74 8.87c-.12.21-.08.47.12.61l2.03 1.58c-.05.3-.09.63-.09.94s.02.64.07.94l-2.03 1.58c-.18.14-.23.41-.12.61l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.47-.12-.61l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"/></svg>
                        @endif
                        <span>{{ $link['label'] }}</span>
                    </a>
                @endforeach
            </nav>
        </div>

        <div class="border-t border-slate-200 bg-white p-3">
            <form method="post" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="mb-2 flex w-full items-center gap-3 rounded-lg bg-green-500 px-3 py-2 text-sm font-semibold text-white transition hover:bg-green-600">
                    <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </button>
            </form>
            <button class="flex w-full items-center justify-center gap-2 rounded-lg bg-white px-3 py-2 text-xs font-medium text-slate-600 shadow-sm transition hover:bg-slate-50">
                <svg viewBox="0 0 24 24" class="h-4 w-4" fill="currentColor">
                    <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/>
                </svg>
                Chat
            </button>
        </div>
    </div>
</aside>
