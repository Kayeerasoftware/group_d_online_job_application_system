<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    /*
    |-----------------------------
    | Relationships
    |-----------------------------
    */

    // Application belongs to a job
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    // Application belongs to a job seeker
    public function jobSeeker()
    {
        return $this->belongsTo(User::class, 'job_seeker_id');
    }
}