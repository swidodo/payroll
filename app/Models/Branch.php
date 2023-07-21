<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'alias',
        'company_id',
        'created_by',
    ];
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

}
