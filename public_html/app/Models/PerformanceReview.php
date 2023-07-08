<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceReview extends Model
{
    use HasFactory;

    protected $fillable = [
            'employee_id',
            'knowledge',
            'skill',
            'accuracy',
            'quality',
            'care',
            'reliability',
            'working_method',
            'flexibility',
            'initiative',
            'cooperation',
            'attendance',
            'organizational_commitment',
            'kpi_total_score',
            'created_by',
            'notes',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
