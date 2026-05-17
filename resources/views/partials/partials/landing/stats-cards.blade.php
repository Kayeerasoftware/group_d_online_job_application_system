<!-- Stats Cards Section - 8 cards responsive to full page -->
<div class="mb-4 p-2 pt-0">
    <!-- System Title Above Header Card -->
    <div class="mb-0 pt-0 -mt-8 flex items-center justify-between">
        <h1 class="text-lg md:text-xl lg:text-2xl font-bold text-center flex-1 py-0"><span class="text-blue-600">Mak-JobLink</span> <span class="text-gray-400"><-></span> <span class="text-green-600">Online   Job   Application   System</span> <span class="text-gray-400"><-></span> <span class="text-purple-600">For   A   Better   Uganda</span></h1>
        <div class="flex gap-2 flex-shrink-0">
            <a href="{{ route('login') }}" class="px-3 py-1 text-xs font-semibold text-white bg-blue-600 rounded hover:bg-blue-700">Login</a>
            <a href="#welcome-card" onclick="document.getElementById('welcome-card')?.scrollIntoView({behavior: 'smooth', block: 'start'}); return false;" class="px-3 py-1 text-xs font-semibold text-white bg-green-600 rounded hover:bg-green-700">Browse Jobs</a>
        </div>
    </div>

    <!-- Welcome Header Card -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg shadow-lg p-2 md:p-3 mb-2 md:mb-3 mt-0">
        <div class="flex items-center justify-center gap-4">
            <!-- Logo (Left) -->
            <div class="flex-shrink-0">
                <img
                    src="{{ asset(rawurlencode('MAK-JOBLINK log.png')) }}"
                    alt="MAK-JOBLINK"
                    class="h-14 w-auto md:h-16 lg:h-[4.25rem] object-contain"
                    loading="eager"
                >
            </div>

            <!-- Welcome Message (Center) -->
            <div class="flex-1 text-center">
                @if(auth()->check())
                    <h1 class="text-sm sm:text-lg md:text-2xl font-bold text-white">Welcome, <span class="text-blue-200 text-base sm:text-xl md:text-3xl">{{ auth()->user()->name }}</span> 👋</h1>
                    <p class="text-blue-100 text-xs sm:text-sm mt-0.5 md:mt-1">Explore opportunities and manage your career journey</p>
                @else
                    <h1 class="text-sm sm:text-lg md:text-2xl font-bold text-white">Welcome to <span class="text-blue-200 text-base sm:text-xl md:text-3xl">Job Portal</span> 👋</h1>
                    <p class="text-blue-100 text-xs sm:text-sm mt-0.5 md:mt-1">Discover amazing job opportunities and start your career journey</p>
                @endif
            </div>

            <!-- Date & Time Section -->
            <div class="bg-white/20 backdrop-blur-sm rounded-lg px-2 py-1 sm:px-3 sm:py-1.5 md:px-4 md:py-2 text-right flex-shrink-0">
                <p class="text-white text-xs sm:text-sm font-semibold whitespace-nowrap">{{ now()->format('l, F d, Y') }}</p>
                <p class="text-blue-100 text-xs mt-0.5 whitespace-nowrap">{{ now()->format('h:i A') }}</p>
            </div>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-2 md:mb-3">
        <div class="h-full bg-gradient-to-r from-green-500 to-green-600 rounded-full loading-bar"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-green-600 font-bold loading-text whitespace-nowrap z-10">Loading Dashboard data...</span>
    </div>

    <style>
    @keyframes loadingBar {
        0% { width: 0%; }
        100% { width: 100%; }
    }

    @keyframes loadingText {
        0% { left: 0%; opacity: 1; }
        95% { opacity: 1; }
        100% { left: 100%; opacity: 0; }
    }

    .loading-bar {
        animation: loadingBar 5s ease-out forwards;
        width: 0%;
    }

    .loading-text {
        animation: loadingText 5s ease-out forwards;
        position: relative;
    }
    </style>

    <!-- 8 Stats Cards -->
    <div class="flex gap-2 w-full">
        <!-- Total Jobs Card -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300 flex-1">
            <div class="flex flex-col">
                <div class="flex items-center mb-2">
                    <i class="fas fa-briefcase text-xs mr-1"></i>
                    <h3 class="text-xs md:text-sm lg:text-base font-bold leading-tight whitespace-nowrap overflow-hidden text-ellipsis">Total Jobs</h3>
                </div>
                <div class="text-center">
                    <p class="text-lg md:text-xl lg:text-2xl font-bold">{{ number_format($totalJobs) }}</p>
                </div>
            </div>
        </div>

        <!-- Open Jobs Card -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300 flex-1">
            <div class="flex flex-col">
                <div class="flex items-center mb-2">
                    <i class="fas fa-door-open text-xs mr-1"></i>
                    <h3 class="text-xs md:text-sm lg:text-base font-bold leading-tight whitespace-nowrap overflow-hidden text-ellipsis">Open Jobs</h3>
                </div>
                <div class="text-center">
                    <p class="text-lg md:text-xl lg:text-2xl font-bold">{{ number_format($openJobs) }}</p>
                </div>
            </div>
        </div>

        <!-- Applications Card -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300 flex-1">
            <div class="flex flex-col">
                <div class="flex items-center mb-2">
                    <i class="fas fa-file-alt text-xs mr-1"></i>
                    <h3 class="text-xs md:text-sm lg:text-base font-bold leading-tight whitespace-nowrap overflow-hidden text-ellipsis">Applications</h3>
                </div>
                <div class="text-center">
                    <p class="text-lg md:text-xl lg:text-2xl font-bold">{{ number_format($applications) }}</p>
                </div>
            </div>
        </div>

        <!-- Employers Card -->
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300 flex-1">
            <div class="flex flex-col">
                <div class="flex items-center mb-2">
                    <i class="fas fa-building text-xs mr-1"></i>
                    <h3 class="text-xs md:text-sm lg:text-base font-bold leading-tight whitespace-nowrap overflow-hidden text-ellipsis">Employers</h3>
                </div>
                <div class="text-center">
                    <p class="text-lg md:text-xl lg:text-2xl font-bold">{{ number_format($employers) }}</p>
                </div>
            </div>
        </div>

        <!-- Job Seekers Card -->
        <div class="bg-gradient-to-br from-teal-500 to-teal-600 rounded-lg p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300 flex-1">
            <div class="flex flex-col">
                <div class="flex items-center mb-2">
                    <i class="fas fa-users text-xs mr-1"></i>
                    <h3 class="text-xs md:text-sm lg:text-base font-bold leading-tight whitespace-nowrap overflow-hidden text-ellipsis">Job Seekers</h3>
                </div>
                <div class="text-center">
                    <p class="text-lg md:text-xl lg:text-2xl font-bold">{{ number_format($seekers) }}</p>
                </div>
            </div>
        </div>

        <!-- Saved Jobs Card -->
        <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-lg p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300 flex-1">
            <div class="flex flex-col">
                <div class="flex items-center mb-2">
                    <i class="fas fa-bookmark text-xs mr-1"></i>
                    <h3 class="text-xs md:text-sm lg:text-base font-bold leading-tight whitespace-nowrap overflow-hidden text-ellipsis">Saved Jobs</h3>
                </div>
                <div class="text-center">
                    <p class="text-lg md:text-xl lg:text-2xl font-bold">{{ number_format($savedJobs) }}</p>
                </div>
            </div>
        </div>

        <!-- Active Users Card -->
        <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300 flex-1">
            <div class="flex flex-col">
                <div class="flex items-center mb-2">
                    <i class="fas fa-user-check text-xs mr-1"></i>
                    <h3 class="text-xs md:text-sm lg:text-base font-bold leading-tight whitespace-nowrap overflow-hidden text-ellipsis">Active Users</h3>
                </div>
                <div class="text-center">
                    <p class="text-lg md:text-xl lg:text-2xl font-bold">{{ number_format($activeUsers) }}</p>
                </div>
            </div>
        </div>

        <!-- New This Week Card -->
        <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-lg p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300 flex-1">
            <div class="flex flex-col">
                <div class="flex items-center mb-2">
                    <i class="fas fa-star text-xs mr-1"></i>
                    <h3 class="text-xs md:text-sm lg:text-base font-bold leading-tight whitespace-nowrap overflow-hidden text-ellipsis">New This Week</h3>
                </div>
                <div class="text-center">
                    <p class="text-lg md:text-xl lg:text-2xl font-bold">{{ number_format($newJobsThisWeek) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
