@extends('layouts.auth')

@section('title', 'Create Account')

@section('content')
    @php
        $selectedRole = old('role', 'seeker');
        $fieldClass = 'w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-2.5 text-slate-100 placeholder:text-slate-500 outline-none transition duration-200 focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20';
        $errorClass = 'border-rose-400/60 focus:border-rose-400 focus:ring-rose-400/20';
        $accountInputClass = 'w-full rounded-2xl border border-emerald-400/60 bg-slate-950/95 px-4 py-2.5 text-slate-100 placeholder:text-slate-500 outline-none transition duration-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/20';
    @endphp

    <div class="space-y-4">
        <div class="space-y-2">
            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/80">Create account</p>
            <h1 class="text-2xl font-semibold text-white sm:text-3xl">Build your profile</h1>
            <p class="max-w-2xl text-sm leading-6 text-slate-400">
                Set up your account in a simple, professional way so you can sign in and start using the platform right away.
            </p>
        </div>

        <form method="post" action="{{ route('register.store') }}" class="space-y-4">
            @csrf

            <section class="rounded-[24px] border border-white/10 bg-slate-950/70 p-4 shadow-2xl shadow-cyan-950/10 backdrop-blur-xl md:p-5">
                <div class="mb-3 flex items-center justify-between gap-3">
                    <h2 class="text-base font-semibold text-white">Personal Details</h2>
                    <span class="rounded-full border border-cyan-400/20 bg-cyan-400/10 px-3 py-1 text-[11px] font-medium text-cyan-200">
                        Your identity
                    </span>
                </div>

                <div class="grid gap-3 md:grid-cols-2">
                    <div class="space-y-1.5 md:col-span-2">
                        <label class="text-sm font-medium text-slate-200" for="name">Full Name</label>
                        <input
                            class="{{ $fieldClass }} {{ $errors->has('name') ? $errorClass : '' }}"
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            placeholder="e.g. Amina Okello"
                            required
                            autocomplete="name"
                        >
                        @error('name')
                            <p class="text-sm text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-sm font-medium text-slate-200" for="phone">Phone Number</label>
                        <input
                            class="{{ $fieldClass }} {{ $errors->has('phone') ? $errorClass : '' }}"
                            id="phone"
                            name="phone"
                            type="tel"
                            value="{{ old('phone') }}"
                            placeholder="Optional"
                            autocomplete="tel"
                        >
                        @error('phone')
                            <p class="text-sm text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-sm font-medium text-slate-200" for="role">Account Type</label>
                        <div class="relative">
                            <select
                                class="{{ $fieldClass }} appearance-none pr-12 {{ $errors->has('role') ? $errorClass : '' }}"
                                id="role"
                                name="role"
                                required
                            >
                                <option value="seeker" {{ $selectedRole === 'seeker' ? 'selected' : '' }}>Job Seeker</option>
                                <option value="employer" {{ $selectedRole === 'employer' ? 'selected' : '' }}>Employer</option>
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-slate-400">
                                <svg viewBox="0 0 20 20" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 8l4 4 4-4" />
                                </svg>
                            </span>
                        </div>
                        <p class="text-xs text-slate-500">Choose the account type that matches how you will use the platform.</p>
                        @error('role')
                            <p class="text-sm text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            <section class="rounded-[24px] border border-slate-800 bg-slate-950/95 p-4 shadow-2xl shadow-cyan-950/10 backdrop-blur-xl md:p-5">
                <div class="mb-3">
                    <h2 class="text-base font-semibold text-white">Account Details (Remember for Sign-In)</h2>
                </div>

                <div class="space-y-3">
                    <div class="space-y-1.5">
                        <label class="text-sm font-medium text-slate-200" for="account_email">Email</label>
                        <input
                            class="{{ $accountInputClass }} {{ $errors->has('email') ? 'border-rose-400/60 focus:border-rose-400 focus:ring-rose-400/20' : '' }}"
                            id="account_email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            placeholder="you@example.com"
                            required
                            autocomplete="email"
                        >
                        @error('email')
                            <p class="text-sm text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <p class="text-sm text-slate-400">
                            Password must be at least <span class="font-semibold text-rose-300">8 characters</span> with uppercase, lowercase, number, and special character.
                        </p>
                        <input
                            class="{{ $accountInputClass }} {{ $errors->has('password') ? 'border-rose-400/60 focus:border-rose-400 focus:ring-rose-400/20' : '' }}"
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="new-password"
                            placeholder="Create a password"
                            data-register-password
                        >
                        <div class="h-1.5 overflow-hidden rounded-full bg-emerald-500/20">
                            <div class="h-full w-0 rounded-full bg-emerald-400 transition-all duration-200" data-password-strength-bar></div>
                        </div>
                        <p class="text-xs font-medium text-emerald-300" data-password-strength-label>Strong</p>
                        <ul class="space-y-1 text-xs leading-5" data-password-rules>
                            <li class="flex items-center gap-2 text-rose-300" data-rule="length">
                                <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full border border-rose-400 text-[10px] leading-none text-rose-400" data-rule-bullet>&times;</span>
                                <span>At least 8 characters</span>
                            </li>
                            <li class="flex items-center gap-2 text-rose-300" data-rule="upper">
                                <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full border border-rose-400 text-[10px] leading-none text-rose-400" data-rule-bullet>&times;</span>
                                <span>One uppercase letter (A-Z)</span>
                            </li>
                            <li class="flex items-center gap-2 text-rose-300" data-rule="lower">
                                <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full border border-rose-400 text-[10px] leading-none text-rose-400" data-rule-bullet>&times;</span>
                                <span>One lowercase letter (a-z)</span>
                            </li>
                            <li class="flex items-center gap-2 text-rose-300" data-rule="number">
                                <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full border border-rose-400 text-[10px] leading-none text-rose-400" data-rule-bullet>&times;</span>
                                <span>One number (0-9)</span>
                            </li>
                            <li class="flex items-center gap-2 text-rose-300" data-rule="special">
                                <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full border border-rose-400 text-[10px] leading-none text-rose-400" data-rule-bullet>&times;</span>
                                <span>One special character (!@#$%^&*)</span>
                            </li>
                            <li class="flex items-center gap-2 text-rose-300" data-rule="common">
                                <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full border border-rose-400 text-[10px] leading-none text-rose-400" data-rule-bullet>&times;</span>
                                <span>Not a common password</span>
                            </li>
                        </ul>
                        @error('password')
                            <p class="text-sm text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <input
                            class="{{ $accountInputClass }}"
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            required
                            autocomplete="new-password"
                            placeholder="Confirm your password"
                            data-register-password-confirmation
                        >
                        <div class="flex items-center gap-2 text-xs font-medium text-rose-300" data-password-match-status>
                            <span class="inline-flex h-4 w-4 items-center justify-center rounded-full border border-rose-400 text-[10px] leading-none text-rose-400">&times;</span>
                            Mismatch
                        </div>
                    </div>

                    <label class="inline-flex items-center gap-2 text-sm text-slate-300">
                        <input class="h-4 w-4 rounded border-emerald-400/40 bg-slate-950 text-emerald-400 focus:ring-emerald-400/20" type="checkbox" data-show-passwords>
                        Show Passwords
                    </label>
                </div>
            </section>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-sm text-slate-400">
                    By creating an account, you can access job tools, hiring tools, and your dashboard from one place.
                </p>
                <button class="inline-flex min-w-44 items-center justify-center rounded-2xl bg-cyan-400 px-7 py-2.5 text-sm font-semibold text-slate-950 shadow-lg shadow-cyan-950/20 transition hover:bg-cyan-300 focus:outline-none focus:ring-2 focus:ring-cyan-400/30 focus:ring-offset-2 focus:ring-offset-slate-950" type="submit">
                    Create Account
                </button>
            </div>

            <p class="text-center text-sm text-slate-400">
                Already have an account?
                <a class="font-medium text-cyan-300 transition hover:text-cyan-200" href="{{ route('login') }}">Sign in</a>
            </p>
        </form>
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

            const evaluatePassword = () => {
                const value = password?.value || '';
                const results = Object.fromEntries(Object.entries(tests).map(([key, test]) => [key, test(value)]));
                const passed = Object.values(results).filter(Boolean).length;

                Object.entries(results).forEach(([key, met]) => setRuleState(key, met));

                if (strengthBar) {
                    strengthBar.style.width = `${(passed / Object.keys(results).length) * 100}%`;
                }

                if (strengthLabel) {
                    const label = passed >= 5 ? 'Strong' : passed >= 3 ? 'Good' : 'Weak';
                    strengthLabel.textContent = label;
                    strengthLabel.className = 'text-xs font-medium ' + (label === 'Strong' ? 'text-emerald-300' : label === 'Good' ? 'text-amber-300' : 'text-slate-400');
                }
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
