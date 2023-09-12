<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bpjs_value extends Model
{
    use HasFactory;
    protected $table = "bpjs_value";
    protected $guarded = ['id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function master_bpjs()
    {
        return $this->belongsTo(Master_bpjs::class, 'bpjs_id');
    }
}
