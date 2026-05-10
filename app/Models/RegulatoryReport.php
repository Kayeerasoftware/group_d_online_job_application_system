<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
=======
use App\Enums\ReportStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce

class RegulatoryReport extends Model
{
    use HasFactory;

    protected $fillable = [
<<<<<<< HEAD
        'generated_by',
        'report_type',
        'content',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'generated_by');
    }
}
=======
        'report_type',
        'generated_by',
        'date_range_start',
        'date_range_end',
        'aggregated_data',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'date_range_start' => 'date',
            'date_range_end' => 'date',
            'aggregated_data' => 'array',
            'status' => ReportStatus::class,
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'generated_by');
    }

    public function statusValue(): string
    {
        return $this->status instanceof ReportStatus ? $this->status->value : (string) $this->status;
    }
}
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
