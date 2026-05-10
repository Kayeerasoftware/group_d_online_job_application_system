@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
    <x-ui.panel tone="surface" class="p-6 md:p-8">
        <x-ui.page-header
            eyebrow="User profile"
            title="{{ $user->name }}"
            description="Review account details, role, status, and activity counts in one tidy profile view."
        >
            <x-slot:actions>
                <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-semibold uppercase tracking-[0.25em] text-slate-200">
                    {{ $user->roleValue() }}
                </span>
                <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-semibold uppercase tracking-[0.25em] text-slate-200">
                    {{ $user->is_active ? 'Active' : 'Suspended' }}
                </span>
            </x-slot:actions>
        </x-ui.page-header>

        <div class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-[28px] border border-white/10 bg-slate-950/60 p-5">
                <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Email</p>
                <p class="mt-2 text-sm font-semibold text-white">{{ $user->email }}</p>
            </div>
            <div class="rounded-[28px] border border-white/10 bg-slate-950/60 p-5">
                <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Phone</p>
                <p class="mt-2 text-sm font-semibold text-white">{{ $user->phone }}</p>
            </div>
            <div class="rounded-[28px] border border-white/10 bg-slate-950/60 p-5">
                <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Joined</p>
                <p class="mt-2 text-sm font-semibold text-white">{{ optional($user->created_at)->format('Y-m-d H:i') }}</p>
            </div>
            <div class="rounded-[28px] border border-white/10 bg-slate-950/60 p-5">
                <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Status</p>
                <p class="mt-2 text-sm font-semibold text-white">{{ $user->is_active ? 'active' : 'suspended' }}</p>
            </div>
        </div>

        <div class="mt-8 grid gap-6 lg:grid-cols-3">
            <x-ui.panel tone="inset" class="p-5 md:p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Counts</p>
                <div class="mt-4 grid gap-3">
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                        <p class="text-[10px] uppercase tracking-[0.3em] text-slate-500">Jobs posted</p>
                        <p class="mt-2 text-2xl font-semibold text-white">{{ $user->jobs->count() }}</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                        <p class="text-[10px] uppercase tracking-[0.3em] text-slate-500">Applications</p>
                        <p class="mt-2 text-2xl font-semibold text-white">{{ $user->applications->count() }}</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                        <p class="text-[10px] uppercase tracking-[0.3em] text-slate-500">Notifications</p>
                        <p class="mt-2 text-2xl font-semibold text-white">{{ $user->notifications->count() }}</p>
                    </div>
                </div>
            </x-ui.panel>

            <x-ui.panel tone="inset" class="p-5 md:p-6 lg:col-span-2">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Recent activity</p>
                <div class="mt-4 overflow-hidden rounded-2xl border border-white/10">
                    <table class="min-w-full divide-y divide-white/10 text-left text-sm">
                        <tbody class="divide-y divide-white/10">
                            <tr class="bg-white/5">
                                <th class="px-4 py-3 text-xs uppercase tracking-[0.3em] text-slate-500">Account</th>
                                <td class="px-4 py-3 text-slate-200">{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th class="px-4 py-3 text-xs uppercase tracking-[0.3em] text-slate-500">Role</th>
                                <td class="px-4 py-3 text-slate-200">{{ $user->roleValue() }}</td>
                            </tr>
                            <tr class="bg-white/5">
                                <th class="px-4 py-3 text-xs uppercase tracking-[0.3em] text-slate-500">Status</th>
                                <td class="px-4 py-3 text-slate-200">{{ $user->is_active ? 'Active' : 'Suspended' }}</td>
                            </tr>
                            <tr>
                                <th class="px-4 py-3 text-xs uppercase tracking-[0.3em] text-slate-500">Joined</th>
                                <td class="px-4 py-3 text-slate-200">{{ optional($user->created_at)->format('Y-m-d H:i') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </x-ui.panel>
        </div>
    </x-ui.panel>
@endsection
