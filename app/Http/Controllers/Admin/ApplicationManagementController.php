<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\AuditLog;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ApplicationManagementController extends Controller
{
    public function index(): View
    {
        $applications = Application::with(['job', 'user'])->latest()->paginate(15);
        $applicationsByStatus = Application::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->get();

        return view('admin.applications.index', [
            'applications' => $applications,
            'applicationsByStatus' => $applicationsByStatus,
        ]);
    }

    public function show(Application $application): View
    {
        return view('admin.applications.show', ['application' => $application]);
    }

    public function filter(Request $request): View
    {
        $query = Application::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('job_id')) {
            $query->where('job_id', $request->job_id);
        }

        $applications = $query->with(['job', 'user'])->latest()->paginate(15);

        return view('admin.applications.index', ['applications' => $applications]);
    }

    public function delete(Application $application): RedirectResponse
    {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete_application',
            'model_type' => Application::class,
            'model_id' => $application->id,
        ]);

        $application->delete();

        return redirect()->route('admin.applications.index')->with('success', 'Application deleted successfully.');
    }
}
