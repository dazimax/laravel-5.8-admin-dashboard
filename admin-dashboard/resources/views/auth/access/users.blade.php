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
<div class="page-heading">
    <h1><i class='fa fa-check'></i> All Staff</h1>
</div>
<!-- Page Heading End-->

<!-- Your awesome content goes here -->
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header transparent">
                <h2><strong>Staff</strong></h2>
            </div>
            <div class="widget-content">
                <div class="data-table-toolbar">
                    <div class="row">
<!--                        <div class="col-md-4">-->
<!--                            <form role="form">-->
<!--                                <input type="text" class="form-control" placeholder="Search...">-->
<!--                            </form>-->
<!--                        </div>-->
                        <div class="col-md-12">
                            <div class="toolbar-btn-action">
                                <a href="{{ url('/user/access/users/new') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add new</a>
<!--                                <a href="{{ url('/user/departments/remove') }}" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</a>-->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table data-sortable class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Created</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Company</th>
                            <th>User Type</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th data-sortable="false">Option</th>
                        </tr>
                        </thead>

                        <tbody>

                        @if (isset($users))
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td><strong>{{ $user->email }}</strong></td>
                                    <td>{{ $user->company }}</td>
                                    <td>{{ $user->user_type }}</td>
                                    <td>{{ $user->rolename }}</td>
                                    <td>
                                        <?php
                                         if($user->status == 1){
                                        ?>
                                        <span class="label label-success">Active</span>
                                        <?php }else{ ?>
                                        <span class="label label-warning">Deactivated</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="{{ url('/user/access/users/view/'.$user->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                        <a href="{{ url('/user/access/users/remove/'.$user->id) }}" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>

<!--                <div class="data-table-toolbar">-->
<!--                    <ul class="pagination">-->
<!--                        <li class="disabled"><a href="#">&laquo;</a></li>-->
<!--                        <li class="active"><a href="#">1</a></li>-->
<!--                        <li><a href="#">2</a></li>-->
<!--                        <li><a href="#">3</a></li>-->
<!--                        <li><a href="#">4</a></li>-->
<!--                        <li><a href="#">5</a></li>-->
<!--                        <li><a href="#">&raquo;</a></li>-->
<!--                    </ul>-->
<!--                </div>-->
            </div>
        </div>
    </div>

</div>

<!-- Footer Start -->
@include('layouts.master.footer')
</body>

<!-- Mirrored from hubancreative.com/projects/templates/coco/corporate/forms.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Jun 2016 20:04:50 GMT -->
</html>