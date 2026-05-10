<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Relations\BelongsTo;
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce

class SavedJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_seeker_id',
        'job_id',
<<<<<<< HEAD
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function jobSeeker()
    {
        return $this->belongsTo(User::class, 'job_seeker_id');
    }
}
=======
        'saved_date',
    ];

    protected function casts(): array
    {
        return [
            'saved_date' => 'datetime',
        ];
    }

    public function seeker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'job_seeker_id');
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }
}
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
