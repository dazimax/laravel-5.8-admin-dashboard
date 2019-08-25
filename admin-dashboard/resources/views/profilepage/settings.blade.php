<?php
/**
 * Created by PhpStorm.
 * User: dasitha
 * Date: 7/11/16
 * Time: 9:12 AM
 */
?>

@include('partials.message')

<!DOCTYPE html>
<html>

<!-- Mirrored from hubancreative.com/projects/templates/coco/corporate/forms.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Jun 2016 20:04:48 GMT -->
<head>
    @include('layouts.master.header')
</head>
<body class="fixed-left">
<!-- Modal Start -->
<!-- Modal Logout -->
<!--<div class="md-modal md-just-me" id="logout-modal">-->
<!--    <div class="md-content">-->
<!--        <h3><strong>Logout</strong> Confirmation</h3>-->
<!--        <div>-->
<!--            <p class="text-center">Are you sure want to logout from this awesome system?</p>-->
<!--            <p class="text-center">-->
<!--                <button class="btn btn-danger md-close">Nope!</button>-->
<!--                <a href="login.html" class="btn btn-success md-close">Yeah, I'm sure</a>-->
<!--            </p>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>        -->
<!-- Modal End -->
<div class="md-modal md-slide-stick-top" id="form-modal">
    <div class="md-content">
        <div class="md-close-btn"><a class="md-close"><i class="fa fa-times"></i></a></div>
        <h3><strong>Form</strong> Modal</h3>
        <div>
            <div class="row">
                <div class="col-sm-6">
                    <h4>Login</h4>
                    <form role="form">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div>
                <div class="col-sm-6">
                    <h4>Not a member?</h4>
                    <p>Create account <a href="#fakelink">here</a></p>
                    <p>OR</p>

                    <button type="button" class="btn btn-primary btn-sm btn-block btn-facebook"><i class="fa fa-facebook"></i> Login with Facebook</button>
                    <button type="button" class="btn btn-primary btn-sm btn-block btn-twitter"><i class="fa fa-twitter"></i> Login with Twitter</button>

                </div>
            </div>
        </div>
    </div>
</div><!-- End .md-modal -->
<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <div class="topbar">
        @include('layouts.master.navbar')
    </div>
    <!-- Top Bar End -->
    <!-- Left Sidebar Start -->
    <div class="left side-menu">
        @include('layouts.master.sidebar')
    </div>
    <!-- Left Sidebar End -->		    <!-- Right Sidebar Start -->
    <div class="right side-menu">
        @include('profilepage.rightsidemenu')
    </div>
    <!-- Right Sidebar End -->
    <!-- Start right content -->
    <div class="content-page">
        <!-- ============================================================== -->
        <!-- Start Content here -->
        <!-- ============================================================== -->
        <div class="content">
            <!-- Page Heading Start -->

            @if (isset($profile))

            <div class="page-heading">
                <h1><i class='fa fa-check'></i> Edit Profile</h1>
            </div>
            <!-- Page Heading End-->

            <!-- Your awesome content goes here -->

            <div class="widget">
                <div class="widget-header transparent">
                    <h2><strong>Profile</strong> Content</h2>
                </div>
                <div class="widget-content padding">

                     <form class="form-horizontal" method="POST" action="{{ url('/user/profile/settings/save') }}" role="form" enctype="multipart/form-data">
                   
                    <div class="data-table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
<!--                                Show erros here-->
                            </div>
                            <div class="col-md-6">
                                <div class="toolbar-btn-action">
                                    <button type="submit" class="btn btn-info">Save</button>
<!--                                    <a href="{{ url('/user/profile/cms/pages/new') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add new</a>-->
<!--                                    <a href="{{ url('/user/access/users/remove/'.$profile->id) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</a>-->
                                    <a href="{{ url('/user/profile') }}" class="btn btn-warning"><i class="fa fa-back"></i> Back</a>
                                    <!--                                <a class="btn btn-primary"><i class="fa fa-refresh"></i> Update</a>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>

                        <div class="form-group">
                            <label for="input-text" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" value="{{ $profile->name }}" class="form-control" id="input-text"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-text" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">

                            <?php
                            //for client and admin need to contact administrators
                            if(\Auth::user()->role_id != 1){ ?>

                                <label for="input-text" class="col-sm-3" style="padding-left: 0;">{{ $profile->email }} </label>
                                <label for="input-text" class="col-sm-9" style="padding-left: 0;">(To change email please contact Administrator) </label>
                                <input type="hidden" name="email" value="{{ $profile->email }}" class="form-control" id="email"/>

                            <?php }else{ ?>
                            {{--Start popup--}}
                            <!-- Trigger the modal with a button -->
                                <a class="control-label" href="#" data-toggle="modal" data-target="#changeEmailBox">Change Email</a>

                                <!-- Modal -->
                                <div id="changeEmailBox" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Add New Email</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="input-text" class="col-sm-2 control-label">Current Password</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" name="current_password" value="" class="form-control" id="email_current_password"/>
                                                    </div>
                                                    <div class="col-sm-10" style="margin-top:5px;display:none;" id="error_email_currentpassword" class="error_email_currentpassword">
                                                        <div class="alert alert-danger">
                                                            <strong>Please add correct current user password!</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="input-text" class="col-sm-2 control-label">New Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="new_email" value="{{ $profile->email }}" class="form-control" id="new_email"/>
                                                        <input type="hidden" name="email" value="{{ $profile->email }}" class="form-control" id="email"/>
                                                        <div class="col-sm-10" style="margin-top:5px;display:none;padding-left: 0;" id="error_newemail">
                                                            <div class="alert alert-danger">
                                                                <strong>New Email is empty! Please add correct email.</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="email_add_button" disabled="disabled" class="btn btn-default" data-dismiss="modal">Add</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                {{--End popup--}}
                                <?php } ?>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-text" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">

                                {{--Start popup--}}
                                <!-- Trigger the modal with a button -->
                                <a class="control-label" href="#" data-toggle="modal" data-target="#changePasswordBox">Change Password</a>

                                <!-- Modal -->
                                <div id="changePasswordBox" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                    <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Add New Password</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="input-text" class="col-sm-2 control-label">Current Password</label>
                                                    <div class="col-sm-10">
                                                       <input type="password" name="current_password" value="" class="form-control" id="current_password"/>
                                                    </div>
                                                    <div class="col-sm-10" style="margin-top:5px;display:none;" id="error_currentpassword" class="error_currentpassword">
                                                      <div class="alert alert-danger">
                                                        <strong>Please add correct current user password!</strong>
                                                      </div>    
                                                    </div>    
                                                </div>
                                                <div class="form-group">
                                                    <label for="input-text" class="col-sm-2 control-label">New Password</label>
                                                    <div class="col-sm-10">
                                                       <input type="password" name="new_password" value="" class="form-control" id="new_password"/>
                                                    </div> 
                                                </div>
                                                <div class="form-group">
                                                    <label for="input-text" class="col-sm-2 control-label">Confirm Password</label>
                                                    <div class="col-sm-10">
                                                       <input type="password" name="confirm_password" value="" class="form-control" id="confirm_password"/>
                                                    </div> 
                                                    <div class="col-sm-10" style="margin-top:5px;display:none;" id="error_passwordconfirm">
                                                      <div class="alert alert-danger">
                                                        <strong>Password mismatched! Please re-enter.</strong>
                                                      </div>    
                                                    </div>  
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="password_add_button" disabled="disabled" class="btn btn-default" data-dismiss="modal">Add</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                {{--End popup--}}

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Company</label>
                            <div class="col-sm-10">
                                <input type="text" name="company" value="{{ $profile->company }}" class="form-control" id="input-text"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Country</label>
                            <div class="col-sm-10">
                                <select name="country" class="form-control">
                                    <option value="" <?php echo ($profile->country == '')?"selected='selected'":''; ?> >Select Country</option>
                                    <?php
                                    foreach($country as $inx=>$countryname){
                                    ?>
                                    <option value="<?php echo $countryname ?>" <?php echo ($profile->country == $countryname)?"selected='selected'":''; ?> ><?php echo $countryname ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Profile Image</label>
                            <div class="col-sm-10">
                                <div class="col-sm-2" style="padding-left: 0px;">
                                    <input type="file" name="profileimage" value="<?php echo (Auth::user()->profileimage != '')?Auth::user()->profileimage:'/assets/img/default_profile.png'; ?>" class="form-control" id="input-text"/>
                                </div>
                                <div class="profile-info">
                                    <div class="col-xs-4">
                                        <a href="user/profile/settings" class="rounded-image-settings profile-image-settings"><img src="<?php echo (Auth::user()->profileimage != '')?Auth::user()->profileimage:'/assets/img/default_profile.png'; ?>"></a>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Only for Staff -->
                        @if (\Auth::user()->isStaff())
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Profile Cover Image</label>
                            <div class="col-sm-10">
                                <div class="col-sm-2" style="padding-left: 0px;">
                                    <input type="file" name="coverpic_image" value="<?php echo ($profile->coverpic_image  != '')?$profile->coverpic_image:'/assets/img/default_cover_image.jpg'; ?>" class="form-control" id="input-text"/>
                                </div>
                                <div class="profile-info">
                                    <div class="col-xs-4">
                                        <a href="user/profile/settings" class="rounded-image-settings profile-image-settings"><img src="<?php echo ($profile->coverpic_image != '')?$profile->coverpic_image:'/assets/img/default_cover_image.jpg'; ?>"></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endif

<!--                        <div class="form-group">-->
<!--                            <label class="col-sm-2 control-label">Active</label>-->
<!--                            <div class="col-sm-10">-->
<!--                                <label class="checkbox-inline checked" style="display: inline;padding:0">-->
<!--                                    <input style="float:left;margin-left: 0;" name="status" type="checkbox" id="visiblecheckbox" value="{{ $profile->status }}" --><?php //echo ($profile->status==1)?'checked="checked"':'' ?><!-- />-->
<!--                                </label>-->
<!--                            </div>-->
<!--                        </div>-->

                        <!-- <div class="form-group">
                            <label class="col-sm-2 control-label">&nbsp;</label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div>
                        </div> -->
                        <input type="hidden" name="_token" id="tokenkey" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{ $profile->id }}"/>
                    </form>

                    @else

                    <div class="page-heading">
                        <h4><i class='fa fa-check'></i> Please login to the system!</h4>
                    </div>

                    @endif

                        </div>

                    </div>
                    <!-- End of your awesome content -->

<script>
$(document).ready(function(){

    var token = $("#tokenkey").val();
    var trackingcodepin = "<?php echo md5(\Auth::user()->id).md5('demo'); ?>";
    var base_url = window.location.origin;

    //email change
    $("#new_email, #email_current_password").focusout(function(){

        $("#error_email_currentpassword").hide();
        $("#error_newemail").hide();
        var new_email = $("#new_email").val();

        if(new_email.length == 0){
            $("#email_add_button").prop("disabled", true);
            $("#error_newemail").slideDown();
        }
        else{

            //=================================
            //validate the current password
            var email = $("#email").val();
            var password = $("#email_current_password").val();
            if(password != ''){
                $.post(
                    base_url+"/user/profile/currentpassword",
                    {'_token':token,'trackingcode':trackingcodepin, 'email':email, 'password':password},
                    function(data,status,xhr){
                        if(typeof data.isvalid != 'undefined'){
                            var old_email = $("#email").val();
                            if(data.isvalid == true){
                                $("#error_email_currentpassword").hide();

                                $("#email_add_button").removeAttr("disabled");
                                $("#email").val(new_email);
                            }
                            else{
                                $("#email_add_button").prop("disabled", true);
                                $("#email").val(old_email);
                                $("#error_email_currentpassword").slideDown();
                            }
                        }
                    },
                    'json'
                );
            }
            //=================================
        }

    });
    
    //password change
    var ispasswordvalid = false;

    $("#current_password, #email_current_password").focusin(function(){
        $("#error_currentpassword").hide();
        $("#error_email_currentpassword").hide();
    });

    $("#confirm_password, #new_password").focusin(function(){
        $("#error_passwordconfirm").hide();
    });

    $("#current_password, #confirm_password, #new_password").focusout(function(){

        $("#error_passwordconfirm").hide();

        var confirm_val = $("#confirm_password").val();
        var new_password = $("#new_password").val();

        if(confirm_val != new_password || new_password.length == 0){
            $("#password_add_button").prop("disabled", true);
            $("#new_password").attr("name","new_password");
            $("#error_passwordconfirm").slideDown();
            ispasswordvalid = false;
        }
        else{
            ispasswordvalid = true;
            $("#error_passwordconfirm").hide();

            //=================================
            //validate the current password
            var email = $("#email").val();
            var password = $("#current_password").val();
            if(password != ''){
                $.post(
                    base_url+"/user/profile/currentpassword",
                    {'_token':token,'trackingcode':trackingcodepin, 'email':email, 'password':password},
                    function(data,status,xhr){
                        if(typeof data.isvalid != 'undefined'){
                            if(data.isvalid == true){
                                $("#error_currentpassword").hide();
                                ispasswordvalid = true;

                                if(ispasswordvalid == true){
                                    $("#password_add_button").removeAttr("disabled");
                                    $("#new_password").attr("name","password");
                                }
                            }
                            else{
                                $("#password_add_button").prop("disabled", true);
                                $("#new_password").attr("name","new_password");
                                $("#error_currentpassword").slideDown();
                                $("#current_password").val("");
                                ispasswordvalid = false;
                            }
                        }
                    },
                    'json'
                );
            }
            //=================================
        }

    });


});            
</script>


                    <!-- Footer Start -->
                    @include('layouts.master.footer');
</body>

<!-- Mirrored from hubancreative.com/projects/templates/coco/corporate/forms.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Jun 2016 20:04:50 GMT -->
</html>