@extends('layouts.app')

@section('title', 'Post Job')

@section('content')
    <x-ui.page-header
        eyebrow="Employer workspace"
        title="Post a job"
        description="Create a polished opening with clearer structure, fewer distractions, and stronger hierarchy."
    />

    @include('jobs._form')
@endsection
