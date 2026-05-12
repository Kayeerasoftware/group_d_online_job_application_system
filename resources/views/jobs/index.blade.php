@extends('layouts.app')

@section('title', 'Jobs')

@section('content')
    <x-ui.page-header
        eyebrow="Opportunity board"
        title="Discover active roles"
        description="Search, filter, and compare open roles in a cleaner workspace built for fast scanning."
    >
        <x-slot:actions>
            @if(safe_auth_check() && safe_auth_user()?->isEmployer())
                    <a class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300" href="{{ route('jobs.create') }}">
                        Post a Job
                    </a>
            @endif
        </x-slot:actions>
    </x-ui.page-header>

    <x-ui.panel tone="inset" class="mt-6 p-5 md:p-6">
        <form class="grid gap-4 lg:grid-cols-[1.4fr_1fr_1fr_1fr_1fr_auto] lg:items-end" method="get" action="{{ route('jobs.index') }}">
            <label class="space-y-2 text-sm text-slate-300 lg:col-span-1">
                <span class="block text-xs uppercase tracking-[0.3em] text-slate-500">Search</span>
                <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 placeholder:text-slate-500 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" name="search" placeholder="Title, company, keyword" value="{{ request('search') }}">
            </label>
            <label class="space-y-2 text-sm text-slate-300">
                <span class="block text-xs uppercase tracking-[0.3em] text-slate-500">Location</span>
                <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 placeholder:text-slate-500 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" name="location" placeholder="Kampala, Remote..." value="{{ request('location') }}">
            </label>
            <label class="space-y-2 text-sm text-slate-300">
                <span class="block text-xs uppercase tracking-[0.3em] text-slate-500">Type</span>
                <select class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" name="job_type">
                    <option value="">Any type</option>
                    @foreach(['full-time','part-time','contract','internship'] as $type)
                        <option value="{{ $type }}" @selected(request('job_type') === $type)>{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
            </label>
            <label class="space-y-2 text-sm text-slate-300">
                <span class="block text-xs uppercase tracking-[0.3em] text-slate-500">Salary min</span>
                <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 placeholder:text-slate-500 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" name="salary_min" type="number" min="0" step="0.01" placeholder="UGX" value="{{ request('salary_min') }}">
            </label>
            <label class="space-y-2 text-sm text-slate-300">
                <span class="block text-xs uppercase tracking-[0.3em] text-slate-500">Salary max</span>
                <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 placeholder:text-slate-500 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" name="salary_max" type="number" min="0" step="0.01" placeholder="UGX" value="{{ request('salary_max') }}">
            </label>
            <button class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300" type="submit">Filter</button>
        </form>
    </x-ui.panel>

    <x-ui.panel tone="inset" class="mt-6 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-white/10 text-left">
                <thead class="bg-white/5 text-xs uppercase tracking-[0.3em] text-slate-500">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Role</th>
                        <th class="px-6 py-4 font-semibold">Location</th>
                        <th class="px-6 py-4 font-semibold">Type</th>
                        <th class="px-6 py-4 font-semibold">Range</th>
                        <th class="px-6 py-4 font-semibold">Stats</th>
                        <th class="px-6 py-4 font-semibold">Status</th>
                        <th class="px-6 py-4 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse($jobs as $job)
                        @php
                            $jobType = $job->job_type instanceof \App\Enums\JobType ? $job->job_type->value : $job->job_type;
                        @endphp
                        <tr class="transition hover:bg-white/5">
                            <td class="px-6 py-5 align-top">
                                <div class="space-y-1">
                                    <a href="{{ route('jobs.show', $job) }}" class="text-base font-semibold text-white transition hover:text-cyan-300">{{ $job->title }}</a>
                                    <p class="text-sm text-slate-400">{{ \Illuminate\Support\Str::limit($job->description, 90) }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-5 align-top text-sm text-slate-300">{{ $job->location }}</td>
                            <td class="px-6 py-5 align-top">
                                <span class="inline-flex rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-semibold uppercase tracking-[0.25em] text-slate-200">{{ $jobType }}</span>
                            </td>
                            <td class="px-6 py-5 align-top text-sm text-slate-300">
                                UGX {{ number_format((float) $job->salary_min) }} - UGX {{ number_format((float) $job->salary_max) }}
                            </td>
                            <td class="px-6 py-5 align-top text-sm text-slate-300">
                                <div class="space-y-1">
                                    <p>{{ number_format($job->views_count ?? 0) }} views</p>
                                    <p>{{ number_format($job->applications_count ?? 0) }} applications</p>
                                </div>
                            </td>
                            <td class="px-6 py-5 align-top">
                                <span class="inline-flex rounded-full border border-cyan-400/20 bg-cyan-400/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.25em] text-cyan-200">
                                    {{ $job->statusValue() }}
                                </span>
                            </td>
                            <td class="px-6 py-5 align-top">
                                <div class="flex justify-end gap-2">
                                    <a class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm font-semibold text-slate-100 transition hover:bg-white/10" href="{{ route('jobs.show', $job) }}">
                                        Open
                                    </a>
                                    @if(safe_auth_check() && safe_auth_user()?->isEmployer() && safe_auth_id() === $job->employer_id)
                                            <a class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm font-semibold text-slate-100 transition hover:bg-white/10" href="{{ route('jobs.edit', $job) }}">
                                                Edit
                                            </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10">
                                <x-ui.empty-state
                                    title="No jobs found"
                                    description="Try widening the filters or post a new role if you are hiring."
                                />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-ui.panel>

    <div class="mt-8">
        {{ $jobs->links() }}
    </div>
@endsection
