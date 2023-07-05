<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'invited_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
