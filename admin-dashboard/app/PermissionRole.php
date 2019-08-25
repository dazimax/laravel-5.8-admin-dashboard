<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionRole extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'permission_role';

    protected $fillable = [
        'role_id', 'perission_id','status'
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    public function permission()
    {
        $this->hasMany('App\Permission', 'id', 'permission_id');
    }

    public function role()
    {
        $this->hasMany('App\Role', 'id', 'role_id');
    }
}
