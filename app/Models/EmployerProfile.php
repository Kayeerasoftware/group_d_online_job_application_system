<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    // Relationship: profile belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Employer has many jobs
    public function jobs()
    {
        return $this->hasMany(Job::class, 'employer_id');
    }
}