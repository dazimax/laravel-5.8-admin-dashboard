<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add default permission roles
        DB::table('permission_role')->delete();

        $permissionList = Permission::all();

        //add super admin role permissions
        $role = Role::where('name','super_admin')->get()->first();
        $roleId = $role->id;
        $superadminExcludePermissons = [];

        foreach($permissionList as $permission){
            $permissionRoleRow = [
                'role_id' => $roleId,
                'permission_id' => $permission->id,
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
            ];
            DB::table('permission_role')->insert($permissionRoleRow);
        }

        //================
        //add admin role permissions
        $role = Role::where('name','admin')->get()->first();
        $roleId = $role->id;
        $excludePermissons = [
            'UserController@createNewUser',
            'UserController@getUsers',
            'UserController@removeUser',
            'UserController@saveUser',
            'RoleController@createNewRole',
            'RoleController@getRoles',
            'RoleController@removeRole',
            'RoleController@viewRole',
            'RoleController@saveRole',
            'CMSController@createNewPage',
            'CMSController@getPages',
            'CMSController@viewPage',
            'CMSController@removePage',
            'CMSController@getPages',
            'CMSController@savePage',
            'SettingsController@saveConfigurations',
            'SettingsController@getConfigurations'
        ];

        foreach($permissionList as $permission){

            if(!in_array($permission->description, $excludePermissons)){
                $permissionRoleRow = [
                    'role_id' => $roleId,
                    'permission_id' => $permission->id,
                    'status' => 1,
                    'created_at' => date("Y-m-d H:i:s"),
                ];
                DB::table('permission_role')->insert($permissionRoleRow);
            }

        }

        //================
        //add user role permissions
        $role = Role::where('name','user')->get()->first();
        $roleId = $role->id;
        $excludePermissons = [
            'UserController@createNewUser',
            'UserController@getUsers',
            'UserController@getClients',
            'UserController@removeUser',
            'UserController@viewUser',
            'UserController@saveUser',
            'RoleController@createNewRole',
            'RoleController@getRoles',
            'RoleController@removeRole',
            'RoleController@viewRole',
            'RoleController@saveRole',
            'CMSController@removePage',
            'UserController@getDashboard',
            'CMSController@createNewPage',
            'CMSController@getPages',
            'CMSController@viewPage',
            'CMSController@savePage',
            'UserController@getActiveUserCount'
        ];

        foreach($permissionList as $permission){

            if(!in_array($permission->description, $excludePermissons)){
                $permissionRoleRow = [
                    'role_id' => $roleId,
                    'permission_id' => $permission->id,
                    'status' => 1,
                    'created_at' => date("Y-m-d H:i:s"),
                ];
                DB::table('permission_role')->insert($permissionRoleRow);
            }

        }
    }
}
