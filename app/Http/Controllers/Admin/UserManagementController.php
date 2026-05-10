<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserManagementController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::query()
            ->withCount(['jobs', 'applications'])
            ->when($request->filled('search'), function ($query) use ($request): void {
                $term = $request->string('search')->toString();
                $query->where(function ($builder) use ($term): void {
                    $builder->where('name', 'like', "%{$term}%")
                        ->orWhere('email', 'like', "%{$term}%");
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user): View
    {
        $user->load(['jobs', 'applications.job', 'notifications']);

        return view('admin.users.show', compact('user'));
    }

    public function suspend(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'reason' => ['nullable', 'string', 'max:500'],
        ]);

        $previousValues = [
            'is_active' => (bool) $user->is_active,
            'role' => $user->roleValue(),
        ];

        $user->update(['is_active' => false]);

        AuditLog::create([
            'admin_id' => $request->user()->id,
            'action' => 'suspend_user',
            'target_type' => User::class,
            'target_id' => $user->id,
            'old_values' => $previousValues,
            'new_values' => [
                'is_active' => false,
            ],
            'ip_address' => $request->ip(),
            'reason' => $data['reason'] ?? 'Suspended by system administrator.',
        ]);

        return back()->with('status', "{$user->name} has been suspended.");
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'role' => ['required', 'in:seeker,employer,admin'],
        ]);

        $previousRole = $user->roleValue();

        $user->update(['role' => $data['role']]);

        AuditLog::create([
            'admin_id' => $request->user()->id,
            'action' => 'update_user_role',
            'target_type' => User::class,
            'target_id' => $user->id,
            'old_values' => ['role' => $previousRole],
            'new_values' => ['role' => $user->fresh()->roleValue()],
            'ip_address' => $request->ip(),
            'reason' => "Role changed from {$previousRole} to {$data['role']}.",
        ]);

        return back()->with('status', "{$user->name} role updated.");
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        $previousValues = [
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->roleValue(),
            'is_active' => (bool) $user->is_active,
        ];

        $user->delete();

        AuditLog::create([
            'admin_id' => $request->user()->id,
            'action' => 'delete_user',
            'target_type' => User::class,
            'target_id' => $user->id,
            'old_values' => $previousValues,
            'new_values' => ['deleted' => true],
            'ip_address' => $request->ip(),
            'reason' => 'Account permanently removed by administrator.',
        ]);

        return redirect()->route('admin.users.index')->with('status', 'User deleted.');
    }
}
