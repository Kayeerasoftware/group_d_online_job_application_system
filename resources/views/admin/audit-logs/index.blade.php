@extends('layouts.app')

@section('title', 'Audit Logs')

@section('content')
    <x-ui.page-header
        eyebrow="Audit trail"
        title="Audit logs"
        description="Monitor admin actions, moderation events, and critical changes without losing the timeline."
    />

    <x-ui.panel tone="inset" class="mt-6 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-white/10 text-left">
                <thead class="bg-white/5 text-xs uppercase tracking-[0.3em] text-slate-500">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Action</th>
                        <th class="px-6 py-4 font-semibold">Target</th>
                        <th class="px-6 py-4 font-semibold">Actor</th>
                        <th class="px-6 py-4 font-semibold">Reason</th>
                        <th class="px-6 py-4 font-semibold">Time</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse($logs as $log)
                        <tr class="transition hover:bg-white/5">
                            <td class="px-6 py-5 align-top text-sm font-semibold text-white">{{ $log->action }}</td>
                            <td class="px-6 py-5 align-top text-sm text-slate-300">{{ $log->target_type }} #{{ $log->target_id }}</td>
                            <td class="px-6 py-5 align-top text-sm text-slate-300">{{ $log->admin?->name }}</td>
                            <td class="px-6 py-5 align-top text-sm text-slate-300">{{ $log->reason ?? 'No reason provided' }}</td>
                            <td class="px-6 py-5 align-top text-sm text-slate-300">{{ $log->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10">
                                <x-ui.empty-state
                                    title="No audit logs"
                                    description="Admin actions and moderation events will appear here once activity starts."
                                />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-ui.panel>

    <div class="mt-8">{{ $logs->links() }}</div>
@endsection
