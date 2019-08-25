<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Authenticatable
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'permissions';

    protected $fillable = [
        'name', 'display_name','description', 'resource','is_common',
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    public function permissionrole()
    {
        return $this->belongsToMany('App\PermissionRole', 'permission_role', 'permission_id', 'id');
    }
}
