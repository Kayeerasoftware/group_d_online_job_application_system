<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    protected $fillable = ['title', 'description', 'company_name', 'location', 'salary', 'job_type', 'deadline', 'user_id'];

    protected $casts = ['deadline' => 'date'];

    public function employer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'job_id');
    }
}
