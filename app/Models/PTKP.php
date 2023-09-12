<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PTKP extends Model
{
    use HasFactory;
    protected $table = 'parameter_pph21s';

    protected $guarded = ['id'];
}
