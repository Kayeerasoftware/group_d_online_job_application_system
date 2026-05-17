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

        <section class="home-hero home-hero--split">
            <div class="home-hero-copy">
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
