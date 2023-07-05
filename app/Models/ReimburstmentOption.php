<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReimburstmentOption extends Model
{
    // change name to reimburstment
    use HasFactory;
    protected $table = 'reimburstment_options';

    protected $fillable = [
        'name',
        'created_by',
    ];
}
