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

            @if (isset($configurations))

            <div class="page-heading">
                <h1><i class='fa fa-check'></i> Edit Settings</h1>
            </div>
            <!-- Page Heading End-->

            <!-- Your awesome content goes here -->

            <div class="widget">
                <div class="widget-header transparent">
                    <h2><strong>System</strong> Configurations</h2>
                </div>
                <div class="widget-content padding">

                    <form class="form-horizontal" method="POST" action="{{ url('/settings/configurations/save') }}" role="form" enctype="multipart/form-data">
                        
                        <?php 
                          //load values
                          $systemData = array();
                          foreach($configurations as $config){
                            $systemData[$config->key] = $config->value;
                          }
                        ?>

            <div class="data-table-toolbar">
                <div class="row">
                    <div class="col-md-12">
                        <div class="toolbar-btn-action">
                            <button type="submit" class="btn btn-info">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
                        <div class="form-group">
                             <label for="input-text" class="col-sm-2 control-label">System Name</label>
                             <div class="col-sm-10">
                                <input type="text" name="system_name" value="<?php echo (isset($systemData['system_name']))?$systemData['system_name']:'Demo'; ?>" class="form-control" id="input-text"/>
                             </div>
                        </div>

                        <div class="form-group">
                            <label for="input-text" class="col-sm-2 control-label">System Email</label>
                            <div class="col-sm-10">
                                <input type="text" name="system_email" value="<?php echo (isset($systemData['system_email']))?$systemData['system_email']:''; ?>" class="form-control" id="input-text"/>
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label class="col-sm-2 control-label">&nbsp;</label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div>
                        </div> -->
                        <input type="hidden" name="_action" value="emailconfigurations"/>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{ (isset($systemData['id']))?$systemData['id']:'' }}"/>
                    </form>

                    @else

                    <div class="page-heading">
                        <h4><i class='fa fa-check'></i> Please login to the system!</h4>
                    </div>

                    @endif

                        </div>

                    </div>
                    <!-- End of your awesome content -->

                    <!-- Footer Start -->
                    @include('layouts.master.footer')
</body>

<!-- Mirrored from hubancreative.com/projects/templates/coco/corporate/forms.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Jun 2016 20:04:50 GMT -->
</html>