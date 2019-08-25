<!--begin col-md-4 -->
<section class="section-white" id="login">

    <style type="text/css">
        @media screen and (max-height: 575px){ #rc-imageselect, .g-recaptcha { transform:scale(0.77); -webkit-transform:scale(0.77); transform-origin:0 0; -webkit-transform-origin:0 0; }
    </style>
    <!--begin container-->
    <div class="container">

        @if (isset($cmspages))
        <?php
        $isContentHas = false;
        ?>

        @foreach ($cmspages as $cmspage)

        @if (strtolower($cmspage->identifier) == 'login')

        <?php
        $isContentHas = true;
        ?>

        <!--begin row-->
        <div class="row margin-bottom-50">

            <!--begin col-md-12-->
            <div class="col-md-12 text-center">
                <h2 class="section-title">{{ $cmspage->title }}</h2>

                <div class="separator_wrapper">
                    <i class="icon icon-star-two red"></i>
                </div>


            </div>
            <!--end col-md-12-->

        </div>
        <!--end row-->

        <!--begin row-->
        <div class="row login-content">


            <form id="homeLoginForm" class="login" action="<?php echo action('UserController@postLogin'); ?>" method="post">

                <!--begin col-md-4 -->
                <div class="col-md-6 login-box">

                    <!--begin login-box -->
                    <div class="login-box-green">

                        <!--begin login-top -->
                        <div class="login-top">

                            <h3>Login</h3>

                        </div>
                        <!--end login-top -->

                        <!--begin login-bottom -->
                        <div class="login-bottom">
                            <input class="login-input" required="" name="email" placeholder="Email*" type="email">
                            <input class="login-input" required="" name="password" placeholder="Password*" type="password">
                            {{ csrf_field() }}
                            <!--<div class="blank"></div>-->
                        </div>
                        <!--end login-bottom -->

                        <div class="login-footer col-md-12">
                            <input type="submit" name="homeLogin" class="btn-square btn btn-md btn-block btn-login-green" value="LOGIN" >
                        </div>
                        <div class="col-md-12 info-registration">
                            <div class="col-md-9">
                                {!! $cmspage->content !!}
                            </div>
                            <div class="col-md-3 direct-registration">
                                <span></span>
                            </div>
                        </div>

                    </div>
                    <!--end login-box -->

                </div>

            </form>
            <form id="homeRegisterForm" class="login" action="<?php echo action('UserController@postRegister'); ?>" method="post">
                <!--end col-md-6 -->

                <!--begin col-md-6 -->
                <div class="col-md-6 login-box">

                    <!--begin login-box -->
                    <div class="login-box-red">
                        <!--begin login-top -->
                        <div class="login-top">

                            <h3>Register</h3>
                            <!--<p>Registration is Free for First 12 hours.</p>-->

                        </div>
                        <!--end login-top -->

                        <!--begin login-bottom -->
                        <div class="login-bottom">
                            <input class="login-input" required="" name="name" placeholder="Name*" type="text">
                            <input class="login-input" required="" name="company" placeholder="company*" type="text">
                            <input class="login-input" required="" name="email" placeholder="Email*" type="email">
                            <input class="login-input" required="" name="password" placeholder="Password*" type="password">
                            <input class="login-input" required="" name="repassword" placeholder="Retype Password*" type="password">
                            {{ csrf_field() }}
                        </div>
                        <div class="recapchaGoogle col-md-6 col-md-offset-2" style="margin-top:-40px;text-align: center; display: inline-block;">
                            {!! Recaptcha::render() !!}
                        </div>

                        <!--end login-bottom -->

                        <div class="login-footer col-md-12">
                            <input type="submit" name="homeRegister" class="btn-square btn btn-md btn-block btn-login-red" value="REGISTER">
                        </div>

                    </div>
                    <!--end pricing-box -->

                </div>
                <!--end col-md-6 -->

            </form>

        </div>
        <!--end row-->

        @endif

        @endforeach

        <?php
        if($isContentHas == false){
        //default content
        ?>

            <!--begin row-->
            <div class="row margin-bottom-50">

                <!--begin col-md-12-->
                <div class="col-md-12 text-center">
                    <h2 class="section-title">Choose How to Get Started</h2>

                    <div class="separator_wrapper">
                        <i class="icon icon-star-two red"></i>
                    </div>


                </div>
                <!--end col-md-12-->

            </div>
            <!--end row-->

            <!--begin row-->
            <div class="row login-content">


                <form id="homeLoginForm" class="login" action="<?php echo action('UserController@postLogin'); ?>" method="post">

                    <!--begin col-md-4 -->
                    <div class="col-md-6 login-box">

                        <!--begin login-box -->
                        <div class="login-box-green">

                            <!--begin login-top -->
                            <div class="login-top">

                                <h3>Login</h3>

                            </div>
                            <!--end login-top -->

                            <!--begin login-bottom -->
                            <div class="login-bottom">
                                <input class="login-input" required="" name="email" placeholder="Email*" type="email">
                                <input class="login-input" required="" name="password" placeholder="Password*" type="password">
                                {{ csrf_field() }}
                                <!--<div class="blank"></div>-->
                            </div>
                            <!--end login-bottom -->

                            <div class="login-footer col-md-12">
                                <input type="submit" name="homeLogin" class="btn-square btn btn-md btn-block btn-login-green" value="LOGIN" >
                            </div>
                            <div class="col-md-12 info-registration">
                                <div class="col-md-9">
                                    <ul>
                                        <li>Registration is free</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 direct-registration">
                                    <span></span>
                                </div>
                            </div>

                        </div>
                        <!--end login-box -->

                    </div>

                </form>
                <form id="homeRegisterForm" class="login" action="<?php echo action('UserController@postRegister'); ?>" method="post">
                    <!--end col-md-6 -->

                    <!--begin col-md-6 -->
                    <div class="col-md-6 login-box">

                        <!--begin login-box -->
                        <div class="login-box-red">
                            <!--begin login-top -->
                            <div class="login-top">

                                <h3>Register</h3>
                                <!--<p>Registration is Free for First 12 hours.</p>-->

                            </div>
                            <!--end login-top -->

                            <!--begin login-bottom -->
                            <div class="login-bottom">
                                <input class="login-input" required="" name="name" placeholder="Name*" type="text">
                                <input class="login-input" required="" name="company" placeholder="company*" type="text">
                                <input class="login-input" required="" name="email" placeholder="Email*" type="email">
                                <input class="login-input" required="" name="password" placeholder="Password*" type="password">
                                <input class="login-input" required="" name="repassword" placeholder="Retype Password*" type="password">
                                {{ csrf_field() }}
                            </div>
                            <div class="recapchaGoogle col-md-6 col-md-offset-2" style="margin-top:-40px;text-align: center; display: inline-block;">
                                {!! Recaptcha::render() !!}
                            </div>

                            <!--end login-bottom -->

                            <div class="login-footer col-md-12">
                                <input type="submit" name="homeRegister" class="btn-square btn btn-md btn-block btn-login-red" value="REGISTER">
                            </div>

                        </div>
                        <!--end pricing-box -->

                    </div>
                    <!--end col-md-6 -->

                </form>

            </div>
            <!--end row-->

        <?php
        }
        ?>
        @endif



    </div>
    <!--end container-->

</section>
<!--end section-white