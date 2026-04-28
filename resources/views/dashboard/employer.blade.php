@extends('layouts.app')
@section('title', 'Employer Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Welcome, {{ auth()->user()->name }}!</h4>
        <small class="text-muted">Employer Dashboard</small>
    </div>
    <a href="{{ route('jobs.create') }}" class="btn btn-warning fw-bold">
        <i class="bi bi-plus-circle me-1"></i>Post New Job
    </a>
</div>

{{-- Stats --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-center p-3">
            <div class="display-5 fw-bold text-warning">{{ $jobs->count() }}</div>
            <div class="text-muted">Total Jobs Posted</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-center p-3">
            <div class="display-5 fw-bold text-success">{{ $jobs->sum('applications_count') }}</div>
            <div class="text-muted">Total Applications</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-center p-3">
            <div class="display-5 fw-bold text-info">{{ $jobs->where('applications_count', '>', 0)->count() }}</div>
            <div class="text-muted">Jobs with Applications</div>
        </div>
    </div>
</div>

<h5 class="fw-bold mb-3">Your Job Listings</h5>

@if($jobs->isEmpty())
    <div class="text-center py-5">
        <i class="bi bi-briefcase display-1 text-muted"></i>
        <p class="mt-3 text-muted">You haven't posted any jobs yet.</p>
        <a href="{{ route('jobs.create') }}" class="btn btn-warning">Post Your First Job</a>
    </div>
@else
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Location</th>
                        <th>Deadline</th>
                        <th>Applications</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $job)
                        <tr>
                            <td class="fw-semibold">{{ $job->title }}</td>
                            <td><span class="badge bg-warning text-dark">{{ ucfirst($job->job_type) }}</span></td>
                            <td>{{ $job->location }}</td>
                            <td>
                                @if($job->deadline)
                                    <span class="{{ $job->deadline->isPast() ? 'text-danger' : 'text-success' }}">
                                        {{ $job->deadline->format('M d, Y') }}
                                    </span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('jobs.applications', $job) }}" class="badge bg-dark text-decoration-none">
                                    {{ $job->applications_count }} applicant(s)
                                </a>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('jobs.show', $job) }}" class="btn btn-sm btn-outline-dark">View</a>
                                    <a href="{{ route('jobs.edit', $job) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                    <form method="POST" action="{{ route('jobs.destroy', $job) }}"
                                          onsubmit="return confirm('Delete this job?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
@endsection
