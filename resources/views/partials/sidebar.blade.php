@php
    $user = auth()->user();
    $initials = collect(preg_split('/\s+/', trim($user?->name ?? 'U')) ?: ['U'])
        ->filter()
        ->map(fn ($part) => mb_substr($part, 0, 1))
        ->take(2)
        ->implode('');

    $links = [
        ['label' => 'Dashboard', 'route' => 'dashboard', 'active' => 'dashboard'],
        ['label' => 'Jobs', 'route' => 'jobs.index', 'active' => 'jobs.*'],
    ];

    $quickActions = [
        ['label' => 'Browse Jobs', 'route' => 'jobs.index', 'active' => 'jobs.index'],
    ];

    if ($user?->isSeeker()) {
        $links = array_merge($links, [
            ['label' => 'Saved Jobs', 'route' => 'seeker.saved-jobs.index', 'active' => 'seeker.saved-jobs.*'],
            ['label' => 'Applications', 'route' => 'applications.index', 'active' => 'applications.*'],
            ['label' => 'Notifications', 'route' => 'seeker.notifications.index', 'active' => 'seeker.notifications.*'],
            ['label' => 'Profile', 'route' => 'seeker.profile.edit', 'active' => 'seeker.profile.*'],
        ]);
        $quickActions = [
            ['label' => 'Browse Jobs', 'route' => 'jobs.index', 'active' => 'jobs.index'],
            ['label' => 'Saved Jobs', 'route' => 'seeker.saved-jobs.index', 'active' => 'seeker.saved-jobs.*'],
            ['label' => 'Edit Profile', 'route' => 'seeker.profile.edit', 'active' => 'seeker.profile.*'],
        ];
    } elseif ($user?->isEmployer()) {
        $links = array_merge($links, [
            ['label' => 'Post a Job', 'route' => 'jobs.create', 'active' => 'jobs.create'],
            ['label' => 'Company Profile', 'route' => 'employer.profile.edit', 'active' => 'employer.profile.*'],
            ['label' => 'Applications', 'route' => 'applications.index', 'active' => 'applications.*'],
        ]);
        $quickActions = [
            ['label' => 'Post a Job', 'route' => 'jobs.create', 'active' => 'jobs.create'],
            ['label' => 'View Jobs', 'route' => 'jobs.index', 'active' => 'jobs.index'],
            ['label' => 'Edit Company Profile', 'route' => 'employer.profile.edit', 'active' => 'employer.profile.*'],
        ];
    } elseif ($user?->isAdmin()) {
        $links = array_merge($links, [
            ['label' => 'Users', 'route' => 'admin.users.index', 'active' => 'admin.users.*'],
            ['label' => 'Audit Logs', 'route' => 'admin.audit-logs.index', 'active' => 'admin.audit-logs.*'],
            ['label' => 'Reports', 'route' => 'admin.reports.index', 'active' => 'admin.reports.*'],
            ['label' => 'System Health', 'route' => 'admin.system.index', 'active' => 'admin.system.*'],
        ]);
        $quickActions = [
            ['label' => 'Users', 'route' => 'admin.users.index', 'active' => 'admin.users.*'],
            ['label' => 'Generate Report', 'route' => 'admin.reports.create', 'active' => 'admin.reports.create'],
            ['label' => 'Audit Logs', 'route' => 'admin.audit-logs.index', 'active' => 'admin.audit-logs.*'],
            ['label' => 'System Health', 'route' => 'admin.system.index', 'active' => 'admin.system.*'],
        ];
    }

    $icons = [
        'dashboard' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.5V6a2 2 0 0 1 2-2h4v9.5H3Zm10-9.5h6a2 2 0 0 1 2 2v5h-8V4Zm0 10h8v6a2 2 0 0 1-2 2h-6v-8Zm-10 0h8v8H5a2 2 0 0 1-2-2v-6Z" /></svg>',
        'jobs.index' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16v11H4z" /><path stroke-linecap="round" stroke-linejoin="round" d="M9 7V5a3 3 0 0 1 6 0v2" /></svg>',
        'seeker.saved-jobs.index' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6 4h12a2 2 0 0 1 2 2v16l-8-5-8 5V6a2 2 0 0 1 2-2Z" /></svg>',
        'applications.index' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5h6l4 4v10a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6M9 17h6" /></svg>',
        'seeker.notifications.index' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17H9m8-2V9a5 5 0 0 0-10 0v6L5 17h14l-1-2Z" /></svg>',
        'seeker.profile.edit' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M4 20a8 8 0 0 1 16 0" /></svg>',
        'jobs.create' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14" /></svg>',
        'employer.profile.edit' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h10M4 17h16" /></svg>',
        'admin.users.index' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20a4 4 0 0 0-8 0" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4Z" /></svg>',
        'admin.audit-logs.index' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6 4h9l5 5v11H6z" /><path stroke-linecap="round" stroke-linejoin="round" d="M9 14h6M9 18h6" /></svg>',
        'admin.reports.index' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M7 4h10v16H7z" /><path stroke-linecap="round" stroke-linejoin="round" d="M9 8h6M9 12h6M9 16h4" /></svg>',
        'admin.reports.create' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14" /></svg>',
        'admin.system.index' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h3m9 0h3M12 4.5v3m0 9v3M6.1 6.1l2.1 2.1m7.6 7.6 2.1 2.1M17.9 6.1l-2.1 2.1M8.2 15.8l-2.1 2.1" /></svg>',
    ];
@endphp

<div data-sidebar-backdrop class="fixed inset-0 z-30 hidden bg-[#1a1714]/70 backdrop-blur-sm md:hidden"></div>

<aside
    data-sidebar
    class="app-chrome fixed inset-y-0 left-0 z-40 w-72 -translate-x-full border-r border-white/10 bg-[#1a1714] backdrop-blur-xl transition-transform duration-300 md:translate-x-0 xl:w-80"
>
    <div class="flex h-full flex-col">
        <div class="flex items-center justify-between border-b border-white/10 px-5 py-5">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-400/15 text-sm font-bold text-emerald-200 ring-1 ring-emerald-400/30">JL</span>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-white/55">Workspace</p>
                    <p class="chrome-brand text-lg text-white">Job<span class="text-emerald-200">Link</span></p>
                </div>
            </a>
            <button
                type="button"
                class="inline-flex h-10 w-10 items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-lg text-white transition hover:bg-white/10 md:hidden"
                data-sidebar-close
                aria-label="Close navigation menu"
            >
                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6 6 18" />
                </svg>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto px-4 py-5">
            <div class="rounded-[28px] border border-white/10 bg-white/5 p-4 shadow-lg shadow-slate-950/20">
                <p class="text-xs uppercase tracking-[0.35em] text-white/45">Signed in as</p>
                <div class="mt-3 flex items-center gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-400/15 text-sm font-semibold text-emerald-200 ring-1 ring-emerald-400/30">
                        {{ $initials }}
                    </div>
                    <div class="min-w-0">
                        <p class="truncate font-semibold text-white">{{ $user?->name }}</p>
                        <p class="truncate text-sm text-white/55">{{ $user?->email }}</p>
                    </div>
                </div>
                <div class="mt-4 chrome-chip">
                    <span class="h-2 w-2 rounded-full bg-emerald-300"></span>
                    {{ $user?->roleValue() }}
                </div>
            </div>

            <nav class="mt-6 space-y-6">
                <div>
                    <p class="px-3 text-xs font-semibold uppercase tracking-[0.35em] text-white/40">Main Navigation</p>
                    <div class="mt-3 space-y-1">
                        @foreach($links as $link)
                            <a
                                href="{{ route($link['route']) }}"
                                @class([
                                    'chrome-link',
                                    'is-active' => request()->routeIs($link['active']),
                                ])
                            >
                                <span class="flex h-9 w-9 items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-white/70">
                                    {!! $icons[$link['route']] ?? $icons['dashboard'] !!}
                                </span>
                                <span class="text-sm font-medium">{{ $link['label'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="rounded-[28px] border border-white/10 bg-white/5 p-4">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-white/40">Quick Actions</p>
                    <div class="mt-3 space-y-2">
                        @foreach($quickActions as $action)
                            <a
                                href="{{ route($action['route']) }}"
                                class="flex items-center justify-between rounded-2xl border border-white/10 bg-[#221e1a] px-4 py-3 text-sm font-semibold text-white/85 transition hover:-translate-y-0.5 hover:bg-[#2a241f]"
                            >
                                <span class="flex items-center gap-3">
                                    <span class="flex h-8 w-8 items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-white/65">
                                        {!! $icons[$action['route']] ?? $icons['jobs.index'] !!}
                                    </span>
                                    <span>{{ $action['label'] }}</span>
                                </span>
                                <svg viewBox="0 0 24 24" class="h-4 w-4 text-white/35" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m9 5 7 7-7 7" />
                                </svg>
                            </a>
                        @endforeach
                    </div>
                </div>
            </nav>
        </div>

        <div class="border-t border-white/10 p-4">
            <form method="post" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-2xl bg-emerald-400 px-4 py-3 text-sm font-semibold text-[#1a1714] transition hover:bg-emerald-300">
                    <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 17l5-5-5-5" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H3" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 3h3a3 3 0 0 1 3 3v12a3 3 0 0 1-3 3h-3" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </div>
</aside>
