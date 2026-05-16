<?php

namespace App\Http\Controllers;

use App\Enums\ApplicationStatus;
use App\Enums\DeliveryStatus;
use App\Enums\JobStatus;
use App\Enums\NotificationChannel;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Models\Application;
use App\Models\Job;
use App\Models\Notification;
use App\Services\Notifications\NotificationDispatcher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ApplicationController extends Controller
{
    public function index(Request $request, ?Job $job = null): View
    {
        $user = $request->user();
        $query = Application::query()->with(['job.employer.employerProfile', 'seeker']);

        if ($job instanceof Job) {
            if (! $user->isAdmin() && $job->employer_id !== $user->id) {
                abort(403, 'You do not own this job.');
            }
            $query->where('job_id', $job->id);
        } elseif ($user->isSeeker()) {
            $query->where('job_seeker_id', $user->id);
        } elseif ($user->isEmployer()) {
            $query->whereHas('job', fn ($builder) => $builder->where('employer_id', $user->id));
        }

        $applications = $query->latest()->paginate(10)->withQueryString();

        return view('applications.index', [
            'applications' => $applications,
            'job' => $job,
        ]);
    }

    public function create(Request $request): View
    {
        $job = $request->integer('job') ? Job::findOrFail($request->integer('job')) : null;

        if ($request->user()?->isSeeker()) {
            return view('jobseeker.applications-create', compact('job'));
        }

        return view('applications.create', compact('job'));
    }

    public function store(StoreApplicationRequest $request, NotificationDispatcher $dispatcher): RedirectResponse
    {
        $user = $request->user();
        abort_unless($user->isSeeker(), 403, 'Only job seekers can apply.');

        $validated = $request->validated();
        $job = Job::query()->with('employer')->findOrFail($validated['job_id']);

        if (! $job->isOpen()) {
            throw ValidationException::withMessages([
                'job_id' => 'This job is no longer open for applications.',
            ]);
        }

        if ($job->applications()->where('job_seeker_id', $user->id)->exists()) {
            throw ValidationException::withMessages([
                'job_id' => 'You have already applied for this job.',
            ]);
        }

        $cvPath = $user->seekerProfile?->resume_path;
        if ($request->hasFile('cv_path')) {
            $cvPath = $request->file('cv_path')->store('cvs', 'public');
        }

        $application = Application::create([
            'job_id' => $job->id,
            'job_seeker_id' => $user->id,
            'cover_letter' => $validated['cover_letter'],
            'cv_path' => $cvPath ?? 'cvs/default-cv.pdf',
            'status' => ApplicationStatus::Pending,
            'applied_date' => now(),
        ]);

        $this->notifyUser(
            $job->employer,
            'email',
            'New application received',
            "A new application has been submitted for {$job->title}.",
            $dispatcher
        );

        $this->notifyUser(
            $user,
            'app',
            'Application submitted',
            "Your application for {$job->title} was submitted successfully.",
            $dispatcher
        );

        if ($user->isSeeker()) {
            return redirect()->route('seeker.applications')->with('status', 'Application submitted successfully.');
        }

        return redirect()->route('applications.show', $application)->with('status', 'Application submitted successfully.');
    }

    public function show(Request $request, Application $application): View
    {
        $this->authorizeViewer($request, $application);

        $application->load(['job.employer.employerProfile', 'seeker.seekerProfile']);

        return view('applications.show', compact('application'));
    }

    public function edit(Request $request, Application $application): View
    {
        $this->authorizeViewer($request, $application);

        return view('applications.edit', compact('application'));
    }

    public function update(UpdateApplicationRequest $request, Application $application, NotificationDispatcher $dispatcher): RedirectResponse
    {
        $user = $request->user();
        $this->authorizeViewer($request, $application);

        $validated = $request->validated();

        if ($user->isEmployer() || $user->isAdmin()) {
            $application->update([
                'status' => $validated['status'] ?? $application->status,
                'employer_notes' => $validated['employer_notes'] ?? $application->employer_notes,
            ]);

            $this->notifyUser(
                $application->seeker,
                'email',
                'Application status updated',
                "Your application for {$application->job->title} is now {$application->status->value}.",
                $dispatcher
            );
        }

        return redirect()->route('applications.show', $application)->with('status', 'Application updated successfully.');
    }

    public function destroy(Request $request, Application $application): RedirectResponse
    {
        $this->authorizeViewer($request, $application);
        $application->delete();

        return redirect()->route('applications.index')->with('status', 'Application removed.');
    }

    public function export(Request $request, ?Job $job = null): StreamedResponse
    {
        $user = $request->user();
        abort_unless($user->isEmployer() || $user->isAdmin(), 403);

        if ($job && ! $user->isAdmin() && $job->employer_id !== $user->id) {
            abort(403, 'You do not own this job.');
        }

        $query = Application::query()->with(['job', 'seeker']);

        if ($job instanceof Job) {
            $query->where('job_id', $job->id);
        } elseif ($user->isEmployer()) {
            $query->whereHas('job', fn ($builder) => $builder->where('employer_id', $user->id));
        }

        $rows = $query->latest()->get()->map(function (Application $application): array {
            return [
                'job_title' => $application->job->title,
                'seeker_name' => $application->seeker->name,
                'seeker_email' => $application->seeker->email,
                'status' => $application->statusValue(),
                'applied_date' => optional($application->applied_date)->format('Y-m-d H:i:s'),
                'cover_letter' => $application->cover_letter,
            ];
        });

        $filename = $job
            ? 'job-applications-'.$job->id.'.csv'
            : 'all-applications.csv';

        return response()->streamDownload(function () use ($rows): void {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['job_title', 'seeker_name', 'seeker_email', 'status', 'applied_date', 'cover_letter']);

            foreach ($rows as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }

    private function authorizeViewer(Request $request, Application $application): void
    {
        $user = $request->user();

        if ($user->isAdmin()) {
            return;
        }

        if ($user->isEmployer() && $application->job->employer_id === $user->id) {
            return;
        }

        if ($user->isSeeker() && $application->job_seeker_id === $user->id) {
            return;
        }

        abort(403, 'You cannot view this application.');
    }

    private function notifyUser($user, string $channel, string $subject, string $message, NotificationDispatcher $dispatcher): void
    {
        $notification = Notification::create([
            'user_id' => $user->id,
            'type' => $channel,
            'subject' => $subject,
            'message' => $message,
            'is_read' => false,
            'delivery_status' => DeliveryStatus::Pending,
        ]);

        $dispatcher->dispatch($notification);
    }
}
