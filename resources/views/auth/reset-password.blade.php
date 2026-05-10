@extends('layouts.auth-compact')

@section('title', 'Reset Password')

@section('content')
    <div>
        <div class="mb-8">
            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-cyan-300/80">Reset password</p>
            <h1 class="mt-3 text-3xl font-semibold text-white">Create a new password</h1>
            <p class="mt-2 text-sm leading-6 text-slate-400">Use the verification link from your email to set a fresh password.</p>
        </div>

        <form method="post" action="{{ route('password.store') }}" class="space-y-5">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-200" for="email">Email</label>
                <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 placeholder:text-slate-500 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" id="email" name="email" type="email" value="{{ old('email', request('email')) }}" required autocomplete="email">
            </div>
            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-200" for="password">New Password</label>
                <div class="relative">
                    <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 pr-24 text-slate-100 placeholder:text-slate-500 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" id="password" name="password" type="password" required autocomplete="new-password">
                    <button
                        class="absolute inset-y-0 right-2 my-2 inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/5 px-3 text-cyan-200 transition hover:bg-white/10"
                        type="button"
                        data-password-toggle="password"
                        aria-pressed="false"
                        aria-label="Toggle password visibility"
                    >
                        <svg data-password-icon-show viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12 18 18.75 12 18.75 2.25 12 2.25 12Z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                        <svg data-password-icon-hide viewBox="0 0 24 24" class="hidden h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.6 10.6a3 3 0 0 0 4.2 4.2" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.2 6.2C4.4 7.5 2.9 9.4 2.25 12c0 0 3.75 6.75 9.75 6.75 1.7 0 3.2-.35 4.48-.96" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.6 4.6A11.2 11.2 0 0 1 12 4.25C18 4.25 21.75 12 21.75 12a14.5 14.5 0 0 1-3.1 4.44" />
                        </svg>
                        <span class="sr-only">Toggle password visibility</span>
                    </button>
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-200" for="password_confirmation">Confirm Password</label>
                <div class="relative">
                    <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 pr-24 text-slate-100 placeholder:text-slate-500 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password">
                    <button
                        class="absolute inset-y-0 right-2 my-2 inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/5 px-3 text-cyan-200 transition hover:bg-white/10"
                        type="button"
                        data-password-toggle="password_confirmation"
                        aria-pressed="false"
                        aria-label="Toggle password visibility"
                    >
                        <svg data-password-icon-show viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12 18 18.75 12 18.75 2.25 12 2.25 12Z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                        <svg data-password-icon-hide viewBox="0 0 24 24" class="hidden h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.6 10.6a3 3 0 0 0 4.2 4.2" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.2 6.2C4.4 7.5 2.9 9.4 2.25 12c0 0 3.75 6.75 9.75 6.75 1.7 0 3.2-.35 4.48-.96" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.6 4.6A11.2 11.2 0 0 1 12 4.25C18 4.25 21.75 12 21.75 12a14.5 14.5 0 0 1-3.1 4.44" />
                        </svg>
                        <span class="sr-only">Toggle password visibility</span>
                    </button>
                </div>
            </div>
            <button class="inline-flex w-full items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300" type="submit">
                Update password
            </button>
        </form>
    </div>
@endsection
