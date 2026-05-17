@extends('layouts.employer')

@section('title', 'All Employers')

@section('content')
<div class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-blue-600 to-cyan-600 p-4 rounded-2xl shadow-xl">
                        <i class="fas fa-building text-white text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 via-cyan-600 to-teal-600 bg-clip-text text-transparent mb-2">All Employers</h1>
                    <p class="text-gray-600 text-sm font-medium">Browse and connect with employers</p>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 border border-gray-200 text-right">
                <p class="text-lg font-bold text-blue-600">{{ $employers->total() }}</p>
                <p class="text-xs text-gray-600 font-medium">Employers Available</p>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6 border border-gray-100">
        <x-employer-search-filter />
    </div>

    <!-- Employers Grid -->
    @if($employers->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($employers as $employer)
                <x-employer-card :employer="$employer" />
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-8">
            {{ $employers->links() }}
        </div>
    @else
        <x-employer-empty-state />
    @endif
</div>
@endsection
