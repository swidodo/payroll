<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyRate extends Model
{
    use HasFactory;
    protected $table = 'ter_monthly_rate_pph21';
    protected $guarded = ['id'];
}
