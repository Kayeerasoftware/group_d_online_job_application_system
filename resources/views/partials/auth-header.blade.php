@php
    $headerVariant = $headerVariant ?? 'login';
    $headerLayout = $headerLayout ?? 'default';
    $headerCenterLabel = $headerCenterLabel ?? null;
    $headerRightLines = $headerRightLines ?? [];
    $headerClass = $headerClass ?? '';
    $navItems = $navItems ?? [];
    $roleItems = $roleItems ?? [];
    $roleNavLabel = $roleNavLabel ?? 'Register as';
    $headerAction = $headerAction ?? null;
    $headerActionHref = $headerAction['href'] ?? null;
    $headerActionLabel = $headerAction['label'] ?? null;
    $headerActionVariant = $headerAction['variant'] ?? 'outline';
@endphp

<header class="auth-header auth-header--{{ $headerVariant }} {{ $headerLayout === 'full' ? 'auth-header--full' : '' }} {{ $headerClass }}">
    <div class="auth-header__inner py-2">
        @if ($headerLayout === 'full')
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img
                    src="{{ asset(rawurlencode('MAK-JOBLINK log.png')) }}"
                    alt="MAK-JOBLINK"
                    class="h-10 w-auto object-contain"
                    loading="eager"
                >
                <div class="hidden sm:block">
                    <span class="block text-white font-bold text-lg leading-tight">MAK-JOBLINK</span>
                    <span class="block text-white/70 text-sm leading-tight">Online Job Application</span>
                    <span class="block text-white/70 text-sm leading-tight">System</span>
                    <span class="block text-white font-bold text-lg leading-tight">MAK-JOBLINK</span>
                </div>
            </a>

            <div class="auth-header__center auth-header__center--title">
                <span class="auth-header__center-stack">
                    <span class="auth-header__center-eyebrow text-3xl font-bold">{{ $headerCenterLabel }}</span>
                </span>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('login') }}" class="text-white text-lg hover:text-white/80 transition font-semibold">Login</a>
                <a href="#welcome-card" class="text-white text-lg hover:text-white/80 transition font-semibold" onclick="document.getElementById('welcome-card')?.scrollIntoView({behavior: 'smooth', block: 'start'}); return false;">Browse Jobs</a>
            </div>
        @else
            <a href="{{ route('home') }}" class="auth-brand-link" aria-label="Go to home page">
                <span class="auth-logo-frame">
                    <svg class="auth-logo-frame__runner" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                        <rect x="0" y="0" width="100" height="100" rx="18" ry="18" pathLength="100"></rect>
                    </svg>
                    <img
                        src="{{ asset(rawurlencode('MAK-JOBLINK log.png')) }}"
                        alt="MAK-JOBLINK logo"
                        loading="eager"
                        decoding="async"
                        class="auth-brand__logo"
                    >
                </span>

                <span class="auth-brand">
                    <span class="auth-brand__eyebrow">Online Job Application System</span>
                    <span class="auth-brand__title">MAK-JOBLINK</span>
                </span>
            </a>

            <div class="auth-header__center">
                @if (count($navItems) || count($roleItems))
                    <nav class="auth-nav auth-nav--{{ $headerVariant }}" aria-label="Authentication pages">
                        @foreach ($navItems as $item)
                            <a
                                href="{{ $item['href'] }}"
                                class="auth-nav__link {{ $item['active'] ? 'is-active' : '' }}"
                                @if ($item['active']) aria-current="page" @endif
                            >
                                {{ $item['label'] }}
                            </a>
                        @endforeach

                        @if (count($roleItems))
                            <span class="auth-nav__separator" aria-hidden="true"></span>
                            <span class="auth-nav__label">{{ $roleNavLabel }}</span>
                            @foreach ($roleItems as $item)
                                <a
                                    href="{{ $item['href'] }}"
                                    class="auth-nav__link auth-nav__link--role {{ $item['active'] ? 'is-active' : '' }}"
                                    @if ($item['active']) aria-current="page" @endif
                                >
                                    {{ $item['label'] }}
                                </a>
                            @endforeach
                        @endif
                    </nav>
                @endif
            </div>

            <div class="auth-header__aside">
                @if ($headerActionHref && $headerActionLabel)
                    <a href="{{ $headerActionHref }}" class="auth-header__action auth-header__action--{{ $headerActionVariant }}">
                        {{ $headerActionLabel }}
                    </a>
                @endif
            </div>
        @endif
    </div>
</header>
