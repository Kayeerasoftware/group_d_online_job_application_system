@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
    <x-ui.page-header
        eyebrow="Inbox"
        title="Notifications"
        description="Review delivery updates, messages, and system alerts in a compact queue."
    />

    <x-ui.panel tone="inset" class="mt-6 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-white/10 text-left">
                <thead class="bg-white/5 text-xs uppercase tracking-[0.3em] text-slate-500">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Message</th>
                        <th class="px-6 py-4 font-semibold">Channel</th>
                        <th class="px-6 py-4 font-semibold">Status</th>
                        <th class="px-6 py-4 font-semibold text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse($notifications as $notification)
                        <tr class="transition hover:bg-white/5">
                            <td class="px-6 py-5 align-top">
                                <div class="space-y-1">
                                    <p class="font-semibold text-white">{{ $notification->subject }}</p>
                                    <p class="text-sm text-slate-400">{{ $notification->message }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-5 align-top text-sm text-slate-300">{{ $notification->type }}</td>
                            <td class="px-6 py-5 align-top">
                                <span class="inline-flex rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-semibold uppercase tracking-[0.25em] text-slate-200">
                                    {{ $notification->delivery_status instanceof \App\Enums\DeliveryStatus ? $notification->delivery_status->value : $notification->delivery_status }}
                                </span>
                            </td>
                            <td class="px-6 py-5 align-top text-right">
                                @if(! $notification->is_read)
                                    <form method="post" action="{{ route('seeker.notifications.read', $notification) }}">
                                        @csrf
                                        @method('patch')
                                        <button class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-4 py-2.5 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300" type="submit">Mark as read</button>
                                    </form>
                                @else
                                    <span class="text-sm text-slate-500">Read</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10">
                                <x-ui.empty-state
                                    title="No notifications"
                                    description="You will see application updates, delivery receipts, and system messages here."
                                />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-ui.panel>
@endsection
