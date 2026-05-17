@extends('layouts.admin')

@section('title', 'System Health & Settings')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">System Health & Settings</h1>
        <p class="text-gray-600">Monitor system status, integrations, and configuration settings</p>
    </div>

    <!-- System Status Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Database</p>
                    <p class="text-2xl font-bold text-gray-900 mt-2">
                        @if($health['database_healthy'])
                            <span class="text-green-600">Connected</span>
                        @else
                            <span class="text-red-600">Offline</span>
                        @endif
                    </p>
                </div>
                <i class="fas fa-database text-3xl {{ $health['database_healthy'] ? 'text-green-500' : 'text-red-500' }}"></i>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Storage</p>
                    <p class="text-2xl font-bold text-gray-900 mt-2">
                        @if($health['storage_healthy'])
                            <span class="text-green-600">Writable</span>
                        @else
                            <span class="text-red-600">Blocked</span>
                        @endif
                    </p>
                </div>
                <i class="fas fa-hdd text-3xl {{ $health['storage_healthy'] ? 'text-green-500' : 'text-red-500' }}"></i>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Email</p>
                    <p class="text-2xl font-bold text-gray-900 mt-2">
                        @if($health['email_configured'])
                            <span class="text-green-600">Configured</span>
                        @else
                            <span class="text-yellow-600">Disabled</span>
                        @endif
                    </p>
                </div>
                <i class="fas fa-envelope text-3xl {{ $health['email_configured'] ? 'text-green-500' : 'text-yellow-500' }}"></i>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Uptime</p>
                    <p class="text-2xl font-bold text-green-600 mt-2">{{ $health['uptime_estimate'] }}%</p>
                </div>
                <i class="fas fa-heartbeat text-3xl text-green-500"></i>
            </div>
        </div>
    </div>

    <!-- Metrics Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        @foreach($health['metrics'] as $label => $value)
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-gray-600 text-xs font-semibold uppercase">{{ str_replace('_', ' ', $label) }}</p>
            <p class="text-2xl font-bold text-gray-900 mt-2">{{ number_format($value) }}</p>
        </div>
        @endforeach
    </div>

    <!-- Settings Section -->
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            <!-- Provider Settings -->
            @foreach($settings as $channel => $setting)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <form method="post" action="{{ route('admin.system.update', $setting) }}" class="space-y-4">
                    @csrf
                    @method('put')
                    
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">{{ ucfirst($channel) }} Integration</h3>
                            <p class="text-sm text-gray-600">Update provider credentials and settings</p>
                        </div>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="enabled" value="1" @checked(old('enabled', $setting->enabled ?? false)) class="w-4 h-4 rounded border-gray-300 text-red-600 focus:ring-red-500">
                            <span class="text-sm font-semibold text-gray-700">Enabled</span>
                        </label>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Provider</label>
                            <input type="text" name="provider" value="{{ old('provider', $setting->provider ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">API Key</label>
                            <input type="password" name="api_key" placeholder="Leave blank to keep current" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                            <p class="text-xs text-gray-500 mt-1">Leave blank to keep current value</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">API Secret</label>
                            <input type="password" name="api_secret" placeholder="Leave blank to keep current" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                            <p class="text-xs text-gray-500 mt-1">Leave blank to keep current value</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">From Name</label>
                            <input type="text" name="from_name" value="{{ old('from_name', $setting->from_name ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">From Address</label>
                            <input type="email" name="from_address" value="{{ old('from_address', $setting->from_address ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Sender ID</label>
                            <input type="text" name="sender_id" value="{{ old('sender_id', $setting->sender_id ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Notes</label>
                        <textarea name="notes" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">{{ old('notes', $setting->notes ?? '') }}</textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-gradient-to-r from-red-600 to-orange-600 text-white rounded-lg hover:shadow-lg transition font-semibold">
                            <i class="fas fa-save mr-2"></i>Save Changes
                        </button>
                    </div>
                </form>
            </div>
            @endforeach
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Recent Errors -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Recent Errors</h3>
                <div class="space-y-2">
                    @forelse($health['recent_errors'] as $error)
                        <div class="p-3 bg-red-50 border border-red-200 rounded-lg text-sm text-red-800">
                            {{ $error }}
                        </div>
                    @empty
                        <div class="p-3 bg-green-50 border border-green-200 rounded-lg text-sm text-green-800">
                            <i class="fas fa-check-circle mr-2"></i>No recent errors detected
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- System Info -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">System Information</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Generated At</p>
                        <p class="text-gray-900 font-semibold mt-1">{{ $health['generated_at'] ?? now()->format('Y-m-d H:i:s') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">PHP Version</p>
                        <p class="text-gray-900 font-semibold mt-1">{{ phpversion() }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Laravel Version</p>
                        <p class="text-gray-900 font-semibold mt-1">{{ app()->version() }}</p>
                    </div>
                </div>
            </div>

            <!-- Help Card -->
            <div class="bg-blue-50 rounded-xl border border-blue-200 p-6">
                <h3 class="text-lg font-bold text-blue-900 mb-3">
                    <i class="fas fa-info-circle mr-2"></i>Important
                </h3>
                <p class="text-sm text-blue-800">
                    Leave API Key and API Secret fields blank to keep their current values. Only fill them in if you want to update them.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
