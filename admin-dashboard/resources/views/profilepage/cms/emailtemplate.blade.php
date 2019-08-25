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

@if (isset($emailtemplate))

<div class="page-heading">
    <h1><i class='fa fa-check'></i> Edit Page</h1>
</div>
<!-- Page Heading End-->

<!-- Your awesome content goes here -->

<div class="widget">
<div class="widget-header transparent">
    <h2><strong>Email Template</strong> Content</h2>
</div>
<div class="widget-content padding">

<form class="form-horizontal" method="POST" action="{{ url('/email/templates/new/save') }}" role="form">
    <div class="data-table-toolbar">
        <div class="row">
            <div class="col-md-12">
                <div class="toolbar-btn-action">
                    <button type="submit" class="btn btn-info">Save</button>
                    <a href="{{ url('/email/templates/new') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add new</a>
                    <a href="{{ url('/email/templates/remove/'.$emailtemplate->id) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</a>
                    <a href="{{ url('/email/templates') }}" class="btn btn-warning"><i class="fa fa-back"></i> Back</a>
                    <!--                                <a class="btn btn-primary"><i class="fa fa-refresh"></i> Update</a>-->
                </div>
            </div>
        </div>
    </div>
    <br/>

        <div class="form-group">
            <label for="input-text" class="col-sm-2 control-label">Email Template Title</label>
            <div class="col-sm-10">
                <input type="text" name="title" value="{{ $emailtemplate->title }}" class="form-control" id="input-text"/>
            </div>
        </div>

        <div class="form-group">
            <label for="input-text" class="col-sm-2 control-label">Identifier</label>
            <div class="col-sm-10">
                <input type="text" name="identifier" value="{{ $emailtemplate->identifier }}" class="form-control" id="input-text"/>
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label">Email Template Content</label>
            <div class="col-sm-10">
                <textarea name="content" class="summernote templatecontent"></textarea>
                <div id="etemplatecontent" style="display:none;" ><?php echo $emailtemplate->content; ?> </div>
            </div>
        </div>

        <div class="form-group" style="clear:both;">
            <label class="col-sm-2 control-label" style="margin-bottom: 20px;">Visible</label>
            <div class="col-sm-10">
                <label class="checkbox-inline checked"  style="display: inline;padding:0">
                    <input  style="float:left;margin-left: 0;" name="visible" type="checkbox" id="visiblecheckbox" value="{{ $emailtemplate->visible }}" <?php echo ($emailtemplate->visible==1)?'checked':'' ?> />
                </label>
            </div>
        </div>
<!-- 
        <div class="form-group">
            <label class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-10" style="margin-bottom: 20px;">
                <button type="submit" class="btn btn-info">Save</button>
            </div>
        </div> -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $emailtemplate->id }}"/>
    </form>

    <script>
       $(document).ready(function(){
        setTimeout(function(){
          var tcontent = $("#etemplatecontent").html();
          $(".summernote").code(tcontent);
        }, 1000);

       });
    </script>

@else

    <div class="page-heading">
        <h1><i class='fa fa-check'></i> Add New Email Template</h1>
    </div>
    <!-- Page Heading End-->

    <!-- Your awesome content goes here -->

    <div class="widget">
        <div class="widget-header transparent">
            <h2><strong>Email Template</strong> Content</h2>
        </div>
        <div class="widget-content padding">

            <form class="form-horizontal" method="POST" action="{{ url('/email/templates/new/save') }}" role="form">
            <div class="data-table-toolbar">
                <div class="row">
                    <div class="col-md-12">
                        <div class="toolbar-btn-action">
                            <button type="submit" class="btn btn-info">Save</button>
                            <a href="{{ url('/email/templates/new') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add new</a>
                            <a href="{{ url('/email/templates') }}" class="btn btn-warning"><i class="fa fa-back"></i> Back</a>
                            <!--                                <a class="btn btn-primary"><i class="fa fa-refresh"></i> Update</a>-->
                        </div>
                    </div>
                </div>
            </div>
            <br/>

        <div class="form-group">
            <label for="input-text" class="col-sm-2 control-label">Email Template Title</label>
            <div class="col-sm-10">
                <input type="text" name="title" value="" placeholder="Add Page Title here" class="form-control" id="input-text" />
            </div>
        </div>

        <div class="form-group">
            <label for="input-text" class="col-sm-2 control-label">Identifier</label>
            <div class="col-sm-10">
                <input type="text" name="identifier" value="" placeholder="Add Url Identifier here" class="form-control" id="input-text"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Email Template Content</label>
            <div class="col-sm-10">
                <textarea name="content" class="summernote">Add Email Template content here</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Visible</label>
            <div class="col-sm-10">
                <label class="checkbox-inline checked" style="display: inline;padding:0">
                    <input style="float:left;margin-left: 0;" name="visible" type="checkbox" id="visiblecheckbox" value="1" checked="checked" />
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