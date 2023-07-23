<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rotate extends Model
{
    use HasFactory;
    protected $table = 'rotates';
    protected $guarded = ['id'];
}
