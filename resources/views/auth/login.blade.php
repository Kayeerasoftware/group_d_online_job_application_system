@extends('layouts.auth-login')

@section('title', 'Login')

@section('content')
    @php
        $advantages = [
            'Apply for jobs faster from one dashboard',
            'Post and manage vacancies with ease',
            'Track applications and saved jobs in real time',
            'Receive account and application notifications',
            'Keep employer, seeker, and admin data organized',
        ];
    @endphp

    <div class="login-choice-shell">
        <h2 class="login-choice-heading">SIGN-IN TO YOUR ACCOUNT</h2>

        <div class="login-choice-shell__inner">
            <div class="login-choice-column">
                <p class="login-card__eyebrow">Don't have an account yet?</p>
                <section class="login-card">
                    <div class="login-card__bar">Register</div>

                    <div class="login-card__body">
                        <h2 class="login-subtitle">Why join this platform</h2>

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
                            Create Account
                        </a>
                    </div>
                </section>
            </div>

            <div class="login-choice-column">
                <p class="login-card__eyebrow">Have an account?</p>
                <section class="login-card">
                    <div class="login-card__bar">Log In</div>

                    <div class="login-card__body">
                        <form method="post" action="{{ route('login.store') }}" class="login-form">
                            @csrf

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

                            <div class="login-forgot-wrap">
                                <a class="login-forgot" href="{{ route('password.request') }}">
                                    Forgot password?
                                </a>
                            </div>

                            <button class="login-button" type="submit">
                                Log In
                            </button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
