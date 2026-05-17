@extends('layouts.jobseeker')

@section('title', 'Job Search')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
            <div class="flex items-center gap-2 md:gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-blue-600 to-cyan-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                        <i class="fas fa-search text-white text-xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-blue-600 via-cyan-600 to-teal-600 bg-clip-text text-transparent mb-1 md:mb-2">Job Search</h1>
                    <p class="text-gray-600 text-xs md:text-sm font-medium">{{ $totalJobs ?? 0 }} active listings across Uganda</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-green-500 to-green-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-green-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Jobs...</span>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-3 mb-3 md:mb-4">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-[8px] md:text-[10px] font-medium mb-0.5">Total Jobs</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $totalJobs ?? 248 }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-briefcase text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-cyan-100 text-[8px] md:text-[10px] font-medium mb-0.5">Matching Your Profile</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $matchingJobs ?? 42 }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-star text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-teal-500 to-teal-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-teal-100 text-[8px] md:text-[10px] font-medium mb-0.5">Posted Today</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $postedToday ?? 18 }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-fire text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-[8px] md:text-[10px] font-medium mb-0.5">Saved Jobs</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $savedCount ?? 12 }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-bookmark text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Form -->
    <form method="GET" action="{{ route('seeker.browse-jobs') }}" class="mb-6">
        <div class="bg-white rounded-xl shadow-lg p-4 border border-gray-100 mb-4">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-2 mb-4">
                <div class="md:col-span-4 relative">
                    <i class="fas fa-search absolute left-2.5 top-1/2 transform -translate-y-1/2 text-blue-400 text-xs"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title, skill, or keyword..." class="w-full pl-8 pr-2 py-1.5 text-xs border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-white">
                </div>
                <div class="md:col-span-3 relative">
                    <i class="fas fa-map-marker-alt absolute left-2.5 top-1/2 transform -translate-y-1/2 text-cyan-400 text-xs"></i>
                    <input type="text" name="location" value="{{ request('location') }}" placeholder="Location..." class="w-full pl-8 pr-2 py-1.5 text-xs border border-cyan-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all bg-white">
                </div>
                <div class="md:col-span-2 relative">
                    <i class="fas fa-briefcase absolute left-2.5 top-1/2 transform -translate-y-1/2 text-teal-400 text-xs"></i>
                    <select name="type" class="w-full pl-8 pr-2 py-1.5 text-xs border border-teal-200 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all appearance-none bg-white">
                        <option value="">All Types</option>
                        <option value="full-time" {{ request('type') === 'full-time' ? 'selected' : '' }}>Full-time</option>
                        <option value="part-time" {{ request('type') === 'part-time' ? 'selected' : '' }}>Part-time</option>
                        <option value="contract" {{ request('type') === 'contract' ? 'selected' : '' }}>Contract</option>
                        <option value="internship" {{ request('type') === 'internship' ? 'selected' : '' }}>Internship</option>
                    </select>
                </div>
                <div class="md:col-span-3 flex gap-1.5">
                    <button type="submit" class="flex-1 px-2 py-1.5 text-xs bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold">
                        <i class="fas fa-search mr-1"></i>Search
                    </button>
                    <a href="{{ route('seeker.browse-jobs') }}" class="px-2 py-1.5 text-xs bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 rounded-lg hover:shadow-md transition-all duration-300 font-semibold">
                        <i class="fas fa-redo"></i>
                    </a>
                </div>
            </div>

            <!-- Industry Filter -->
            <div class="flex flex-wrap gap-2">
                <button type="button" class="rounded-full border border-gray-300 px-4 py-1.5 text-sm font-medium transition hover:bg-gray-100 {{ !request('industry') ? 'bg-blue-600 text-white border-blue-600' : 'text-gray-700' }}">All Industries</button>
                @foreach(['Tech & IT', 'Finance', 'Health', 'NGO', 'Education'] as $industry)
                <button type="button" onclick="document.querySelector('[name=industry]').value='{{ $industry }}'; this.closest('form').submit();" class="rounded-full border border-gray-300 px-4 py-1.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100 {{ request('industry') === $industry ? 'bg-blue-600 text-white border-blue-600' : '' }}">{{ $industry }}</button>
                @endforeach
                <input type="hidden" name="industry" value="{{ request('industry') }}">
            </div>
        </div>
    </form>

    <!-- Main Content Grid -->
    <div class="grid gap-6 lg:grid-cols-4">
        <!-- Sidebar Filters -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100 sticky top-6">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-filter text-blue-600 mr-2"></i>Filters
                </h3>
                
                <form method="GET" action="{{ route('seeker.browse-jobs') }}" class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Salary Range (UGX)</label>
                        <input type="text" name="min_salary" value="{{ request('min_salary') }}" placeholder="Min" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500 mb-2">
                        <input type="text" name="max_salary" value="{{ request('max_salary') }}" placeholder="Max" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Experience Level</label>
                        <select name="experience" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Any Level</option>
                            <option value="entry" {{ request('experience') === 'entry' ? 'selected' : '' }}>Entry (0–2 yrs)</option>
                            <option value="mid" {{ request('experience') === 'mid' ? 'selected' : '' }}>Mid (3–5 yrs)</option>
                            <option value="senior" {{ request('experience') === 'senior' ? 'selected' : '' }}>Senior (6+ yrs)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Job Type</label>
                        <div class="space-y-2">
                            @foreach(['full-time' => 'Full-time', 'part-time' => 'Part-time', 'contract' => 'Contract', 'internship' => 'Internship'] as $value => $label)
                            <label class="flex items-center gap-2 text-sm cursor-pointer">
                                <input type="checkbox" name="types[]" value="{{ $value }}" {{ in_array($value, request('types', [])) ? 'checked' : '' }} class="rounded border-gray-300">
                                <span class="text-gray-700">{{ $label }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Posted Within</label>
                        <select name="posted" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Any time</option>
                            <option value="24h" {{ request('posted') === '24h' ? 'selected' : '' }}>Last 24 hours</option>
                            <option value="7d" {{ request('posted') === '7d' ? 'selected' : '' }}>Last 7 days</option>
                            <option value="30d" {{ request('posted') === '30d' ? 'selected' : '' }}>Last 30 days</option>
                        </select>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="flex-1 rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 px-4 py-2 text-sm font-medium text-white hover:shadow-lg transition">Apply</button>
                        <a href="{{ route('seeker.browse-jobs') }}" class="flex-1 rounded-lg border border-gray-300 bg-white px-4 py-2 text-center text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Job Listings -->
        <div class="lg:col-span-3">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-gray-600">Showing <strong>{{ $jobs->total() ?? 0 }} results</strong> {{ request('search') ? 'for "'.request('search').'"' : '' }}</p>
                <select name="sort" onchange="window.location.href='{{ route('seeker.browse-jobs') }}?sort=' + this.value" class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="recent" {{ request('sort') === 'recent' ? 'selected' : '' }}>Most Recent</option>
                    <option value="relevant" {{ request('sort') === 'relevant' ? 'selected' : '' }}>Best Match</option>
                    <option value="salary" {{ request('sort') === 'salary' ? 'selected' : '' }}>Highest Salary</option>
                </select>
            </div>

            <div class="space-y-3">
                @forelse($jobs as $job)
                <div class="flex gap-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 bg-white p-5 cursor-pointer hover:border-blue-200" onclick="window.location='{{ route('jobs.show', $job) }}'">
                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-lg border border-gray-200 bg-gray-50 text-2xl">
                        {{ $job->company_logo ?? '💼' }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-3 mb-2">
                            <div>
                                <h3 class="font-bold text-gray-900">{{ $job->title }}</h3>
                                <p class="text-sm text-gray-600">{{ $job->company_name }} · {{ $job->location }}</p>
                            </div>
                            <span class="inline-flex shrink-0 items-center rounded-full px-3 py-1 text-xs font-medium
                                @if($job->status === 'open') bg-green-100 text-green-800
                                @else bg-yellow-100 text-yellow-800
                                @endif">
                                {{ ucfirst($job->status) }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $job->description }}</p>
                        <div class="flex flex-wrap items-center gap-3 text-xs text-gray-600">
                            <span class="flex items-center gap-1">💼 {{ ucfirst($job->type) }}</span>
                            @if($job->salary_min && $job->salary_max)
                            <span class="flex items-center gap-1">💰 UGX {{ number_format($job->salary_min/1000000, 1) }}M–{{ number_format($job->salary_max/1000000, 1) }}M</span>
                            @endif
                            <span class="flex items-center gap-1">⏰ {{ $job->deadline->diffForHumans() }}</span>
                            <span class="flex items-center gap-1">👁 {{ $job->views_count ?? 0 }} views</span>
                        </div>
                    </div>
                    <div class="flex shrink-0 flex-col gap-2">
                        <a href="{{ route('seeker.applications') }}" onclick="event.stopPropagation()" class="rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 px-4 py-2 text-center text-sm font-medium text-white hover:shadow-lg transition">Apply</a>
                        <form action="{{ route('seeker.saved-jobs.store', $job) }}" method="POST" onclick="event.stopPropagation()">
                            @csrf
                            <button type="submit" class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Save</button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="rounded-xl border border-gray-200 bg-white p-12 text-center">
                    <i class="fas fa-search text-4xl text-gray-300 mb-4"></i>
                    <p class="text-lg font-medium text-gray-900">No jobs found</p>
                    <p class="mt-2 text-sm text-gray-600">Try adjusting your filters or search terms</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($jobs && $jobs->hasPages())
            <div class="mt-6 flex justify-center">
                {{ $jobs->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<style>
@keyframes slide-right {
    0% { width: 0%; }
    100% { width: 100%; }
}
.animate-slide-right {
    animation: slide-right 5s ease-out forwards;
}
@keyframes slide-text {
    0% { left: 0%; opacity: 1; }
    95% { opacity: 1; }
    100% { left: 100%; opacity: 0; }
}
.animate-slide-text {
    animation: slide-text 5s ease-out forwards;
}
</style>
@endsection
