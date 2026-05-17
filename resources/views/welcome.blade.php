@extends('layouts.app')

@section('title', 'Welcome - Job Application System')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<div class="min-h-screen">
    <!-- Stats Cards Section -->
    @include('partials.partials.landing.stats-cards')
    
    <!-- Charts Section -->
    @include('partials.partials.landing.charts-section')
    
    <!-- Data Tables Section -->
    @include('partials.partials.landing.data-tables')
    
    <!-- Long Card Section -->
    <div class="mb-6 p-2 sticky top-20 z-20" id="welcome-card">
        <div class="w-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-lg shadow-lg p-6 text-white">
            <h2 class="text-2xl font-bold mb-2">Welcome to Mak-JobLink</h2>
            <p class="text-lg">Your gateway to finding the perfect job opportunity or hiring the right talent. Explore thousands of positions, connect with employers, and advance your career today.</p>
        </div>
    </div>
    
    <!-- Search Section -->
    @include('partials.partials.landing.search-section')
    
    <!-- Jobs Grid/List Section -->
    @include('partials.partials.landing.jobs-section')
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const browseJobsBtns = document.querySelectorAll('a[href="{{ route('jobs.index') }}"]');
    browseJobsBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            const card = document.getElementById('welcome-card');
            if (card && window.location.pathname === '/') {
                e.preventDefault();
                card.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
    initializeCharts();
    initializeDataTables();
    initializeJobFilters();
});

function initializeCharts() {
    // Chart initialization will be handled in individual components
}

function initializeDataTables() {
    // Data table animations will be handled here
    animateProgressBars();
}

function initializeJobFilters() {
    // Job filtering functionality from browse-jobs
    const allJobs = document.querySelectorAll('.job-card');
    const allTableRows = document.querySelectorAll('.job-table-row');
    
    // Filter functionality will be implemented here
}

function animateProgressBars() {
    const progressBars = document.querySelectorAll('.progress-bar');
    progressBars.forEach(bar => {
        const width = bar.dataset.width;
        setTimeout(() => {
            bar.style.width = width + '%';
        }, 100);
    });
}
</script>
@endpush

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
<style>
.progress-bar {
    transition: width 2s ease-in-out;
}

.chart-container {
    position: relative;
    height: 300px;
}

.data-table-container {
    max-height: 400px;
    overflow-y: auto;
}

/* Loading line animations */
@keyframes slide-right-loading {
    0% { width: 0%; }
    100% { width: 100%; }
}

.animate-slide-right {
    animation: slide-right-loading 5s ease-out forwards;
}

@keyframes slide-text {
    0% { left: 0%; opacity: 1; }
    95% { opacity: 1; }
    100% { left: 100%; opacity: 0; }
}

.animate-slide-text {
    animation: slide-text 5s ease-out forwards;
}

/* Progress bar animations for data tables */
@keyframes slide-right-progress {
    0% { width: 0%; }
    100% { width: var(--target-width); }
}

.progress-bar {
    transition: width 2s ease-in-out;
}

.line-clamp-1 {
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 1;
}

.line-clamp-2 {
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
}

.line-clamp-3 {
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 3;
}

body::-webkit-scrollbar { 
    display: none; 
}

[x-cloak] { 
    display: none !important; 
}
</style>
@endpush
