@extends('layouts.auth-signup')

@section('title', 'Express Sign Up')

@section('content')
    <div class="signup-choice-wrap">
        <div class="signup-choice-shell">
            <h2 class="signup-choice-heading">SIGN UP AS</h2>

            <div class="signup-choice-shell__inner">
                <article class="signup-card">
                    <h2 class="signup-card__title">Job Seeker</h2>
                    <p class="signup-card__subtitle">Find jobs, save roles, and track every application from one dashboard.</p>

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

                    <a class="signup-button" href="{{ route('register', ['role' => 'seeker']) }}">
                        Click here
                    </a>
                </article>

                <article class="signup-card">
                    <h2 class="signup-card__title">Employer</h2>
                    <p class="signup-card__subtitle">Post vacancies, review candidates, and manage hiring in one place.</p>

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

                    <a class="signup-button" href="{{ route('register', ['role' => 'employer']) }}">
                        Click here
                    </a>
                </article>
            </div>
        </div>

        <p class="signup-choice-footer">
            Already have an account? <a href="{{ route('login') }}">Sign in</a>
        </p>
    </div>
@endsection
