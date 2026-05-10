<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegulatoryReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'generated_by',
        'report_type',
        'content',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'generated_by');
    }
}