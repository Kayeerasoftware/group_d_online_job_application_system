@extends('layouts.auth-compact')

@section('title', 'Login')

@section('content')
    <div>
        <div class="mb-8">
            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-cyan-300/80">Welcome back</p>
            <h1 class="mt-3 text-3xl font-semibold text-white">Sign in to continue</h1>
            <p class="mt-2 text-sm leading-6 text-slate-400">Use your email and password to access your workspace, dashboards, and workflows.</p>
        </div>

        <form method="post" action="{{ route('login.store') }}" class="space-y-5">
            @csrf
            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-200" for="email">Email</label>
                <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 placeholder:text-slate-500 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-200" for="password">Password</label>
                <div class="relative">
                    <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 pr-24 text-slate-100 placeholder:text-slate-500 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" id="password" name="password" type="password" required autocomplete="current-password">
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

            <label class="flex items-center gap-3 text-sm text-slate-300">
                <input class="h-4 w-4 rounded border-white/20 bg-slate-950 text-cyan-400 focus:ring-cyan-400/20" type="checkbox" name="remember">
                Remember me
            </label>

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <a class="text-sm font-medium text-cyan-300 transition hover:text-cyan-200" href="{{ route('password.request') }}">Forgot password?</a>
                <button class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300" type="submit">
                    Sign in
                </button>
            </div>

            <p class="text-center text-sm text-slate-400">
                Don't have an account?
                <a class="font-medium text-cyan-300 transition hover:text-cyan-200" href="{{ route('register') }}">Create one</a>
            </p>
        </form>
    </div>
@endsection
