@extends('layouts.app')

@section('title', 'Application Details')

@section('content')
<div class="mb-6">
    <a href="{{ route('applications.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-[color:var(--accent)] hover:underline mb-3">
        ← Back to Applications
    </a>
    <h1 class="font-serif text-3xl text-[color:var(--text)]">Application Details</h1>
    <p class="mt-1 text-sm text-[color:var(--text2)]">Track your application progress</p>
</div>

<div class="grid gap-6 lg:grid-cols-3">
    <div class="lg:col-span-2 space-y-6">
        <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--surface)] p-6">
            <div class="flex items-start gap-4 mb-6">
                <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl border border-[color:var(--border)] bg-[color:var(--surface2)] text-3xl">
                    {{ $application->job->company_logo ?? '💼' }}
                </div>
                <div class="flex-1">
                    <h2 class="text-2xl font-semibold text-[color:var(--text)]">{{ $application->job->title }}</h2>
                    <p class="text-[color:var(--text2)]">{{ $application->job->company_name }}</p>
                    <p class="text-sm text-[color:var(--text3)]">{{ $application->job->location }}</p>
                </div>
                <span class="inline-flex shrink-0 items-center rounded-full px-4 py-2 text-sm font-medium
                    @if($application->status === 'pending') bg-[color:var(--surface2)] text-[color:var(--text2)]
                    @elseif($application->status === 'reviewed') bg-[color:var(--amber-light)] text-[color:var(--amber)]
                    @elseif($application->status === 'shortlisted') bg-[color:var(--accent-light)] text-[color:var(--accent)]
                    @elseif($application->status === 'interview') bg-[color:var(--blue-light)] text-[color:var(--blue)]
                    @elseif($application->status === 'hired') bg-[color:var(--accent-light)] text-[color:var(--accent)]
                    @elseif($application->status === 'rejected') bg-[color:var(--red-light)] text-[color:var(--red)]
                    @endif">
                    {{ ucfirst($application->status) }}
                </span>
            </div>

            <div class="rounded-xl border border-[color:var(--border)] bg-[color:var(--surface2)] p-4 mb-6">
                <h3 class="font-semibold text-[color:var(--text)] mb-3">Application Timeline</h3>
                <div class="flex items-center">
                    @foreach(['applied', 'reviewed', 'shortlisted', 'interview', 'hired'] as $index => $stage)
                    <div class="flex flex-col items-center flex-1">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full text-sm font-semibold
                            @if($application->status === $stage) bg-[color:var(--blue)] text-white
                            @elseif(array_search($application->status, ['applied', 'reviewed', 'shortlisted', 'interview', 'hired']) > $index) bg-[color:var(--accent)] text-white
                            @else bg-[color:var(--surface)] text-[color:var(--text3)] border border-[color:var(--border)]
                            @endif">
                            @if(array_search($application->status, ['applied', 'reviewed', 'shortlisted', 'interview', 'hired']) > $index)
                                ✓
                            @else
                                {{ $index + 1 }}
                            @endif
                        </div>
                        <p class="mt-2 text-xs text-center
                            @if($application->status === $stage) text-[color:var(--blue)] font-medium
                            @elseif(array_search($application->status, ['applied', 'reviewed', 'shortlisted', 'interview', 'hired']) > $index) text-[color:var(--accent)]
                            @else text-[color:var(--text3)]
                            @endif">
                            {{ ucfirst($stage) }}
                        </p>
                    </div>
                    @if($index < 4)
                    <div class="h-0.5 flex-1 -mt-8 @if(array_search($application->status, ['applied', 'reviewed', 'shortlisted', 'interview', 'hired']) > $index) bg-[color:var(--accent)] @else bg-[color:var(--border)] @endif"></div>
                    @endif
                    @endforeach
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <h3 class="font-semibold text-[color:var(--text)] mb-2">Cover Letter</h3>
                    <div class="rounded-xl border border-[color:var(--border)] bg-[color:var(--surface2)] p-4 text-sm text-[color:var(--text2)] whitespace-pre-wrap">{{ $application->cover_letter ?? 'No cover letter provided' }}</div>
                </div>

                <div>
                    <h3 class="font-semibold text-[color:var(--text)] mb-2">Submitted CV</h3>
                    @if($application->cv_path)
                    <div class="flex items-center gap-3 rounded-xl border border-[color:var(--border)] bg-[color:var(--surface2)] p-4">
                        <span class="text-3xl">📄</span>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-[color:var(--text)]">{{ basename($application->cv_path) }}</p>
                            <p class="text-xs text-[color:var(--text3)]">Uploaded {{ $application->created_at->format('M d, Y') }}</p>
                        </div>
                        <a href="{{ Storage::url($application->cv_path) }}" target="_blank" class="rounded-lg border border-[color:var(--border)] bg-[color:var(--surface)] px-4 py-2 text-sm font-medium text-[color:var(--text)] hover:bg-[color:var(--border)] transition">
                            Download
                        </a>
                    </div>
                    @else
                    <p class="text-sm text-[color:var(--text3)]">No CV attached</p>
                    @endif
                </div>

                @if($application->employer_notes)
                <div>
                    <h3 class="font-semibold text-[color:var(--text)] mb-2">Employer Notes</h3>
                    <div class="rounded-xl border border-[color:var(--border)] bg-[color:var(--blue-light)] p-4 text-sm text-[color:var(--text)]">
                        {{ $application->employer_notes }}
                    </div>
                </div>
                @endif
            </div>
        </div>

        <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--surface)] p-6">
            <h3 class="font-semibold text-[color:var(--text)] mb-4">Job Details</h3>
            <div class="prose prose-sm max-w-none text-[color:var(--text2)]">
                {!! nl2br(e($application->job->description)) !!}
            </div>
            <div class="mt-4 pt-4 border-t border-[color:var(--border)]">
                <a href="{{ route('jobs.show', $application->job) }}" class="inline-flex items-center gap-2 text-sm font-medium text-[color:var(--accent)] hover:underline">
                    View full job posting →
                </a>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--surface)] p-5">
            <h3 class="font-semibold text-[color:var(--text)] mb-4">Application Info</h3>
            <div class="space-y-3 text-sm">
                <div>
                    <p class="text-[color:var(--text3)]">Applied</p>
                    <p class="font-medium text-[color:var(--text)]">{{ $application->created_at->format('M d, Y') }}</p>
                    <p class="text-xs text-[color:var(--text3)]">{{ $application->created_at->diffForHumans() }}</p>
                </div>
                <div class="border-t border-[color:var(--border)] pt-3">
                    <p class="text-[color:var(--text3)]">Last Updated</p>
                    <p class="font-medium text-[color:var(--text)]">{{ $application->updated_at->format('M d, Y') }}</p>
                    <p class="text-xs text-[color:var(--text3)]">{{ $application->updated_at->diffForHumans() }}</p>
                </div>
                <div class="border-t border-[color:var(--border)] pt-3">
                    <p class="text-[color:var(--text3)]">Application ID</p>
                    <p class="font-mono text-xs text-[color:var(--text)]">{{ $application->id }}</p>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--surface)] p-5">
            <h3 class="font-semibold text-[color:var(--text)] mb-4">Job Info</h3>
            <div class="space-y-3 text-sm">
                <div class="flex items-center gap-2">
                    <span class="text-[color:var(--text3)]">💼</span>
                    <span class="text-[color:var(--text)]">{{ ucfirst($application->job->type) }}</span>
                </div>
                @if($application->job->salary_min && $application->job->salary_max)
                <div class="flex items-center gap-2">
                    <span class="text-[color:var(--text3)]">💰</span>
                    <span class="text-[color:var(--text)]">UGX {{ number_format($application->job->salary_min) }} - {{ number_format($application->job->salary_max) }}</span>
                </div>
                @endif
                <div class="flex items-center gap-2">
                    <span class="text-[color:var(--text3)]">📍</span>
                    <span class="text-[color:var(--text)]">{{ $application->job->location }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-[color:var(--text3)]">⏰</span>
                    <span class="text-[color:var(--text)]">Closes {{ $application->job->deadline->format('M d, Y') }}</span>
                </div>
            </div>
        </div>

        @if($application->status === 'pending' || $application->status === 'applied')
        <div class="rounded-2xl border border-[color:var(--red-light)] bg-[color:var(--red-light)] p-5">
            <h3 class="font-semibold text-[color:var(--red)] mb-2">Withdraw Application</h3>
            <p class="text-sm text-[color:var(--red)] mb-4">This action cannot be undone.</p>
            <form action="{{ route('applications.destroy', $application) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to withdraw this application?')" class="w-full rounded-xl bg-[color:var(--red)] px-4 py-2 text-sm font-medium text-white hover:opacity-90 transition">
                    Withdraw Application
                </button>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection
