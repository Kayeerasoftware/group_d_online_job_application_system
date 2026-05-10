<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GenerateRegulatoryReportRequest;
use App\Jobs\GenerateRegulatoryReportJob;
use App\Models\RegulatoryReport;
use App\Services\Reports\RegulatoryReportService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ComplianceReportController extends Controller
{
    public function index(): View
    {
        $reports = RegulatoryReport::query()->latest()->paginate(10);

        return view('admin.reports.index', compact('reports'));
    }

    public function create(): View
    {
        return view('admin.reports.create');
    }

    public function store(GenerateRegulatoryReportRequest $request, RegulatoryReportService $service): RedirectResponse
    {
        $report = RegulatoryReport::create([
            'report_type' => $request->validated()['report_type'],
            'generated_by' => $request->user()->id,
            'date_range_start' => $request->validated()['date_range_start'],
            'date_range_end' => $request->validated()['date_range_end'],
            'aggregated_data' => [],
            'status' => 'draft',
        ]);

        $report->update([
            'aggregated_data' => $service->generate($report),
        ]);

        dispatch(new GenerateRegulatoryReportJob($report));

        return redirect()->route('admin.reports.show', $report)->with('status', 'Report generated.');
    }

    public function show(RegulatoryReport $regulatoryReport): View
    {
        return view('admin.reports.show', [
            'report' => $regulatoryReport,
        ]);
    }

    public function submit(RegulatoryReport $regulatoryReport): RedirectResponse
    {
        $regulatoryReport->update(['status' => 'submitted']);

        return back()->with('status', 'Report submitted to regulator.');
    }

    public function download(RegulatoryReport $regulatoryReport): StreamedResponse
    {
        $payload = json_encode(
            $regulatoryReport->fresh()->aggregated_data ?? [],
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        ) ?: '{}';

        return response()->streamDownload(function () use ($payload): void {
            echo $payload;
        }, $regulatoryReport->report_type.'-'.now()->format('YmdHis').'.json', [
            'Content-Type' => 'application/json',
        ]);
    }
}
