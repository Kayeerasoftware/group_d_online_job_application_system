@extends('layouts.auth-signup')

@section('body-class', 'auth-shell auth-shell--signup register-form-page')

@section('main-class', 'auth-main--top')

@section('title', old('role', $selectedRole ?? 'seeker') === 'employer' ? 'Employer Registration' : 'Job Seeker Registration')

@section('content')
    @php
        $selectedRole = old('role', $selectedRole ?? 'seeker');
        $isEmployer = $selectedRole === 'employer';
        $roleTitle = $isEmployer ? 'EMPLOYER REGISTRATION' : 'JOB SEEKER REGISTRATION';
        $roleBar = $isEmployer ? 'Employer' : 'Job Seeker';
        $roleSubtitle = $isEmployer ? 'Create your employer account' : 'Create your job seeker account';
        $roleSupport = $isEmployer
            ? 'Set up your employer profile so you can post jobs and manage applicants in one place.'
            : 'Set up your profile so you can apply for jobs and manage your applications in one place.';
        $nameLabel = $isEmployer ? 'Company Name' : 'Full Name';
        $namePlaceholder = $isEmployer ? 'Company Name *' : 'Full Name *';
        $submitLabel = $isEmployer ? 'Create Employer Account' : 'Create Seeker Account';
        $fieldClass = 'register-input';
        $errorClass = 'border-rose-300 focus:border-rose-400 focus:ring-rose-400/15';
        $accountInputClass = 'register-input';
    @endphp

    <div class="register-shell">
        <h2 class="register-heading">{{ $roleTitle }}</h2>

        <section class="register-card">
            <div class="register-card__bar">{{ $roleBar }}</div>

            <div class="register-card__body">
                <form method="post" action="{{ route('register.store') }}" class="register-form">
                    @csrf
                    <input type="hidden" name="role" value="{{ $selectedRole }}">

                    <h2 class="register-subtitle">{{ $roleSubtitle }}</h2>
                    <p class="text-sm text-slate-600">
                        {{ $roleSupport }}
                    </p>

                    <div class="register-grid">
                        <div class="space-y-1.5">
                            <label class="text-sm font-medium text-slate-700" for="name">{{ $nameLabel }}</label>
                            <input
                                class="{{ $fieldClass }} {{ $errors->has('name') ? $errorClass : '' }}"
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name') }}"
                                placeholder="{{ $namePlaceholder }}"
                                required
                                autocomplete="name"
                            >
                            @error('name')
                                <p class="text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-sm font-medium text-slate-700" for="phone">Phone Number</label>
                            <input
                                class="{{ $fieldClass }} {{ $errors->has('phone') ? $errorClass : '' }}"
                                id="phone"
                                name="phone"
                                type="tel"
                                value="{{ old('phone') }}"
                                placeholder="Phone Number"
                                autocomplete="tel"
                            >
                            @error('phone')
                                <p class="text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-sm font-medium text-slate-700" for="account_email">Email</label>
                            <input
                                class="{{ $accountInputClass }} {{ $errors->has('email') ? 'border-rose-300 focus:border-rose-400 focus:ring-rose-400/15' : '' }}"
                                id="account_email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                placeholder="Email"
                                required
                                autocomplete="email"
                            >
                            @error('email')
                                <p class="text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="register-password-stack">
                        <div class="space-y-1">
                            <p class="register-password-note">
                                Use at least <span class="font-semibold text-rose-600">8 characters</span> with uppercase, lowercase, number, and special character.
                            </p>
                            <input
                                class="{{ $accountInputClass }} {{ $errors->has('password') ? 'border-rose-300 focus:border-rose-400 focus:ring-rose-400/15' : '' }}"
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
                                <p class="text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <input
                                class="{{ $accountInputClass }}"
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
                        <button class="register-button" type="submit">
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const password = document.querySelector('[data-register-password]');
            const confirmation = document.querySelector('[data-register-password-confirmation]');
            const showPasswords = document.querySelector('[data-show-passwords]');
            const strengthBar = document.querySelector('[data-password-strength-bar]');
            const strengthLabel = document.querySelector('[data-password-strength-label]');
            const matchStatus = document.querySelector('[data-password-match-status]');

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
                        'text-slate-400'
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

            evaluatePassword();
            evaluateMatch();
            togglePasswords();
        });
    </script>
@endsection
