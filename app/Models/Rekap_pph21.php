<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekap_pph21 extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'rekap_pph21s';
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
