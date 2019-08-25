<?php

namespace App\Http\Controllers;

use Log;
use Validator;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as ValidationRequest;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Redirect;
use App\Http\Controllers\Session;
use Hash;
use App\User;
use App\UserActivities;
use App\Departments;
use App\Country;
use App\Role;
use DB;
use App\UserDepartment;
use App\CoreConfig;
use App\EmailTemplates;

class UserController extends BaseController
{

    public function __construct()
    {
        //show system logo on each views
        $settingsObj = new CoreConfig();
        $settingsObj->setConfigurationsValues();
    }

	public function postLogin(){

        if(!Request::has('email') || !Request::has('password')){
    		$this->msg = "Invalid Credentials.!";
    		$this->status = false;
		}else{
			$checkUser = User::where('email',Request::get('email'))->first();
			if(!$checkUser){
	    		$this->msg = "Invalid Credentials.!";
	    		$this->status = false;
			}else{
				$hashedPassword = $checkUser->password;
				if(Hash::check(Request::get('password'), $hashedPassword)){
					$this->status = true;
					//\Auth::login($checkUser);
                    //$this->msg = 'Login successfull.!';
                    //$this->status = true;

                    $credentials = array('email' => Request::get('email'), 'password' => Request::get('password'));

                    if (\Auth::attempt($credentials, true))
                    {
                        //check active user or not
                        $profileId = \Auth::user()->id;
                        $isProfile = User::where('id',$profileId)->where('status',1)->get()->first();
                        if($isProfile){
                            $this->msg = 'Login successfull..!';
                            $this->status = true;

                            //record activity
                            $profileId = \Auth::user()->id;
                            $activityProfile = User::find($profileId);
                            $activityObj = new UserActivities;
                            $activityObj->addActivity($activityProfile->id, $activityProfile->name.' Online.');

                        }
                        else{
                            $this->msg = "Account is still not yet activated..!";
                            $this->status = false;
                        }

                    }else{
                        $this->msg = "Invalid Credentials..!";
                        $this->status = false;
                    }

				}else{
		    		$this->msg = "Invalid Credentials..!";
		    		$this->status = false;
				}
			}
		}
		if(Request::ajax()){
			return response()->json(['status' => $this->status, 'msg' => $this->msg ]);
		}else{
			if($this->status){
				//return redirect()->route('home');
                return redirect()->intended('user/profile');
			}else{
				return back()->withErrors($this->msg);	
            }
		}
	}

	public function postRegister(ValidationRequest $request){

	    $validator = Validator::make(Request::all(),[
	        'g-recaptcha-response' => 'required|recaptcha'
	    ]);

	    //capcha check only
	    if ($validator->fails()) {
	    	return response()->json(['status' => false, 'msg' => 'Please prove that you are a human.!' ]);
	    }

		if(!Request::has('name') || !Request::has('company') || !Request::has('email') || !Request::has('password') || !Request::has('repassword')){
    		$this->msg = "Please provide all the necessary details.!";
    		$this->status = false;
		}elseif(Request::get('name') == '' || Request::get('company') == '' || Request::get('email') == '' || Request::get('password') == '' || Request::get('repassword') == ''){
			$this->msg = "Please provide all the necessary details.!";
    		$this->status = false;
		}elseif(strlen(Request::get('password')) < 5 ) {
    		$this->msg = "Password should contain atleast 5 characters !";
    		$this->status = false;
		}elseif(Request::get('password') != Request::get('repassword')){
	   		$this->msg = "Passwords should be matched.!";
    		$this->status = false;
		}else{

			$requestParams = Request::all();

            //add default user role to new account for first time account add super admin role
            $roleId = 0;
            $userList = User::all();
            if(count($userList) > 0){
                //add default user role to new account
                $role = Role::where('name','user')->get()->first();
                $roleId = $role->id;
            }else{
                //add first time user to super admin role
                $role = Role::where('name','super_admin')->get()->first();
                $roleId = $role->id;
            }

			//check an user exists with same email
			$checkUser = User::where('email',$requestParams['email'])->get();

			if($checkUser->count() > 0){
				$this->status = false;
				$this->msg = "User with this email already exists.!";
			}else{
				$user = new User();
		        $user->fill([
		        	'name' => $requestParams['name'],
		        	'email' => $requestParams['email'],
		        	'company' => $requestParams['company'],
		        	'status' => 1,
                    'role_id' => $roleId,
                    'created_at' => date("Y-m-d H:i:s"),
		            'password' => Hash::make($requestParams['password'])
		        ])->save();

                $this->status = true;
		        $this->msg = "Successfully added the User";

                //record activity
                $profileId = $user->id;
                $activityProfile = User::find($profileId);
                $activityObj = new UserActivities;
                $activityObj->addActivity($activityProfile->id, $activityProfile->name.' email '.$user->email.' successfully added to the Users list.');

                //===============================================================================
                //send emails

                //store msg data
                $emailData = array(
                    'email.register.name' => $requestParams['name'],
                    'email.register.company' => $requestParams['company'],
                    'email.register.email' => $requestParams['email'],
                    'email.register.password' => $requestParams['password'],
                    'email.register.system_email' => \Session::get('system_email'),
                    'email.register.system_name' => \Session::get('system_name')
                );

                //load emails contents
                $customer_register_admin_template = EmailTemplates::where('identifier', 'customer_register_admin_template')->first();
                $customer_register_template = EmailTemplates::where('identifier', 'customer_register_template')->first();

                //customer_register_admin_template
                try{
                    Mail::send([],[], function ($m) use ($customer_register_admin_template, $emailData) {
                        $m->from($emailData['email.register.system_email'], $emailData['email.register.system_name']);
                        $m->to($emailData['email.register.system_email'], 'Admin')
                            ->subject($customer_register_admin_template->title)
                            ->setBody($customer_register_admin_template->parse($emailData), 'text/html');
                    });
                }
                catch(Exception $e){
                    // Get error here
                    Log::warning('Customer register Admin email not sent!', ['error : '.$e->getMessage()]);
                }

                //customer_register_template
                try{
                    Mail::send([], [], function ($m) use ($customer_register_template, $emailData) {
                        $m->from($emailData['email.register.system_email'], $emailData['email.register.system_name']);
                        $m->to($emailData['email.register.email'], $emailData['email.register.name'])
                            ->subject($customer_register_template->title)
                            ->setBody($customer_register_template->parse($emailData), 'text/html');
                    });
                }
                catch(Exception $e){
                    // Get error here
                    Log::warning('Customer register Client email not sent!', ['error : '.$e->getMessage()]);
                }

                //===============================================================================

			}
		}

		if(Request::ajax()){
			return response()->json(['status' => $this->status, 'msg' => $this->msg ]);
		}else{
			if($this->status){
				\Session::flash('success',$this->msg);
				return back();
			}else{
				return back()->withErrors($this->msg);				
			}
		}
	}

    public function getDashboard(){
        //return view('layouts.user.profile');
        return view('profilepage.main');
    }

	public function getProfile(){

        $activityObj = new UserActivities();
        $activityList = $activityObj->getNotifyActivities();

        foreach($activityList as $activity){
            $activity->created_at = $activityObj->getHumanTime($activity->created_at);
        }

        return view('profilepage.profilecontent')->with(['activities'=>$activityList]);
	}

    public function createNewPage(){
        return view('profilepage.cms.cmspage');
    }

    public function getPages(){
        return view('profilepage.cms.cmspages');
    }

    public function getSettings(){

        $profileObj = array();

        if (\Auth::check()){
            $profileId = \Auth::user()->id;
            $isProfile = User::where('id',$profileId)->exists();
            if($isProfile){
                //load
                $profileObj = User::find($profileId);

                //load the countries
                $countryList = Country::pluck('name','countryId');

                //record activity
                $profileId = \Auth::user()->id;
                $activityProfile = User::find($profileId);
                $activityObj = new UserActivities;
                $activityObj->addActivity($activityProfile->id, $activityProfile->name.' view profile settings.', 0);

            }
        }

        return view('profilepage.settings')->with(['profile'=>$profileObj, 'country'=>$countryList]);
    }

    public function saveSettings(ValidationRequest $requestObj){

        $profileObj = array();
        $this->status = true;
        $requestParams = Request::all();

        if(count($requestParams) > 0){
            if(empty($requestParams['name'])){
                $this->msg = "Please provide all the necessary details.!";
                $this->status = false;
            }

            $image = $requestObj->file('profileimage');
            if($image != null){

                $file_extension = $requestObj->file('profileimage')->getMimeType();
                if($file_extension == 'image/jpeg' || $file_extension == 'image/jpg' || $file_extension == 'image/png'){
                    $this->status = true;
                }
                else{
                    $this->msg = "Please upload correct profile image!";
                    $this->status = false;
                }
            }

            $coverpic_image = $requestObj->file('coverpic_image');
            
            if($coverpic_image != null){

                $file_extension = $requestObj->file('coverpic_image')->getMimeType();
                if($file_extension == 'image/jpeg' || $file_extension == 'image/jpg' || $file_extension == 'image/png' || $file_extension == 'image/gif'){
                    $this->status = true;
                }
                else{
                    $this->msg = "Please upload correct coverpic image!";
                    $this->status = false;
                }
            }


            if($this->status){

                if(!isset($requestParams['status'])) $requestParams['status'] = 1;

                if(isset($requestParams['id'])){

                    $profileId = $requestParams['id'];
                    $isProfile = User::where('id',$profileId)->exists();
                    if($isProfile){

                        //upload image
                        if($image != null){
                            $profileimgname = $profileId.'_profile_image'.'.'.$image->getClientOriginalExtension();
                            $destinationPath = public_path('/media/profile');
                            $destinationImagePath = '/media/profile';
                            $image->move($destinationPath, $profileimgname);

                            $profileimagepath = $destinationImagePath.'/'.$profileimgname;
                        }

                        //upload cover pic image
                        if($coverpic_image != null){
                            $coverpic_image_name = $profileId.'_coverpic_image'.'.'.$coverpic_image->getClientOriginalExtension();
                            $destinationPath = public_path('/media/profile');
                            $destinationImagePath = '/media/profile';
                            $coverpic_image->move($destinationPath, $coverpic_image_name);

                            $coverpic_imagepath = $destinationImagePath.'/'.$coverpic_image_name;
                        }

                        //update
                        $profileObj = User::find($profileId);
                        $profileObj->name = $requestParams['name'];
                        $profileObj->email = $requestParams['email'];
                        $profileObj->company = $requestParams['company'];
                        if($image != null){
                            $profileObj->profileimage = $profileimagepath;
                        }
                        if($coverpic_image != null){
                            $profileObj->coverpic_image = $coverpic_imagepath;
                        }
                        $profileObj->country = $requestParams['country'];
                        //$profileObj->status = (isset($requestParams['status']))?1:0;

                        //check role_id exists if not add default role user
                        if(empty($profileObj->role_id)){
                            $role = Role::where('name','user')->get()->first();
                            $profileObj->role_id = $role->id;
                        }

                        //update password
                        if(!empty($requestParams['password'])){
                            $profileObj->password = Hash::make($requestParams['password']);
                        }

                        $profileObj->save();

                        //record activity
                        $profileId = \Auth::user()->id;
                        $activityProfile = User::find($profileId);
                        $activityObj = new UserActivities;
                        $activityObj->addActivity($activityProfile->id, $activityProfile->name.' save profile settings.', 0);
                    }
                }

                return redirect()->action('UserController@getSettings')->with(['profile'=>$profileObj]);

            }
            else{
                $errormsg = $this->msg;
                //return redirect()->action('UserController@getSettings')->with(compact('errormsg',[$errormsg]));
            }
        }
        else{
            return redirect()->action('UserController@getSettings');
        }

    }

    // User Access - User Functions
    public function createNewUser(){

        //load the countries
        $countryList = Country::pluck('name','countryId');

        //load roles
        $roleList = Role::all();

        //record activity
        $profileId = \Auth::user()->id;
        $activityProfile = User::find($profileId);
        $activityObj = new UserActivities;
        $activityObj->addActivity($activityProfile->id, $activityProfile->name.' view create new user page.', 0);

        return view('auth.access.user')->with(['roles'=>$roleList, 'country'=>$countryList]);
    }

    public function getUsers(){

        //record activity
        $profileId = \Auth::user()->id;
        $activityProfile = User::find($profileId);
        $activityObj = new UserActivities;
        $activityObj->addActivity($activityProfile->id, $activityProfile->name.' view all staff users.', 0);

        //join roles table and users table
        //$userslist = User::all()->where('user_type', 'Staff');
        $userslist = DB::table('users')->select('users.*','roles.display_name as rolename')
        ->join('roles','roles.id','=','users.role_id')
        ->whereNull('users.deleted_at')
        ->where(['user_type' => 'Staff'])->get();

        return view('auth.access.users')->with('users', $userslist);
    }

    public function getClients(){

        //record activity
        $profileId = \Auth::user()->id;
        $activityProfile = User::find($profileId);
        $activityObj = new UserActivities;
        $activityObj->addActivity($activityProfile->id, $activityProfile->name.' view all clients.', 0);

        $userslist = User::all()
        ->where('user_type', 'Client');

        return view('auth.access.clients')->with('users', $userslist);
    }

    public function viewUser($userId){

        $this->status = true;

        if(empty($userId)){
            $this->msg = "User must be load!";
            $this->status = false;
        }

        if($this->status){
            $isUser = User::where('id',$userId)->exists();
            if($isUser){
                //update
                $userObj = User::find($userId);

                //load the countries
                $countryList = Country::pluck('name','countryId');

                //load roles
                $roleList = Role::all();

                //record activity
                $profileId = \Auth::user()->id;
                $activityProfile = User::find($profileId);
                $activityObj = new UserActivities;
                $activityObj->addActivity($activityProfile->id, $activityProfile->name.' view user '.$userObj->name.' email '.$userObj->email, 0);

                return view('auth.access.user')->with(['roles'=>$roleList, 'user'=>$userObj, 'country'=>$countryList]);
            }
            else{
                $this->msg = "User not exists!";
                return back()->withErrors($this->msg);
            }


        }
        else{
            return back()->withErrors($this->msg);
        }

    }

    public function removeUser($userId){

        $this->status = true;

        if(empty($userId)){
            $this->msg = "User must be load!";
            $this->status = false;
        }

        if($this->status){
            $isUser = User::where('id',$userId)->exists();
            if($isUser){
                //remove
                $userObj = User::find($userId);
                $userType = $userObj->user_type;
                $userObj->delete();

                //record activity
                $profileId = \Auth::user()->id;
                $activityProfile = User::find($profileId);
                $activityObj = new UserActivities;
                $activityObj->addActivity($activityProfile->id, $activityProfile->name.' remove user '.$userObj->name.' email '.$userObj->email, 0);

                //redirect back to correct page
                if($userType != '' && $userType == 'Staff'){
                    return redirect()->action('UserController@getUsers')->with('users', User::all());   
                }
                else{
                    return redirect()->action('UserController@getClients')->with('users', User::all());
                }
                
            }

            return redirect('user/access/users');
        }
        else{
            return back()->withErrors($this->msg);
        }

    }

    public function saveUser(ValidationRequest $requestObj){

        $profileObj = array();
        $this->status = true;
        $requestParams = Request::all();

        if(count($requestParams) > 0){

            if(empty($requestParams['name'])){
                $this->msg = "Please provide all the necessary details.!";
                $this->status = false;
            }

            $image = $requestObj->file('profileimage');
            if($image != null){

                $file_extension = $requestObj->file('profileimage')->getMimeType();
                if($file_extension == 'image/jpeg' || $file_extension == 'image/jpg' || $file_extension == 'image/png'){
                    $this->status = true;
                }
                else{
                    $this->msg = "Please upload correct profile image!";
                    $this->status = false;
                }
            }

            $coverpic_image = $requestObj->file('coverpic_image');
            if($coverpic_image != null){

                $file_extension = $requestObj->file('coverpic_image')->getMimeType();
                if($file_extension == 'image/jpeg' || $file_extension == 'image/jpg' || $file_extension == 'image/png'){
                    $this->status = true;
                }
                else{
                    $this->msg = "Please upload correct coverpic image!";
                    $this->status = false;
                }
            }

            if($this->status){

                if(!empty($requestParams['id'])){
                    $profileId = $requestParams['id'];
                    $isProfile = User::where('id',$requestParams['id'])->exists();
                    if($isProfile){

                        //upload image
                        if($image != null){
                            $profileimgname = $profileId.'_profile_image'.'.'.$image->getClientOriginalExtension();
                            $destinationPath = public_path('/media/profile');
                            $destinationImagePath = '/media/profile';
                            $image->move($destinationPath, $profileimgname);

                            $profileimagepath = $destinationImagePath.'/'.$profileimgname;
                        }

                        //upload cover pic image
                        if($coverpic_image != null){
                            $coverpic_image_name = $profileId.'_coverpic_image'.'.'.$coverpic_image->getClientOriginalExtension();
                            $destinationPath = public_path('/media/profile');
                            $destinationImagePath = '/media/profile';
                            $coverpic_image->move($destinationPath, $coverpic_image_name);

                            $coverpic_imagepath = $destinationImagePath.'/'.$coverpic_image_name;
                        }

                        //update
                        $profileObj = User::find($profileId);
                        $profileObj->name = $requestParams['name'];
                        $profileObj->email = $requestParams['email'];
                        $profileObj->company = $requestParams['company'];
                        $profileObj->user_type = $requestParams['user_type'];
                        if($image != null){
                            $profileObj->profileimage = $profileimagepath;
                        }
                        if($coverpic_image != null){
                            $profileObj->coverpic_image = $coverpic_imagepath;
                        }
                        $profileObj->country = $requestParams['country'];
                        $profileObj->role_id = $requestParams['role_id'];
                        $profileObj->status = (isset($requestParams['status']))?1:0;


                        //update password
                        if(!empty($requestParams['password'])){
                            $profileObj->password = Hash::make($requestParams['password']);
                        }

                        $profileObj->save();

                        //record activity
                        $profileId = \Auth::user()->id;
                        $activityProfile = User::find($profileId);
                        $activityObj = new UserActivities;
                        $activityObj->addActivity($activityProfile->id, $activityProfile->name.' update user '.$profileObj->name.' email '.$profileObj->email, 0);


                    }
                }
                else{
                    //insert
                    $profileObj = new User();
                    $profileObj->name = $requestParams['name'];
                    $profileObj->email = $requestParams['email'];
                    $profileObj->company = $requestParams['company'];
                    $profileObj->user_type = $requestParams['user_type'];
                    $profileObj->country = $requestParams['country'];
                    $profileObj->role_id = $requestParams['role_id'];
                    $profileObj->status = (isset($requestParams['status']))?1:0;

                    //update password
                    if(!empty($requestParams['password'])){
                        $profileObj->password = Hash::make($requestParams['password']);
                    }

                    $profileObj->save(); //generate id

                    //upload image
                    if($image != null){
                        $profileimgname = $profileObj->id.'_profile_image'.'.'.$image->getClientOriginalExtension();
                        $destinationPath = public_path('/media/profile');
                        $destinationImagePath = '/media/profile';
                        $image->move($destinationPath, $profileimgname);

                        $profileimagepath = $destinationImagePath.'/'.$profileimgname;
                    }

                    //upload cover pic image
                        if($coverpic_image != null){
                            $coverpic_image_name = $profileObj->id.'_coverpic_image'.'.'.$coverpic_image->getClientOriginalExtension();
                            $destinationPath = public_path('/media/profile');
                            $destinationImagePath = '/media/profile';
                            $coverpic_image->move($destinationPath, $profileimgname);

                            $coverpic_imagepath = $destinationImagePath.'/'.$profileimgname;
                        }

                    $profileObj = User::find($profileObj->id);
                    if($image != null){
                        $profileObj->profileimage = $profileimagepath;
                    }
                    if($coverpic_image != null){
                            $profileObj->coverpic_image = $coverpic_imagepath;
                    }

                    $profileObj->save();

                    //record activity
                    $profileId = \Auth::user()->id;
                    $activityProfile = User::find($profileId);
                    $activityObj = new UserActivities;
                    $activityObj->addActivity($activityProfile->id, $activityProfile->name.' create new user '.$profileObj->name.' email '.$profileObj->email, 0);

                    //===============================================================================
                    //send emails

                    $isStaff = true;
                    if(strtolower($requestParams['user_type']) == 'client'){
                        $isStaff = false;
                    }

                    //store msg data
                    $emailData = array(
                        'email.register.name' => $requestParams['name'],
                        'email.register.company' => $requestParams['company'],
                        'email.register.email' => $requestParams['email'],
                        'email.register.user_type' => $requestParams['user_type'],
                        'email.register.country' => $requestParams['country'],
                        'email.register.role_id' => $requestParams['role_id'],
                        'email.register.status' => $requestParams['status'],
                        'email.register.password' => $requestParams['password'],
                        'email.register.system_email' => \Session::get('system_email'),
                        'email.register.system_name' => \Session::get('system_name')
                    );

                    //load emails contents
                    $customer_register_admin_template = EmailTemplates::where('identifier', 'customer_register_admin_template')->first();
                    $customer_register_template = EmailTemplates::where('identifier', 'customer_register_template')->first();
                    $staff_register_template = EmailTemplates::where('identifier', 'staff_register_template')->first();

                    //customer_register_admin_template
                    try{
                        Mail::send([],[], function ($m) use ($customer_register_admin_template, $emailData) {
                            $m->from($emailData['email.register.system_email'], $emailData['email.register.system_name']);
                            $m->to($emailData['email.register.system_email'], 'Admin')
                                ->subject($customer_register_admin_template->title)
                                ->setBody($customer_register_admin_template->parse($emailData), 'text/html');
                        });
                    }
                    catch(Exception $e){
                        // Get error here
                        Log::warning('Customer system register Admin email not sent ', ['error : '.$e->getMessage()]);
                    }

                    if(!$isStaff){
                        //customer_register_template
                        try{
                            Mail::send([], [], function ($m) use ($customer_register_template, $emailData) {
                                $m->from($emailData['email.register.system_email'], $emailData['email.register.system_name']);
                                $m->to($emailData['email.register.email'], $emailData['email.register.name'])
                                    ->subject($customer_register_template->title)
                                    ->setBody($customer_register_template->parse($emailData), 'text/html');
                            });
                        }
                        catch(Exception $e){
                            // Get error here
                            Log::warning('Customer system register Client email not sent!', ['error : '.$e->getMessage()]);
                        }
                    }

                    if($isStaff){
                        //staff_register_template
                        try{
                            Mail::send([], [], function ($m) use ($staff_register_template, $emailData) {
                                $m->from($emailData['email.register.system_email'], 'Demo');
                                $m->to($emailData['email.register.email'], $emailData['email.register.name'])
                                    ->subject($staff_register_template->title)
                                    ->setBody($staff_register_template->parse($emailData), 'text/html');
                            });
                        }
                        catch(Exception $e){
                            // Get error here
                            Log::warning('Staff register email not sent!', ['error : '.$e->getMessage()]);
                        }
                    }

                    //===============================================================================

                }

                //load the countries
                $countryList = Country::pluck('name','countryId');

                //load roles
                $roleList = Role::all();

                if(isset($requestParams['user_type']) && $requestParams['user_type'] == 'Staff'){
                    return redirect()->action('UserController@getUsers')->with('users', User::all());    
                }
                else{
                    return redirect()->action('UserController@getClients')->with('users', User::all());
                }
                
            }
            else{
                $errormsg = $this->msg;
                //return redirect()->action('UserController@getSettings')->with(compact('errormsg',[$errormsg]));
            }
        }
        else{
            if(isset($requestParams['user_type']) && $requestParams['user_type'] == 'Staff'){
                    return redirect()->action('UserController@getUsers')->with('users', User::all());    
                }
                else{
                    return redirect()->action('UserController@getClients')->with('users', User::all());
                }
        }

    }

    public function getActiveUserCount(){

        $requestParams = Request::all();
        $validate_pin = md5(\Auth::user()->id).md5('demo');
        $validate_token = \Session::token();
        $pin = $requestParams['trackingcode'];
        $token = $requestParams['_token'];

        if($validate_pin != $pin){
            if($validate_token != $token){
                return response()->json(['error' => 'Error on token mismatch!']);
            }
        }
        else{
            $online_userlist = DB::table('users')->where([
                ['status','1'],
                ['isonline','1'],
            ])->get();

            return response()->json(['activeuserscount' => count($online_userlist)]);
        }

    }

    public function isValidCurrentPassword(){

        //check current logged user password is valid or not
        $requestParams = Request::all();
        $validate_pin = md5(\Auth::user()->id).md5('demo');
        $validate_token = \Session::token();
        $pin = $requestParams['trackingcode'];
        $token = $requestParams['_token'];
        $email = $requestParams['email'];
        $password = $requestParams['password'];

        if($validate_pin != $pin){
            if($validate_token != $token){
                return response()->json(['error' => 'Error on token mismatch!']);
            }
        }
        else{
           if(empty($password) || empty($email)){
                return response()->json(['isvalid' => false]);
           }else{
                if(\Auth::attempt(['email'=>$email,'password'=>$password], true))
                {
                    return response()->json(['isvalid' => true]);
                }
                else{
                    return response()->json(['isvalid' => false]);
                }
           } 
           
        }

    }
}