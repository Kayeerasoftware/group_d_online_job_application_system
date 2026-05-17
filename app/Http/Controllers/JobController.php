<?php

namespace App\Http\Controllers;

use App\Enums\DeliveryStatus;
use App\Enums\JobStatus;
use App\Enums\NotificationChannel;
use App\Enums\UserRole;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\AuditLog;
use App\Models\Job;
use App\Models\Notification;
use App\Models\User;
use App\Services\Security\ComplianceChecker;
use App\Services\Notifications\NotificationDispatcher;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobController extends Controller
{
    public function index(Request $request): View
    {
        try {
            $user = $request->user();
            $query = Job::query()->with(['employer.employerProfile'])->withCount('applications');

            // Check if employer filter is provided
            $employerFilter = $request->filled('employer') ? $request->integer('employer') : null;
            $isEmployerViewingOwnJobs = $user?->isEmployer() && ($employerFilter === null || $employerFilter === $user->id);
            $isEmployerProfileView = $request->filled('employer') && $employerFilter !== $user?->id;

            if ($isEmployerViewingOwnJobs) {
                // Employer viewing their own jobs - show management view
                $query->where('employer_id', $user->id);
                $employer = null;
            } elseif ($isEmployerProfileView) {
                // Viewing another employer's jobs - show profile view
                $employerId = $employerFilter;
                $query->where('employer_id', $employerId);
                $employer = User::findOrFail($employerId);
            } else {
                // Seeker, guest, or admin viewing jobs
                $employer = null;
                
                if ($user?->isSeeker() || !$user) {
                    // Seekers and guests see only open jobs
                    $query->where('status', JobStatus::Open->value);
                } elseif ($user?->isAdmin()) {
                    // Admins see all jobs
                }
            }

            $query->search($request->string('search')->toString() ?: null);

            if ($request->filled('location')) {
                $query->where('location', 'like', '%'.$request->string('location')->toString().'%');
            }

            if ($request->filled('job_type')) {
                $query->where('job_type', $request->string('job_type')->toString());
            }

            if ($request->filled('salary_min')) {
                $minSalary = $request->float('salary_min');

                $query->where(function ($builder) use ($minSalary): void {
                    $builder->whereNull('salary_max')
                        ->orWhere('salary_max', '>=', $minSalary);
                });
            }

            if ($request->filled('salary_max')) {
                $maxSalary = $request->float('salary_max');

                $query->where(function ($builder) use ($maxSalary): void {
                    $builder->whereNull('salary_min')
                        ->orWhere('salary_min', '<=', $maxSalary);
                });
            }

            $jobs = $query->latest()->paginate(10)->withQueryString();
        } catch (\Throwable $e) {
            $jobs = new LengthAwarePaginator([], 0, 10, 1, [
                'path' => $request->url(),
            ]);
            $employer = null;
        }

        // Use employer profile view only if viewing another employer's jobs
        if ($isEmployerProfileView && $employer) {
            return view('jobs.employer-jobs', compact('jobs', 'employer'));
        }

        // For employers viewing their own jobs, use employer layout
        if ($isEmployerViewingOwnJobs) {
            return view('employer.jobs-list', compact('jobs'));
        }

        // All other users (seekers, guests, admins) use browse-jobs
        return view('seeker.browse-jobs', [
            'jobs' => $jobs,
            'savedJobIds' => auth()->check() ? auth()->user()->savedJobs()->pluck('job_id')->toArray() : [],
            'appliedJobIds' => auth()->check() ? auth()->user()->applications()->pluck('job_id')->toArray() : [],
        ]);
    }

    public function create(): View
    {
        return view('jobs.create', [
            'job' => new Job(),
        ]);
    }

    public function store(StoreJobRequest $request, ComplianceChecker $checker, NotificationDispatcher $dispatcher): RedirectResponse
    {
        $job = Job::create([
            ...$request->validated(),
            'employer_id' => $request->user()->id,
            'status' => JobStatus::Open,
        ]);

        if ($checker->flagSuspiciousTerms($job->title.' '.$job->description.' '.$job->requirements)) {
            AuditLog::create([
                'admin_id' => $request->user()->id,
                'action' => 'flag_job',
                'target_type' => Job::class,
                'target_id' => $job->id,
                'new_values' => $job->toArray(),
                'reason' => 'Automated compliance keyword check flagged this job posting.',
            ]);

            $admin = User::query()->where('role', UserRole::Admin->value)->first();

            if ($admin) {
                $notification = Notification::create([
                    'user_id' => $admin->id,
                    'type' => NotificationChannel::App,
                    'subject' => 'Job posting flagged for review',
                    'message' => "The job posting \"{$job->title}\" contains language that requires review.",
                    'is_read' => false,
                    'delivery_status' => DeliveryStatus::Pending,
                ]);

                $dispatcher->dispatch($notification);
            }
        }

        return redirect()->route('jobs.show', $job)->with('status', 'Job posted successfully.');
    }

    public function show(Request $request, Job $job): View
    {
        $job->load(['employer.employerProfile'])->loadCount('applications');
        $job->increment('views_count');

        $saved = $request->user()
            ? $request->user()->savedJobs()->where('job_id', $job->id)->exists()
            : false;

        $applied = $request->user()
            ? $request->user()->applications()->where('job_id', $job->id)->exists()
            : false;

        $appliedJobIds = $request->user()
            ? $request->user()->applications()->pluck('job_id')->toArray()
            : [];

        if ($request->user()?->isSeeker()) {
            return view('seeker.job-detail', compact('job', 'saved', 'applied', 'appliedJobIds'));
        }

        return view('jobs.show', compact('job', 'saved', 'applied'));
    }

    public function edit(Request $request, Job $job): View
    {
        $this->authorizeOwnership($request, $job);

        return view('jobs.edit', compact('job'));
    }

    public function update(UpdateJobRequest $request, Job $job): RedirectResponse
    {
        $this->authorizeOwnership($request, $job);

        $job->update($request->validated());

        return redirect()->route('jobs.show', $job)->with('status', 'Job updated successfully.');
    }

    public function destroy(Request $request, Job $job): RedirectResponse
    {
        $this->authorizeOwnership($request, $job);
        $job->delete();

        return redirect()->route('jobs.index')->with('status', 'Job deleted.');
    }

    private function authorizeOwnership(Request $request, Job $job): void
    {
        if (! $request->user()->isAdmin() && $job->employer_id !== $request->user()->id) {
            abort(403, 'You do not own this job posting.');
        }
    }
}
