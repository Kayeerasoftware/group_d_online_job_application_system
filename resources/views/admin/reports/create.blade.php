@extends('layouts.app')

@section('title', 'Generate Report')

@section('content')
    <x-ui.page-header
        eyebrow="Compliance center"
        title="Generate regulatory report"
        description="Produce a dated compliance summary that can be submitted to the regulator or downloaded as JSON."
    />

    <form class="mt-6 grid gap-6 lg:grid-cols-[1.1fr_0.9fr]" method="post" action="{{ route('admin.reports.store') }}">
        @csrf

        <x-ui.panel tone="inset" class="p-5 md:p-6">
            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Report details</p>
            <div class="mt-5 space-y-5">
                <div class="space-y-2">
                    <label class="block text-xs uppercase tracking-[0.3em] text-slate-500" for="report_type">Report type</label>
                    <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 placeholder:text-slate-500 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" id="report_type" name="report_type" placeholder="Monthly compliance review" value="{{ old('report_type') }}">
                </div>
                <div class="grid gap-4 md:grid-cols-2">
                    <div class="space-y-2">
                        <label class="block text-xs uppercase tracking-[0.3em] text-slate-500" for="date_range_start">Start date</label>
                        <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" id="date_range_start" name="date_range_start" type="date" value="{{ old('date_range_start') }}">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-xs uppercase tracking-[0.3em] text-slate-500" for="date_range_end">End date</label>
                        <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" id="date_range_end" name="date_range_end" type="date" value="{{ old('date_range_end') }}">
                    </div>
                </div>
            </div>
        </x-ui.panel>

        <div class="space-y-6">
            <x-ui.panel tone="soft" class="p-5 md:p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">What this includes</p>
                <ul class="mt-4 space-y-3 text-sm leading-7 text-slate-300">
                    <li>Job counts and application trends for the chosen period.</li>
                    <li>Salary distribution and conversion metrics for compliance review.</li>
                    <li>A JSON payload that can be archived or downloaded immediately.</li>
                </ul>
            </x-ui.panel>

            <div class="flex items-center justify-end">
                <button class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300" type="submit">
                    Generate report
                </button>
            </div>
        </div>
    </form>
@endsection
