<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
=======
use App\Enums\ApplicationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'job_seeker_id',
        'cover_letter',
        'cv_path',
        'status',
        'applied_date',
        'employer_notes',
    ];

<<<<<<< HEAD
    /*
    |-----------------------------
    | Relationships
    |-----------------------------
    */

    // Application belongs to a job
    public function job()
=======
    protected function casts(): array
    {
        return [
            'applied_date' => 'datetime',
            'status' => ApplicationStatus::class,
        ];
    }

    public function job(): BelongsTo
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
    {
        return $this->belongsTo(Job::class);
    }

<<<<<<< HEAD
    // Application belongs to a job seeker
    public function jobSeeker()
    {
        return $this->belongsTo(User::class, 'job_seeker_id');
    }
}
=======
    public function seeker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'job_seeker_id');
    }

    public function scopeForJob(Builder $query, int $jobId): Builder
    {
        return $query->where('job_id', $jobId);
    }

    public function statusValue(): string
    {
        return $this->status instanceof ApplicationStatus ? $this->status->value : (string) $this->status;
    }
}
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
