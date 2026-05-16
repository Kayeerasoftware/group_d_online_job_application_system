@extends('layouts.jobseeker')

@section('title', 'Browse Jobs')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Header Section -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
            <div class="flex items-center gap-2 md:gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-xl md:rounded-2xl blur-xl opacity-50"></div>
                    <div class="relative bg-gradient-to-br from-blue-600 to-cyan-600 p-2 md:p-4 rounded-xl md:rounded-2xl shadow-xl">
                        <i class="fas fa-search text-white text-xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-xl md:text-3xl font-bold bg-gradient-to-r from-blue-600 via-cyan-600 to-teal-600 bg-clip-text text-transparent mb-1 md:mb-2">Browse Jobs</h1>
                    <p class="text-gray-600 text-xs md:text-sm font-medium">Find your next opportunity</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Animated Separator Line -->
    <div class="relative h-2 bg-gray-200 rounded-full overflow-visible mb-4 md:mb-6">
        <div class="h-full bg-gradient-to-r from-green-500 to-green-600 rounded-full animate-slide-right"></div>
        <span class="absolute -top-6 text-2xl md:text-3xl text-green-600 font-bold animate-slide-text whitespace-nowrap z-10">Loading Jobs...</span>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-3 mb-3 md:mb-4">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-[8px] md:text-[10px] font-medium mb-0.5">Total Jobs</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $totalJobs ?? 248 }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-briefcase text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-[8px] md:text-[10px] font-medium mb-0.5">Remote Jobs</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $remoteJobs ?? 85 }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-globe text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-[8px] md:text-[10px] font-medium mb-0.5">New This Week</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $newJobs ?? 42 }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-star text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg p-2 md:p-3 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-[8px] md:text-[10px] font-medium mb-0.5">Saved Jobs</p>
                    <h3 class="text-base md:text-xl font-bold">{{ $savedCount ?? 12 }}</h3>
                </div>
                <div class="bg-white/20 p-1.5 md:p-2 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-bookmark text-sm md:text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filters -->
    <div class="bg-gradient-to-br from-blue-50 via-cyan-50 to-teal-50 rounded-2xl shadow-lg border border-blue-100 overflow-hidden mb-4">
        <form method="GET" action="{{ route('seeker.browse-jobs') }}" x-data="{ showAdvanced: false }">
            <div class="bg-white/60 backdrop-blur-sm p-3">
                <div class="bg-white/80 rounded-xl p-2.5 border border-blue-100">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-2">
                        <div class="md:col-span-4 relative">
                            <i class="fas fa-search absolute left-2.5 top-1/2 transform -translate-y-1/2 text-blue-400 text-xs"></i>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Job title, keywords..." class="w-full pl-8 pr-2 py-1.5 text-xs border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-white">
                        </div>
                        <div class="md:col-span-3 relative">
                            <i class="fas fa-map-marker-alt absolute left-2.5 top-1/2 transform -translate-y-1/2 text-cyan-400 text-xs"></i>
                            <input type="text" name="location" value="{{ request('location') }}" placeholder="Location..." class="w-full pl-8 pr-2 py-1.5 text-xs border border-cyan-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all bg-white">
                        </div>
                        <div class="md:col-span-2 relative">
                            <i class="fas fa-briefcase absolute left-2.5 top-1/2 transform -translate-y-1/2 text-teal-400 text-xs"></i>
                            <select name="category" class="w-full pl-8 pr-2 py-1.5 text-xs border border-teal-200 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all appearance-none bg-white">
                                <option value="">All Categories</option>
                                <option value="technology" {{ request('category') == 'technology' ? 'selected' : '' }}>Technology</option>
                                <option value="finance" {{ request('category') == 'finance' ? 'selected' : '' }}>Finance</option>
                                <option value="healthcare" {{ request('category') == 'healthcare' ? 'selected' : '' }}>Healthcare</option>
                                <option value="education" {{ request('category') == 'education' ? 'selected' : '' }}>Education</option>
                            </select>
                        </div>
                        <div class="md:col-span-3 flex gap-1.5">
                            <button type="submit" class="flex-1 px-2 py-1.5 text-xs bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold">
                                <i class="fas fa-search mr-1"></i>Search
                            </button>
                            <a href="{{ route('seeker.browse-jobs') }}" class="px-2 py-1.5 text-xs bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 rounded-lg hover:shadow-md transition-all duration-300 font-semibold">
                                <i class="fas fa-redo"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Advanced Filters Section -->
                    <div x-show="showAdvanced" x-collapse class="mt-2 pt-2 border-t border-blue-100">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                            <select name="job_type" class="w-full px-2 py-1.5 text-xs border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                                <option value="">All Job Types</option>
                                <option value="full-time" {{ request('job_type') == 'full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="part-time" {{ request('job_type') == 'part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="contract" {{ request('job_type') == 'contract' ? 'selected' : '' }}>Contract</option>
                                <option value="freelance" {{ request('job_type') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                            </select>
                            <select name="level" class="w-full px-2 py-1.5 text-xs border border-cyan-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent bg-white">
                                <option value="">All Levels</option>
                                <option value="entry" {{ request('level') == 'entry' ? 'selected' : '' }}>Entry Level</option>
                                <option value="mid" {{ request('level') == 'mid' ? 'selected' : '' }}>Mid Level</option>
                                <option value="senior" {{ request('level') == 'senior' ? 'selected' : '' }}>Senior</option>
                                <option value="executive" {{ request('level') == 'executive' ? 'selected' : '' }}>Executive</option>
                            </select>
                            <select name="work_arrangement" class="w-full px-2 py-1.5 text-xs border border-teal-200 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent bg-white">
                                <option value="">All Arrangements</option>
                                <option value="remote" {{ request('work_arrangement') == 'remote' ? 'selected' : '' }}>Remote</option>
                                <option value="on-site" {{ request('work_arrangement') == 'on-site' ? 'selected' : '' }}>On-site</option>
                                <option value="hybrid" {{ request('work_arrangement') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                            </select>
                            <select name="sort" class="w-full px-2 py-1.5 text-xs border border-purple-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Most Recent</option>
                                <option value="relevant" {{ request('sort') == 'relevant' ? 'selected' : '' }}>Most Relevant</option>
                                <option value="salary_high" {{ request('sort') == 'salary_high' ? 'selected' : '' }}>Salary: High to Low</option>
                                <option value="salary_low" {{ request('sort') == 'salary_low' ? 'selected' : '' }}>Salary: Low to High</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-2 flex justify-end">
                    <button type="button" @click="showAdvanced = !showAdvanced" class="text-xs font-semibold text-blue-600 hover:text-blue-800 transition flex items-center gap-1">
                        <i class="fas fa-sliders-h"></i>
                        <span x-text="showAdvanced ? 'Hide Advanced' : 'Show Advanced'"></span>
                        <i class="fas fa-chevron-down text-[8px] transition-transform" :class="showAdvanced ? 'rotate-180' : ''"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Results Count -->
    <div class="flex justify-between items-center mb-4">
        <p class="text-gray-600 font-semibold text-sm">Showing <span class="text-blue-600">1-12</span> of <span class="text-blue-600">{{ $totalJobs ?? 248 }}</span> jobs</p>
        <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
            <option>Most Recent</option>
            <option>Most Relevant</option>
            <option>Salary: High to Low</option>
            <option>Salary: Low to High</option>
        </select>
    </div>

    <!-- Job Listings -->
    <div class="space-y-4">
        <!-- Job Card -->
        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border-l-4 border-blue-600 p-6">
            <div class="flex flex-col md:flex-row gap-6">
                <div class="w-16 h-16 rounded-lg bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-code text-white text-2xl"></i>
                </div>
                <div class="flex-1">
                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-3">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-1">Senior React Developer</h3>
                            <p class="text-gray-600 font-semibold">Tech Innovations Inc.</p>
                        </div>
                        <button class="text-red-500 hover:text-red-700 transition text-xl">
                            <i class="fas fa-bookmark"></i>
                        </button>
                    </div>
                    <p class="text-gray-600 mb-4">We're looking for an experienced React developer to join our growing team. You'll work on cutting-edge projects and collaborate with talented engineers.</p>
                    <div class="flex flex-wrap gap-4 mb-4 text-sm text-gray-600">
                        <span><i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>San Francisco, CA</span>
                        <span><i class="fas fa-briefcase mr-2 text-blue-600"></i>Full-time</span>
                        <span><i class="fas fa-dollar-sign mr-2 text-blue-600"></i>$120k - $160k</span>
                        <span><i class="fas fa-clock mr-2 text-blue-600"></i>Posted 2 days ago</span>
                    </div>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">React</span>
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">JavaScript</span>
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">TypeScript</span>
                    </div>
                    <div class="flex gap-2">
                        <button class="px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg font-semibold hover:shadow-lg transition">
                            <i class="fas fa-paper-plane mr-2"></i>Apply Now
                        </button>
                        <button class="px-6 py-2 border border-blue-600 text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition">
                            <i class="fas fa-eye mr-2"></i>View Details
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Job Card -->
        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border-l-4 border-green-600 p-6">
            <div class="flex flex-col md:flex-row gap-6">
                <div class="w-16 h-16 rounded-lg bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-database text-white text-2xl"></i>
                </div>
                <div class="flex-1">
                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-3">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-1">Database Administrator</h3>
                            <p class="text-gray-600 font-semibold">Cloud Systems Ltd.</p>
                        </div>
                        <button class="text-red-500 hover:text-red-700 transition text-xl">
                            <i class="fas fa-bookmark"></i>
                        </button>
                    </div>
                    <p class="text-gray-600 mb-4">Manage and optimize our cloud database infrastructure. Work with a team of experienced DevOps engineers.</p>
                    <div class="flex flex-wrap gap-4 mb-4 text-sm text-gray-600">
                        <span><i class="fas fa-map-marker-alt mr-2 text-green-600"></i>New York, NY</span>
                        <span><i class="fas fa-briefcase mr-2 text-green-600"></i>Full-time</span>
                        <span><i class="fas fa-dollar-sign mr-2 text-green-600"></i>$100k - $140k</span>
                        <span><i class="fas fa-clock mr-2 text-green-600"></i>Posted 1 day ago</span>
                    </div>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">MySQL</span>
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">PostgreSQL</span>
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">AWS</span>
                    </div>
                    <div class="flex gap-2">
                        <button class="px-6 py-2 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg font-semibold hover:shadow-lg transition">
                            <i class="fas fa-paper-plane mr-2"></i>Apply Now
                        </button>
                        <button class="px-6 py-2 border border-green-600 text-green-600 rounded-lg font-semibold hover:bg-green-50 transition">
                            <i class="fas fa-eye mr-2"></i>View Details
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Job Card -->
        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border-l-4 border-purple-600 p-6">
            <div class="flex flex-col md:flex-row gap-6">
                <div class="w-16 h-16 rounded-lg bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-mobile-alt text-white text-2xl"></i>
                </div>
                <div class="flex-1">
                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-3">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-1">Mobile App Developer</h3>
                            <p class="text-gray-600 font-semibold">StartUp Ventures</p>
                        </div>
                        <button class="text-red-500 hover:text-red-700 transition text-xl">
                            <i class="fas fa-bookmark"></i>
                        </button>
                    </div>
                    <p class="text-gray-600 mb-4">Build innovative mobile applications for iOS and Android. Join a fast-growing startup with great culture.</p>
                    <div class="flex flex-wrap gap-4 mb-4 text-sm text-gray-600">
                        <span><i class="fas fa-map-marker-alt mr-2 text-purple-600"></i>Remote</span>
                        <span><i class="fas fa-briefcase mr-2 text-purple-600"></i>Contract</span>
                        <span><i class="fas fa-dollar-sign mr-2 text-purple-600"></i>$80k - $120k</span>
                        <span><i class="fas fa-clock mr-2 text-purple-600"></i>Posted 3 days ago</span>
                    </div>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">Swift</span>
                        <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">Kotlin</span>
                        <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">Flutter</span>
                    </div>
                    <div class="flex gap-2">
                        <button class="px-6 py-2 bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-lg font-semibold hover:shadow-lg transition">
                            <i class="fas fa-paper-plane mr-2"></i>Apply Now
                        </button>
                        <button class="px-6 py-2 border border-purple-600 text-purple-600 rounded-lg font-semibold hover:bg-purple-50 transition">
                            <i class="fas fa-eye mr-2"></i>View Details
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center items-center gap-2 mt-6">
        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Previous</button>
        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg">1</button>
        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">2</button>
        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">3</button>
        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">...</button>
        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">20</button>
        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Next</button>
    </div>
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
