<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'start_date',
        'end_date',
        'client',
        'project_image',
        'budget',
        'estimated_hrs',
        'project_stage_id',
        'description',
        'status',
        'tags',
        'created_by'
    ];

    public static $project_status = [
        'in_progress' => 'In Progress',
        'on_hold' => 'On Hold',
        'complete' => 'Complete',
        'canceled' => 'Canceled'
    ];

    public static $status_color = [
        'on_hold' => 'warning',
        'in_progress' => 'info',
        'complete' => 'success',
        'canceled' => 'danger',
    ];

    public function user_in_project()
    {
        return $this->hasMany(ProjectUser::class, 'project_id');
    }
}
