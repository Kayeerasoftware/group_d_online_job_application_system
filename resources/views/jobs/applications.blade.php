@extends('layouts.app')
@section('title', 'Applications for ' . $job->title)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Applications for: {{ $job->title }}</h4>
        <small class="text-muted">{{ $job->company_name }} · {{ $applications->total() }} applicant(s)</small>
    </div>
    <a href="{{ route('jobs.show', $job) }}" class="btn btn-outline-dark btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back to Job
    </a>
</div>

@if($applications->isEmpty())
    <div class="text-center py-5">
        <i class="bi bi-inbox display-1 text-muted"></i>
        <p class="mt-3 text-muted">No applications yet.</p>
    </div>
@else
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Applicant</th>
                        <th>Email</th>
                        <th>Applied</th>
                        <th>Status</th>
                        <th>CV</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $application)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $application->applicant->name }}</td>
                            <td>{{ $application->applicant->email }}</td>
                            <td>{{ $application->created_at->format('M d, Y') }}</td>
                            <td>
                                <span class="badge status-{{ $application->status }}">
                                    {{ ucfirst($application->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ asset('storage/' . $application->cv_path) }}"
                                   target="_blank" class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-file-earmark-arrow-down me-1"></i>CV
                                </a>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('applications.status', $application) }}" class="d-flex gap-1">
                                    @csrf @method('PATCH')
                                    <select name="status" class="form-select form-select-sm" style="width:130px">
                                        @foreach(['pending','reviewed','accepted','rejected'] as $s)
                                            <option value="{{ $s }}" {{ $application->status === $s ? 'selected' : '' }}>
                                                {{ ucfirst($s) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-sm btn-dark">Update</button>
                                </form>
                            </td>
                        </tr>
                        @if($application->cover_letter)
                            <tr class="table-light">
                                <td colspan="7" class="small text-muted ps-4">
                                    <strong>Cover Letter:</strong> {{ $application->cover_letter }}
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">{{ $applications->links() }}</div>
@endif
@endsection
