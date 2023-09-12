<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'departement_head_id',
        'branch_id',
        'is_active',
        'description',
        'created_by'
    ];


    public function departement_head()
    {
        return $this->belongsTo(Employee::class, 'departement_head_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
