@extends('layouts.jobseeker')

@section('title', 'Browse Jobs')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-cyan-600 rounded-lg shadow-lg p-6">
        <h1 class="text-3xl font-bold text-white mb-2">Browse Jobs</h1>
        <p class="text-blue-100">Find your next opportunity</p>
    </div>

    <!-- Search & Filters -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
            <input type="text" placeholder="Job title, keywords..." class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <input type="text" placeholder="Location..." class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option>All Categories</option>
                <option>Technology</option>
                <option>Finance</option>
                <option>Healthcare</option>
                <option>Education</option>
            </select>
            <button class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                <i class="fas fa-search mr-2"></i>Search
            </button>
        </div>

        <!-- Advanced Filters -->
        <div class="flex flex-wrap gap-2">
            <select class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option>All Job Types</option>
                <option>Full-time</option>
                <option>Part-time</option>
                <option>Contract</option>
                <option>Freelance</option>
            </select>
            <select class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option>All Levels</option>
                <option>Entry Level</option>
                <option>Mid Level</option>
                <option>Senior</option>
                <option>Executive</option>
            </select>
            <select class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option>All Salary Ranges</option>
                <option>$0 - $50k</option>
                <option>$50k - $100k</option>
                <option>$100k - $150k</option>
                <option>$150k+</option>
            </select>
            <select class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option>All Work Arrangements</option>
                <option>Remote</option>
                <option>On-site</option>
                <option>Hybrid</option>
            </select>
        </div>
    </div>

    <!-- Results Count -->
    <div class="flex justify-between items-center">
        <p class="text-gray-600 font-semibold">Showing <span class="text-blue-600">1-12</span> of <span class="text-blue-600">248</span> jobs</p>
        <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option>Most Recent</option>
            <option>Most Relevant</option>
            <option>Salary: High to Low</option>
            <option>Salary: Low to High</option>
        </select>
    </div>

    <!-- Job Listings -->
    <div class="space-y-4">
        <!-- Job Card -->
        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition border-l-4 border-blue-600">
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
                        <button class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
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
        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition border-l-4 border-green-600">
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
                        <button class="px-6 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition">
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
        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition border-l-4 border-purple-600">
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
                        <button class="px-6 py-2 bg-purple-600 text-white rounded-lg font-semibold hover:bg-purple-700 transition">
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
    <div class="flex justify-center items-center gap-2">
        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Previous</button>
        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg">1</button>
        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">2</button>
        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">3</button>
        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">...</button>
        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">20</button>
        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Next</button>
    </div>
</div>
@endsection
