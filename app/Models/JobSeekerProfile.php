<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Relations\BelongsTo;
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce

class JobSeekerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_of_birth',
        'gender',
        'location',
        'education_level',
        'years_experience',
<<<<<<< HEAD
        'skills',
        'resume_path',
        'notification_preferences',
    ];

    // Relationship: belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A job seeker can have many applications
    public function applications()
    {
        return $this->hasMany(Application::class, 'job_seeker_id');
    }

    // A job seeker can save jobs
    public function savedJobs()
    {
        return $this->hasMany(SavedJob::class, 'job_seeker_id');
    }
}
=======
        'resume_path',
        'skills',
        'notification_preferences',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'skills' => 'array',
            'notification_preferences' => 'array',
            'years_experience' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
