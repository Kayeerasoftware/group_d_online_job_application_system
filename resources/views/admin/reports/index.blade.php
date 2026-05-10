@extends('layouts.app')

@section('title', 'Compliance Reports')

@section('content')
    <x-ui.page-header
        eyebrow="Compliance center"
        title="Compliance reports"
        description="Create and review regulatory summaries for job activity, hiring trends, and policy checks."
    >
        <x-slot:actions>
            <a class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300" href="{{ route('admin.reports.create') }}">
                Generate report
            </a>
        </x-slot:actions>
    </x-ui.page-header>

    <x-ui.panel tone="inset" class="mt-6 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-white/10 text-left">
                <thead class="bg-white/5 text-xs uppercase tracking-[0.3em] text-slate-500">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Report</th>
                        <th class="px-6 py-4 font-semibold">Period</th>
                        <th class="px-6 py-4 font-semibold">Author</th>
                        <th class="px-6 py-4 font-semibold">Status</th>
                        <th class="px-6 py-4 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse($reports as $report)
                        <tr class="transition hover:bg-white/5">
                            <td class="px-6 py-5 align-top">
                                <div class="space-y-1">
                                    <a href="{{ route('admin.reports.show', $report) }}" class="text-base font-semibold text-white transition hover:text-cyan-300">{{ $report->report_type }}</a>
                                    <p class="text-sm text-slate-400">Generated for compliance review and regulator reporting.</p>
                                </div>
                            </td>
                            <td class="px-6 py-5 align-top text-sm text-slate-300">
                                {{ optional($report->date_range_start)->format('Y-m-d') }} to {{ optional($report->date_range_end)->format('Y-m-d') }}
                            </td>
                            <td class="px-6 py-5 align-top text-sm text-slate-300">{{ $report->author?->name ?? 'System' }}</td>
                            <td class="px-6 py-5 align-top">
                                <span class="inline-flex rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-semibold uppercase tracking-[0.25em] text-slate-200">
                                    {{ $report->statusValue() }}
                                </span>
                            </td>
                            <td class="px-6 py-5 align-top">
                                <div class="flex justify-end gap-2">
                                    <a class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm font-semibold text-slate-100 transition hover:bg-white/10" href="{{ route('admin.reports.show', $report) }}">
                                        View
                                    </a>
                                    <a class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm font-semibold text-slate-100 transition hover:bg-white/10" href="{{ route('admin.reports.download', $report) }}">
                                        Download
                                    </a>
                                    <form method="post" action="{{ route('admin.reports.submit', $report) }}">
                                        @csrf
                                        @method('patch')
                                        <button class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-4 py-2.5 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300" type="submit">
                                            Submit
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10">
                                <x-ui.empty-state
                                    title="No reports yet"
                                    description="Generate the first compliance report to populate this dashboard."
                                />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-ui.panel>

    <div class="mt-8">
        {{ $reports->links() }}
    </div>
@endsection
