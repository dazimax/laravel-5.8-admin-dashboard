<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Role;
use App\Permission;
use App\PermissionRole;
use App\User;
use App\UserActivities;
use Illuminate\Routing\Redirector;
use DB;
use App\CoreConfig;

class RoleController extends Controller
{
    public function __construct()
    {
        //show system logo on each views
        $settingsObj = new CoreConfig();
        $settingsObj->setConfigurationsValues();

    }

    public function createNewRole(){

        //load the permissions
        $permissionsList = Permission::all();

        return view('auth.access.userrole')->with(['permissions'=>$permissionsList]);
    }

    public function getRoles(){

        return view('auth.access.userroles')->with('roles', Role::all());
    }

    public function viewRole($roleId){

        $this->status = true;

        if(empty($roleId)){
            $this->msg = "Role must be load!";
            $this->status = false;
        }

        if($this->status){
            $isRole = Role::where('id',$roleId)->exists();
            if($isRole){
                //update

                //load the permissions
                $permissionsList = Permission::all();

                //load role assigned permissions
                $rolePermissionsList = Role::getRolePermissions($roleId);

                //load role
                $roleObj = Role::find($roleId);

                //record activity
                $profileId = \Auth::user()->id;
                $activityProfile = User::find($profileId);
                $activityObj = new UserActivities;
                $activityObj->addActivity($activityProfile->id, $activityProfile->name.' view user roles', 0);


                return view('auth.access.userrole')->with(['role'=>$roleObj, 'permissions'=>$permissionsList, 'rolepermissions'=>$rolePermissionsList]);
            }
            else{
                $this->msg = "Role not exists!";
                return back()->withErrors($this->msg);
            }


        }
        else{
            return back()->withErrors($this->msg);
        }

    }

    public function removeRole($roleId){

        $this->status = true;

        if(empty($roleId)){
            $this->msg = "Role must be load!";
            $this->status = false;
        }

        if($this->status){
            $isRole = Role::where('id',$roleId)->exists();
            if($isRole){
                //remove
                $roleObj = Role::find($roleId);
                $roleObj->delete();

                //record activity
                $profileId = \Auth::user()->id;
                $activityProfile = User::find($profileId);
                $activityObj = new UserActivities;
                $activityObj->addActivity($activityProfile->id, $activityProfile->name.' remove user role '.$roleObj->name, 0);
            }

            return redirect('user/access/roles');
        }
        else{
            return back()->withErrors($this->msg);
        }

    }

    public function saveRole(Request $requestObj){

        $this->status = true;
        $requestParams = $requestObj::all();

        if(empty($requestParams['name'])){
            $this->msg = "Please provide all the necessary details.!";
            $this->status = false;
        }

        if($this->status){

            if(!isset($requestParams['status'])) $requestParams['status'] = 0;

            $roleId = $requestParams['id'];
            $isRole = Role::where('id',$roleId)->exists();
            if($isRole){
                //update
                $roleObj = Role::find($roleId);
                $roleObj->id = $requestParams['id'];
                $roleObj->name = $requestParams['name'];
                $roleObj->display_name = $requestParams['display_name'];
                $roleObj->description = $requestParams['description'];
                $roleObj->status = $requestParams['status'];
                $roleObj->created_at = date("Y-m-d H:i:s");
                $roleObj->save();

                //update the role permissions
                $this->assignPermissionsToRole($roleObj->id, $requestParams['permissionIds']);

                //record activity
                $profileId = \Auth::user()->id;
                $activityProfile = User::find($profileId);
                $activityObj = new UserActivities;
                $activityObj->addActivity($activityProfile->id, $activityProfile->name.' update user role '.$roleObj->name, 0);


            }else{
                //insert
                $roleObj = new Role;
                $roleObj->id = $requestParams['id'];
                $roleObj->name = $requestParams['name'];
                $roleObj->display_name = $requestParams['display_name'];
                $roleObj->description = $requestParams['description'];
                $roleObj->status = $requestParams['status'];
                $roleObj->created_at = date("Y-m-d H:i:s");
                $roleObj->save();

                //update the role permissions
                $this->assignPermissionsToRole($roleObj->id, $requestParams['permissionIds']);

                //record activity
                $profileId = \Auth::user()->id;
                $activityProfile = User::find($profileId);
                $activityObj = new UserActivities;
                $activityObj->addActivity($activityProfile->id, $activityProfile->name.' add user role '.$roleObj->name, 0);


            }

            //load the permissions
            $permissionsList = Permission::all();

            //load role assigned permissions
            $rolePermissionsList = Role::getRolePermissions($roleObj->id);

            return view('auth.access.userrole')->with(['role'=>$roleObj, 'permissions'=>$permissionsList, 'rolepermissions'=>$rolePermissionsList]);

        }
        else{
            return back()->withErrors($this->msg);
        }

    }

    public function assignPermissionsToRole($roleId, $permissionList){

        DB::table('permission_role')->where('role_id', '=', $roleId)->delete();

        for($i=0; $i < count($permissionList); $i++){

            $permissionRow = array(
                'role_id' => $roleId,
                'status'  => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'permission_id' => $permissionList[$i]
            );

            $permissionRoleObj = new PermissionRole;
            $permissionRoleObj->role_id = $permissionRow['role_id'];
            $permissionRoleObj->status = $permissionRow['status'];
            $permissionRoleObj->created_at = $permissionRow['created_at'];
            $permissionRoleObj->permission_id = $permissionRow['permission_id'];
            $permissionRoleObj->save();
        }

        //record activity
        $roleObj = Role::find($roleId);

        $profileId = \Auth::user()->id;
        $activityProfile = User::find($profileId);
        $activityObj = new UserActivities;
        $activityObj->addActivity($activityProfile->id, $activityProfile->name.' assigned permissions to user role '.$roleObj->name, 0);

    }

}
