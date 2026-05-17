<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\EmployerProfile;
use App\Models\AuditLog;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmployerManagementController extends Controller
{
    public function index(): View
    {
        $employers = User::where('role', 'employer')
            ->with('employerProfile')
            ->latest()
            ->paginate(15);

        $totalEmployers = User::where('role', 'employer')->count();
        $activeEmployers = User::where('role', 'employer')->where('is_active', true)->count();

        return view('admin.employers.index', [
            'employers' => $employers,
            'totalEmployers' => $totalEmployers,
            'activeEmployers' => $activeEmployers,
        ]);
    }

    public function show(User $user): View
    {
        if ($user->role !== 'employer') {
            abort(404);
        }

        return view('admin.employers.show', ['employer' => $user]);
    }

    public function suspend(User $user): RedirectResponse
    {
        if ($user->role !== 'employer') {
            abort(404);
        }

        $user->update(['is_active' => false]);

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'suspend_employer',
            'model_type' => User::class,
            'model_id' => $user->id,
        ]);

        return redirect()->back()->with('success', 'Employer suspended successfully.');
    }

    public function activate(User $user): RedirectResponse
    {
        if ($user->role !== 'employer') {
            abort(404);
        }

        $user->update(['is_active' => true]);

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'activate_employer',
            'model_type' => User::class,
            'model_id' => $user->id,
        ]);

        return redirect()->back()->with('success', 'Employer activated successfully.');
    }

    public function delete(User $user): RedirectResponse
    {
        if ($user->role !== 'employer') {
            abort(404);
        }

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete_employer',
            'model_type' => User::class,
            'model_id' => $user->id,
        ]);

        $user->delete();

        return redirect()->route('admin.employers.index')->with('success', 'Employer deleted successfully.');
    }
}
