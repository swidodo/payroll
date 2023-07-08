<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetBpjsTK extends Model
{
    use HasFactory;
    protected $table = 'set_bpjstk';

    protected $fillable = [
        'employee_id',
        'bpjstk_name',
        'created_by',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
