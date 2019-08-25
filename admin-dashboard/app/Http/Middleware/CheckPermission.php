<?php

namespace App\Http\Middleware;

use Closure;
use App\Permission;
use App\Role;
use App\CoreConfig;

class CheckPermission
{
    public function __construct()
    {
        //show system logo on each views
        $settingsObj = new CoreConfig();
        $settingsObj->setConfigurationsValues();
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //developing purpose only
        $debugMode = true;

        $user = \Auth::user();
        $rolePermissionList = Role::getRolePermissions($user->role_id);

        $whitelist = array();
        foreach($rolePermissionList as $rolePermission){
            $whiteListPermission = Permission::find($rolePermission->permission_id);
            array_push($whitelist, $whiteListPermission->resource);
        }

        $resource = \Route::getCurrentRoute()->getActionName();

        $whitelistajax = array(
            "App\\Http\\Controllers\\ActivityController@getAjaxActivities",
            "App\\Http\\Controllers\\ActivityController@getAjaxActivitiesListItems",
        );

        if ($request->has('trackingcode') && in_array($resource, $whitelistajax)) {
            $trackingcodepin = md5(\Auth::user()->id).md5('polygon');
            if($trackingcodepin != $request->trackingcode){
                abort(403, 'Unauthorized action.');
            }
        }
        else{
            if(!in_array($resource, $whitelist) && $debugMode == false){
                abort(403, 'Unauthorized action.');
            }
        }

        return $next($request);
    }
}
