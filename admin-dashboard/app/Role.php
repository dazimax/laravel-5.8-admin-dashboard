<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\PermissionRole;
use App\DB;

class Role extends Authenticatable
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'roles';

    protected $fillable = [
        'name', 'display_name','description', 'status',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User', 'role_id', 'id');
    }

    public function permissionrole()
    {
        return $this->belongsToMany('App\PermissionRole', 'permission_role', 'role_id', 'id');
    }

    public static function getRolePermissions($roleId){
        return $rolePermissionsArray = PermissionRole::where('role_id', $roleId)->get();
    }

    public function getCurrentUserRoleName(){

        $userId = \Auth::user()->id;

        if($userId != null){
            //get user role details
            $user_role_details = \DB::table('users')
                ->select('users.*','roles.*')
                ->join('roles','roles.id','=','users.role_id')
                ->where([
                    'users.deleted_at' => null,
                    'users.id' => $userId
                ])
                ->get();

            if(count($user_role_details) > 0){
                foreach($user_role_details as $user_role){
                    return $user_role->name;
                }    
            }    
        }
        else{
            //default user role
            return 'user';
        }
        
    }
}
