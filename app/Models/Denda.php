<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    use HasFactory;

    protected $fillable = [
        'day_type_id',
        'time',
        'amount',
        'created_by',
    ];

    public function day_type()
    {
        return $this->belongsTo(DayType::class, 'day_type_id');
    }
}
