@extends('layouts.app')

@section('title', 'Edit Job')

@section('content')
    <x-ui.page-header
        eyebrow="Employer workspace"
        title="Edit job"
        description="Refresh the listing details, status, or deadline while keeping the layout calm and readable."
    />

    @include('jobs._form')
@endsection
