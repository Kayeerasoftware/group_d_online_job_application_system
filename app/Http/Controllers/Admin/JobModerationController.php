<?php

namespace App\Http\Controllers\Admin;

use App\Enums\JobStatus;
use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class JobModerationController extends Controller
{
    public function flag(Request $request, Job $job): RedirectResponse
    {
        $data = $request->validate([
            'reason' => ['nullable', 'string', 'max:500'],
        ]);

        $previousStatus = $job->statusValue();

        $job->update([
            'status' => JobStatus::Closed,
        ]);

        AuditLog::create([
            'admin_id' => $request->user()->id,
            'action' => 'flag_job',
            'target_type' => Job::class,
            'target_id' => $job->id,
            'old_values' => ['status' => $previousStatus],
            'new_values' => ['status' => JobStatus::Closed->value],
            'reason' => $data['reason'] ?? 'Flagged during admin compliance review.',
            'ip_address' => $request->ip(),
        ]);

        return back()->with('status', 'Job flagged and closed for compliance review.');
    }
}
