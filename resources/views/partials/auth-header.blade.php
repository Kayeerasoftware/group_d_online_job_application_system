@php
    $headerVariant = $headerVariant ?? 'login';
    $navItems = $navItems ?? [];
    $roleItems = $roleItems ?? [];
    $roleNavLabel = $roleNavLabel ?? 'Register as';
    $headerAction = $headerAction ?? null;
    $headerActionHref = $headerAction['href'] ?? null;
    $headerActionLabel = $headerAction['label'] ?? null;
    $headerActionVariant = $headerAction['variant'] ?? 'outline';
@endphp

<header class="auth-header auth-header--{{ $headerVariant }}">
    <div class="auth-header__inner">
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
    </div>
</header>
