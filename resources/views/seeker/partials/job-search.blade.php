<div class="mb-6">
    <p class="mt-1 text-sm text-[color:var(--text2)]">{{ $totalJobs ?? 0 }} active listings</p>
</div>

<form method="GET" action="{{ route('jobs.index') }}" class="mb-6">
    <div class="flex flex-wrap gap-3 mb-4">
        <div class="flex flex-1 min-w-[200px] items-center gap-2 rounded-xl border border-[color:var(--border)] bg-[color:var(--surface)] px-4 py-2">
            <span>🔍</span>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title, skill, or keyword..." class="flex-1 border-0 bg-transparent text-sm outline-none">
        </div>
        <input type="text" name="location" value="{{ request('location') }}" placeholder="📍 Location" class="w-40 rounded-xl border border-[color:var(--border)] bg-[color:var(--surface)] px-4 py-2 text-sm outline-none focus:border-[color:var(--accent)]">
        <select name="type" class="w-36 rounded-xl border border-[color:var(--border)] bg-[color:var(--surface)] px-4 py-2 text-sm outline-none focus:border-[color:var(--accent)]">
            <option value="">All Types</option>
            <option value="full-time" {{ request('type') === 'full-time' ? 'selected' : '' }}>Full-time</option>
            <option value="part-time" {{ request('type') === 'part-time' ? 'selected' : '' }}>Part-time</option>
            <option value="contract" {{ request('type') === 'contract' ? 'selected' : '' }}>Contract</option>
            <option value="internship" {{ request('type') === 'internship' ? 'selected' : '' }}>Internship</option>
        </select>
        <button type="submit" class="rounded-xl bg-[color:var(--accent)] px-6 py-2 text-sm font-medium text-white hover:opacity-90 transition">Search</button>
    </div>
</form>

<div class="space-y-3">
    @forelse($jobs ?? [] as $job)
    <div class="flex gap-4 rounded-2xl border border-[color:var(--border)] bg-[color:var(--surface)] p-5 transition hover:border-[color:var(--accent)] hover:shadow-lg cursor-pointer" onclick="window.location='{{ route('jobs.show', $job) }}'">
        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl border border-[color:var(--border)] bg-[color:var(--surface2)] text-2xl">
            {{ $job->company_logo ?? '💼' }}
        </div>
        <div class="flex-1 min-w-0">
            <div class="flex items-start justify-between gap-3 mb-2">
                <div>
                    <h3 class="font-semibold text-[color:var(--text)]">{{ $job->title }}</h3>
                    <p class="text-sm text-[color:var(--text2)]">{{ $job->company_name }} · {{ $job->location }}</p>
                </div>
                <span class="inline-flex shrink-0 items-center rounded-full px-3 py-1 text-xs font-medium
                    @if($job->status === 'open') bg-[color:var(--accent-light)] text-[color:var(--accent)]
                    @else bg-[color:var(--amber-light)] text-[color:var(--amber)]
                    @endif">
                    {{ ucfirst($job->status) }}
                </span>
            </div>
            <p class="text-sm text-[color:var(--text2)] mb-3 line-clamp-2">{{ $job->description }}</p>
            <div class="flex flex-wrap items-center gap-3 text-xs text-[color:var(--text3)]">
                <span class="flex items-center gap-1">💼 {{ ucfirst($job->type) }}</span>
                @if($job->salary_min && $job->salary_max)
                <span class="flex items-center gap-1">💰 UGX {{ number_format($job->salary_min/1000000, 1) }}M–{{ number_format($job->salary_max/1000000, 1) }}M</span>
                @endif
                <span class="flex items-center gap-1">⏰ {{ $job->deadline->diffForHumans() }}</span>
            </div>
        </div>
        <div class="flex shrink-0 flex-col gap-2">
            <a href="{{ route('applications.create', ['job' => $job->id]) }}" onclick="event.stopPropagation()" class="rounded-xl bg-[color:var(--accent)] px-4 py-2 text-center text-sm font-medium text-white hover:opacity-90 transition">Apply</a>
            <form action="{{ route('seeker.saved-jobs.store', $job) }}" method="POST" onclick="event.stopPropagation()">
                @csrf
                <button type="submit" class="w-full rounded-xl border border-[color:var(--border)] bg-[color:var(--surface2)] px-4 py-2 text-sm font-medium text-[color:var(--text)] hover:bg-[color:var(--border)] transition">Save</button>
            </form>
        </div>
    </div>
    @empty
    <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--surface)] p-12 text-center">
        <p class="text-lg font-medium text-[color:var(--text)]">No jobs found</p>
        <p class="mt-2 text-sm text-[color:var(--text2)]">Try adjusting your search terms</p>
    </div>
    @endforelse
</div>
