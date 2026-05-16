@extends('layouts.app')

@section('title', 'Job Search')

@section('content')
<div class="mb-6">
    <h1 class="font-serif text-3xl text-[color:var(--text)]">Job Search</h1>
    <p class="mt-1 text-sm text-[color:var(--text2)]">{{ $totalJobs }} active listings across Uganda</p>
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

    <div class="flex flex-wrap gap-2">
        <button type="button" class="rounded-full border border-[color:var(--border)] px-4 py-1.5 text-sm font-medium transition hover:bg-[color:var(--surface2)] {{ !request('industry') ? 'bg-[color:var(--accent)] text-white border-[color:var(--accent)]' : 'text-[color:var(--text2)]' }}">All Industries</button>
        @foreach(['Tech & IT', 'Finance', 'Health', 'NGO', 'Education'] as $industry)
        <button type="button" onclick="document.querySelector('[name=industry]').value='{{ $industry }}'; this.closest('form').submit();" class="rounded-full border border-[color:var(--border)] px-4 py-1.5 text-sm font-medium text-[color:var(--text2)] transition hover:bg-[color:var(--surface2)] {{ request('industry') === $industry ? 'bg-[color:var(--accent)] text-white border-[color:var(--accent)]' : '' }}">{{ $industry }}</button>
        @endforeach
        <input type="hidden" name="industry" value="{{ request('industry') }}">
    </div>
</form>

<div class="grid gap-6 lg:grid-cols-4">
    <div class="lg:col-span-1">
        <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--surface)] p-5 sticky top-4">
            <h3 class="font-semibold text-[color:var(--text)] mb-4">Filters</h3>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-[color:var(--text2)] mb-2">Salary Range (UGX)</label>
                <input type="text" name="min_salary" value="{{ request('min_salary') }}" placeholder="Min (e.g. 1,500,000)" class="w-full rounded-lg border border-[color:var(--border)] bg-[color:var(--surface)] px-3 py-2 text-sm outline-none focus:border-[color:var(--accent)] mb-2">
                <input type="text" name="max_salary" value="{{ request('max_salary') }}" placeholder="Max (e.g. 5,000,000)" class="w-full rounded-lg border border-[color:var(--border)] bg-[color:var(--surface)] px-3 py-2 text-sm outline-none focus:border-[color:var(--accent)]">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-[color:var(--text2)] mb-2">Experience Level</label>
                <select name="experience" class="w-full rounded-lg border border-[color:var(--border)] bg-[color:var(--surface)] px-3 py-2 text-sm outline-none focus:border-[color:var(--accent)]">
                    <option value="">Any Level</option>
                    <option value="entry" {{ request('experience') === 'entry' ? 'selected' : '' }}>Entry (0–2 yrs)</option>
                    <option value="mid" {{ request('experience') === 'mid' ? 'selected' : '' }}>Mid (3–5 yrs)</option>
                    <option value="senior" {{ request('experience') === 'senior' ? 'selected' : '' }}>Senior (6+ yrs)</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-[color:var(--text2)] mb-2">Job Type</label>
                <div class="space-y-2">
                    @foreach(['full-time' => 'Full-time', 'part-time' => 'Part-time', 'contract' => 'Contract', 'internship' => 'Internship'] as $value => $label)
                    <label class="flex items-center gap-2 text-sm">
                        <input type="checkbox" name="types[]" value="{{ $value }}" {{ in_array($value, request('types', [])) ? 'checked' : '' }} class="rounded border-[color:var(--border)]">
                        <span class="text-[color:var(--text)]">{{ $label }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-[color:var(--text2)] mb-2">Posted Within</label>
                <select name="posted" class="w-full rounded-lg border border-[color:var(--border)] bg-[color:var(--surface)] px-3 py-2 text-sm outline-none focus:border-[color:var(--accent)]">
                    <option value="">Any time</option>
                    <option value="24h" {{ request('posted') === '24h' ? 'selected' : '' }}>Last 24 hours</option>
                    <option value="7d" {{ request('posted') === '7d' ? 'selected' : '' }}>Last 7 days</option>
                    <option value="30d" {{ request('posted') === '30d' ? 'selected' : '' }}>Last 30 days</option>
                </select>
            </div>

            <button type="submit" class="w-full rounded-xl bg-[color:var(--accent)] px-4 py-2 text-sm font-medium text-white hover:opacity-90 transition mb-2">Apply Filters</button>
            <a href="{{ route('jobs.index') }}" class="block w-full rounded-xl border border-[color:var(--border)] bg-[color:var(--surface2)] px-4 py-2 text-center text-sm font-medium text-[color:var(--text)] hover:bg-[color:var(--border)] transition">Reset</a>
        </div>
    </div>

    <div class="lg:col-span-3">
        <div class="flex items-center justify-between mb-4">
            <p class="text-sm text-[color:var(--text2)]">Showing <strong>{{ $jobs->total() }} results</strong> {{ request('search') ? 'for "'.request('search').'"' : '' }}</p>
            <select name="sort" onchange="this.form.submit()" class="rounded-lg border border-[color:var(--border)] bg-[color:var(--surface)] px-3 py-1.5 text-sm outline-none focus:border-[color:var(--accent)]">
                <option value="recent" {{ request('sort') === 'recent' ? 'selected' : '' }}>Most Recent</option>
                <option value="relevant" {{ request('sort') === 'relevant' ? 'selected' : '' }}>Best Match</option>
                <option value="salary" {{ request('sort') === 'salary' ? 'selected' : '' }}>Highest Salary</option>
            </select>
        </div>

        <div class="space-y-3">
            @forelse($jobs as $job)
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
                        <span class="flex items-center gap-1">👁 {{ $job->views_count ?? 0 }} views</span>
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
                <p class="mt-2 text-sm text-[color:var(--text2)]">Try adjusting your filters or search terms</p>
            </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $jobs->links() }}
        </div>
    </div>
</div>
</form>
@endsection
