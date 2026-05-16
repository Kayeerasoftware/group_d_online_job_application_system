@extends('layouts.jobseeker')

@section('title', 'My Applications')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg shadow-lg p-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">My Applications</h1>
                <p class="text-blue-100">Track and manage all your job applications</p>
            </div>
            <a href="#browse" class="px-6 py-3 bg-white text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition">
                <i class="fas fa-plus mr-2"></i>New Application
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 md:gap-4">
        <div class="bg-white rounded-lg shadow-md p-4 text-center hover:shadow-lg transition">
            <p class="text-gray-600 text-sm font-semibold mb-2">Total</p>
            <p class="text-3xl font-bold text-blue-600">24</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 text-center hover:shadow-lg transition">
            <p class="text-gray-600 text-sm font-semibold mb-2">Pending</p>
            <p class="text-3xl font-bold text-yellow-600">8</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 text-center hover:shadow-lg transition">
            <p class="text-gray-600 text-sm font-semibold mb-2">Shortlisted</p>
            <p class="text-3xl font-bold text-green-600">5</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 text-center hover:shadow-lg transition">
            <p class="text-gray-600 text-sm font-semibold mb-2">Rejected</p>
            <p class="text-3xl font-bold text-red-600">11</p>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex flex-col md:flex-row gap-4 items-center">
            <div class="flex-1">
                <input type="text" placeholder="Search applications..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option>All Status</option>
                <option>Pending</option>
                <option>Shortlisted</option>
                <option>Rejected</option>
                <option>Accepted</option>
            </select>
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option>All Dates</option>
                <option>Last 7 days</option>
                <option>Last 30 days</option>
                <option>Last 90 days</option>
            </select>
        </div>
    </div>

    <!-- Applications List -->
    <div class="space-y-4">
        <!-- Application Card -->
        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div class="flex-1">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="w-16 h-16 rounded-lg bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-building text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Senior Laravel Developer</h3>
                            <p class="text-gray-600">Tech Solutions Inc.</p>
                            <p class="text-sm text-gray-500">Applied on Dec 15, 2024</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col items-end gap-2 w-full md:w-auto">
                    <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-semibold">Shortlisted</span>
                    <a href="#" class="text-blue-600 font-semibold hover:underline text-sm">View Details →</a>
                </div>
            </div>
        </div>

        <!-- Application Card -->
        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div class="flex-1">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="w-16 h-16 rounded-lg bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-building text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Full Stack Developer</h3>
                            <p class="text-gray-600">Digital Innovations Ltd.</p>
                            <p class="text-sm text-gray-500">Applied on Dec 10, 2024</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col items-end gap-2 w-full md:w-auto">
                    <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">Pending Review</span>
                    <a href="#" class="text-blue-600 font-semibold hover:underline text-sm">View Details →</a>
                </div>
            </div>
        </div>

        <!-- Application Card -->
        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div class="flex-1">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="w-16 h-16 rounded-lg bg-gradient-to-br from-red-400 to-red-600 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-building text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Backend Developer</h3>
                            <p class="text-gray-600">Enterprise Systems Co.</p>
                            <p class="text-sm text-gray-500">Applied on Dec 5, 2024</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col items-end gap-2 w-full md:w-auto">
                    <span class="px-4 py-2 bg-red-100 text-red-800 rounded-full text-sm font-semibold">Rejected</span>
                    <a href="#" class="text-blue-600 font-semibold hover:underline text-sm">View Details →</a>
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
        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Next</button>
    </div>
</div>
@endsection
