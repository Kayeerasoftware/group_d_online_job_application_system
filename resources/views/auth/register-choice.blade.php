@extends('layouts.auth-register')

@section('title', 'Choose Account Type')

@section('body-class', 'auth-shell auth-shell--login login-page-shell register-choice-page-shell')

@section('main-class', 'auth-main--login')

@section('content')
    <div class="login-page">
        <section class="login-banner" aria-labelledby="register-choice-title">
            <h1 id="register-choice-title" class="login-banner__title">Choose your account type</h1>
        </section>

        <div class="login-panels-wrap">
            <div class="login-grid">
                <div class="login-card-stack">
                    <p class="login-card__eyebrow">For applicants</p>
                    <section class="login-panel login-panel--invite" aria-labelledby="choice-seeker-title">
                        <div class="login-panel__bar">Job Seeker</div>

                        <div class="login-panel__body">
                            <h2 id="choice-seeker-title" class="login-panel__title">Find and apply for roles</h2>
                            <p class="login-panel__intro">
                                Build a seeker profile, browse opportunities, and track every application from one dashboard.
                            </p>

                            <div class="signup-illustration" aria-hidden="true">
                                <img
                                    src="{{ asset(rawurlencode('job seeker.png')) }}"
                                    alt=""
                                    class="signup-illustration__svg"
                                    style="object-fit: cover;"
                                    loading="eager"
                                    decoding="async"
                                >
                            </div>

                            <ul class="login-advantage-list">
                                <li class="login-advantage-item">
                                    <span class="login-check" aria-hidden="true">
                                        <svg viewBox="0 0 12 12" class="login-check__icon" fill="none">
                                            <path d="M1.4 5.8L4.6 9L10.6 2.8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span>Search and save roles that match your goals</span>
                                </li>
                                <li class="login-advantage-item">
                                    <span class="login-check" aria-hidden="true">
                                        <svg viewBox="0 0 12 12" class="login-check__icon" fill="none">
                                            <path d="M1.4 5.8L4.6 9L10.6 2.8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span>Track applications and alerts in one place</span>
                                </li>
                            </ul>

                            <a class="login-button login-button--register" href="{{ route('register', ['role' => 'seeker']) }}">
                                Continue as seeker
                            </a>
                        </div>
                    </section>
                </div>

                <div class="login-card-stack">
                    <p class="login-card__eyebrow">For employers</p>
                    <section class="login-panel login-panel--form" aria-labelledby="choice-employer-title">
                        <div class="login-panel__bar">Employer</div>

                        <div class="login-panel__body">
                            <h2 id="choice-employer-title" class="login-panel__title">Post jobs and review candidates</h2>
                            <p class="login-panel__intro">
                                Create an employer profile to publish vacancies, manage applicants, and handle hiring with clarity.
                            </p>

                            <div class="signup-illustration" aria-hidden="true">
                                <img
                                    src="{{ asset(rawurlencode('Employer.png')) }}"
                                    alt=""
                                    class="signup-illustration__svg"
                                    style="object-fit: cover;"
                                    loading="eager"
                                    decoding="async"
                                >
                            </div>

                            <ul class="login-advantage-list">
                                <li class="login-advantage-item">
                                    <span class="login-check" aria-hidden="true">
                                        <svg viewBox="0 0 12 12" class="login-check__icon" fill="none">
                                            <path d="M1.4 5.8L4.6 9L10.6 2.8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span>Publish openings and manage candidate flow</span>
                                </li>
                                <li class="login-advantage-item">
                                    <span class="login-check" aria-hidden="true">
                                        <svg viewBox="0 0 12 12" class="login-check__icon" fill="none">
                                            <path d="M1.4 5.8L4.6 9L10.6 2.8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span>Keep job posts, reviews, and messages organised</span>
                                </li>
                            </ul>

                            <a class="login-button login-button--register" href="{{ route('register', ['role' => 'employer']) }}">
                                Continue as employer
                            </a>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <p class="signup-choice-footer">
            Already have an account? <a href="{{ route('login') }}">Sign in</a>
        </p>
    </div>
@endsection
