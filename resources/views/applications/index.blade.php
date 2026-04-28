@extends('layouts.app')
@section('title', 'My Applications')

@section('content')
<h4 class="fw-bold mb-4"><i class="bi bi-file-earmark-text me-2 text-warning"></i>My Applications</h4>

@if($applications->isEmpty())
    <div class="text-center py-5">
        <i class="bi bi-inbox display-1 text-muted"></i>
        <p class="mt-3 text-muted">You haven't applied to any jobs yet.</p>
        <a href="{{ route('jobs.index') }}" class="btn btn-dark">Browse Jobs</a>
    </div>
@else
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Job Title</th>
                        <th>Company</th>
                        <th>Applied</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $application)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ route('jobs.show', $application->job) }}" class="fw-semibold text-decoration-none">
                                    {{ $application->job->title }}
                                </a>
                            </td>
                            <td>{{ $application->job->company_name }}</td>
                            <td>{{ $application->created_at->format('M d, Y') }}</td>
                            <td>
                                <span class="badge status-{{ $application->status }}">
                                    {{ ucfirst($application->status) }}
                                </span>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('applications.destroy', $application) }}"
                                      onsubmit="return confirm('Withdraw this application?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-x-circle me-1"></i>Withdraw
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">{{ $applications->links() }}</div>
@endif
@endsection
