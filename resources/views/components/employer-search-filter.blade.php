<form method="GET" action="{{ route('employer.all-employers') }}" class="space-y-4" id="employer-search-form">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Search Input -->
        <div>
            <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-search text-blue-600 mr-2"></i>Search Employers
            </label>
            <input 
                type="text" 
                id="search" 
                name="search" 
                value="{{ request('search') }}"
                placeholder="Search by name or email..."
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
            >
        </div>

        <!-- Sort Dropdown -->
        <div>
            <label for="sort" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-sort text-blue-600 mr-2"></i>Sort By
            </label>
            <select 
                id="sort" 
                name="sort"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
            >
                <option value="">Latest</option>
                <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                <option value="name_desc" {{ request('sort') === 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                <option value="jobs_desc" {{ request('sort') === 'jobs_desc' ? 'selected' : '' }}>Most Jobs</option>
                <option value="jobs_asc" {{ request('sort') === 'jobs_asc' ? 'selected' : '' }}>Least Jobs</option>
            </select>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-end gap-2">
            <button 
                type="submit"
                class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-2.5 px-4 rounded-lg transition-all duration-300 shadow-md hover:shadow-lg"
            >
                <i class="fas fa-search mr-2"></i>Search
            </button>
            <button 
                type="reset"
                onclick="document.getElementById('employer-search-form').reset(); window.location.href='{{ route('employer.all-employers') }}'"
                class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2.5 px-4 rounded-lg transition-all duration-300"
            >
                <i class="fas fa-redo mr-2"></i>Clear
            </button>
        </div>
    </div>

    <!-- Active Filters Display -->
    @if(request('search') || request('sort'))
        <div class="pt-4 border-t border-gray-200">
            <div class="flex flex-wrap gap-2 items-center">
                <span class="text-sm text-gray-600 font-medium">Active filters:</span>
                @if(request('search'))
                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">
                        <i class="fas fa-search text-xs"></i>
                        {{ request('search') }}
                    </span>
                @endif
                @if(request('sort'))
                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">
                        <i class="fas fa-sort text-xs"></i>
                        {{ ucfirst(str_replace('_', ' ', request('sort'))) }}
                    </span>
                @endif
            </div>
        </div>
    @endif
</form>
