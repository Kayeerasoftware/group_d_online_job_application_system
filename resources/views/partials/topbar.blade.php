@php
    $user = safe_auth_user();
    $pageTitle = trim($__env->yieldContent('title', 'Dashboard'));
@endphp

<header class="app-chrome sticky top-0 z-30 border-b border-white/10 bg-[#1a1714] backdrop-blur-xl {{ safe_auth_check() ? 'md:pl-72 xl:pl-80' : '' }}">
    <div class="mx-auto flex max-w-7xl items-center gap-4 px-4 py-4 md:px-6">
        @if (safe_auth_check())
            <button
                type="button"
                class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-[#f9f7f3] transition hover:bg-white/10 md:hidden"
                data-sidebar-toggle
                aria-label="Open navigation menu"
            >
                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        @endif

        <a href="{{ safe_auth_check() ? route('dashboard') : route('home') }}" class="flex min-w-0 items-center gap-3">
            @if (request()->routeIs('home'))
                <img
                    src="{{ asset(rawurlencode('MAK-JOBLINK log.png')) }}"
                    alt="MAK-JOBLINK"
                    class="block h-14 w-auto max-w-[300px] object-contain md:h-16 lg:h-[4.25rem]"
                    loading="eager"
                >
            @else
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-400/15 text-sm font-bold text-emerald-200 ring-1 ring-emerald-400/30">JL</span>
                <span class="min-w-0">
                    <span class="block chrome-brand text-lg text-white">Job<span class="text-emerald-200">Link</span></span>
                    <span class="block truncate text-[0.68rem] font-semibold uppercase tracking-[0.35em] text-white/55">Online Job Application System</span>
                </span>
            @endif
        </a>

        <div class="hidden flex-1 justify-center xl:flex">
            <form method="get" action="{{ route('jobs.index') }}" class="w-full max-w-lg">
                <label class="relative block">
                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-white/35">
                        <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.3-4.3m1.8-5.2a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" />
                        </svg>
                    </span>
                    <input
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search jobs, companies, locations"
                        class="w-full rounded-full border border-white/10 bg-white/5 py-3 pl-11 pr-4 text-sm text-white placeholder:text-white/35 outline-none transition focus:border-emerald-300/50 focus:ring-2 focus:ring-emerald-300/15"
                    >
                </label>
            </form>
        </div>

        <div class="ml-auto flex items-center gap-3">
            @if (! safe_auth_check())
                <a href="{{ route('jobs.index') }}" class="hidden rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-white/85 transition hover:bg-white/10 md:inline-flex">
                    Browse Jobs
                </a>
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-white/85 transition hover:bg-white/10">
                    <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 3h3a3 3 0 0 1 3 3v12a3 3 0 0 1-3 3h-3" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 17l5-5-5-5" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H3" />
                    </svg>
                    Sign in
                </a>
                <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-full bg-emerald-400 px-4 py-2 text-sm font-semibold text-[#1a1714] transition hover:bg-emerald-300">
                    <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14" />
                    </svg>
                    Create account
                </a>
            @else
                @if($user?->isSeeker())
                    <a href="{{ route('seeker.saved-jobs') }}" class="hidden items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-white/85 transition hover:bg-white/10 lg:inline-flex">
                        <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 4h12a2 2 0 0 1 2 2v16l-8-5-8 5V6a2 2 0 0 1 2-2Z" />
                        </svg>
                        Saved Jobs
                    </a>
                @endif

                @if($user?->isEmployer())
                    <a href="{{ route('jobs.create') }}" class="hidden items-center gap-2 rounded-full bg-emerald-400 px-4 py-2 text-sm font-semibold text-[#1a1714] transition hover:bg-emerald-300 lg:inline-flex">
                        <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14" />
                        </svg>
                        Post a Job
                    </a>
                @endif

                @if($user?->isAdmin())
                    <a href="{{ route('admin.reports.create') }}" class="hidden items-center gap-2 rounded-full bg-emerald-400 px-4 py-2 text-sm font-semibold text-[#1a1714] transition hover:bg-emerald-300 lg:inline-flex">
                        <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14" />
                        </svg>
                        Generate Report
                    </a>
                @endif

                <div class="hidden min-w-0 flex-col text-right md:flex">
                    <span class="truncate text-sm font-semibold text-white">{{ $user?->name }}</span>
                    <span class="truncate text-xs text-white/55">{{ $user?->email }}</span>
                </div>

                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-white/85 transition hover:bg-white/10">
                        <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 17l5-5-5-5" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H3" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 3h3a3 3 0 0 1 3 3v12a3 3 0 0 1-3 3h-3" />
                        </svg>
                        Logout
                    </button>
                </form>
            @endif
        </div>
    </div>
</header>
