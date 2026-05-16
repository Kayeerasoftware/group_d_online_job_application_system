<div class="space-y-4">
    @forelse($recentApplications ?? [] as $savedJob)
    <div class="flex gap-4 rounded-2xl border border-[color:var(--border)] bg-[color:var(--surface)] p-5 transition hover:border-[color:var(--accent)] hover:shadow-lg">
        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl border border-[color:var(--border)] bg-[color:var(--surface2)] text-2xl">
            {{ $savedJob->job->company_logo ?? '💼' }}
        </div>
        <div class="flex-1 min-w-0">
            <div class="flex items-start justify-between gap-3 mb-2">
                <div>
                    <h3 class="font-semibold text-[color:var(--text)]">{{ $savedJob->job->title }}</h3>
                    <p class="text-sm text-[color:var(--text2)]">{{ $savedJob->job->company_name }} · {{ $savedJob->job->location }}</p>
                </div>
                <span class="inline-flex shrink-0 items-center rounded-full px-3 py-1 text-xs font-medium
                    @if($savedJob->job->status === 'open') bg-[color:var(--accent-light)] text-[color:var(--accent)]
                    @else bg-[color:var(--amber-light)] text-[color:var(--amber)]
                    @endif">
                    {{ ucfirst($savedJob->job->status) }}
                </span>
            </div>
            <p class="text-sm text-[color:var(--text2)] mb-3 line-clamp-2">{{ $savedJob->job->description }}</p>
            <div class="flex flex-wrap items-center gap-3 text-xs text-[color:var(--text3)]">
                <span class="flex items-center gap-1">💼 {{ ucfirst($savedJob->job->type) }}</span>
                @if($savedJob->job->salary_min && $savedJob->job->salary_max)
                <span class="flex items-center gap-1">💰 UGX {{ number_format($savedJob->job->salary_min/1000000, 1) }}M–{{ number_format($savedJob->job->salary_max/1000000, 1) }}M</span>
                @endif
                <span class="flex items-center gap-1">⏰ {{ $savedJob->job->deadline->diffForHumans() }}</span>
            </div>
        </div>
        <div class="flex shrink-0 flex-col gap-2">
            <a href="{{ route('jobs.show', $savedJob->job) }}" class="rounded-xl border border-[color:var(--border)] bg-[color:var(--surface2)] px-4 py-2 text-center text-sm font-medium text-[color:var(--text)] hover:bg-[color:var(--border)] transition">View</a>
            <a href="{{ route('applications.create', ['job' => $savedJob->job->id]) }}" class="rounded-xl bg-[color:var(--accent)] px-4 py-2 text-center text-sm font-medium text-white hover:opacity-90 transition">Apply</a>
        </div>
    </div>
    @empty
    <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--surface)] p-12 text-center">
        <p class="text-lg font-medium text-[color:var(--text)]">No saved jobs yet</p>
        <p class="mt-2 text-sm text-[color:var(--text2)]">Save jobs you're interested in</p>
    </div>
    @endforelse
</div>
