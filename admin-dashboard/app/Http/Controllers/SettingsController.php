<?php

namespace App\Http\Controllers;

use App\Departments;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as ValidationRequest;
use App\Http\Requests;
use App\DataSet;
use App\DataSetAdditional;
use App\DataSetSecondary;
use App\UserChart;
use App\User;
use App\UserActivities;
use App\Role;
use App\UserDepartment;
use App\CoreConfig;
use DB;

class SettingsController extends BaseController
{

    public function saveConfigurations(ValidationRequest $requestObj){

        $configurations_list = array();
        $configObj = array();
        $this->status = true;
        $requestParams = Request::all();

            if(empty($requestParams['system_email'])){
                $this->msg = "Please provide all the necessary details.!";
                $this->status = false;
            }

            $image = $requestObj->file('logo_image');
            if($image != null){

                $file_extension = $requestObj->file('logo_image')->getMimeType();
                if($file_extension == 'image/jpeg' || $file_extension == 'image/jpg' || $file_extension == 'image/png'){
                    $this->status = true;
                }
                else{
                    $this->msg = "Please upload correct logo image!";
                    $this->status = false;
                }
            }

            $client_cover_profile_image = $requestObj->file('common_client_profile_coverpic_image');
            if($client_cover_profile_image != null){

                $file_extension = $requestObj->file('common_client_profile_coverpic_image')->getMimeType();
                if($file_extension == 'image/jpeg' || $file_extension == 'image/jpg' || $file_extension == 'image/png'){
                    $this->status = true;
                }
                else{
                    $this->msg = "Please upload correct client cover profile image!";
                    $this->status = false;
                }
            }

                if(!isset($requestParams['visible'])) $requestParams['visible'] = 1;

                if($image != null){
                    $logoimgname = 'logo_image'.'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/media/system');
                    $destinationImagePath = '/media/system';
                    $image->move($destinationPath, $logoimgname);

                    $logoimagepath = $destinationImagePath.'/'.$logoimgname;
                }

                if($client_cover_profile_image != null){
                    $client_cover_profile_imgname = 'client_cover_profile_image'.'.'.$client_cover_profile_image->getClientOriginalExtension();
                    $destinationPath = public_path('/media/system');
                    $destinationImagePath = '/media/system';
                    $client_cover_profile_image->move($destinationPath, $client_cover_profile_imgname);

                    $client_cover_profile_image_path = $destinationImagePath.'/'.$client_cover_profile_imgname;
                }

                    //update configurations in form
                    $config_keys = array_keys($requestParams); 
                    for($i = 0; $i < count($config_keys); $i++){

                        if($config_keys[$i] == 'id' || $config_keys[$i] == '_token'){
                            continue;
                        }

                        if($config_keys[$i] == 'visible'){
                            continue;
                        }

                        //logo image path check
                        if($config_keys[$i] == 'logo_image' && $requestParams[$config_keys[$i]] != null){
                            $requestParams[$config_keys[$i]] = $logoimagepath;
                        }

                        //client_cover_profile image path check
                        if($config_keys[$i] == 'common_client_profile_coverpic_image' && $requestParams[$config_keys[$i]] != null){
                            $requestParams[$config_keys[$i]] = $client_cover_profile_image_path;

                            //update all the Client user type profile cover images
                            $updateClientRecords = DB::table('users')->where('user_type', '=', 'Client')->update(array('coverpic_image' => $client_cover_profile_image_path));
                        }

                        $isConfigObj = CoreConfig::where('key', '=' ,$config_keys[$i])->exists(); 
                        if($isConfigObj){
                            $configObj = CoreConfig::where('key', '=' ,$config_keys[$i])->firstOrFail();
                            $configObj->key = $config_keys[$i];
                            $configObj->field = $config_keys[$i];
                            $configObj->value = $requestParams[$config_keys[$i]];
                            $configObj->save();
                        }       
                        else{
                            $configObj = new CoreConfig();
                            $configObj->key = $config_keys[$i];
                            $configObj->field = $config_keys[$i];
                            $configObj->value = $requestParams[$config_keys[$i]];
                            $configObj->save();
                        }    

                    }
 
                    //record activity
                    $profileId = \Auth::user()->id;
                    $activityProfile = User::find($profileId);
                    $activityObj = new UserActivities;
                    $activityObj->addActivity($activityProfile->id, $activityProfile->name.' save system configurations.', 0);
                    
                    $configurations_list = DB::table('core_config')
                        ->select('core_config.*')
                        ->where(['core_config.deleted_at' => null])
                        ->get();

            return view('settings.'.$requestParams['_action'])->with(['configurations'=>$configurations_list]);
    }

    public function getConfigurations(){

        $configurations_list = DB::table('core_config')
                            ->select('core_config.*')
                            ->where(['core_config.deleted_at' => null])
                            ->get();
        return view('settings.configurations')->with(['configurations'=>$configurations_list]);
    }

    public function getEmailConfigurations(){

        $configurations_list = DB::table('core_config')
            ->select('core_config.*')
            ->where(['core_config.deleted_at' => null])
            ->get();

        return view('settings.emailconfigurations')->with(['configurations'=>$configurations_list]);
    }
}
