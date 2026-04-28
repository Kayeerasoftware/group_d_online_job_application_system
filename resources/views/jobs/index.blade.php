@extends('layouts.app')
@section('title', 'Browse Jobs')

@section('content')
{{-- Hero --}}
<div class="bg-dark text-white rounded-3 p-5 mb-4">
    <h1 class="fw-bold">Find Your Dream Job</h1>
    <p class="lead text-warning mb-4">Browse hundreds of opportunities from top companies</p>
    <form method="GET" action="{{ route('jobs.index') }}" class="row g-2">
        <div class="col-md-6">
            <input type="text" name="search" class="form-control form-control-lg"
                   placeholder="Job title, company or location..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="job_type" class="form-select form-select-lg">
                <option value="">All Types</option>
                @foreach(['full-time','part-time','contract','remote'] as $type)
                    <option value="{{ $type }}" {{ request('job_type') === $type ? 'selected' : '' }}>
                        {{ ucfirst($type) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-warning btn-lg w-100">
                <i class="bi bi-search me-1"></i>Search
            </button>
        </div>
    </form>
</div>

{{-- Results --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">{{ $jobs->total() }} job(s) found</h5>
    @auth
        @if(auth()->user()->isEmployer())
            <a href="{{ route('jobs.create') }}" class="btn btn-dark">
                <i class="bi bi-plus-circle me-1"></i>Post a Job
            </a>
        @endif
    @endauth
</div>

@if($jobs->isEmpty())
    <div class="text-center py-5">
        <i class="bi bi-search display-1 text-muted"></i>
        <p class="mt-3 text-muted">No jobs found. Try different search terms.</p>
    </div>
@else
    <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
        @foreach($jobs as $job)
            <div class="col">
                <div class="card h-100 job-card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-warning text-dark badge-job-type">{{ ucfirst($job->job_type) }}</span>
                            @if($job->deadline && $job->deadline->isPast())
                                <span class="badge bg-danger">Closed</span>
                            @endif
                        </div>
                        <h5 class="card-title fw-bold">{{ $job->title }}</h5>
                        <p class="text-muted mb-1"><i class="bi bi-building me-1"></i>{{ $job->company_name }}</p>
                        <p class="text-muted mb-1"><i class="bi bi-geo-alt me-1"></i>{{ $job->location }}</p>
                        <p class="text-success fw-semibold mb-2"><i class="bi bi-cash me-1"></i>UGX {{ number_format($job->salary) }}</p>
                        <p class="card-text text-muted small">{{ Str::limit($job->description, 100) }}</p>
                    </div>
                    <div class="card-footer bg-transparent border-0 d-flex justify-content-between align-items-center">
                        <small class="text-muted">{{ $job->created_at->diffForHumans() }}</small>
                        <a href="{{ route('jobs.show', $job) }}" class="btn btn-sm btn-dark">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $jobs->links() }}
@endif
@endsection
