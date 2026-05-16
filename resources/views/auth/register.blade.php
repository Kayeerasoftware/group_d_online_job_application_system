@extends('layouts.auth-register')

@section('title', old('role', $selectedRole ?? 'seeker') === 'employer' ? 'Employer Registration' : 'Job Seeker Registration')

@section('body-class', 'auth-shell auth-shell--signup register-page-shell')

@section('main-class', 'auth-main--top')

@section('content')
    @php
        $selectedRole = old('role', $selectedRole ?? 'seeker');
        $isEmployer = $selectedRole === 'employer';
        $roleTitle = $isEmployer ? 'Employer Account' : 'Job Seeker Account';
        $roleBar = $isEmployer ? 'Employer' : 'Job Seeker';
        $roleSubtitle = $isEmployer ? 'Create your employer account' : 'Create your job seeker account';
        $roleSupport = $isEmployer
            ? 'Set up your employer profile so you can post jobs, review applicants, and manage hiring in one place.'
            : 'Set up your profile so you can apply for jobs, track applications, and keep your updates organised.';
        $nameLabel = $isEmployer ? 'Company Name' : 'Full Name';
        $namePlaceholder = $isEmployer ? 'Company Name *' : 'Full Name *';
        $submitLabel = $isEmployer ? 'Create Employer Account' : 'Create Seeker Account';
        $benefits = $isEmployer
            ? [
                'Post job openings and review candidates from one dashboard',
                'Keep hiring updates, shortlist decisions, and alerts together',
                'Manage your employer profile once and return anytime',
                'Switch between employer tasks without losing your place',
            ]
            : [
                'Build a seeker profile and start applying faster',
                'Track applications, alerts, and saved roles in one place',
                'Return to your account anytime without redoing your progress',
                'Keep your personal details ready for future opportunities',
            ];
    @endphp

                <div
                    class="login-page"
                    style="width:100vw;max-width:none;margin-left:calc(50% - 50vw);margin-right:calc(50% - 50vw);padding-inline:0;"
                >
        <section class="login-banner" aria-labelledby="register-banner-title">
            <h1 id="register-banner-title" class="login-banner__title">Create your account</h1>
        </section>

        <div class="login-panels-wrap" style="width:100%;max-width:none;">
            <div
                class="login-grid"
                style="width:100%;max-width:none;grid-template-columns:minmax(260px,320px) minmax(0,1fr);align-items:stretch;padding-inline:clamp(16px,2.5vw,40px);"
            >
                <div class="login-card-stack" data-register-invite style="max-width:320px;align-self:stretch;min-width:0;">
                    <p class="login-card__eyebrow">Why register?</p>
                    <section class="login-panel login-panel--invite" aria-labelledby="register-benefits-title">
                        <div class="login-panel__bar">Account benefits</div>

                        <div class="login-panel__body">
                            <h2 id="register-benefits-title" class="login-panel__title">{{ $roleTitle }}</h2>
                            <p class="login-panel__intro">
                                {{ $roleSupport }}
                            </p>

                            <ul class="login-advantage-list">
                                @foreach ($benefits as $benefit)
                                    <li class="login-advantage-item">
                                        <span class="login-check" aria-hidden="true">
                                            <svg viewBox="0 0 12 12" class="login-check__icon" fill="none">
                                                <path d="M1.4 5.8L4.6 9L10.6 2.8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                        <span>{{ $benefit }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <a class="login-button login-button--register" href="{{ route('login') }}">
                                Back to sign in
                            </a>
                        </div>
                    </section>
                </div>

                <div class="login-card-stack" style="max-width:none;width:100%;align-self:stretch;align-items:stretch;min-width:0;">
                    @include('partials.alerts', ['alertMode' => 'dialog'])
                    <p class="login-card__eyebrow">Complete your details</p>
                    <section class="login-panel login-panel--form" aria-labelledby="register-form-title">
                        <div class="login-panel__bar">Register as {{ $roleBar }}</div>

                        <div class="login-panel__body">
                            <h2 id="register-form-title" class="login-panel__title">{{ $roleSubtitle }}</h2>

                            <form method="post" action="{{ route('register.store') }}" class="register-form">
                                @csrf
                                <input type="hidden" name="role" value="{{ $selectedRole }}">

                                <div class="register-grid">
                                    <div class="login-field">
                                        <label class="register-field__label" for="name">{{ $nameLabel }}</label>
                                        <input
                                            class="login-input {{ $errors->has('name') ? 'login-input--error' : '' }}"
                                            id="name"
                                            name="name"
                                            type="text"
                                            value="{{ old('name') }}"
                                            placeholder="{{ $namePlaceholder }}"
                                            required
                                            autocomplete="name"
                                        >
                                        @error('name')
                                            <p class="login-error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="login-field">
                                        <label class="register-field__label" for="phone">Phone Number</label>
                                        <input
                                            class="login-input {{ $errors->has('phone') ? 'login-input--error' : '' }}"
                                            id="phone"
                                            name="phone"
                                            type="tel"
                                            value="{{ old('phone') }}"
                                            placeholder="Phone Number"
                                            autocomplete="tel"
                                        >
                                        @error('phone')
                                            <p class="login-error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="login-field register-field--full">
                                        <label class="register-field__label" for="account_email">Email</label>
                                        <input
                                            class="login-input {{ $errors->has('email') ? 'login-input--error' : '' }}"
                                            id="account_email"
                                            name="email"
                                            type="email"
                                            value="{{ old('email') }}"
                                            placeholder="Email"
                                            required
                                            autocomplete="email"
                                        >
                                        @error('email')
                                            <p class="login-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="register-password-stack">
                                    <div class="login-field">
                                        <label class="register-field__label" for="password">Password</label>
                                        <p class="register-password-note">
                                            Use at least <span class="font-semibold text-rose-600">8 characters</span> with uppercase, lowercase, number, and special character.
                                        </p>
                                        <input
                                            class="login-input {{ $errors->has('password') ? 'login-input--error' : '' }}"
                                            id="password"
                                            name="password"
                                            type="password"
                                            required
                                            autocomplete="new-password"
                                            placeholder="Password"
                                            data-register-password
                                        >
                                        <div class="password-strength-meter">
                                            <div class="password-strength-track" aria-hidden="true">
                                                <div class="password-strength-track__fill password-strength-bar" data-password-strength-bar></div>
                                            </div>
                                            <div class="password-strength-partitions" aria-hidden="true">
                                                <span class="password-strength-partition" data-strength-step="0">Weak</span>
                                                <span class="password-strength-partition" data-strength-step="1">Moderate</span>
                                                <span class="password-strength-partition" data-strength-step="2">Decent</span>
                                                <span class="password-strength-partition" data-strength-step="3">Strong</span>
                                                <span class="password-strength-partition" data-strength-step="4">Very Strong</span>
                                            </div>
                                        </div>
                                        <p class="text-xs font-medium text-emerald-700" data-password-strength-label></p>
                                        <ul class="space-y-1 text-xs leading-5" data-password-rules>
                                            <li class="flex items-center gap-2 text-rose-600" data-rule="length">
                                                <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full border border-rose-400 text-[10px] leading-none text-rose-500" data-rule-bullet>&times;</span>
                                                <span>At least 8 characters</span>
                                            </li>
                                            <li class="flex items-center gap-2 text-rose-600" data-rule="upper">
                                                <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full border border-rose-400 text-[10px] leading-none text-rose-500" data-rule-bullet>&times;</span>
                                                <span>One uppercase letter (A-Z)</span>
                                            </li>
                                            <li class="flex items-center gap-2 text-rose-600" data-rule="lower">
                                                <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full border border-rose-400 text-[10px] leading-none text-rose-500" data-rule-bullet>&times;</span>
                                                <span>One lowercase letter (a-z)</span>
                                            </li>
                                            <li class="flex items-center gap-2 text-rose-600" data-rule="number">
                                                <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full border border-rose-400 text-[10px] leading-none text-rose-500" data-rule-bullet>&times;</span>
                                                <span>One number (0-9)</span>
                                            </li>
                                            <li class="flex items-center gap-2 text-rose-600" data-rule="special">
                                                <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full border border-rose-400 text-[10px] leading-none text-rose-500" data-rule-bullet>&times;</span>
                                                <span>One special character (!@#$%^&*)</span>
                                            </li>
                                            <li class="flex items-center gap-2 text-rose-600" data-rule="common">
                                                <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full border border-rose-400 text-[10px] leading-none text-rose-500" data-rule-bullet>&times;</span>
                                                <span>Not a common password</span>
                                            </li>
                                        </ul>
                                        @error('password')
                                            <p class="login-error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="login-field">
                                        <label class="register-field__label" for="password_confirmation">Confirm Password</label>
                                        <input
                                            class="login-input"
                                            id="password_confirmation"
                                            name="password_confirmation"
                                            type="password"
                                            required
                                            autocomplete="new-password"
                                            placeholder="Confirm Password *"
                                            data-register-password-confirmation
                                        >
                                        <div class="flex items-center gap-2 text-xs font-medium text-rose-600" data-password-match-status>
                                            <span class="inline-flex h-4 w-4 items-center justify-center rounded-full border border-rose-400 text-[10px] leading-none text-rose-500">&times;</span>
                                            Mismatch
                                        </div>
                                    </div>

                                    <div class="register-password-row">
                                        <label class="inline-flex items-center gap-2 text-sm text-slate-700">
                                            <input class="h-4 w-4 rounded border-emerald-400/40 bg-white text-emerald-500 focus:ring-emerald-400/20" type="checkbox" data-show-passwords>
                                            Show passwords
                                        </label>

                                        <p class="register-password-row__note">
                                            You can edit, add, and change your profile after registration when logged in.
                                        </p>
                                    </div>
                                </div>

                                <div class="register-footer">
                                    <button
                                        class="login-button register-submit-button"
                                        type="submit"
                                        style="width:max-content;min-width:15rem;padding-inline:1.4rem;white-space:nowrap;"
                                    >
                                        {{ $submitLabel }}
                                    </button>

                                    <p class="text-center text-sm text-slate-600">
                                        Already have an account?
                                        <a class="register-link font-medium transition hover:text-[#bb0829]" href="{{ route('login') }}">Sign in</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const password = document.querySelector('[data-register-password]');
            const confirmation = document.querySelector('[data-register-password-confirmation]');
            const showPasswords = document.querySelector('[data-show-passwords]');
            const strengthBar = document.querySelector('[data-password-strength-bar]');
            const strengthLabel = document.querySelector('[data-password-strength-label]');
            const matchStatus = document.querySelector('[data-password-match-status]');
            const inviteCard = document.querySelector('[data-register-invite]');

            const updateInviteCard = () => {
                if (!inviteCard) {
                    return;
                }

                const compact = window.matchMedia('(max-width: 1024px)').matches;
                inviteCard.hidden = compact;
            };

            const tests = {
                length: (value) => value.length >= 8,
                upper: (value) => /[A-Z]/.test(value),
                lower: (value) => /[a-z]/.test(value),
                number: (value) => /[0-9]/.test(value),
                special: (value) => /[^A-Za-z0-9]/.test(value),
                common: (value) => value.length > 0 && /^(?!.*(password|12345678|qwerty|letmein|admin))/i.test(value),
            };
            const strengthRules = ['length', 'upper', 'lower', 'number', 'special'];

            const setRuleState = (key, met) => {
                const item = document.querySelector(`[data-rule="${key}"]`);
                if (!item) {
                    return;
                }

                const bullet = item.querySelector('[data-rule-bullet]');
                item.classList.toggle('text-emerald-300', met);
                item.classList.toggle('text-rose-300', !met);
                item.classList.toggle('text-slate-500', false);

                if (bullet) {
                    bullet.className = 'inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full border text-[10px] leading-none ' + (met ? 'border-emerald-400 text-emerald-400' : 'border-rose-400 text-rose-400');
                    bullet.classList.toggle('text-emerald-400', met);
                    bullet.classList.toggle('text-rose-400', !met);
                    bullet.innerHTML = met ? '&#10003;' : '&times;';
                }
            };

            const setStrengthBarState = (passed) => {
                if (!strengthBar) {
                    return;
                }

                const labels = ['Weak', 'Moderate', 'Decent', 'Strong', 'Very Strong'];
                const colors = ['#ef4444', '#f97316', '#eab308', '#16a34a', '#15803d'];
                const hasPassword = passed > 0;
                const activeStep = hasPassword ? Math.min(4, passed - 1) : -1;

                strengthBar.style.width = hasPassword ? `${(activeStep + 1) * 20}%` : '0%';
                strengthBar.style.backgroundColor = hasPassword ? colors[activeStep] : 'transparent';

                document.querySelectorAll('[data-strength-step]').forEach((step, index) => {
                    step.classList.toggle('is-active', hasPassword && index === activeStep);
                });

                if (strengthLabel) {
                    strengthLabel.textContent = hasPassword ? labels[activeStep] : '';
                    strengthLabel.className = 'text-xs font-medium ' + (
                        activeStep >= 4 ? 'text-emerald-700' :
                        activeStep === 3 ? 'text-emerald-600' :
                        activeStep === 2 ? 'text-amber-600' :
                        activeStep === 1 ? 'text-orange-600' :
                        activeStep === 0 ? 'text-rose-600' :
                        'text-slate-500'
                    );
                }
            };

            const evaluatePassword = () => {
                const value = password?.value || '';
                const results = Object.fromEntries(Object.entries(tests).map(([key, test]) => [key, test(value)]));
                const passed = strengthRules.filter((key) => results[key]).length;

                Object.entries(results).forEach(([key, met]) => setRuleState(key, met));
                setStrengthBarState(passed);
            };

            const evaluateMatch = () => {
                if (!matchStatus) {
                    return;
                }

                const matched = Boolean(password?.value) && password.value === (confirmation?.value || '');
                matchStatus.className = 'flex items-center gap-2 text-xs font-medium ' + (matched ? 'text-emerald-300' : 'text-rose-300');
                matchStatus.innerHTML = matched
                    ? '<span class="inline-flex h-4 w-4 items-center justify-center rounded-full border border-emerald-400 text-[10px] leading-none text-emerald-400">&#10003;</span> Matching'
                    : '<span class="inline-flex h-4 w-4 items-center justify-center rounded-full border border-rose-400 text-[10px] leading-none text-rose-400">&times;</span> Mismatch';
            };

            const togglePasswords = () => {
                const visible = Boolean(showPasswords?.checked);

                [password, confirmation].forEach((input) => {
                    if (input) {
                        input.type = visible ? 'text' : 'password';
                    }
                });
            };

            password?.addEventListener('input', () => {
                evaluatePassword();
                evaluateMatch();
            });

            confirmation?.addEventListener('input', evaluateMatch);
            showPasswords?.addEventListener('change', togglePasswords);
            window.addEventListener('resize', updateInviteCard, { passive: true });

            evaluatePassword();
            evaluateMatch();
            togglePasswords();
            updateInviteCard();
        });
    </script>
@endsection
