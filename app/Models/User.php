<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'branch_id',
        'name',
        'email',
        'password',
        'type',
        'avatar',
        'lang',
        'mode',
        'delete_status',
        'plan',
        'plan_expire_date',
        'requested_plan',
        'last_login_at',
        'initial',
        'created_by',
        'fcm_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function creatorId()
    {
        if ($this->type == 'company' || $this->type == 'super admin') {
            return $this->id;
        } else {
            return $this->created_by;
        }
    }

    public function ownerDetails()
    {

        if ($this->type == 'company' || $this->type == 'super admin') {
            return User::where('id', $this->id)->first();
        } else {
            return User::where('id', $this->created_by)->first();
        }
    }


    public function branches()
    {
        return $this->hasMany(Branch::class, 'created_by');
    }

    public function employee()
    {
        return $this->hasOne(Employee::class, 'user_id');
    }

    public static function employeeIdFormat($branch_id, $number)
    {
        $settings = Utility::settings();
        $branch = Branch::find($branch_id);

        if (!is_null($branch)) {
            return $branch->alias . sprintf("%05d", $number);
        }

        return $settings["employee_prefix"] . sprintf("%05d", $number);
    }

    public function dateFormat($date)
    {
        $settings = Utility::settings();

        return date($settings['site_date_format'], strtotime($date));
    }
}
