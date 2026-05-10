<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
<<<<<<< HEAD
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
=======
    use HasFactory;
    use Notifiable;

>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
    protected $fillable = [
        'name',
        'email',
        'password',
<<<<<<< HEAD
        'role',                 // seeker, employer, admin
        'phone',
        'profile_picture',
        'is_active',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
=======
        'role',
        'phone',
        'profile_picture',
        'is_active',
    ];

>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
    protected $hidden = [
        'password',
        'remember_token',
    ];

<<<<<<< HEAD
    /**
     * The attributes that should be cast.
     */
=======
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
<<<<<<< HEAD
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
=======
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
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
    {
        return $this->hasMany(Job::class, 'employer_id');
    }

<<<<<<< HEAD
    // A seeker has many saved jobs
    public function savedJobs()
=======
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'job_seeker_id');
    }

    public function savedJobs(): HasMany
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
    {
        return $this->hasMany(SavedJob::class, 'job_seeker_id');
    }

<<<<<<< HEAD
    // A user has many notifications
    public function notifications()
=======
    public function notifications(): HasMany
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
    {
        return $this->hasMany(Notification::class);
    }

<<<<<<< HEAD
    // Admin has many audit logs
    public function auditLogs()
=======
    public function auditLogs(): HasMany
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
    {
        return $this->hasMany(AuditLog::class, 'admin_id');
    }

<<<<<<< HEAD
    // Admin generates many regulatory reports
    public function regulatoryReports()
=======
    public function regulatoryReports(): HasMany
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
    {
        return $this->hasMany(RegulatoryReport::class, 'generated_by');
    }

<<<<<<< HEAD
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
=======
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
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
