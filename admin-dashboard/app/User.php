<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = ['deleted_at'];

    public function role()
    {
        return $this->hasOne('App\Role', 'id', 'role_id');
    }

    public function userType()
    {
        return $this->user_type;
    }

    public  function  isStaff()
    {
        if($this->user_type == 'staff'){
            return true;
        }else{
            false;
        }
    }

    public function isSuperAdmin()
    {
        if($this->role()->first()->name == 'super_admin'){
            return true;
        }else{
            return false;
        }
    }

    public function plans()
    {
        return $this->hasMany('App\Plan', 'user_id', 'id');
    }
}
