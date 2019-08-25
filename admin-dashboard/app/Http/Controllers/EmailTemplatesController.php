<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\CMS;
use Illuminate\Routing\Redirector;
use App\User;
use App\UserActivities;
use App\Role;
use App\EmailTemplates;
use App\CoreConfig;

class EmailTemplatesController extends Controller
{
    public function __construct()
    {
        //show system logo on each views
        $settingsObj = new CoreConfig();
        $settingsObj->setConfigurationsValues();
    }

    public function createNewEmailTemplate(){
        return view('profilepage.cms.emailtemplate');
    }

    public function getEmailTemplates(){

        return view('profilepage.cms.emailtemplates')->with('emailtemplates', EmailTemplates::all());
    }

    public function viewEmailTemplate($emailTemplateId){

        $this->status = true;

        if(empty($emailTemplateId)){
            $this->msg = "Page must be load!";
            $this->status = false;
        }

        $isTemplate = EmailTemplates::where('id',$emailTemplateId)->exists();
        if($isTemplate){
            //update
            $templateObj = EmailTemplates::find($emailTemplateId);
            
            //record activity
            $profileId = \Auth::user()->id;
            $activityProfile = User::find($profileId);
            $activityObj = new UserActivities;
            $activityObj->addActivity($activityProfile->id, $activityProfile->name.' view Email Template '.$templateObj->title, 0);

           return view('profilepage.cms.emailtemplate')->with('emailtemplate', $templateObj);
        }

    }

    public function removeEmailTemplate($emailTemplateId){

        $this->status = true;

        if(empty($emailTemplateId)){
            $this->msg = "Page must be load!";
            $this->status = false;
        }

        if($this->status){
            $isTemplate = EmailTemplates::where('id',$emailTemplateId)->exists();
            if($isTemplate){
                //remove
                $templateObj = EmailTemplates::find($emailTemplateId);
                $templateObj->delete();

                //record activity
                $profileId = \Auth::user()->id;
                $activityProfile = User::find($profileId);
                $activityObj = new UserActivities;
                $activityObj->addActivity($activityProfile->id, $activityProfile->name.' remove Email Template '.$templateObj->title, 0);

            }

            return redirect('email/templates');
        }
        else{
            return back()->withErrors($this->msg);
        }

    }

    public function saveEmailTemplate(Request $requestObj){

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

            $templateId = $requestParams['id'];
            $isTemplate = EmailTemplates::where('id',$templateId)->exists();
            if($isTemplate){
                //update
                $templateObj = EmailTemplates::find($templateId);
                $templateObj->id = $requestParams['id'];
                $templateObj->title = $requestParams['title'];
                $templateObj->identifier = $requestParams['identifier'];
                $templateObj->content = $requestParams['content'];
                $templateObj->visible = $requestParams['visible'];

                $templateObj->save();

                //record activity
                $profileId = \Auth::user()->id;
                $activityProfile = User::find($profileId);
                $activityObj = new UserActivities;
                $activityObj->addActivity($activityProfile->id, $activityProfile->name.' update Email Template '.$templateObj->title, 0);


            }else{
                //insert
                $templateObj = new EmailTemplates;
                $templateObj->title = $requestParams['title'];
                $templateObj->identifier = $requestParams['identifier'];
                $templateObj->content = $requestParams['content'];
                $templateObj->visible = $requestParams['visible'];
                $templateObj->save();

                //record activity
                $profileId = \Auth::user()->id;
                $activityProfile = User::find($profileId);
                $activityObj = new UserActivities;
                $activityObj->addActivity($activityProfile->id, $activityProfile->name.' add new Email Template '.$templateObj->title, 0);

            }

            return view('profilepage.cms.emailtemplate')->with(['emailtemplate'=>$templateObj]);

        }
        else{
            return back()->withErrors($this->msg);
        }

    }
}
