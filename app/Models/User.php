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
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'is_active' => 'boolean',
            'password' => 'hashed',
            'role' => UserRole::class,
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

    public function roleValue(): string
    {
        return $this->role instanceof UserRole ? $this->role->value : (string) $this->role;
    }
}
