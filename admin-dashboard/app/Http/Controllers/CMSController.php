<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\CMS;
use Illuminate\Routing\Redirector;
use App\User;
use App\UserActivities;
use App\Role;
use App\CoreConfig;

class CMSController extends Controller
{
    public function __construct()
    {
        //show system logo on each views
        $settingsObj = new CoreConfig();
        $settingsObj->setConfigurationsValues();
    }

    public function createNewPage(){
        return view('profilepage.cms.cmspage');
    }

    public function getPages(){

        return view('profilepage.cms.cmspages')->with('cmspages', CMS::all());
    }

    public function viewPage($pageId){

        $this->status = true;

        if(empty($pageId)){
            $this->msg = "Page must be load!";
            $this->status = false;
        }

        if($this->status){
            $isPage = CMS::where('pageId',$pageId)->exists();
            if($isPage){
                //update
                $cmsObj = CMS::find($pageId);

                //record activity
                $profileId = \Auth::user()->id;
                $activityProfile = User::find($profileId);
                $activityObj = new UserActivities;
                $activityObj->addActivity($activityProfile->id, $activityProfile->name.' view page '.$cmsObj->title, 0);

                return view('profilepage.cms.cmspage')->with('cmspage', $cmsObj);
            }
            else{
                $this->msg = "Page not exists!";
                return back()->withErrors($this->msg);
            }


        }
        else{
            return back()->withErrors($this->msg);
        }

    }

    public function removePage($pageId){

        $this->status = true;

        if(empty($pageId)){
            $this->msg = "Page must be load!";
            $this->status = false;
        }

        if($this->status){
            $isPage = CMS::where('pageId',$pageId)->exists();
            if($isPage){
                //remove
                $cmsObj = CMS::find($pageId);
                $cmsObj->delete();

                //record activity
                $profileId = \Auth::user()->id;
                $activityProfile = User::find($profileId);
                $activityObj = new UserActivities;
                $activityObj->addActivity($activityProfile->id, $activityProfile->name.' remove page '.$cmsObj->title, 0);

            }

            return redirect('user/profile/cms/pages');
        }
        else{
            return back()->withErrors($this->msg);
        }

    }

    public function savePage(Request $requestObj){

        $this->status = true;
        $requestParams = $requestObj::all();

        if(empty($requestParams['title']) || empty($requestParams['content'])){
            $this->msg = "Please provide all the necessary details.!";
            $this->status = false;
        }

        if($this->status){

            if(empty($requestParams['identifier'])){
                $requestParams['identifier'] = str_replace(' ', '-', strtolower($requestParams['title']));
            }
            if(!isset($requestParams['visible'])) $requestParams['visible'] = 0;

            $pageId = $requestParams['pageId'];
            $isPage = CMS::where('pageId',$pageId)->exists();
            if($isPage){
                //update
                $cmsObj = CMS::find($pageId);
                $cmsObj->pageId = $requestParams['pageId'];
                $cmsObj->title = $requestParams['title'];
                $cmsObj->identifier = $requestParams['identifier'];
                $cmsObj->content = $requestParams['content'];
                $cmsObj->visible = $requestParams['visible'];

                $cmsObj->save();

                //record activity
                $profileId = \Auth::user()->id;
                $activityProfile = User::find($profileId);
                $activityObj = new UserActivities;
                $activityObj->addActivity($activityProfile->id, $activityProfile->name.' update page '.$cmsObj->title, 0);


            }else{
                //insert
                $cmsObj = new CMS;
                $cmsObj->title = $requestParams['title'];
                $cmsObj->identifier = $requestParams['identifier'];
                $cmsObj->content = $requestParams['content'];
                $cmsObj->visible = $requestParams['visible'];
                $cmsObj->save();

                //record activity
                $profileId = \Auth::user()->id;
                $activityProfile = User::find($profileId);
                $activityObj = new UserActivities;
                $activityObj->addActivity($activityProfile->id, $activityProfile->name.' add new page '.$cmsObj->title, 0);

            }

            return view('profilepage.cms.cmspage')->with(['cmspage'=>$cmsObj]);

        }
        else{
            return back()->withErrors($this->msg);
        }

    }
}
