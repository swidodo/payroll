<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllowanceOption extends Model
{
    use HasFactory;

    protected $table = 'allowance_options';

    protected $fillable = [
        'name',
        'created_by',
    ];
}
