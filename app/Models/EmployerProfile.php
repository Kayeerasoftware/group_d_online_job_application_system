<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce

class EmployerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'company_description',
        'company_website',
        'industry',
        'company_logo',
        'tax_id',
        'verified_by_admin',
        'verification_date',
    ];

<<<<<<< HEAD
    // Relationship: profile belongs to user
    public function user()
=======
    protected function casts(): array
    {
        return [
            'verified_by_admin' => 'boolean',
            'verification_date' => 'date',
        ];
    }

    public function user(): BelongsTo
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
    {
        return $this->belongsTo(User::class);
    }

<<<<<<< HEAD
    // Employer has many jobs
    public function jobs()
    {
        return $this->hasMany(Job::class, 'employer_id');
    }
}
=======
    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class, 'employer_id', 'user_id');
    }
}
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
