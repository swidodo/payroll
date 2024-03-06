<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MontlyRateRelative extends Model
{
    use HasFactory;
    protected $table="ter_category_pph21";
    protected $guarded = ['id'];
}
