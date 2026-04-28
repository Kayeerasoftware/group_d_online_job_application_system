@extends('layouts.app')
@section('title', 'Edit Job')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h4 class="fw-bold mb-4"><i class="bi bi-pencil me-2 text-warning"></i>Edit Job</h4>

                <form method="POST" action="{{ route('jobs.update', $job) }}">
                    @csrf @method('PUT')
                    @include('jobs._form')
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-warning fw-bold px-4">
                            <i class="bi bi-save me-1"></i>Update Job
                        </button>
                        <a href="{{ route('jobs.show', $job) }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
