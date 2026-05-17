<div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 overflow-hidden group">
    <div class="p-6">
        <!-- Employer Header -->
        <div class="flex items-start justify-between mb-4">
            <div class="flex-1">
                <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition">{{ $employer->name }}</h3>
                <p class="text-sm text-gray-600">{{ $employer->email }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center flex-shrink-0 text-white font-bold text-lg shadow-md group-hover:shadow-lg transition">
                {{ strtoupper(substr($employer->name, 0, 1)) }}
            </div>
        </div>

        <!-- Contact Info -->
        @if($employer->phone)
            <div class="mb-4 pb-4 border-b border-gray-200">
                <p class="text-sm text-gray-600">
                    <i class="fas fa-phone text-blue-600 mr-2"></i>
                    <span class="font-medium">{{ $employer->phone }}</span>
                </p>
            </div>
        @endif

        <!-- Stats -->
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-3 text-center border border-blue-200 hover:border-blue-300 transition">
                <p class="text-2xl font-bold text-blue-600">{{ $employer->jobs_count ?? 0 }}</p>
                <p class="text-xs text-gray-600 font-medium">Active Jobs</p>
            </div>
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-3 text-center border border-green-200 hover:border-green-300 transition">
                <p class="text-sm font-bold text-green-600">{{ $employer->created_at->format('M d, Y') }}</p>
                <p class="text-xs text-gray-600 font-medium">Joined</p>
            </div>
        </div>

        <!-- Action Button -->
        <a 
            href="{{ route('jobs.index', ['employer' => $employer->id]) }}"
            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 hover:shadow-lg text-white font-medium py-2 px-4 rounded-lg text-center transition-all duration-300 inline-flex items-center justify-center gap-2"
        >
            <i class="fas fa-briefcase"></i>View Jobs
        </a>
    </div>
</div>
