@extends('layouts.app')
@section('title', 'My Dashboard')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-0">Welcome, {{ auth()->user()->name }}!</h4>
    <small class="text-muted">Job Seeker Dashboard</small>
</div>

{{-- Stats --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <div class="display-5 fw-bold text-warning">{{ $applications->count() }}</div>
            <div class="text-muted">Total Applied</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <div class="display-5 fw-bold text-info">{{ $applications->where('status','reviewed')->count() }}</div>
            <div class="text-muted">Reviewed</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <div class="display-5 fw-bold text-success">{{ $applications->where('status','accepted')->count() }}</div>
            <div class="text-muted">Accepted</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <div class="display-5 fw-bold text-danger">{{ $applications->where('status','rejected')->count() }}</div>
            <div class="text-muted">Rejected</div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-bold mb-0">Recent Applications</h5>
    <a href="{{ route('jobs.index') }}" class="btn btn-warning btn-sm">
        <i class="bi bi-search me-1"></i>Find More Jobs
    </a>
</div>

@if($applications->isEmpty())
    <div class="text-center py-5">
        <i class="bi bi-search display-1 text-muted"></i>
        <p class="mt-3 text-muted">You haven't applied to any jobs yet.</p>
        <a href="{{ route('jobs.index') }}" class="btn btn-dark">Browse Jobs</a>
    </div>
@else
    <div class="row g-3">
        @foreach($applications->take(6) as $application)
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="fw-bold mb-1">
                                    <a href="{{ route('jobs.show', $application->job) }}" class="text-decoration-none">
                                        {{ $application->job->title }}
                                    </a>
                                </h6>
                                <p class="text-muted small mb-0">
                                    <i class="bi bi-building me-1"></i>{{ $application->job->company_name }}
                                </p>
                            </div>
                            <span class="badge status-{{ $application->status }}">
                                {{ ucfirst($application->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 small text-muted">
                        Applied {{ $application->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if($applications->count() > 6)
        <div class="text-center mt-3">
            <a href="{{ route('applications.index') }}" class="btn btn-outline-dark">View All Applications</a>
        </div>
    @endif
@endif
@endsection
