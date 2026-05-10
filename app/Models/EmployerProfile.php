<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    protected function casts(): array
    {
        return [
            'verified_by_admin' => 'boolean',
            'verification_date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class, 'employer_id', 'user_id');
    }
}
