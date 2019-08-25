<!DOCTYPE html>
<html>

<!-- Mirrored from hubancreative.com/projects/templates/coco/corporate/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Jun 2016 20:04:31 GMT -->
<head>
    @include('layouts.master.header')
</head>
<body class="fixed-left login-page">
<!-- Modal Start -->

<!-- Modal Logout -->
<!--<div class="md-modal md-just-me" id="logout-modal">-->
<!--    <div class="md-content">-->
<!--        <h3><strong>Logout</strong> Confirmation</h3>-->
<!--        <div>-->
<!--            <p class="text-center">Are you sure want to logout from this awesome system?</p>-->
<!--            <p class="text-center">-->
<!--                <button class="btn btn-danger md-close">Nope!</button>-->
<!--                <a href="/" class="btn btn-success md-close">Yeah, I'm sure</a>-->
<!--            </p>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>        -->
<!-- Modal End -->
<!-- Begin page -->
<div class="container">
    <div class="full-content-center">
        <p class="text-center"><a href="#"><img src="{{ URL::asset('assets/img/logo.png') }}" alt="Logo"></a></p>
        <div class="login-wrap animated flipInX">
            <div class="login-block">
                <!--                <img src="images/users/default-user.png" class="img-circle not-logged-avatar">-->
                @include('partials.message')
                <form role="form" id="loginForm" action="<?php echo action('UserController@postLogin'); ?>" method="post">
                    <div class="form-group login-input">
                        <i class="fa fa-user overlay"></i>
                        <input type="email" required="required" name="email" class="form-control text-input" placeholder="Username">
                    </div>
                    <div class="form-group login-input">
                        <i class="fa fa-key overlay"></i>
                        <input type="password" required="required" name="password" class="form-control text-input" placeholder="********">
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-success btn-block">LOGIN</button>
                        </div>
                        <div class="col-sm-6">
                            <a href="/#login" class="btn btn-default btn-block">Register</a>
                        </div>
                    </div>
                    {{ csrf_field() }}
                </form>
            </div>
        </div>

    </div>
</div>
<!-- the overlay modal element -->
<div class="md-overlay"></div>
<!-- End of eoverlay modal -->
@include('layouts.user.footer')
</body>

<!-- Mirrored from hubancreative.com/projects/templates/coco/corporate/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Jun 2016 20:04:32 GMT -->
</html>