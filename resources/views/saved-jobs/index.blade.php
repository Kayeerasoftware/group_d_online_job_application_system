@extends('layouts.app')

@section('title', 'Saved Jobs')

@section('content')
    <x-ui.page-header
        eyebrow="Seeker workspace"
        title="Saved jobs"
        description="A clean shortlist of roles you want to revisit later."
    />

    <x-ui.panel tone="inset" class="mt-6 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-white/10 text-left">
                <thead class="bg-white/5 text-xs uppercase tracking-[0.3em] text-slate-500">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Job</th>
                        <th class="px-6 py-4 font-semibold">Location</th>
                        <th class="px-6 py-4 font-semibold">Type</th>
                        <th class="px-6 py-4 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse($savedJobs as $savedJob)
                        <tr class="transition hover:bg-white/5">
                            <td class="px-6 py-5 align-top">
                                <a href="{{ route('jobs.show', $savedJob->job) }}" class="font-semibold text-white transition hover:text-cyan-300">{{ $savedJob->job->title }}</a>
                            </td>
                            <td class="px-6 py-5 align-top text-sm text-slate-300">{{ $savedJob->job->location }}</td>
                            <td class="px-6 py-5 align-top text-sm text-slate-300">{{ $savedJob->job->job_type instanceof \App\Enums\JobType ? $savedJob->job->job_type->value : $savedJob->job->job_type }}</td>
                            <td class="px-6 py-5 align-top text-right">
                                <button
                                    type="button"
                                    class="inline-flex items-center justify-center rounded-2xl border border-rose-500/30 bg-rose-500/10 px-4 py-2.5 text-sm font-semibold text-rose-200 transition hover:bg-rose-500/20"
                                    data-modal-open="remove-saved-job-{{ $savedJob->id }}"
                                >
                                    Remove
                                </button>
                            </td>
                        </tr>

                        <x-ui.modal
                            id="remove-saved-job-{{ $savedJob->id }}"
                            title="Remove saved job?"
                            description="This will delete the bookmark from your saved list."
                        >
                            <form method="post" action="{{ route('seeker.saved-jobs.destroy', $savedJob) }}" class="flex items-center justify-end gap-3">
                                @csrf
                                @method('delete')
                                <button type="button" class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm font-semibold text-slate-100 transition hover:bg-white/10" data-modal-close>
                                    Cancel
                                </button>
                                <button type="submit" class="rounded-2xl border border-rose-500/30 bg-rose-500/10 px-4 py-3 text-sm font-semibold text-rose-200 transition hover:bg-rose-500/20">
                                    Remove job
                                </button>
                            </form>
                        </x-ui.modal>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10">
                                <x-ui.empty-state
                                    title="No saved jobs yet"
                                    description="Save a role from the jobs board and it will appear here for easy return visits."
                                />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-ui.panel>

    <div class="mt-8">{{ $savedJobs->links() }}</div>
@endsection
