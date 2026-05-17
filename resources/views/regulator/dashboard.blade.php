@extends('layouts.regulator')

@section('title', 'Regulator Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Regulator Dashboard</h1>
        <p class="text-gray-600 mt-2">System compliance monitoring and oversight</p>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Users Card -->
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl shadow-lg p-6 border border-blue-200 hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Users</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalUsers }}</p>
                </div>
                <div class="bg-blue-500 rounded-full p-4 shadow-lg">
                    <i class="fas fa-users text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Jobs Card -->
        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl shadow-lg p-6 border border-green-200 hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Jobs</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalJobs }}</p>
                </div>
                <div class="bg-green-500 rounded-full p-4 shadow-lg">
                    <i class="fas fa-briefcase text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Applications Card -->
        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl shadow-lg p-6 border border-purple-200 hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Applications</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalApplications }}</p>
                </div>
                <div class="bg-purple-500 rounded-full p-4 shadow-lg">
                    <i class="fas fa-file-alt text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Compliance Reports Card -->
        <div class="bg-gradient-to-br from-amber-50 to-orange-100 rounded-xl shadow-lg p-6 border border-amber-200 hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Compliance Reports</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalReports }}</p>
                </div>
                <div class="bg-amber-500 rounded-full p-4 shadow-lg">
                    <i class="fas fa-chart-bar text-white text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Status Overview -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Report Status Card -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                <i class="fas fa-chart-pie text-amber-500"></i>
                Report Status
            </h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center p-3 bg-yellow-50 rounded-lg border border-yellow-200">
                    <span class="text-gray-700 font-medium">Pending</span>
                    <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-bold">{{ $pendingReports }}</span>
                </div>
                <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg border border-green-200">
                    <span class="text-gray-700 font-medium">Submitted</span>
                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-bold">{{ $submittedReports }}</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions Card -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                <i class="fas fa-lightning-bolt text-blue-500"></i>
                Quick Actions
            </h3>
            <div class="space-y-2">
                <a href="{{ route('regulator.compliance.index') }}" class="block w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-medium py-2 px-4 rounded-lg text-center transition shadow-md hover:shadow-lg">
                    <i class="fas fa-file-alt mr-2"></i>View Compliance
                </a>
                <a href="{{ route('regulator.audit-logs') }}" class="block w-full bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white font-medium py-2 px-4 rounded-lg text-center transition shadow-md hover:shadow-lg">
                    <i class="fas fa-history mr-2"></i>View Audit Logs
                </a>
            </div>
        </div>

        <!-- System Monitoring Card -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                <i class="fas fa-heartbeat text-red-500"></i>
                System Monitoring
            </h3>
            <a href="{{ route('regulator.system-monitoring') }}" class="block w-full bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white font-medium py-3 px-4 rounded-lg text-center transition shadow-md hover:shadow-lg">
                <i class="fas fa-chart-line mr-2"></i>View System Status
            </a>
        </div>
    </div>

    <!-- Recent Audit Logs -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition">
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-amber-50 to-orange-50">
            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                <i class="fas fa-history text-amber-500"></i>
                Recent Activity
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Action</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Timestamp</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($recentAuditLogs as $log)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $log->action }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $log->user->name ?? 'System' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $log->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                <i class="fas fa-inbox text-2xl mb-2 block opacity-50"></i>
                                No recent activity
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
