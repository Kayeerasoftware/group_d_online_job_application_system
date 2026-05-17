@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
            <div class="flex items-center gap-2 md:gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-blue-600 to-cyan-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                        <i class="fas fa-building text-white text-xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-blue-600 via-cyan-600 to-teal-600 bg-clip-text text-transparent mb-1 md:mb-2">All Employers</h1>
                    <p class="text-gray-600 text-xs md:text-sm font-medium">Browse and connect with employers</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-blue-500 to-blue-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-blue-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Employers...</span>
    </div>

    <!-- Search and Filter Section -->
    <div class="bg-white rounded-xl shadow-lg p-4 md:p-6 mb-6 border border-gray-100">
        <form method="GET" action="{{ route('employer.all-employers') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search Employers</label>
                    <input 
                        type="text" 
                        id="search" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Search by name or email..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                </div>

                <div>
                    <label for="sort" class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                    <select 
                        id="sort" 
                        name="sort"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                        <option value="">Latest</option>
                        <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                        <option value="name_desc" {{ request('sort') === 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                        <option value="jobs_desc" {{ request('sort') === 'jobs_desc' ? 'selected' : '' }}>Most Jobs</option>
                        <option value="jobs_asc" {{ request('sort') === 'jobs_asc' ? 'selected' : '' }}>Least Jobs</option>
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <button 
                        type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition"
                    >
                        Search
                    </button>
                    <a 
                        href="{{ route('employer.all-employers') }}"
                        class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-4 rounded-lg text-center transition"
                    >
                        Clear
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Employers Grid -->
    @if($employers->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($employers as $employer)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden">
                    <div class="p-6">
                        <!-- Employer Header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-900">{{ $employer->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $employer->email }}</p>
                            </div>
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center flex-shrink-0 text-white font-bold text-lg shadow-md">
                                {{ strtoupper(substr($employer->name, 0, 1)) }}
                            </div>
                        </div>

                        <!-- Contact Info -->
                        <div class="mb-4 pb-4 border-b border-gray-200">
                            @if($employer->phone)
                                <p class="text-sm text-gray-600">
                                    <span class="font-medium">Phone:</span> {{ $employer->phone }}
                                </p>
                            @endif
                        </div>

                        <!-- Stats -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-3 text-center border border-blue-200">
                                <p class="text-2xl font-bold text-blue-600">{{ $employer->jobs_count }}</p>
                                <p class="text-xs text-gray-600 font-medium">Active Jobs</p>
                            </div>
                            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-3 text-center border border-green-200">
                                <p class="text-2xl font-bold text-green-600">{{ $employer->created_at->diffInMonths(now()) }}</p>
                                <p class="text-xs text-gray-600 font-medium">Months Active</p>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <a 
                            href="{{ route('jobs.index', ['employer' => $employer->id]) }}"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:shadow-lg text-white font-medium py-2 px-4 rounded-lg text-center transition-all duration-300"
                        >
                            <i class="fas fa-briefcase mr-2"></i>View Jobs
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $employers->links() }}
        </div>
    @else
        <div class="bg-white rounded-xl shadow-lg p-12 text-center border border-gray-100">
            <i class="fas fa-search text-gray-400 text-5xl mb-4 block"></i>
            <h3 class="text-xl font-bold text-gray-900 mb-2">No employers found</h3>
            <p class="text-gray-600 mb-4">Try adjusting your search criteria</p>
            <a 
                href="{{ route('employer.all-employers') }}"
                class="inline-block bg-gradient-to-r from-blue-600 to-blue-700 hover:shadow-lg text-white font-medium py-2 px-6 rounded-lg transition-all duration-300"
            >
                View All Employers
            </a>
        </div>
    @endif
</div>

<style>
@keyframes slide-right {
    0% { width: 0%; }
    100% { width: 100%; }
}
.animate-slide-right {
    animation: slide-right 5s ease-out forwards;
}
@keyframes slide-text {
    0% { left: 0%; opacity: 1; }
    95% { opacity: 1; }
    100% { left: 100%; opacity: 0; }
}
.animate-slide-text {
    animation: slide-text 5s ease-out forwards;
}
</style>
@endsection
