<div class="bg-white rounded-xl shadow-lg p-12 text-center border border-gray-100">
    <div class="mb-6">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full mb-4">
            <i class="fas fa-search text-gray-400 text-4xl"></i>
        </div>
    </div>
    <h3 class="text-2xl font-bold text-gray-900 mb-2">No employers found</h3>
    <p class="text-gray-600 mb-6 max-w-md mx-auto">
        @if(request('search') || request('sort'))
            We couldn't find any employers matching your search criteria. Try adjusting your filters.
        @else
            No employers are currently available. Please check back later.
        @endif
    </p>
    <div class="flex flex-col sm:flex-row gap-3 justify-center">
        <a 
            href="{{ route('employer.all-employers') }}"
            class="inline-block bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 hover:shadow-lg text-white font-semibold py-2.5 px-6 rounded-lg transition-all duration-300"
        >
            <i class="fas fa-redo mr-2"></i>Clear Filters
        </a>
        <a 
            href="{{ route('employer.dashboard') }}"
            class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2.5 px-6 rounded-lg transition-all duration-300"
        >
            <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
        </a>
    </div>
</div>
