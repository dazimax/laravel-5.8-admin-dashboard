<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as ValidationRequest;
use App\User;
use App\UserActivities;
use App\Role;
use DB;
use App\CoreConfig;

class ActivityController extends Controller
{

    public function __construct()
    {
        //show system logo on each views
        $settingsObj = new CoreConfig();
        $settingsObj->setConfigurationsValues();
    }

    public function getActivities(){

        $activityObj = new UserActivities();
        $activityList = $activityObj->getActivities();

        foreach($activityList as $activity){
            $activity->created_at = $activityObj->getHumanTime($activity->created_at);
        }

        return view('auth.access.userhistory')->with(['activities'=>$activityList]);
    }

    public function getAjaxActivities(){

        $activityObj = new UserActivities();
        $activityList = $activityObj->getActivities();

        foreach($activityList as $activity){
            $activity->created_at = $activityObj->getHumanTime($activity->created_at);
        }

        if(isset($activityList)){
            foreach ($activityList as $activity){
                echo '<tr><td>'.$activity->id.'</td><td>'.$activity->created_at.'</td><td>'.$activity->name.'</td><td>'.$activity->email.'</td><td><strong>'.$activity->activity.'</strong></td></tr>';
            }
        }

    }

    public function getAjaxActivitiesListItems(){

        $activityObj = new UserActivities();
        $activityList = $activityObj->getNotifyActivities();

        foreach($activityList as $activity){
            $activity->created_at = $activityObj->getHumanTime($activity->created_at);
        }

        if(isset($activityList)){
            foreach ($activityList as $activity){
                echo '<li class="media">
                        <a href="#">
                            <p><strong>'.$activity->activity.'</strong>
                            <br /><i>'.$activity->created_at.'</i></p>
                        </a>
                    </li>';
            }
        }

    }

    public function getNotifyActivities(){

        $activityObj = new UserActivities();
        $notifyList = $activityObj->getNotifyActivities();

        echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-globe"></i><span class="label label-danger absolute">'.count($notifyList).'</span></a>';
        echo '<ul class="dropdown-menu dropdown-message notify-ul-messages" style="height:300px;overflow-x: scroll;width: 315px;" >';
        echo '<li class="dropdown-header notif-header"><i class="icon-bell-2"></i> Notifications<a class="pull-right" href="#"><!--<i class="fa fa-cog"></i>--></a></li>';
        echo '<li class="dropdown-footer">
                            <div class="btn-group btn-group-justified">
                                <div class="btn-group">
                                    <a href="#" id="clear-all-notification-btn" class="btn btn-sm btn-danger clear-all-notification-btn"><i class="icon-trash-3"></i> Clear All</a>
                               </div>
                                <div class="btn-group">
                                    <a href="/user/profile" class="btn btn-sm btn-success">See All <i class="icon-right-open-2"></i></a>
                                </div>
                            </div>
                        </li>';

        foreach($notifyList as $notify){
            $notify->created_at = $activityObj->getHumanTime($notify->created_at);
            if($notify->is_viwed == 1){
                echo '<li class="unread" style="color:#4C5264;background:rgba(0,0,0,0.06);">
                  <a href="#">
                       <p>'.$notify->activity.'</strong>
                           <br><i>'.$notify->created_at.'</i>
                       </p>
                  </a>
               </li>';
            }
            else{
               echo '<li class="unread" >
                  <a href="#">
                       <p>'.$notify->activity.'</strong>
                           <br><i>'.$notify->created_at.'</i>
                       </p>
                  </a>
              </li>';
            }


        }
        echo '</ul>';

    }

    public function viewAllNotifyActivities(){

        $profileId = \Auth::user()->id;

        DB::table('user_activities')
            ->where('is_notification', 1)
            ->update(array('is_viwed' => 1, 'user_id' => $profileId));
    }
}
