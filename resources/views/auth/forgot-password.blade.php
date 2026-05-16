@extends('layouts.auth-recovery')

@section('title', 'Forgot Password')

@section('body-class', 'auth-shell auth-shell--login login-page-shell forgot-password-page-shell')

@section('main-class', 'auth-main--login')

@section('content')
    @php
        $steps = [
            'Enter the email address linked to your account',
            'We will send a secure reset link if the account exists',
            'Use the link to create a new password and sign back in',
            'Works for both job seeker and employer accounts',
        ];
    @endphp

    <div class="login-page">
        <section class="login-banner" aria-labelledby="forgot-banner-title">
            <h1 id="forgot-banner-title" class="login-banner__title">Reset your account access</h1>
        </section>

        <div class="login-panels-wrap">
            <div class="login-grid">
                <div class="login-card-stack">
                    <p class="login-card__eyebrow">Need a new link?</p>
                    <section class="login-panel login-panel--invite" aria-labelledby="forgot-help-title">
                        <div class="login-panel__bar">Recovery steps</div>

                        <div class="login-panel__body">
                            <h2 id="forgot-help-title" class="login-panel__title">How it works</h2>

                            <p class="login-panel__intro">
                                We keep the recovery flow simple and secure so job seekers and employers can get back into their accounts quickly.
                            </p>

                            <ul class="login-advantage-list">
                                @foreach ($steps as $step)
                                    <li class="login-advantage-item">
                                        <span class="login-check" aria-hidden="true">
                                            <svg viewBox="0 0 12 12" class="login-check__icon" fill="none">
                                                <path d="M1.4 5.8L4.6 9L10.6 2.8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                        <span>{{ $step }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <a class="login-button login-button--register" href="{{ route('login') }}">
                                Back to sign in
                            </a>
                        </div>
                    </section>
                </div>

                <div class="login-card-stack">
                    @include('partials.alerts', ['alertMode' => 'dialog'])
                    <p class="login-card__eyebrow">Request a reset link</p>
                    <section class="login-panel login-panel--form" aria-labelledby="forgot-form-title">
                        <div class="login-panel__bar">Send link</div>

                        <div class="login-panel__body">
                            <h2 id="forgot-form-title" class="login-panel__title">Enter your email</h2>
                            <p class="login-panel__intro">
                                Add the address you used when you created your account, and we’ll send a password reset link if we find a matching record.
                            </p>

                            <form method="post" action="{{ route('password.email') }}" class="login-form">
                                @csrf

                                <div class="login-field">
                                    <label class="sr-only" for="email">Email address</label>
                                    <input
                                        class="login-input"
                                        id="email"
                                        name="email"
                                        type="email"
                                        value="{{ old('email') }}"
                                        placeholder="Email address *"
                                        required
                                        autocomplete="email"
                                    >
                                    @error('email')
                                        <p class="login-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button class="login-button" type="submit">
                                    Send reset link
                                </button>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
