<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'profile_picture',
        'two_factor_enabled',
        'two_factor_secret',
        'notifications_enabled',
        'job_recommendations',
        'application_updates',
        'message_notifications',
        'interview_reminders',
        'profile_visible',
        'show_email',
        'show_phone',
        'theme',
        'last_login_at',
    ];

    protected $appends = ['profile_picture_url'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
            'two_factor_enabled' => 'boolean',
            'notifications_enabled' => 'boolean',
            'job_recommendations' => 'boolean',
            'application_updates' => 'boolean',
            'message_notifications' => 'boolean',
            'interview_reminders' => 'boolean',
            'profile_visible' => 'boolean',
            'show_email' => 'boolean',
            'show_phone' => 'boolean',
            'last_login_at' => 'datetime',
        ];
    }

    public function seekerProfile(): HasOne
    {
        return $this->hasOne(JobSeekerProfile::class);
    }

    public function employerProfile(): HasOne
    {
        return $this->hasOne(EmployerProfile::class);
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class, 'employer_id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'job_seeker_id');
    }

    public function savedJobs(): HasMany
    {
        return $this->hasMany(SavedJob::class, 'job_seeker_id');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function auditLogs(): HasMany
    {
        return $this->hasMany(AuditLog::class, 'admin_id');
    }

    public function regulatoryReports(): HasMany
    {
        return $this->hasMany(RegulatoryReport::class, 'generated_by');
    }

    public function isSeeker(): bool
    {
        return $this->roleValue() === UserRole::Seeker->value;
    }

    public function isEmployer(): bool
    {
        return $this->roleValue() === UserRole::Employer->value;
    }

    public function isAdmin(): bool
    {
        return $this->roleValue() === UserRole::Admin->value;
    }

    public function isRegulator(): bool
    {
        return $this->roleValue() === UserRole::Regulator->value;
    }

    public function roleValue(): string
    {
        return $this->role instanceof UserRole ? $this->role->value : (string) $this->role;
    }

    public function getProfilePictureUrlAttribute(): ?string
    {
        return $this->profile_picture ? asset($this->profile_picture) : null;
    }
}
