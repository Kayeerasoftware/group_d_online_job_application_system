<?php

namespace App\Providers;

use App\Models\Application;
use App\Models\AuditLog;
use App\Models\EmployerProfile;
use App\Models\Job;
use App\Models\JobSeekerProfile;
use App\Models\Notification;
use App\Models\RegulatoryReport;
use App\Models\SavedJob;
use App\Policies\ApplicationPolicy;
use App\Policies\AuditLogPolicy;
use App\Policies\EmployerProfilePolicy;
use App\Policies\JobPolicy;
use App\Policies\JobSeekerProfilePolicy;
use App\Policies\NotificationPolicy;
use App\Policies\RegulatoryReportPolicy;
use App\Policies\SavedJobPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected array $policies = [
        Application::class => ApplicationPolicy::class,
        AuditLog::class => AuditLogPolicy::class,
        EmployerProfile::class => EmployerProfilePolicy::class,
        Job::class => JobPolicy::class,
        JobSeekerProfile::class => JobSeekerProfilePolicy::class,
        Notification::class => NotificationPolicy::class,
        RegulatoryReport::class => RegulatoryReportPolicy::class,
        SavedJob::class => SavedJobPolicy::class,
    ];

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        foreach ($this->policies as $model => $policy) {
            Gate::policy($model, $policy);
        }
    }
}
