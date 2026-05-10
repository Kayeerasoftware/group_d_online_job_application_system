@php
    $user = auth()->user();
    $pageTitle = trim($__env->yieldContent('title', 'Dashboard'));
@endphp

<header class="sticky top-0 z-30 border-b border-white/10 bg-slate-950/85 backdrop-blur-xl {{ auth()->check() ? 'md:pl-72 xl:pl-80' : '' }}">
    <div class="mx-auto flex max-w-7xl items-center gap-4 px-4 py-4 md:px-6">
        @auth
            <button
                type="button"
                class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-slate-100 transition hover:bg-white/10 md:hidden"
                data-sidebar-toggle
                aria-label="Open navigation menu"
            >
                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        @endauth

        <div class="min-w-0 flex-1">
            <div class="flex items-center gap-2 text-[0.7rem] font-semibold uppercase tracking-[0.35em] text-cyan-300/70">
                <span class="h-2 w-2 rounded-full bg-cyan-400"></span>
                Secure recruitment workspace
            </div>
            <div class="mt-1 flex items-center gap-3">
                <h1 class="truncate text-lg font-semibold text-white md:text-2xl">{{ $pageTitle }}</h1>
                @auth
                    <span class="hidden rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-medium text-slate-300 md:inline-flex">
                        {{ $user?->roleValue() }}
                    </span>
                @endauth
            </div>
        </div>

        <div class="hidden flex-1 justify-center xl:flex">
            <form method="get" action="{{ route('jobs.index') }}" class="w-full max-w-md">
                <label class="relative block">
                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-500">
                        <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.3-4.3m1.8-5.2a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" />
                        </svg>
                    </span>
                    <input
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search jobs, companies, locations"
                        class="w-full rounded-full border border-white/10 bg-white/5 py-3 pl-11 pr-4 text-sm text-slate-100 placeholder:text-slate-500 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20"
                    >
                </label>
            </form>
        </div>

        <div class="ml-auto flex items-center gap-3">
            @guest
                <a href="{{ route('jobs.index') }}" class="hidden rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-200 transition hover:bg-white/10 md:inline-flex">
                    Browse Jobs
                </a>
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-200 transition hover:bg-white/10">
                    <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 3h3a3 3 0 0 1 3 3v12a3 3 0 0 1-3 3h-3" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 17l5-5-5-5" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H3" />
                    </svg>
                    Sign in
                </a>
                <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-full bg-cyan-400 px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300">
                    <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14" />
                    </svg>
                    Create account
                </a>
            @else
                @if($user?->isSeeker())
                    <a href="{{ route('seeker.saved-jobs.index') }}" class="hidden items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-200 transition hover:bg-white/10 lg:inline-flex">
                        <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 4h12a2 2 0 0 1 2 2v16l-8-5-8 5V6a2 2 0 0 1 2-2Z" />
                        </svg>
                        Saved Jobs
                    </a>
                @endif

                @if($user?->isEmployer())
                    <a href="{{ route('jobs.create') }}" class="hidden items-center gap-2 rounded-full bg-cyan-400 px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300 lg:inline-flex">
                        <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14" />
                        </svg>
                        Post a Job
                    </a>
                @endif

                @if($user?->isAdmin())
                    <a href="{{ route('admin.reports.create') }}" class="hidden items-center gap-2 rounded-full bg-cyan-400 px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300 lg:inline-flex">
                        <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 4h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z" />
                        </svg>
                        Generate Report
                    </a>
                @endif

                <div class="hidden min-w-0 flex-col text-right md:flex">
                    <span class="truncate text-sm font-semibold text-white">{{ $user?->name }}</span>
                    <span class="truncate text-xs text-slate-400">{{ $user?->email }}</span>
                </div>

                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-200 transition hover:bg-white/10">
                        <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 17l5-5-5-5" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H3" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 3h3a3 3 0 0 1 3 3v12a3 3 0 0 1-3 3h-3" />
                        </svg>
                        Logout
                    </button>
                </form>
            @endguest
        </div>
    </div>
</header>
