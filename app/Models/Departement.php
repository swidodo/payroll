<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'department_head_id',
        'branch_id',
        'is_active',
        'description'
    ];


    public function department_head()
    {
        return $this->belongsTo(Employee::class, 'department_head_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
