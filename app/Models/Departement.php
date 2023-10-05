<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_code',
        'name',
        'is_active',
        'branch_id',
        'description',
        'created_by'
    ];
    protected $table = 'departements';


    // public function departement_head()
    // {
    //     return $this->belongsTo(Employee::class, 'departement_head_id');
    // }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
