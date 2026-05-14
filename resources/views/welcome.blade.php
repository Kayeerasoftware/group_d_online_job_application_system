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

        $stats = [
            ['value' => '3,840', 'label' => 'Active Jobs'],
            ['value' => '1,200+', 'label' => 'Employers'],
            ['value' => '47K', 'label' => 'Job Seekers'],
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

        $featuredJobs = [
            [
                'icon' => 'bank',
                'title' => 'Senior Data Analyst',
                'company' => 'Stanbic Bank Uganda',
                'status' => 'Open',
                'statusClass' => 'home-job-badge--green',
                'summary' => 'Analyze financial data, build dashboards, and support strategic decision-making across the retail banking division.',
                'meta' => ['Kampala CBD', 'Full-time', 'UGX 3.2M - 4.5M', '12 days left'],
            ],
            [
                'icon' => 'leaf',
                'title' => 'Programs Manager',
                'company' => 'USAID / Chemonics',
                'status' => 'Closing soon',
                'statusClass' => 'home-job-badge--amber',
                'summary' => 'Lead multi-stakeholder agricultural programs in Northern Uganda. Experience in USAID-funded projects required.',
                'meta' => ['Gulu', 'Contract', 'USD 2,800/mo', '3 days left'],
            ],
            [
                'icon' => 'mobile',
                'title' => 'Mobile Developer (Flutter)',
                'company' => 'Flutterwave Africa',
                'status' => 'Open',
                'statusClass' => 'home-job-badge--green',
                'summary' => 'Build cross-platform mobile apps for East Africa\'s fastest-growing fintech. Remote-first culture with Kampala office support.',
                'meta' => ['Remote / Kampala', 'Full-time', 'UGX 5M - 8M', '20 days left'],
            ],
            [
                'icon' => 'hospital',
                'title' => 'Clinical Nurse - ICU',
                'company' => 'Mulago National Hospital',
                'status' => 'Open',
                'statusClass' => 'home-job-badge--green',
                'summary' => 'Experienced ICU nurse needed for the expanded Critical Care Unit. Government pay scale plus accommodation allowance.',
                'meta' => ['Mulago Hill, Kampala', 'Full-time', 'Gov. Scale U4', '30 days left'],
            ],
        ];
    @endphp

    <div class="home-page space-y-6">
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
                    @foreach ($stats as $stat)
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
                    <p class="home-hero-panel__metric-value">3,840</p>
                    <p class="home-hero-panel__metric-label">active jobs across Uganda</p>
                </div>

                <div class="home-hero-panel__stack">
                    <div class="home-hero-panel__item">
                        <span class="home-hero-panel__item-icon">01</span>
                        <div>
                            <p class="home-hero-panel__item-title">Verified employers</p>
                            <p class="home-hero-panel__item-copy">Clear branding, job status, and structured listings.</p>
                        </div>
                    </div>

                    <div class="home-hero-panel__item">
                        <span class="home-hero-panel__item-icon">02</span>
                        <div>
                            <p class="home-hero-panel__item-title">Fast applications</p>
                            <p class="home-hero-panel__item-copy">Move from discovery to submission in a few steps.</p>
                        </div>
                    </div>

                    <div class="home-hero-panel__item">
                        <span class="home-hero-panel__item-icon">03</span>
                        <div>
                            <p class="home-hero-panel__item-title">Works everywhere</p>
                            <p class="home-hero-panel__item-copy">Responsive UI that stays polished on mobile and desktop.</p>
                        </div>
                    </div>
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

            <div class="home-grid">
                @foreach ($featuredJobs as $job)
                    <article class="home-job-card">
                        <div class="home-job-header">
                            <div class="home-company-logo" aria-hidden="true">
                                @switch($job['icon'])
                                    @case('bank')
                                        <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.7">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 10.5h16" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 10.5V18h2.5v-7.5M10.75 10.5V18h2.5v-7.5M15.5 10.5V18H18V10.5" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8.5 12 4l9 4.5H3Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 18h15" />
                                        </svg>
                                        @break
                                    @case('leaf')
                                        <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.7">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 17c4.5 0 8-3.5 8-8V6h-3c-4.5 0-8 3.5-8 8 0 1.9.7 3.6 1.8 5A5 5 0 0 1 9 15" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 10c-.8 2.8-2.6 4.9-5 6" />
                                        </svg>
                                        @break
                                    @case('mobile')
                                        <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.7">
                                            <rect x="7" y="3.5" width="10" height="17" rx="2.2" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 17h2" />
                                        </svg>
                                        @break
                                    @case('hospital')
                                        <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.7">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 4h10a2 2 0 0 1 2 2v14H5V6a2 2 0 0 1 2-2Z" />
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
        </section>
    </div>
@endsection
