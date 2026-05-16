@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    @php
        $industries = [
            ['label' => 'All Industries', 'query' => [], 'active' => true],
            ['label' => 'Technology', 'query' => ['search' => 'technology']],
            ['label' => 'Finance', 'query' => ['search' => 'finance']],
            ['label' => 'Healthcare', 'query' => ['search' => 'healthcare']],
            ['label' => 'Education', 'query' => ['search' => 'education']],
            ['label' => 'NGO / INGO', 'query' => ['search' => 'ngo']],
            ['label' => 'Construction', 'query' => ['search' => 'construction']],
            ['label' => 'Agriculture', 'query' => ['search' => 'agriculture']],
        ];

        $featureCards = [
            [
                'icon' => 'search',
                'title' => 'Find roles faster',
                'summary' => 'Search by skill, company, salary, or location with a clear, guided job discovery flow.',
            ],
            [
                'icon' => 'shield',
                'title' => 'Trusted listings',
                'summary' => 'Keep applications transparent with employer profiles, status badges, and clear timelines.',
            ],
            [
                'icon' => 'phone',
                'title' => 'Built for every screen',
                'summary' => 'The interface stays clean on desktop and mobile so users can apply wherever they are.',
            ],
        ];
    @endphp

    <div class="home-page space-y-6">
        <section class="home-intelligence">
            <div class="home-hero-banner home-hero-banner--light">
                <div class="home-hero-banner__content">
                    <div class="home-hero-banner__icon home-hero-banner__icon--light" aria-hidden="true">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="home-hero-banner__eyebrow">Welcome dashboard</p>
                        <h1 class="home-hero-banner__title">Find jobs quickly in one organized place</h1>
                        <p class="home-hero-banner__copy">
                            Clean summary, clear stats, and simple navigation for a faster job search.
                        </p>
                    </div>
                </div>

                <div class="home-hero-banner__clock">
                    <p>{{ now()->format('l, F d, Y') }}</p>
                    <p>{{ now()->format('h:i A') }}</p>
                </div>
            </div>

            <div class="home-metric-grid mt-5">
                @foreach ($overviewCards as $card)
                    <article class="home-metric-card home-metric-card--compact">
                        <p class="home-metric-label">{{ $card['label'] }}</p>
                        <p class="home-metric-value">{{ $card['value'] }}</p>
                        <p class="home-metric-meta">{{ $card['meta'] }}</p>
                    </article>
                @endforeach
            </div>

            <div class="home-insight-grid mt-5">
                <article class="home-chart-card home-chart-card--wide">
                    <div class="home-chart-card__header">
                        <div>
                            <p class="home-section-label">Graph chart</p>
                            <h3 class="home-chart-title">Activity trend</h3>
                        </div>
                        <span class="home-chart-chip">Monthly movement</span>
                    </div>

                    <div class="home-activity-chart home-activity-chart--tall mt-4">
                        @forelse ($monthlyActivity as $month)
                            <div class="home-activity-column">
                                <div class="home-activity-bars">
                                    <span class="home-activity-bar home-activity-bar--jobs" style="height: {{ $month['jobsPercent'] }}%;"></span>
                                    <span class="home-activity-bar home-activity-bar--applications" style="height: {{ $month['applicationsPercent'] }}%;"></span>
                                </div>
                                <p class="home-activity-label">{{ $month['label'] }}</p>
                                <p class="home-activity-meta">{{ number_format($month['jobs']) }} jobs / {{ number_format($month['applications']) }} apps</p>
                            </div>
                        @empty
                            <p class="home-empty-note">Not enough data to build an activity chart yet.</p>
                        @endforelse
                    </div>

                    <div class="home-line-legend">
                        <span><i class="home-line-legend__swatch home-line-legend__swatch--jobs"></i>Jobs created</span>
                        <span><i class="home-line-legend__swatch home-line-legend__swatch--apps"></i>Applications submitted</span>
                    </div>
                </article>

                <article class="home-chart-card home-analytics-card">
                    <div class="home-chart-card__header">
                        <div>
                            <p class="home-section-label">Analytics</p>
                            <h3 class="home-chart-title">Snapshot at a glance</h3>
                        </div>
                        <span class="home-chart-chip">{{ number_format($applicationTotal) }} applications</span>
                    </div>

                    <div class="home-analytics-summary mt-4">
                        <div class="home-analytics-summary__item">
                            <p class="home-analytics-summary__label">Open jobs</p>
                            <p class="home-analytics-summary__value">{{ number_format($openJobs) }}</p>
                            <p class="home-analytics-summary__meta">Live roles ready for applications</p>
                        </div>
                        <div class="home-analytics-summary__item">
                            <p class="home-analytics-summary__label">Employers</p>
                            <p class="home-analytics-summary__value">{{ number_format($employers) }}</p>
                            <p class="home-analytics-summary__meta">Verified companies on the platform</p>
                        </div>
                        <div class="home-analytics-summary__item">
                            <p class="home-analytics-summary__label">Saved jobs</p>
                            <p class="home-analytics-summary__value">{{ number_format($savedJobs) }}</p>
                            <p class="home-analytics-summary__meta">Bookmarked opportunities by seekers</p>
                        </div>
                    </div>

                    <div class="home-analytics-stack">
                        @forelse ($applicationBreakdown as $segment)
                            <div class="home-analytics-row">
                                <div class="home-analytics-row__meta">
                                    <span class="home-analytics-row__swatch" style="background: {{ $segment['color'] }}"></span>
                                    <div>
                                        <p class="home-analytics-row__title">{{ $segment['label'] }}</p>
                                        <p class="home-analytics-row__copy">{{ number_format($segment['value']) }} applications</p>
                                    </div>
                                </div>
                                <span class="home-analytics-row__percent">{{ $segment['percent'] }}%</span>
                            </div>
                        @empty
                            <p class="home-empty-note">No applications have been submitted yet.</p>
                        @endforelse
                    </div>
                </article>

                <article class="home-chart-card">
                    <div class="home-chart-card__header">
                        <div>
                            <p class="home-section-label">Status view</p>
                            <h3 class="home-chart-title">Application status mix</h3>
                        </div>
                        <span class="home-chart-chip">{{ number_format($applicationTotal) }} tracked</span>
                    </div>

                    <div class="home-ring-wrap">
                        <div class="home-ring" style="{{ $applicationRingStyle }}">
                            <div class="home-ring__center">
                                <span>{{ number_format($applicationTotal) }}</span>
                                <small>applications</small>
                            </div>
                        </div>
                    </div>

                    <div class="home-legend">
                        @forelse ($applicationBreakdown as $segment)
                            <div class="home-legend__item">
                                <span class="home-legend__swatch" style="background: {{ $segment['color'] }}"></span>
                                <div>
                                    <p>{{ $segment['label'] }}</p>
                                    <p>{{ number_format($segment['value']) }} applications ({{ $segment['percent'] }}%)</p>
                                </div>
                            </div>
                        @empty
                            <p class="home-empty-note">No applications have been submitted yet.</p>
                        @endforelse
                    </div>
                </article>

                <article class="home-chart-card">
                    <div class="home-chart-card__header">
                        <div>
                            <p class="home-section-label">Hiring mix</p>
                            <h3 class="home-chart-title">Job types</h3>
                        </div>
                        <span class="home-chart-chip">{{ number_format(array_sum(array_column($jobTypeBreakdown, 'value'))) }} tracked</span>
                    </div>

                    <div class="home-bar-list">
                        @forelse ($jobTypeBreakdown as $type)
                            <div class="home-bar-row">
                                <div class="home-bar-row__label">
                                    <span>{{ $type['label'] }}</span>
                                    <span>{{ number_format($type['value']) }}</span>
                                </div>
                                <div class="home-bar-track">
                                    <span class="home-bar-fill" style="width: {{ $type['percent'] }}%; background: {{ $type['color'] }};"></span>
                                </div>
                            </div>
                        @empty
                            <p class="home-empty-note">No job listings are available yet.</p>
                        @endforelse
                    </div>
                </article>
            </div>

            <div class="home-dual-grid mt-5">
                <article class="home-chart-card">
                    <div class="home-chart-card__header">
                        <div>
                            <p class="home-section-label">System pulse</p>
                            <h3 class="home-chart-title">Last 6 months of activity</h3>
                        </div>
                        <span class="home-chart-chip">Jobs and applications</span>
                    </div>

                    <div class="home-activity-chart">
                        @forelse ($monthlyActivity as $month)
                            <div class="home-activity-column">
                                <div class="home-activity-bars">
                                    <span class="home-activity-bar home-activity-bar--jobs" style="height: {{ $month['jobsPercent'] }}%;"></span>
                                    <span class="home-activity-bar home-activity-bar--applications" style="height: {{ $month['applicationsPercent'] }}%;"></span>
                                </div>
                                <p class="home-activity-label">{{ $month['label'] }}</p>
                                <p class="home-activity-meta">{{ number_format($month['jobs']) }} jobs / {{ number_format($month['applications']) }} apps</p>
                            </div>
                        @empty
                            <p class="home-empty-note">Not enough data to build an activity chart yet.</p>
                        @endforelse
                    </div>

                    <div class="home-line-legend">
                        <span><i class="home-line-legend__swatch home-line-legend__swatch--jobs"></i>Jobs created</span>
                        <span><i class="home-line-legend__swatch home-line-legend__swatch--apps"></i>Applications submitted</span>
                    </div>
                </article>

                <article class="home-chart-card">
                    <div class="home-chart-card__header">
                        <div>
                            <p class="home-section-label">Operational view</p>
                            <h3 class="home-chart-title">Open roles, top employers, and active locations</h3>
                        </div>
                        <span class="home-chart-chip">Live summary</span>
                    </div>

                    <div class="home-status-strip">
                        @foreach ($jobStatusBreakdown as $segment)
                            <div class="home-status-strip__item">
                                <div class="home-status-strip__meta">
                                    <span>{{ $segment['label'] }}</span>
                                    <strong>{{ number_format($segment['value']) }}</strong>
                                </div>
                                <div class="home-status-strip__track">
                                    <span class="home-status-strip__fill" style="width: {{ $segment['percent'] }}%; background: {{ $segment['color'] }};"></span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="home-dual-grid mt-5">
                        <div class="home-list-panel">
                            <div class="home-list-panel__header">
                                <p class="home-list-panel__title">Top employers</p>
                                <span>Active openings</span>
                            </div>

                            <div class="home-list-stack">
                                @forelse ($topEmployers as $employer)
                                    <div class="home-list-row">
                                        <div>
                                            <p class="home-list-row__title">{{ $employer->name }}</p>
                                            <p class="home-list-row__copy">{{ $employer->email }}</p>
                                        </div>
                                        <span class="home-list-row__count">{{ number_format($employer->active_jobs_count) }}</span>
                                    </div>
                                @empty
                                    <p class="home-empty-note">No employer activity has been recorded yet.</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="home-list-panel">
                            <div class="home-list-panel__header">
                                <p class="home-list-panel__title">Top locations</p>
                                <span>All listings</span>
                            </div>

                            <div class="home-list-stack">
                                @forelse ($topLocations as $location)
                                    <div class="home-list-row">
                                        <div>
                                            <p class="home-list-row__title">{{ $location['label'] }}</p>
                                            <p class="home-list-row__copy">Location demand from the database</p>
                                        </div>
                                        <span class="home-list-row__count">{{ number_format($location['value']) }}</span>
                                    </div>
                                @empty
                                    <p class="home-empty-note">No location data is available yet.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <section class="home-hero home-hero--split">
            <div class="home-hero-copy">
                <span class="home-tag">
                    <span class="home-tag-dot"></span>
                    Uganda's modern hiring platform
                </span>

                <h1 class="home-title mt-4 max-w-[14ch]">
                    Find your next<br>
                    <em>great opportunity</em>
                </h1>

                <p class="home-sub mt-4">
                    A polished job marketplace for seekers, employers, and administrators with fast search, clear status updates, and a mobile-first experience.
                </p>

                <form method="get" action="{{ route('jobs.index') }}" class="home-search mt-6">
                    <label class="sr-only" for="home-search-query">Job title, skill, or company</label>
                    <input
                        id="home-search-query"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Job title, skill, or company..."
                        class="home-search-input"
                    >

                    <label class="sr-only" for="home-search-location">Location</label>
                    <input
                        id="home-search-location"
                        name="location"
                        value="{{ request('location') }}"
                        placeholder="Location - Kampala, Entebbe..."
                        class="home-search-input home-search-input--location"
                    >

                    <button type="submit" class="home-search-button">
                        Search Jobs
                    </button>
                </form>

                <div class="home-stats">
                    @foreach ($heroStats as $stat)
                        <div>
                            <p class="home-stat-value">{{ $stat['value'] }}</p>
                            <p class="home-stat-label">{{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <aside class="home-hero-panel">
                <div class="home-hero-panel__header">
                    <p class="home-section-label">Platform snapshot</p>
                    <span class="home-panel-chip">Live now</span>
                </div>

                <div class="home-hero-panel__metric">
                    <p class="home-hero-panel__metric-value">{{ $heroMetric['value'] }}</p>
                    <p class="home-hero-panel__metric-label">{{ $heroMetric['label'] }}</p>
                </div>

                <div class="home-hero-panel__stack">
                    @foreach ($heroSnapshot as $item)
                        <div class="home-hero-panel__item">
                            <span class="home-hero-panel__item-icon">0{{ $loop->iteration }}</span>
                            <div>
                                <p class="home-hero-panel__item-title">{{ $item['title'] }}</p>
                                <p class="home-hero-panel__item-copy">{{ $item['copy'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="home-hero-panel__footer">
                    <a href="{{ route('register') }}" class="home-panel-button">Create account</a>
                    <a href="{{ route('jobs.index') }}" class="home-panel-link">Explore jobs</a>
                </div>
            </aside>
        </section>

        <section class="home-features">
            @foreach ($featureCards as $feature)
                <article class="home-feature-card">
                    <span class="home-feature-icon">
                        @switch($feature['icon'])
                            @case('search')
                                <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.3-4.3m1.8-5.2a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" />
                                </svg>
                                @break
                            @case('shield')
                                <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3 19 6v6c0 5-3.2 8.6-7 9-3.8-.4-7-4-7-9V6l7-3Z" />
                                </svg>
                                @break
                            @case('phone')
                                <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                    <rect x="7" y="3.5" width="10" height="17" rx="2.2" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 17h2" />
                                </svg>
                                @break
                        @endswitch
                    </span>
                    <h3 class="home-feature-title">{{ $feature['title'] }}</h3>
                    <p class="home-feature-copy">{{ $feature['summary'] }}</p>
                </article>
            @endforeach
        </section>

        <section class="home-pills">
            @foreach ($industries as $industry)
                <a
                    href="{{ route('jobs.index', $industry['query']) }}"
                    class="home-pill {{ $industry['active'] ?? false ? 'is-active' : '' }}"
                >
                    {{ $industry['label'] }}
                </a>
            @endforeach
        </section>

        <section class="space-y-3">
            <div class="home-section-header">
                <div>
                    <p class="home-section-label">Featured Listings</p>
                    <h2 class="home-section-title">Trending this week</h2>
                </div>

                <a href="{{ route('jobs.index') }}" class="home-view-all">
                    View all ->
                </a>
            </div>

            @if (count($featuredJobs) > 0)
                <div class="home-grid">
                    @foreach ($featuredJobs as $job)
                        <article class="home-job-card">
                            <div class="home-job-header">
                                <div class="home-company-logo" aria-hidden="true">
                                    @switch($job['icon'])
                                        @case('briefcase')
                                            <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.7">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6V5a2 2 0 0 1 2-2h0a2 2 0 0 1 2 2v1" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 9h16v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 12h16" />
                                            </svg>
                                            @break
                                        @case('clock')
                                            <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.7">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 2" />
                                                <circle cx="12" cy="12" r="8.5" />
                                            </svg>
                                            @break
                                        @case('document')
                                            <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.7">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 3.5h7l5 5V20a1.5 1.5 0 0 1-1.5 1.5h-10A1.5 1.5 0 0 1 6 20V5a1.5 1.5 0 0 1 1-1.5Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 3.5V9h5" />
                                            </svg>
                                            @break
                                        @case('spark')
                                            <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.7">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 2.5 4.8 13H11l-1 8.5L19.2 11H13l0-8.5Z" />
                                            </svg>
                                            @break
                                    @endswitch
                                </div>

                                <div class="min-w-0">
                                    <h3 class="home-job-title truncate">{{ $job['title'] }}</h3>
                                    <p class="home-job-company truncate">{{ $job['company'] }}</p>
                                </div>

                                <span class="home-job-badge {{ $job['statusClass'] }}">
                                    {{ $job['status'] }}
                                </span>
                            </div>

                            <p class="home-job-description">
                                {{ $job['summary'] }}
                            </p>

                            <div class="home-meta">
                                @foreach ($job['meta'] as $meta)
                                    <span class="home-meta-item">{{ $meta }}</span>
                                @endforeach
                            </div>

                            <div class="home-actions">
                                <a href="{{ route('register') }}" class="home-btn home-btn--primary">
                                    Apply Now
                                </a>
                                <a href="{{ route('jobs.index') }}" class="home-btn home-btn--secondary">
                                    Save
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="home-empty-card">
                    <p class="home-empty-card__title">No live jobs yet</p>
                    <p class="home-empty-card__copy">
                        Once employers start posting, this section will pull the newest listings directly from the database.
                    </p>
                </div>
            @endif
        </section>
    </div>
@endsection
