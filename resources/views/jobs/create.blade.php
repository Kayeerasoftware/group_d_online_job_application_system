@extends('layouts.app')
@section('title', 'Post a Job')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h4 class="fw-bold mb-4"><i class="bi bi-plus-circle me-2 text-warning"></i>Post a New Job</h4>

                <form method="POST" action="{{ route('jobs.store') }}">
                    @csrf
                    @include('jobs._form')
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-warning fw-bold px-4">
                            <i class="bi bi-send me-1"></i>Post Job
                        </button>
                        <a href="{{ route('jobs.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
