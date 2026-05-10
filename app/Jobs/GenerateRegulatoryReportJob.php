<?php

namespace App\Jobs;

use App\Models\RegulatoryReport;
use App\Services\Reports\RegulatoryReportService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateRegulatoryReportJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(public RegulatoryReport $report)
    {
    }

    public function handle(RegulatoryReportService $service): void
    {
        $this->report->update([
            'aggregated_data' => $service->generate($this->report),
        ]);
    }
}
