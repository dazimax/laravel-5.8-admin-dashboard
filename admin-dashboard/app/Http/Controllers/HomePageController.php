<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Mail;
use App\UserMessage;
use App\CMS;
use App\User;
use App\UserActivities;
use Log;
use App\CoreConfig;
use App\EmailTemplates;
use DB;
use Exception;

class HomePageController extends BaseController
{

    public function __construct()
    {
        //show system logo on each views
        $settingsObj = new CoreConfig();
        $settingsObj->setConfigurationsValues();

    }

    public function index(){
    	//return view('homepage.main');
    	return view('homepage.main')->with('cmspages', CMS::all());
    }

    public function postContact(){

    	if(Request::has('contactName') && Request::has('contactEmail') && Request::has('contactMessage')){

    		$contactUserData = Request::all();

            $userMessage =  UserMessage::create([
                'full_name' => $contactUserData['contactName'],
                'email' => $contactUserData['contactEmail'],
                'phone' => $contactUserData['contactPhone'],
                'message' => $contactUserData['contactMessage'],
                'status' => 'UNREAD',
            ]);

            if($userMessage){

                //===============================================================================
                //send emails

                //store msg data
                $emailData = array(
                    'email.contactus.contactName' => $contactUserData['contactName'],
                    'email.contactus.contactEmail' => $contactUserData['contactEmail'],
                    'email.contactus.contactPhone' => $contactUserData['contactPhone'],
                    'email.contactus.contactMessage' => $contactUserData['contactMessage'],
                    'email.contactus.system_email' => \Session::get('system_email'),
                    'email.contactus.system_name' => \Session::get('system_name')
                );

                //load emails contents
                $contactus_template = EmailTemplates::where('identifier', 'contactus_template')->first();
                $contactus_admin_template = EmailTemplates::where('identifier', 'contactus_admin_template')->first();

                //contactus_admin_template
                try{
                    Mail::send([],[], function ($m) use ($contactus_admin_template, $emailData) {
                        $m->from($emailData['email.contactus.system_email'], $emailData['email.contactus.system_name']);
                        $m->to($emailData['email.contactus.system_email'], 'Admin')
                            ->subject($contactus_admin_template->title)
                            ->setBody($contactus_admin_template->parse($emailData), 'text/html');
                    });
                }
                catch(Exception $e){
                    // Get error here
                    Log::warning('Error customer contact us Admin email not sent!', ['error : '.$e->getMessage()]);
                }

                //contactus_template
                try{
                    Mail::send([], [], function ($m) use ($contactus_template, $emailData) {
                        $m->from($emailData['email.contactus.system_email'], $emailData['email.contactus.system_name']);
                        $m->to($emailData['email.contactus.contactEmail'], $emailData['email.contactus.contactName'])
                            ->subject($contactus_template->title)
                            ->setBody($contactus_template->parse($emailData), 'text/html');
                    });
                }
                catch(Exception $e){
                    // Get error here
                    Log::warning('Error customer contact us Client email not sent!', ['error : '.$e->getMessage()]);
                }

                //===============================================================================

                $this->msg = "Details Successfully Submitted.!";
                $this->status = true;

                //record activity
                $profileId = \Auth::user()->id;
                $activityProfile = User::find($profileId);
                if($activityProfile){
                    $activityObj = new UserActivities;
                    $activityObj->addActivity($activityProfile->id, $activityProfile->name.' send message via contact us form.', 0);
                }else{
                    $activityObj = new UserActivities;
                    $activityObj->addActivity(0, 'Guest send message via contact us form.', 0);
                }

            }else{
                $this->status = false;
                $this->msg = "Unable to save your message.!";
                
            }
    		return response()->json(['status' => $this->status, 'msg' => $this->msg ]);

    	}else{
    		$msg = "Please provide necessary details.!";
    		return response()->json(['status' => false, 'msg' => $msg ]);
    	}
    }
}
