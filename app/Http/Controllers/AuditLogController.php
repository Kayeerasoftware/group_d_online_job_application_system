<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuditLogController extends Controller
{
    public function index(Request $request): View
    {
        $logs = AuditLog::query()->with('admin')->latest()->paginate(15);

        return view('admin.audit-logs.index', compact('logs'));
    }

    public function create()
    {
        abort(404);
    }

    public function store()
    {
        abort(404);
    }

    public function show(AuditLog $auditLog)
    {
        abort(404);
    }

    public function edit(AuditLog $auditLog)
    {
        abort(404);
    }

    public function update(Request $request, AuditLog $auditLog)
    {
        abort(404);
    }

    public function destroy(AuditLog $auditLog)
    {
        abort(404);
    }
}
