<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetPTKP extends Model
{
    use HasFactory;
    protected $table = 'set_ptkp';

    protected $fillable = [
        'employee_id',
        'ptkp_name',
        'created_by',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
