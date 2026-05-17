@extends('layouts.regulator')

@section('title', 'System Monitoring')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">System Monitoring</h1>
        <p class="text-gray-600 mt-2">Real-time system health and performance metrics</p>
    </div>

    <!-- User Statistics -->
    <div>
        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
            <i class="fas fa-users text-amber-500"></i>
            User Statistics
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl shadow-lg p-4 border border-gray-200 hover:shadow-xl transition">
                <p class="text-gray-600 text-sm font-medium">Total Users</p>
                <p class="text-2xl font-bold text-gray-900 mt-2">{{ $userStats['total'] }}</p>
            </div>
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl shadow-lg p-4 border border-blue-200 hover:shadow-xl transition">
                <p class="text-gray-600 text-sm font-medium">Job Seekers</p>
                <p class="text-2xl font-bold text-blue-600 mt-2">{{ $userStats['seekers'] }}</p>
            </div>
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl shadow-lg p-4 border border-green-200 hover:shadow-xl transition">
                <p class="text-gray-600 text-sm font-medium">Employers</p>
                <p class="text-2xl font-bold text-green-600 mt-2">{{ $userStats['employers'] }}</p>
            </div>
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl shadow-lg p-4 border border-purple-200 hover:shadow-xl transition">
                <p class="text-gray-600 text-sm font-medium">Admins</p>
                <p class="text-2xl font-bold text-purple-600 mt-2">{{ $userStats['admins'] }}</p>
            </div>
            <div class="bg-gradient-to-br from-amber-50 to-orange-100 rounded-xl shadow-lg p-4 border border-amber-200 hover:shadow-xl transition">
                <p class="text-gray-600 text-sm font-medium">Regulators</p>
                <p class="text-2xl font-bold text-amber-600 mt-2">{{ $userStats['regulators'] }}</p>
            </div>
        </div>
    </div>

    <!-- Job Statistics -->
    <div>
        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
            <i class="fas fa-briefcase text-green-500"></i>
            Job Statistics
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl shadow-lg p-4 border border-gray-200 hover:shadow-xl transition">
                <p class="text-gray-600 text-sm font-medium">Total Jobs</p>
                <p class="text-2xl font-bold text-gray-900 mt-2">{{ $jobStats['total'] }}</p>
            </div>
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl shadow-lg p-4 border border-green-200 hover:shadow-xl transition">
                <p class="text-gray-600 text-sm font-medium">Active</p>
                <p class="text-2xl font-bold text-green-600 mt-2">{{ $jobStats['active'] }}</p>
            </div>
            <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-xl shadow-lg p-4 border border-red-200 hover:shadow-xl transition">
                <p class="text-gray-600 text-sm font-medium">Closed</p>
                <p class="text-2xl font-bold text-red-600 mt-2">{{ $jobStats['closed'] }}</p>
            </div>
            <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl shadow-lg p-4 border border-gray-200 hover:shadow-xl transition">
                <p class="text-gray-600 text-sm font-medium">Draft</p>
                <p class="text-2xl font-bold text-gray-600 mt-2">{{ $jobStats['draft'] }}</p>
            </div>
        </div>
    </div>

    <!-- Application Statistics -->
    <div>
        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
            <i class="fas fa-file-alt text-purple-500"></i>
            Application Statistics
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl shadow-lg p-4 border border-gray-200 hover:shadow-xl transition">
                <p class="text-gray-600 text-sm font-medium">Total Applications</p>
                <p class="text-2xl font-bold text-gray-900 mt-2">{{ $applicationStats['total'] }}</p>
            </div>
            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl shadow-lg p-4 border border-yellow-200 hover:shadow-xl transition">
                <p class="text-gray-600 text-sm font-medium">Pending</p>
                <p class="text-2xl font-bold text-yellow-600 mt-2">{{ $applicationStats['pending'] }}</p>
            </div>
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl shadow-lg p-4 border border-green-200 hover:shadow-xl transition">
                <p class="text-gray-600 text-sm font-medium">Accepted</p>
                <p class="text-2xl font-bold text-green-600 mt-2">{{ $applicationStats['accepted'] }}</p>
            </div>
            <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-xl shadow-lg p-4 border border-red-200 hover:shadow-xl transition">
                <p class="text-gray-600 text-sm font-medium">Rejected</p>
                <p class="text-2xl font-bold text-red-600 mt-2">{{ $applicationStats['rejected'] }}</p>
            </div>
        </div>
    </div>

    <!-- Recent Users -->
    <div>
        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
            <i class="fas fa-user-clock text-blue-500"></i>
            Recent Users
        </h2>
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Joined</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($recentUsers as $user)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-2 py-1 rounded-lg text-xs font-bold bg-blue-100 text-blue-800">
                                        {{ ucfirst($user->role->value) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $user->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    <i class="fas fa-inbox text-2xl mb-2 block opacity-50"></i>
                                    No users found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Jobs -->
    <div>
        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
            <i class="fas fa-briefcase text-green-500"></i>
            Recent Jobs
        </h2>
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Employer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Posted</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($recentJobs as $job)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $job->title }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $job->employer->company_name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-2 py-1 rounded-lg text-xs font-bold
                                        @if($job->status->value === 'active') bg-green-100 text-green-800
                                        @elseif($job->status->value === 'closed') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst($job->status->value) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $job->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    <i class="fas fa-inbox text-2xl mb-2 block opacity-50"></i>
                                    No jobs found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
