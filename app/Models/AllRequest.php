<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'request_no',
        'request_for',
        'request_by',
        'request_type',
        'req_date',
        'created_by',
        'status',
    ];
}
