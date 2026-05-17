<?php

namespace App\Http\Controllers\Regulator;

use App\Http\Controllers\Controller;
use App\Models\RegulatoryReport;
use App\Models\AuditLog;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ComplianceController extends Controller
{
    public function index(): View
    {
        $reports = RegulatoryReport::latest()->paginate(15);
        $reportsByStatus = RegulatoryReport::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->get();

        return view('regulator.compliance.index', [
            'reports' => $reports,
            'reportsByStatus' => $reportsByStatus,
        ]);
    }

    public function show(RegulatoryReport $report): View
    {
        return view('regulator.compliance.show', ['report' => $report]);
    }

    public function audit(): View
    {
        $auditLogs = AuditLog::latest()->paginate(20);

        return view('regulator.compliance.audit', ['auditLogs' => $auditLogs]);
    }

    public function filter(Request $request): View
    {
        $query = RegulatoryReport::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $reports = $query->latest()->paginate(15);

        return view('regulator.compliance.index', ['reports' => $reports]);
    }
}
