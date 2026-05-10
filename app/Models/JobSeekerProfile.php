<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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