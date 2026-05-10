@extends('layouts.app')

@section('title', 'System Health')

@section('content')
    <x-ui.page-header
        eyebrow="System console"
        title="Health, integrations, and monitoring"
        description="Review uptime, recent errors, and third-party delivery settings from one operational dashboard."
    >
        <x-slot:actions>
            <div class="rounded-[28px] border border-cyan-400/20 bg-cyan-400/10 px-5 py-4 text-cyan-100">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-200/70">Uptime estimate</p>
                <p class="mt-2 text-4xl font-semibold">{{ $health['uptime_estimate'] }}%</p>
            </div>
        </x-slot:actions>
    </x-ui.page-header>

    <div class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach([
            'database_healthy' => ['Database', $health['database_healthy'] ? 'Connected' : 'Offline'],
            'storage_healthy' => ['Storage', $health['storage_healthy'] ? 'Writable' : 'Blocked'],
            'email_configured' => ['Email', $health['email_configured'] ? 'Configured' : 'Disabled'],
            'sms_configured' => ['SMS', $health['sms_configured'] ? 'Configured' : 'Disabled'],
        ] as $key => [$label, $value])
            <div class="rounded-[28px] border border-white/10 bg-slate-950/60 p-5 shadow-lg shadow-slate-950/20">
                <p class="text-xs uppercase tracking-[0.35em] text-slate-500">{{ $label }}</p>
                <p class="mt-2 text-lg font-semibold {{ $health[$key] ? 'text-emerald-300' : 'text-rose-300' }}">{{ $value }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        @foreach($health['metrics'] as $label => $value)
            <div class="rounded-[28px] border border-white/10 bg-slate-950/60 p-5">
                <p class="text-xs uppercase tracking-[0.35em] text-slate-500">{{ str_replace('_', ' ', $label) }}</p>
                <p class="mt-2 text-3xl font-semibold text-white">{{ number_format($value) }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-8 grid gap-6 lg:grid-cols-[1.15fr_0.85fr]">
        <x-ui.panel tone="inset" class="p-5 md:p-6">
            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Provider settings</p>
            <div class="mt-5 space-y-5">
                @foreach($settings as $channel => $setting)
                    <form class="rounded-[24px] border border-white/10 bg-white/5 p-5" method="post" action="{{ route('admin.system.update', $setting) }}">
                        @csrf
                        @method('put')
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h2 class="text-lg font-semibold text-white">{{ ucfirst($channel) }} integration</h2>
                                <p class="text-sm text-slate-400">Update provider credentials and delivery metadata.</p>
                            </div>
                            <label class="inline-flex items-center gap-2 text-sm text-slate-300">
                                <input type="checkbox" name="enabled" value="1" @checked(old('enabled', $setting->enabled)) class="h-4 w-4 rounded border-white/20 bg-slate-950 text-cyan-400 focus:ring-cyan-400/20">
                                Enabled
                            </label>
                        </div>

                        <div class="mt-4 grid gap-4 md:grid-cols-2">
                            <label class="space-y-2 text-sm text-slate-300">
                                <span class="block text-xs uppercase tracking-[0.3em] text-slate-500">Provider</span>
                                <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" name="provider" value="{{ old('provider', $setting->provider) }}">
                            </label>
                            <label class="space-y-2 text-sm text-slate-300">
                                <span class="block text-xs uppercase tracking-[0.3em] text-slate-500">API Key</span>
                                <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" name="api_key" value="{{ old('api_key', $setting->api_key) }}">
                            </label>
                            <label class="space-y-2 text-sm text-slate-300">
                                <span class="block text-xs uppercase tracking-[0.3em] text-slate-500">API Secret</span>
                                <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" name="api_secret" value="{{ old('api_secret', $setting->api_secret) }}">
                            </label>
                            <label class="space-y-2 text-sm text-slate-300">
                                <span class="block text-xs uppercase tracking-[0.3em] text-slate-500">From Name</span>
                                <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" name="from_name" value="{{ old('from_name', $setting->from_name) }}">
                            </label>
                            <label class="space-y-2 text-sm text-slate-300">
                                <span class="block text-xs uppercase tracking-[0.3em] text-slate-500">From Address</span>
                                <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" name="from_address" value="{{ old('from_address', $setting->from_address) }}">
                            </label>
                            <label class="space-y-2 text-sm text-slate-300">
                                <span class="block text-xs uppercase tracking-[0.3em] text-slate-500">Sender ID</span>
                                <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" name="sender_id" value="{{ old('sender_id', $setting->sender_id) }}">
                            </label>
                        </div>

                        <label class="mt-4 block space-y-2 text-sm text-slate-300">
                            <span class="block text-xs uppercase tracking-[0.3em] text-slate-500">Notes</span>
                            <textarea class="min-h-28 w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" name="notes">{{ old('notes', $setting->notes) }}</textarea>
                        </label>

                        <div class="mt-4 flex justify-end">
                            <button class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300" type="submit">
                                Save changes
                            </button>
                        </div>
                    </form>
                @endforeach
            </div>
        </x-ui.panel>

        <div class="space-y-6">
            <x-ui.panel tone="inset" class="p-5 md:p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Recent errors</p>
                <div class="mt-4 space-y-3">
                    @forelse($health['recent_errors'] as $error)
                        <div class="rounded-2xl border border-rose-400/20 bg-rose-400/10 px-4 py-3 text-sm text-rose-100">{{ $error }}</div>
                    @empty
                        <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-slate-400">No recent critical errors were detected.</div>
                    @endforelse
                </div>
            </x-ui.panel>

            <x-ui.panel tone="inset" class="p-5 md:p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Generated at</p>
                <p class="mt-3 text-lg font-semibold text-white">{{ $health['generated_at'] }}</p>
            </x-ui.panel>
        </div>
    </div>
@endsection
