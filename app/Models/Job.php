<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
=======
use App\Enums\JobStatus;
use App\Enums\JobType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce

class Job extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $table = 'job_postings';

=======
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
    protected $fillable = [
        'employer_id',
        'title',
        'description',
        'requirements',
        'location',
        'salary_min',
        'salary_max',
        'job_type',
<<<<<<< HEAD
        'status',
        'deadline',
    ];

    /*
    |-----------------------------
    | Relationships
    |-----------------------------
    */

    // Job belongs to an employer (user)
    public function employer()
=======
        'deadline',
        'status',
        'views_count',
    ];

    protected function casts(): array
    {
        return [
            'deadline' => 'date',
            'salary_min' => 'decimal:2',
            'salary_max' => 'decimal:2',
            'job_type' => JobType::class,
            'status' => JobStatus::class,
            'views_count' => 'integer',
        ];
    }

    public function employer(): BelongsTo
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

<<<<<<< HEAD
    // Job has many applications
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
=======
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function savedJobs(): HasMany
    {
        return $this->hasMany(SavedJob::class);
    }

    public function flaggedBy(): HasOne
    {
        return $this->hasOne(AuditLog::class, 'target_id')
            ->where('target_type', self::class);
    }

    public function scopeOpen(Builder $query): Builder
    {
        return $query->where('status', JobStatus::Open->value);
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (! $term) {
            return $query;
        }

        return $query->where(function (Builder $builder) use ($term): void {
            $builder->where('title', 'like', "%{$term}%")
                ->orWhere('description', 'like', "%{$term}%")
                ->orWhere('location', 'like', "%{$term}%")
                ->orWhere('requirements', 'like', "%{$term}%");
        });
    }

    public function isOpen(): bool
    {
        return $this->status instanceof JobStatus
            ? $this->status === JobStatus::Open
            : (string) $this->status === JobStatus::Open->value;
    }

    public function statusValue(): string
    {
        return $this->status instanceof JobStatus ? $this->status->value : (string) $this->status;
    }
}
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
