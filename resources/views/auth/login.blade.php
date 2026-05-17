@extends('layouts.auth-login')

@section('title', 'Login')

@section('body-class', 'auth-shell auth-shell--login login-page-shell')

@section('main-class', 'auth-main--login')

@section('content')
    @php
        $advantages = [
            'Create your profile in a few simple steps',
            'Move through search, applications, and updates smoothly',
            'Keep alerts and account activity in one place',
            'Stay organised with a tidy, easy-to-read dashboard',
            'Return anytime without losing your progress',
        ];

        $highlights = [
            ['value' => '3', 'label' => 'Roles supported'],
            ['value' => '24/7', 'label' => 'Account access'],
            ['value' => '1 tap', 'label' => 'Recover fast'],
        ];
    @endphp

    <div class="login-page login-page--premium">
        <section class="login-banner login-banner--hero" aria-labelledby="login-banner-title">


            <div class="login-banner__highlights" aria-label="Login highlights">
                @foreach ($highlights as $highlight)
                    <div class="login-banner__highlight">
                        <span class="login-banner__highlight-value">{{ $highlight['value'] }}</span>
                        <span class="login-banner__highlight-label">{{ $highlight['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </section>

        <div class="login-panels-wrap">
            <div class="login-grid">
                <div class="login-card-stack login-card-stack--story">
                    <p class="login-card__eyebrow">A smoother way to sign in</p>
                    <section class="login-panel login-panel--invite login-panel--story" aria-labelledby="login-invite-title">
                        <div class="login-panel__bar">Platform benefits</div>

                        <div class="login-panel__body">
                            <div class="login-summary">
                                <div class="login-summary__item">
                                    <span class="login-summary__value">Fast</span>
                                    <span class="login-summary__label">Continue where you left off</span>
                                </div>
                                <div class="login-summary__item">
                                    <span class="login-summary__value">Safe</span>
                                    <span class="login-summary__label">Protected account access</span>
                                </div>
                                <div class="login-summary__item">
                                    <span class="login-summary__value">Clear</span>
                                    <span class="login-summary__label">Manage jobs and alerts</span>
                                </div>
                            </div>

                            <h2 id="login-invite-title" class="login-panel__title">What you gain</h2>
                            <p class="login-panel__intro">
                                One account gives you a cleaner, more organised way to track your work across the platform.
                            </p>

                            <ul class="login-advantage-list">
                                @foreach ($advantages as $advantage)
                                    <li class="login-advantage-item">
                                        <span class="login-check" aria-hidden="true">
                                            <svg viewBox="0 0 12 12" class="login-check__icon" fill="none">
                                                <path d="M1.4 5.8L4.6 9L10.6 2.8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                        <span>{{ $advantage }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <a class="login-button login-button--register" href="{{ route('register') }}">
                                Start here
                            </a>
                        </div>
                    </section>
                </div>

                <div class="login-card-stack login-card-stack--form">
                    <div class="login-mobile-register">
                        <span>New here?</span>
                        <a href="{{ route('register') }}">Create account</a>
                    </div>
                    @include('partials.alerts', ['alertMode' => 'dialog'])
                    <p class="login-card__eyebrow">Already have an account?</p>
                    <section class="login-panel login-panel--form login-panel--auth" aria-labelledby="login-form-title">
                        <div class="login-panel__bar">Sign in</div>

                        <div class="login-panel__body">
                            <div class="login-form-intro">
                                <h2 id="login-form-title" class="login-panel__title">Welcome back</h2>
                                <p class="login-panel__intro">
                                    Use your email and password to resume applications, review hiring activity, and stay connected.
                                </p>
                            </div>

                            <form method="post" action="{{ route('login.store') }}" class="login-form">
                                @csrf

                                <div class="login-field">
                                    <label class="sr-only" for="email">Email address</label>
                                    <input
                                        class="login-input"
                                        id="email"
                                        name="email"
                                        type="email"
                                        value="{{ old('email') }}"
                                        placeholder="Email *"
                                        required
                                        autocomplete="email"
                                    >
                                    @error('email')
                                        <p class="login-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="login-field">
                                    <label class="sr-only" for="password">Password</label>
                                    <div class="login-password-row">
                                        <input
                                            class="login-input login-input--password"
                                            id="password"
                                            name="password"
                                            type="password"
                                            placeholder="Password *"
                                            required
                                            autocomplete="current-password"
                                        >
                                        <button
                                            class="login-eye"
                                            type="button"
                                            data-password-toggle="password"
                                            aria-pressed="false"
                                            aria-label="Toggle password visibility"
                                        >
                                            <svg data-password-icon-show viewBox="0 0 24 24" class="login-eye__icon" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12 18 18.75 12 18.75 2.25 12 2.25 12Z" />
                                                <circle cx="12" cy="12" r="3" />
                                            </svg>
                                            <svg data-password-icon-hide viewBox="0 0 24 24" class="login-eye__icon hidden" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.6 10.6a3 3 0 0 0 4.2 4.2" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.2 6.2C4.4 7.5 2.9 9.4 2.25 12c0 0 3.75 6.75 9.75 6.75 1.7 0 3.2-.35 4.48-.96" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.6 4.6A11.2 11.2 0 0 1 12 4.25C18 4.25 21.75 12 21.75 12a14.5 14.5 0 0 1-3.1 4.44" />
                                            </svg>
                                        </button>
                                    </div>
                                    @error('password')
                                        <p class="login-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="login-forgot-wrap">
                                    <a class="login-forgot" href="{{ route('password.request') }}">
                                        Forgot password?
                                    </a>
                                </div>

                                <button class="login-button" type="submit">
                                    Sign in
                                </button>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
