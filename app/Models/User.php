<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',                 // seeker, employer, admin
        'phone',
        'profile_picture',
        'is_active',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships (From Full ERD)
    |--------------------------------------------------------------------------
    */

    // A seeker has many applications
    public function applications()
    {
        return $this->hasMany(Application::class, 'job_seeker_id');
    }

    // An employer has many jobs
    public function jobs()
    {
        return $this->hasMany(Job::class, 'employer_id');
    }

    // A seeker has many saved jobs
    public function savedJobs()
    {
        return $this->hasMany(SavedJob::class, 'job_seeker_id');
    }

    // A user has many notifications
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // Admin has many audit logs
    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class, 'admin_id');
    }

    // Admin generates many regulatory reports
    public function regulatoryReports()
    {
        return $this->hasMany(RegulatoryReport::class, 'generated_by');
    }

    /*
    |--------------------------------------------------------------------------
    | Role Helpers (Very Useful)
    |--------------------------------------------------------------------------
    */

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isEmployer()
    {
        return $this->role === 'employer';
    }

    public function isSeeker()
    {
        return $this->role === 'seeker';
    }

    public function jobSeekerProfile()
    {
    return $this->hasOne(JobSeekerProfile::class);
    }
}