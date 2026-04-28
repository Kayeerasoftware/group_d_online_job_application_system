@extends('layouts.app')
@section('title', $job->title)

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h2 class="fw-bold mb-1">{{ $job->title }}</h2>
                        <p class="text-muted mb-0"><i class="bi bi-building me-1"></i>{{ $job->company_name }}</p>
                    </div>
                    <span class="badge bg-warning text-dark fs-6">{{ ucfirst($job->job_type) }}</span>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-sm-4">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-geo-alt-fill text-danger fs-5"></i>
                            <div>
                                <div class="small text-muted">Location</div>
                                <div class="fw-semibold">{{ $job->location }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-cash-stack text-success fs-5"></i>
                            <div>
                                <div class="small text-muted">Salary</div>
                                <div class="fw-semibold text-success">UGX {{ number_format($job->salary) }}</div>
                            </div>
                        </div>
                    </div>
                    @if($job->deadline)
                    <div class="col-sm-4">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-calendar-event text-warning fs-5"></i>
                            <div>
                                <div class="small text-muted">Deadline</div>
                                <div class="fw-semibold {{ $job->deadline->isPast() ? 'text-danger' : '' }}">
                                    {{ $job->deadline->format('M d, Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <h5 class="fw-bold">Job Description</h5>
                <div class="text-muted" style="white-space: pre-line">{{ $job->description }}</div>

                <hr>
                <small class="text-muted">Posted by <strong>{{ $job->employer->name }}</strong> · {{ $job->created_at->diffForHumans() }}</small>
            </div>
        </div>

        {{-- Employer controls --}}
        @auth
            @if(auth()->id() === $job->user_id)
                <div class="d-flex gap-2 mb-4">
                    <a href="{{ route('jobs.edit', $job) }}" class="btn btn-outline-dark">
                        <i class="bi bi-pencil me-1"></i>Edit Job
                    </a>
                    <a href="{{ route('jobs.applications', $job) }}" class="btn btn-dark">
                        <i class="bi bi-people me-1"></i>View Applications ({{ $job->applications->count() }})
                    </a>
                    <form method="POST" action="{{ route('jobs.destroy', $job) }}"
                          onsubmit="return confirm('Delete this job?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-outline-danger"><i class="bi bi-trash me-1"></i>Delete</button>
                    </form>
                </div>
            @endif
        @endauth
    </div>

    {{-- Apply sidebar --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm sticky-top" style="top: 80px">
            <div class="card-body p-4">
                @guest
                    <h5 class="fw-bold mb-3">Apply for this Job</h5>
                    <p class="text-muted small">You need to be logged in as a job seeker to apply.</p>
                    <a href="{{ route('login') }}" class="btn btn-dark w-100">Login to Apply</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-warning w-100 mt-2">Create Account</a>
                @endguest

                @auth
                    @if(auth()->user()->isApplicant())
                        @if($hasApplied)
                            <div class="text-center py-3">
                                <i class="bi bi-check-circle-fill text-success display-4"></i>
                                <p class="mt-2 fw-semibold">You've already applied!</p>
                                <a href="{{ route('applications.index') }}" class="btn btn-outline-dark btn-sm">
                                    View My Applications
                                </a>
                            </div>
                        @elseif($job->deadline && $job->deadline->isPast())
                            <div class="alert alert-danger mb-0">
                                <i class="bi bi-x-circle me-1"></i>Application deadline has passed.
                            </div>
                        @else
                            <h5 class="fw-bold mb-3">Apply Now</h5>
                            <form method="POST" action="{{ route('jobs.apply', $job) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Upload CV <span class="text-danger">*</span></label>
                                    <input type="file" name="cv" class="form-control @error('cv') is-invalid @enderror"
                                           accept=".pdf,.doc,.docx" required>
                                    <div class="form-text">PDF, DOC or DOCX — max 2MB</div>
                                    @error('cv')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Cover Letter</label>
                                    <textarea name="cover_letter" class="form-control @error('cover_letter') is-invalid @enderror"
                                              rows="5" placeholder="Tell the employer why you're a great fit...">{{ old('cover_letter') }}</textarea>
                                    @error('cover_letter')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <button type="submit" class="btn btn-warning w-100 fw-bold">
                                    <i class="bi bi-send me-1"></i>Submit Application
                                </button>
                            </form>
                        @endif
                    @elseif(auth()->id() !== $job->user_id)
                        <div class="alert alert-info mb-0">
                            <i class="bi bi-info-circle me-1"></i>Employers cannot apply for jobs.
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>

<a href="{{ route('jobs.index') }}" class="btn btn-link ps-0"><i class="bi bi-arrow-left me-1"></i>Back to Jobs</a>
@endsection
