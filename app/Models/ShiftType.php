<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'created_by',
        'day_type_id',
        'start_time',
        'end_time',
        'is_wfh',
    ];

    public function break_time()
    {
        return $this->hasMany(BreakTime::class, 'shift_type_id');
    }
}
