<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupPositionModel extends Model
{
    use HasFactory;
    protected $table = 'group_positions';
    protected $guarded = ['id'];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id');
    }
     public function departement()
    {
        return $this->belongsTo(Employee::class, 'departement_id');
    }
}
