<?php
/**
 * Created by PhpStorm.
 * User: dasitha
 * Date: 9/10/16
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
<!-- Modal Task Progress -->
<div class="md-modal md-3d-flip-vertical" id="task-progress">
    <div class="md-content">
        <h3><strong>Task Progress</strong> Information</h3>
        <div>
            <p>CLEANING BUGS</p>
            <div class="progress progress-xs for-modal">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                    <span class="sr-only">80&#37; Complete</span>
                </div>
            </div>
            <p>POSTING SOME STUFF</p>
            <div class="progress progress-xs for-modal">
                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                    <span class="sr-only">65&#37; Complete</span>
                </div>
            </div>
            <p>BACKUP DATA FROM SERVER</p>
            <div class="progress progress-xs for-modal">
                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 95%">
                    <span class="sr-only">95&#37; Complete</span>
                </div>
            </div>
            <p>RE-DESIGNING WEB APPLICATION</p>
            <div class="progress progress-xs for-modal">
                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                    <span class="sr-only">100&#37; Complete</span>
                </div>
            </div>
            <p class="text-center">
                <button class="btn btn-danger btn-sm md-close">Close</button>
            </p>
        </div>
    </div>
</div>

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

@if (isset($user))

<div class="page-heading">
    <h1><i class='fa fa-check'></i> User Edit</h1>
</div>
<!-- Page Heading End-->

<!-- Your awesome content goes here -->

<div class="widget">
<div class="widget-header transparent">
    <h2><strong>User</strong> Details</h2>
</div>
<div class="widget-content padding">

    <form class="form-horizontal" method="POST" action="{{ url('/user/access/users/new/save') }}" role="form" enctype="multipart/form-data">
    
    <div class="data-table-toolbar">
        <div class="row">
            <div class="col-md-12">
                <div class="toolbar-btn-action">
                    <button type="submit" class="btn btn-info">Save</button>
                    <a href="{{ url('/user/access/users/new') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add new</a>
                    <a href="{{ url('/user/access/users/remove/'.$user->id) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</a>
                    <a href="{{ url('/user/access/users') }}" class="btn btn-warning"><i class="fa fa-back"></i> Back</a>
                    <!--                                <a class="btn btn-primary"><i class="fa fa-refresh"></i> Update</a>-->
                </div>
            </div>
        </div>
    </div>
    <br/>

        <div class="form-group">
            <label for="input-text" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="input-text"/>
            </div>
        </div>

        <div class="form-group">
            <label for="input-text" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="text" name="email" value="{{ $user->email }}" class="form-control" id="input-text"/>
            </div>
        </div>

        <div class="form-group">
            <label for="input-text" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="password" name="password" value="" class="form-control" id="input-text"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Company</label>
            <div class="col-sm-10">
                <input type="text" name="company" value="{{ $user->company }}" class="form-control" id="input-text"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Country</label>
            <div class="col-sm-10">
                <select name="country" class="form-control">
                    <option value="" <?php echo ($user->country == '')?"selected='selected'":''; ?> >Select Country</option>
                    <?php
                    foreach($country as $inx=>$countryname){
                        ?>
                        <option value="<?php echo $countryname ?>" <?php echo ($user->country == $countryname)?"selected='selected'":''; ?> ><?php echo $countryname ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">User Type</label>
            <div class="col-sm-10">
                <select id="user_type" name="user_type" class="form-control">
                    <option value="" >Select User Type</option>
                    <!-- Hide for admins -->
                    <?php if(\Auth::user()->role_id == 1){ ?>
                    <option value="Staff" <?php echo ($user->user_type=='Staff')?'selected="selected"':''; ?> >Staff</option>
                    <?php } ?>
                    <option value="Client" <?php echo ($user->user_type=='Client')?'selected="selected"':''; ?>>Client</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Role</label>
            <div class="col-sm-10">
                <select id="role_id" name="role_id" class="form-control">
                    <option value="" >Select Role</option>
                    <?php
                    //Hide for admins
                    //Admin can only add clients
                    if(\Auth::user()->role_id == 2){
                    ?>
                    <option value="3" selected="selected" >User</option>
                    <?php
                    }
                    else{
                        //For Super Admin
                        foreach($roles as $role){
                        ?>
                            <option value="<?php echo $role->id ?>" <?php echo ($user->role_id == $role->id)?"selected='selected'":''; ?> ><?php echo $role->display_name; ?></option>
                        <?php
                        }
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Profile Image</label>
            <div class="col-sm-10">
                <div class="col-sm-2" style="padding-left: 0px;">
                    <input type="file" name="profileimage" value="<?php echo ($user->profileimage != '')?$user->profileimage:'/assets/img/default_profile.png'; ?>" class="form-control" id="input-text"/>
                </div>
                <div class="profile-info">
                    <div class="col-xs-4">
                        <a href="#" class="rounded-image-settings profile-image-settings"><img src="<?php echo ($user->profileimage != '')?$user->profileimage:'/assets/img/default_profile.png'; ?>"></a>
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
                    <input type="file" name="coverpic_image" value="<?php echo ($user->coverpic_image != '')?$user->coverpic_image:'/assets/img/default_cover_image.jpg'; ?>" class="form-control" id="input-text"/>
                </div>
                <div class="profile-info">
                  <div class="col-xs-4">
                     <a href="user/profile/settings" class="rounded-image-settings profile-image-settings"><img src="<?php echo ($user->coverpic_image != '')?$user->coverpic_image:'/assets/img/default_cover_image.jpg'; ?>"></a>
                  </div>
                </div>
            </div>
        </div>
        @endif

        <div class="form-group">
            <label class="col-sm-2 control-label">Active</label>
            <div class="col-sm-10">
                <label class="checkbox-inline checked" style="display: inline;padding:0">
                    <input style="float:left;margin-left: 0;" name="status" type="checkbox" id="visiblecheckbox" value="{{ $user->status }}" <?php echo ($user->status==1)?'checked="checked"':'' ?>  />
                </label>
            </div>
        </div>

        <!-- <div class="form-group">
            <label class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-info">Save</button>
            </div>
        </div> -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $user->id }}"/>
    </form>

@else

    <div class="page-heading">
        <h1><i class='fa fa-check'></i> Add New User</h1>
    </div>
    <!-- Page Heading End-->

    <!-- Your awesome content goes here -->

    <div class="widget">
        <div class="widget-header transparent">
            <h2><strong>User</strong> Details</h2>
        </div>
        <div class="widget-content padding">

            <form class="form-horizontal" method="POST" action="{{ url('/user/access/users/new/save') }}" role="form" enctype="multipart/form-data">
    
            <div class="data-table-toolbar">
                <div class="row">
                    <div class="col-md-12">
                        <div class="toolbar-btn-action">
                            <button type="submit" class="btn btn-info">Save</button>
                            <a href="{{ url('/user/access/users/new') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add new</a>
                            <a href="{{ url('/user/access/users') }}" class="btn btn-warning"><i class="fa fa-back"></i> Back</a>
                            <!--                                <a class="btn btn-primary"><i class="fa fa-refresh"></i> Update</a>-->
                        </div>
                    </div>
                </div>
            </div>
            <br/>

        <div class="form-group">
            <label for="input-text" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" name="name" placeholder="Add Name here" value="" class="form-control" id="input-text"/>
            </div>
        </div>

        <div class="form-group">
            <label for="input-text" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="text" name="email" placeholder="Add Email here" value="" class="form-control" id="input-text"/>
            </div>
        </div>

        <div class="form-group">
            <label for="input-text" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="password" name="password"  placeholder="Add Password here" value="" class="form-control" id="input-text"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Company</label>
            <div class="col-sm-10">
                <input type="text" name="company" placeholder="Add Company here" value="" class="form-control" id="input-text"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Country</label>
            <div class="col-sm-10">
                <select name="country" class="form-control">
                    <option value="" >Select Country</option>
                    <?php
                    foreach($country as $inx=>$countryname){
                        ?>
                        <option value="<?php echo $countryname ?>" ><?php echo $countryname ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">User Type</label>
            <div class="col-sm-10">
                <select id="user_type" name="user_type" class="form-control">
                    <option value="" >Select User Type</option>
                    <!-- Hide for admins -->
                    <?php if(\Auth::user()->role_id == 1){ ?>
                    <option value="Staff" selected="selected" >Staff</option>
                    <option value="Client" >Client</option>
                    <?php }else{ ?>
                    <option value="Client" selected="selected">Client</option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Role</label>
            <div class="col-sm-10">
                <select id="role_id" name="role_id" class="form-control">
                    <option value="" >Select Role</option>
                    <?php
                    //Hide for admins
                    //Admin can only add clients
                    if(\Auth::user()->role_id == 2){
                    ?>
                    <option value="3" selected="selected" >User</option>
                    <?php
                    }
                    else{
                        //For Super Admin
                        foreach($roles as $role){
                        ?>
                            <option value="<?php echo $role->id ?>" ><?php echo $role->display_name; ?></option>
                        <?php
                        }
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Profile Image</label>
            <div class="col-sm-10">
                <div class="col-sm-2" style="padding-left: 0px;">
                    <input type="file" name="profileimage" value="" class="form-control" id="input-text"/>
                </div>
                <div class="profile-info">
                    <div class="col-xs-4">
                        <a href="#" class="rounded-image-settings profile-image-settings"><img src="<?php echo '/assets/img/default_profile.png'; ?>"></a>
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
                    <input type="file" name="coverpic_image" value="" class="form-control" id="input-text"/>
                </div>
                <div class="profile-info">
                  <div class="col-xs-4">
                     <a href="#" class="rounded-image-settings profile-image-settings"><img src="<?php echo '/assets/img/default_cover_image.jpg'; ?>"></a>
                  </div>
                </div>
            </div>
        </div>
        @endif

        <div class="form-group">
            <label class="col-sm-2 control-label">Active</label>
            <div class="col-sm-10">
                <label class="checkbox-inline checked" style="display: inline;padding:0">
                    <input style="float:left;margin-left: 0;" name="status" type="checkbox" id="visiblecheckbox" value="1" checked="checked" />
                </label>
            </div>
        </div>

        <!-- <div class="form-group">
            <label class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-info">Save</button>
            </div>
        </div> -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value=""/>
    </form>

@endif

</div>

</div>
<!-- End of your awesome content -->

<!-- Footer Start -->
@include('layouts.master.footer')
</body>

<!-- Mirrored from hubancreative.com/projects/templates/coco/corporate/forms.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Jun 2016 20:04:50 GMT -->
</html>

<script>
    /*jQuery(document).ready(function(){
       //add validation to select user role when select user type to client
       jQuery("#user_type").change(function(){
          if(jQuery("#user_type option:selected").text() == 'Client'){
              jQuery('#role_id option').each(function(){
                  jQuery(this).removeAttr("selected");
              });
              jQuery('#role_id').find('option:contains("User")').attr("selected",true);
          }
       });

       jQuery("#role_id").change(function(){
           if(jQuery("#role_id option:selected").text() == 'Admin' || jQuery(this).text() == 'Super Admin'){
               jQuery('#user_type option').each(function(){
                   jQuery(this).removeAttr("selected");
               });
               jQuery('#user_type').find('option:contains("Staff")').attr("selected",true);
           }
       });

    });*/
</script>
