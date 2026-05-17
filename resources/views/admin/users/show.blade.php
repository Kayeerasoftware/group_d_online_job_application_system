@extends('layouts.admin')

@section('title', 'User Profile - ' . $user->name)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Back Button -->
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-red-600 hover:text-red-700 mb-6 font-semibold">
        <i class="fas fa-arrow-left"></i>Back to Users
    </a>

    <!-- User Header -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <div class="flex items-start justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-red-400 to-orange-500 flex items-center justify-center text-white text-3xl font-bold shadow-lg">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
                    <p class="text-gray-600">{{ $user->email }}</p>
                    <div class="flex gap-2 mt-2">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full
                            @if($user->roleValue() === 'admin') bg-red-100 text-red-800
                            @elseif($user->roleValue() === 'employer') bg-blue-100 text-blue-800
                            @else bg-green-100 text-green-800
                            @endif">
                            {{ ucfirst($user->roleValue()) }}
                        </span>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full
                            @if($user->is_active) bg-green-100 text-green-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ $user->is_active ? 'Active' : 'Suspended' }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex gap-2">
                <button onclick="document.getElementById('editModal').classList.remove('hidden')" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">
                    <i class="fas fa-edit mr-2"></i>Edit
                </button>
                <button onclick="document.getElementById('suspendModal').classList.remove('hidden')" class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition font-semibold">
                    <i class="fas fa-ban mr-2"></i>Suspend
                </button>
                <button onclick="document.getElementById('deleteModal').classList.remove('hidden')" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">
                    <i class="fas fa-trash mr-2"></i>Delete
                </button>
            </div>
        </div>
    </div>

    <!-- User Details Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-gray-600 text-sm font-semibold">Email</p>
            <p class="text-gray-900 font-bold mt-1">{{ $user->email }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-gray-600 text-sm font-semibold">Phone</p>
            <p class="text-gray-900 font-bold mt-1">{{ $user->phone ?? 'N/A' }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-gray-600 text-sm font-semibold">Joined</p>
            <p class="text-gray-900 font-bold mt-1">{{ $user->created_at->format('M d, Y') }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-gray-600 text-sm font-semibold">Last Updated</p>
            <p class="text-gray-900 font-bold mt-1">{{ $user->updated_at->format('M d, Y') }}</p>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            <!-- Activity Counts -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Activity Summary</h2>
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-4 border border-blue-200">
                        <p class="text-gray-600 text-sm font-semibold">Jobs Posted</p>
                        <p class="text-3xl font-bold text-blue-600 mt-2">{{ $user->jobs->count() }}</p>
                    </div>
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-4 border border-purple-200">
                        <p class="text-gray-600 text-sm font-semibold">Applications</p>
                        <p class="text-3xl font-bold text-purple-600 mt-2">{{ $user->applications->count() }}</p>
                    </div>
                    <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-lg p-4 border border-orange-200">
                        <p class="text-gray-600 text-sm font-semibold">Notifications</p>
                        <p class="text-3xl font-bold text-orange-600 mt-2">{{ $user->notifications->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Recent Jobs -->
            @if($user->jobs->count() > 0)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Recent Jobs</h2>
                <div class="space-y-3">
                    @foreach($user->jobs->take(5) as $job)
                    <div class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                        <p class="font-semibold text-gray-900">{{ $job->title }}</p>
                        <p class="text-sm text-gray-600">{{ $job->company_name }}</p>
                        <p class="text-xs text-gray-500 mt-1">Posted {{ $job->created_at->diffForHumans() }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Recent Applications -->
            @if($user->applications->count() > 0)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Recent Applications</h2>
                <div class="space-y-3">
                    @foreach($user->applications->take(5) as $app)
                    <div class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                        <p class="font-semibold text-gray-900">{{ $app->job->title }}</p>
                        <div class="flex items-center justify-between mt-2">
                            <p class="text-sm text-gray-600">{{ $app->job->company_name }}</p>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                @if($app->status->value === 'shortlisted') bg-green-100 text-green-800
                                @elseif($app->status->value === 'rejected') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800
                                @endif">
                                {{ ucfirst($app->status->value) }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Account Info -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Account Information</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">User ID</p>
                        <p class="text-gray-900 font-mono text-sm">{{ $user->id }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Role</p>
                        <p class="text-gray-900 font-semibold">{{ ucfirst($user->roleValue()) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Status</p>
                        <p class="text-gray-900 font-semibold">{{ $user->is_active ? 'Active' : 'Suspended' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Member Since</p>
                        <p class="text-gray-900 font-semibold">{{ $user->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-2">
                    <a href="mailto:{{ $user->email }}" class="block w-full px-4 py-2 text-center bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold text-sm">
                        <i class="fas fa-envelope mr-2"></i>Send Email
                    </a>
                    <button onclick="document.getElementById('editModal').classList.remove('hidden')" class="w-full px-4 py-2 text-center bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition font-semibold text-sm">
                        <i class="fas fa-edit mr-2"></i>Edit User
                    </button>
                    <button onclick="document.getElementById('suspendModal').classList.remove('hidden')" class="w-full px-4 py-2 text-center bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition font-semibold text-sm">
                        <i class="fas fa-ban mr-2"></i>Suspend
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Edit User</h3>
        <form method="post" action="{{ route('admin.users.role', $user) }}" class="space-y-4">
            @csrf
            @method('patch')
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Role</label>
                <select name="role" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    <option value="seeker" @selected($user->roleValue() === 'seeker')>Job Seeker</option>
                    <option value="employer" @selected($user->roleValue() === 'employer')>Employer</option>
                    <option value="admin" @selected($user->roleValue() === 'admin')>Administrator</option>
                </select>
            </div>
            <div class="flex gap-3 justify-end">
                <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<!-- Suspend Modal -->
<div id="suspendModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-2">Suspend User?</h3>
        <p class="text-gray-600 mb-4">Suspended users will no longer be able to access the system.</p>
        <form method="post" action="{{ route('admin.users.suspend', $user) }}" class="space-y-4">
            @csrf
            @method('patch')
            <textarea name="reason" placeholder="Reason for suspension..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" rows="3"></textarea>
            <div class="flex gap-3 justify-end">
                <button type="button" onclick="document.getElementById('suspendModal').classList.add('hidden')" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition font-semibold">Suspend</button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-2">Delete User?</h3>
        <p class="text-gray-600 mb-4">This action cannot be undone. All user data will be permanently removed.</p>
        <form method="post" action="{{ route('admin.users.destroy', $user) }}" class="space-y-4">
            @csrf
            @method('delete')
            <div class="flex gap-3 justify-end">
                <button type="button" onclick="document.getElementById('deleteModal').classList.add('hidden')" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">Delete</button>
            </div>
        </form>
    </div>
</div>
@endsection
