<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job_postings';

    protected $fillable = [
        'employer_id',
        'title',
        'description',
        'requirements',
        'location',
        'salary_min',
        'salary_max',
        'job_type',
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
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    // Job has many applications
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}