<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'resume_path',
        'cv_path',
        'skills',
        'notification_preferences',
        'job_title',
        'bio',
        'experience_level',
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
