@extends('layouts.jobseeker')

@section('title', 'Saved Jobs')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-lg shadow-lg p-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Saved Jobs</h1>
                <p class="text-purple-100">Your bookmarked job opportunities</p>
            </div>
            <div class="text-white text-center">
                <p class="text-4xl font-bold">18</p>
                <p class="text-purple-100">Total Saved</p>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex flex-col md:flex-row gap-4 items-center">
            <div class="flex-1">
                <input type="text" placeholder="Search saved jobs..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
            </div>
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                <option>All Categories</option>
                <option>Technology</option>
                <option>Finance</option>
                <option>Healthcare</option>
                <option>Education</option>
            </select>
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                <option>All Locations</option>
                <option>Remote</option>
                <option>On-site</option>
                <option>Hybrid</option>
            </select>
        </div>
    </div>

    <!-- Saved Jobs Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Job Card -->
        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition border-t-4 border-blue-500">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-code text-white text-lg"></i>
                </div>
                <button class="text-red-500 hover:text-red-700 transition">
                    <i class="fas fa-bookmark text-lg"></i>
                </button>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Senior React Developer</h3>
            <p class="text-gray-600 mb-3">Tech Innovations Inc.</p>
            <div class="space-y-2 mb-4 text-sm text-gray-600">
                <p><i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>San Francisco, CA</p>
                <p><i class="fas fa-briefcase mr-2 text-blue-600"></i>Full-time</p>
                <p><i class="fas fa-dollar-sign mr-2 text-blue-600"></i>$120k - $160k</p>
            </div>
            <div class="flex gap-2">
                <button class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                    <i class="fas fa-paper-plane mr-2"></i>Apply
                </button>
                <button class="flex-1 px-4 py-2 border border-blue-600 text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition">
                    <i class="fas fa-eye mr-2"></i>View
                </button>
            </div>
        </div>

        <!-- Job Card -->
        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition border-t-4 border-green-500">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-database text-white text-lg"></i>
                </div>
                <button class="text-red-500 hover:text-red-700 transition">
                    <i class="fas fa-bookmark text-lg"></i>
                </button>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Database Administrator</h3>
            <p class="text-gray-600 mb-3">Cloud Systems Ltd.</p>
            <div class="space-y-2 mb-4 text-sm text-gray-600">
                <p><i class="fas fa-map-marker-alt mr-2 text-green-600"></i>New York, NY</p>
                <p><i class="fas fa-briefcase mr-2 text-green-600"></i>Full-time</p>
                <p><i class="fas fa-dollar-sign mr-2 text-green-600"></i>$100k - $140k</p>
            </div>
            <div class="flex gap-2">
                <button class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition">
                    <i class="fas fa-paper-plane mr-2"></i>Apply
                </button>
                <button class="flex-1 px-4 py-2 border border-green-600 text-green-600 rounded-lg font-semibold hover:bg-green-50 transition">
                    <i class="fas fa-eye mr-2"></i>View
                </button>
            </div>
        </div>

        <!-- Job Card -->
        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition border-t-4 border-purple-500">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-mobile-alt text-white text-lg"></i>
                </div>
                <button class="text-red-500 hover:text-red-700 transition">
                    <i class="fas fa-bookmark text-lg"></i>
                </button>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Mobile App Developer</h3>
            <p class="text-gray-600 mb-3">StartUp Ventures</p>
            <div class="space-y-2 mb-4 text-sm text-gray-600">
                <p><i class="fas fa-map-marker-alt mr-2 text-purple-600"></i>Remote</p>
                <p><i class="fas fa-briefcase mr-2 text-purple-600"></i>Contract</p>
                <p><i class="fas fa-dollar-sign mr-2 text-purple-600"></i>$80k - $120k</p>
            </div>
            <div class="flex gap-2">
                <button class="flex-1 px-4 py-2 bg-purple-600 text-white rounded-lg font-semibold hover:bg-purple-700 transition">
                    <i class="fas fa-paper-plane mr-2"></i>Apply
                </button>
                <button class="flex-1 px-4 py-2 border border-purple-600 text-purple-600 rounded-lg font-semibold hover:bg-purple-50 transition">
                    <i class="fas fa-eye mr-2"></i>View
                </button>
            </div>
        </div>

        <!-- Job Card -->
        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition border-t-4 border-orange-500">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-chart-line text-white text-lg"></i>
                </div>
                <button class="text-red-500 hover:text-red-700 transition">
                    <i class="fas fa-bookmark text-lg"></i>
                </button>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Data Analyst</h3>
            <p class="text-gray-600 mb-3">Analytics Pro Inc.</p>
            <div class="space-y-2 mb-4 text-sm text-gray-600">
                <p><i class="fas fa-map-marker-alt mr-2 text-orange-600"></i>Chicago, IL</p>
                <p><i class="fas fa-briefcase mr-2 text-orange-600"></i>Full-time</p>
                <p><i class="fas fa-dollar-sign mr-2 text-orange-600"></i>$90k - $130k</p>
            </div>
            <div class="flex gap-2">
                <button class="flex-1 px-4 py-2 bg-orange-600 text-white rounded-lg font-semibold hover:bg-orange-700 transition">
                    <i class="fas fa-paper-plane mr-2"></i>Apply
                </button>
                <button class="flex-1 px-4 py-2 border border-orange-600 text-orange-600 rounded-lg font-semibold hover:bg-orange-50 transition">
                    <i class="fas fa-eye mr-2"></i>View
                </button>
            </div>
        </div>

        <!-- Job Card -->
        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition border-t-4 border-red-500">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-red-400 to-red-600 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-shield-alt text-white text-lg"></i>
                </div>
                <button class="text-red-500 hover:text-red-700 transition">
                    <i class="fas fa-bookmark text-lg"></i>
                </button>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Security Engineer</h3>
            <p class="text-gray-600 mb-3">CyberSec Solutions</p>
            <div class="space-y-2 mb-4 text-sm text-gray-600">
                <p><i class="fas fa-map-marker-alt mr-2 text-red-600"></i>Boston, MA</p>
                <p><i class="fas fa-briefcase mr-2 text-red-600"></i>Full-time</p>
                <p><i class="fas fa-dollar-sign mr-2 text-red-600"></i>$110k - $150k</p>
            </div>
            <div class="flex gap-2">
                <button class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition">
                    <i class="fas fa-paper-plane mr-2"></i>Apply
                </button>
                <button class="flex-1 px-4 py-2 border border-red-600 text-red-600 rounded-lg font-semibold hover:bg-red-50 transition">
                    <i class="fas fa-eye mr-2"></i>View
                </button>
            </div>
        </div>

        <!-- Job Card -->
        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition border-t-4 border-indigo-500">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-indigo-400 to-indigo-600 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-graduation-cap text-white text-lg"></i>
                </div>
                <button class="text-red-500 hover:text-red-700 transition">
                    <i class="fas fa-bookmark text-lg"></i>
                </button>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Technical Trainer</h3>
            <p class="text-gray-600 mb-3">Education Plus</p>
            <div class="space-y-2 mb-4 text-sm text-gray-600">
                <p><i class="fas fa-map-marker-alt mr-2 text-indigo-600"></i>Seattle, WA</p>
                <p><i class="fas fa-briefcase mr-2 text-indigo-600"></i>Full-time</p>
                <p><i class="fas fa-dollar-sign mr-2 text-indigo-600"></i>$75k - $110k</p>
            </div>
            <div class="flex gap-2">
                <button class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition">
                    <i class="fas fa-paper-plane mr-2"></i>Apply
                </button>
                <button class="flex-1 px-4 py-2 border border-indigo-600 text-indigo-600 rounded-lg font-semibold hover:bg-indigo-50 transition">
                    <i class="fas fa-eye mr-2"></i>View
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
