@extends('layouts.auth-compact')

@section('title', 'Forgot Password')

@section('content')
    <div>
        <div class="mb-8">
            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-cyan-300/80">Password recovery</p>
            <h1 class="mt-3 text-3xl font-semibold text-white">Reset access to your account</h1>
            <p class="mt-2 text-sm leading-6 text-slate-400">Enter your email address and we'll send a reset link if the account exists.</p>
        </div>

        <form method="post" action="{{ route('password.email') }}" class="space-y-5">
            @csrf
            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-200" for="email">Email</label>
                <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 placeholder:text-slate-500 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email">
            </div>
            <button class="inline-flex w-full items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300" type="submit">
                Send reset link
            </button>

            <p class="text-center text-sm text-slate-400">
                Remember your password?
                <a class="font-medium text-cyan-300 transition hover:text-cyan-200" href="{{ route('login') }}">Sign in</a>
            </p>
        </form>
    </div>
@endsection
