@extends('layouts.app')

@section('title', 'Applications')

@section('content')
    <x-ui.page-header
        eyebrow="Application tracker"
        title="{{ $job ? 'Applications for '.$job->title : 'Review applications' }}"
        description="A cleaner review queue for seekers, employers, and administrators."
    >
        <x-slot:actions>
            @if($job && auth()->check() && auth()->user()->isEmployer())
                <a class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-semibold text-slate-100 transition hover:bg-white/10" href="{{ route('employer.applications.export', $job) }}">
                    Export CSV
                </a>
            @endif
            @auth
                @if(auth()->user()->isSeeker())
                    <a class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300" href="{{ route('jobs.index') }}">
                        Apply to jobs
                    </a>
                @endif
            @endauth
        </x-slot:actions>
    </x-ui.page-header>

    <x-ui.panel tone="inset" class="mt-6 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-white/10 text-left">
                <thead class="bg-white/5 text-xs uppercase tracking-[0.3em] text-slate-500">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Job</th>
                        <th class="px-6 py-4 font-semibold">Applicant</th>
                        <th class="px-6 py-4 font-semibold">Status</th>
                        <th class="px-6 py-4 font-semibold">Applied</th>
                        <th class="px-6 py-4 font-semibold">Notes</th>
                        <th class="px-6 py-4 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse($applications as $application)
                        <tr class="transition hover:bg-white/5">
                            <td class="px-6 py-5 align-top">
                                <div class="space-y-1">
                                    <a href="{{ route('applications.show', $application) }}" class="text-base font-semibold text-white transition hover:text-cyan-300">{{ $application->job->title }}</a>
                                    <p class="text-sm text-slate-400">{{ $application->job->location }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-5 align-top text-sm text-slate-300">{{ $application->seeker->name }}</td>
                            <td class="px-6 py-5 align-top">
                                <x-ui.status-badge :value="$application->statusValue()" />
                            </td>
                            <td class="px-6 py-5 align-top text-sm text-slate-300">{{ optional($application->applied_date)->format('Y-m-d') }}</td>
                            <td class="px-6 py-5 align-top text-sm text-slate-300">
                                {{ \Illuminate\Support\Str::limit($application->cover_letter, 120) }}
                            </td>
                            <td class="px-6 py-5 align-top">
                                <div class="flex justify-end gap-2">
                                    <a class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm font-semibold text-slate-100 transition hover:bg-white/10" href="{{ route('applications.show', $application) }}">
                                        Open
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10">
                                <x-ui.empty-state
                                    title="No applications found"
                                    description="Once seekers submit applications, they will appear here with status and notes."
                                />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-ui.panel>

    <div class="mt-8">
        {{ $applications->links() }}
    </div>
@endsection
