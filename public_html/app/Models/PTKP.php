<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PTKP extends Model
{
    use HasFactory;
    protected $table = 'ptkp';

    protected $fillable = [
        'status_name',
        'ptkp_amount',
        'created_by'
    ];
}
