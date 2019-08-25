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
<?php 
//cover profile pics
$coverpic = '';
if(Auth::user()->coverpic_image != ''){
    $coverpic = URL::asset(Auth::user()->coverpic_image);
}
else{
    //set default
    $coverpic = URL::asset('/images/stock/1epgUO0.jpg');
}

?>
<div class="profile-banner" style="background-image: url({{ $coverpic}});">
    <div class="col-sm-3 avatar-container">
        <img src="<?php echo (Auth::user()->profileimage != '')?Auth::user()->profileimage:'/assets/img/default_profile.png'; ?>" class="img-circle profile-avatar" alt="User avatar">
    </div>
<!--    <div class="col-sm-12 profile-actions text-right">-->
<!--        <button type="button" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Friends</button>-->
<!--        <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-envelope"></i> Send Message</button>-->
<!--        <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-ellipsis-v"></i></button>-->
<!--    </div>-->
</div>
<div class="content">

<div class="row">
<div class="col-sm-3">
    <!-- Begin user profile -->
    <div class="text-center user-profile-2">
        <h4>Howdy, <b>{{ Auth::user()->name }}</b></h4>

<!--        <h5>Administrator</h5>-->
<!--        <ul class="list-group">-->
<!--            <li class="list-group-item">-->
<!--                <span class="badge">1,245</span>-->
<!--                Followers-->
<!--            </li>-->
<!--            <li class="list-group-item">-->
<!--                <span class="badge">245</span>-->
<!--                Following-->
<!--            </li>-->
<!--            <li class="list-group-item">-->
<!--                <span class="badge">1,245</span>-->
<!--                Tweets-->
<!--            </li>-->
<!--        </ul>-->

        <!-- User button -->
<!--        <div class="user-button">-->
<!--            <div class="row">-->
<!--                <div class="col-lg-6">-->
<!--                    <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-envelope"></i> Send Message</button>-->
<!--                </div>-->
<!--                <div class="col-lg-6">-->
<!--                    <button type="button" class="btn btn-default btn-sm btn-block"><i class="fa fa-user"></i> Add as friend</button>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <!-- End div .user-button -->
    </div><!-- End div .box-info -->
    <!-- Begin user profile -->

    <div style="clear:both">&nbsp;</div>

    @if (\Auth::user()->isStaff())

    <div class="widget widget-tabbed">
<!-- Nav tab -->
<ul class="nav nav-tabs nav-justified">
<!--    <li class="active"><a href="#my-timeline" data-toggle="tab"><i class="fa fa-pencil"></i> Timeline</a></li>-->
<!--    <li><a href="#about" data-toggle="tab"><i class="fa fa-user"></i> About</a></li>-->
    <!-- <li class="active"><a href="#user-activities" data-toggle="tab"><i class="fa fa-laptop"></i> Activities</a></li> -->
<!--    <li><a href="#mymessage" data-toggle="tab"><i class="fa fa-envelope"></i> Message</a></li>-->
</ul>
<!-- End nav tab -->

<!-- Tab panes -->

 </div><!-- End div .box-info -->
    @endif
</div>


<div class="col-sm-9">

<!-- Start info box -->
<div class="row top-summary">

    @if (\Auth::user()->isStaff())
        <div class="col-lg-4 col-md-6">
            <div class="widget blue-1 animated fadeInDown">
                <div class="widget-content padding">
                    <div class="widget-icon">
                        <i class="fa fa-usd"></i>
                    </div>
                    <div class="text-box">
                        <p class="maindata">TOTAL <b>SUBSCRIPTIONS</b></p>
                        <h2><span class="animate-number total-active-plans" data-value="1" data-duration="3000">0</span></h2>
                        <div class="clearfix"></div>
                    </div>
                </div>
    <!--            <div class="widget-footer">-->
    <!--                <div class="row">-->
    <!--                    <div class="col-sm-12">-->
    <!--                        <i class="fa fa-caret-up rel-change"></i> <b>39%</b> increase in traffic-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="clearfix"></div>-->
    <!--            </div>-->
            </div>
        </div>
    @endif

    @if (\Auth::user()->isStaff())
        <div class="col-lg-4 col-md-6">

            <div class="widget red-1 animated fadeInDown">
                <div class="widget-content padding">
                    <div class="widget-icon">
                        <i class="fa fa-bell-o"></i>
                    </div>
                    <div class="text-box">
                        <p class="maindata">EXPIRE <b> SUBSRIPTIONS</b></p>
                        <h2><span class="animate-number total-today-expire-plans" data-value="1" data-duration="3000">0</span></h2>
                        <div class="clearfix"></div>
                    </div>
                </div>
    <!--            <div class="widget-footer">-->
    <!--                <div class="row">-->
    <!--                    <div class="col-sm-12">-->
    <!--                        <i class="fa fa-caret-up rel-change"></i> <b>39%</b> increase in traffic-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="clearfix"></div>-->
    <!--            </div>-->
            </div>
        </div>
    @endif
    <!-- @if (\Auth::user()->isStaff())
        <div class="col-lg-4 col-md-6">
            <div class="widget lightblue-1 animated fadeInDown">
                <div class="widget-content padding">
                    <div class="widget-icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="text-box">
                        <p class="maindata">TOTAL <b>ACTIVE USERS</b></p>
                        <h2><span class="animate-number total-active-users" data-value="1" data-duration="3000">0</span></h2>
                        <div class="clearfix"></div>
                    </div>
                </div>\
            </div>
        </div>
    @endif -->
    <input type="hidden" name="_token" id="tokenkey" value="{{ csrf_token() }}">

</div>
<!-- End of info box -->

<!-- Start Detail Box -->

    <div class="row">
        <div class="col-sm-7">
            <div id="notes-app" class="widget">
                <div class="notes-line"></div>
                <div class="widget-header centered transparent">
                    <div class="left-btn btn-group"><a class="btn btn-sm btn-primary add-note"><i class="fa fa-plus"></i></a><a class="btn btn-sm btn-primary back-note-list"><i class="icon-align-justify"></i></a></div>
                    <h2>Notes</h2>
                    <div class="additional-btn">
                        <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                        <a href="#" class="widget-popout hidden tt" title="Pop Out/In"><i class="icon-publish"></i></a>
                        <a href="#" class="widget-maximize hidden"><i class="icon-resize-full-1"></i></a>
                        <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                        <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                    </div>
                </div>
                <div class="widget-content padding-sm">
                    <div id="notes-list">
                        <div class="scroller">
                            <ul class="list-unstyled">
                            </ul>
                        </div>
                    </div>
                    <div id="note-data">
                        <form>
                            <textarea class="form-control" id="note-text" placeholder="Your note..."></textarea>
                        </form>
                    </div>
                    <div class="status-indicator">Saved</div>
                </div>
            </div>
        </div>
        <div class="col-sm-5 portlets">
            <div id="calendar-widget2" class="widget blue-1 bic_calender">
                <div class="widget-header transparent">
                    <h2><strong>Calendar</strong> Widget</h2>
                    <div class="additional-btn">
                        <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                        <a href="#" class="widget-popout hidden tt" title="Pop Out/In"><i class="icon-publish"></i></a>
                        <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                        <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                    </div>
                </div>
                <div id="calendar-box2" class="widget-content col-sm-12 bic_calender">

                </div>
            </div>
        </div>
    </div>

</div>

</div>

<!-- Footer Start -->
@include('layouts.master.footer')

<script>
    $(document).ready(function(){

        setInterval(function(){
            var token = $("#tokenkey").val();
            var trackingcodepin = "<?php echo md5(\Auth::user()->id).md5('demo'); ?>";
            var base_url = window.location.origin;
            $.post(
                base_url+"/user/access/ajaxactivitieslistitems",
                {'_token':token,'trackingcode':trackingcodepin},
                function(data,status,xhr){
                    $("#useractivitylistitems").html(data);
                },
                'text'
            );
        }, 1000*5);

        //Dashboard items
        var token = $("#tokenkey").val();
            var trackingcodepin = "<?php echo md5(\Auth::user()->id).md5('demo'); ?>";
            var base_url = window.location.origin;

            //default check total active users
            $.post(
                base_url+"/user/access/users/countonline",
                {'_token':token,'trackingcode':trackingcodepin},
                function(data,status,xhr){
                    $(".total-active-users").attr('data-value', data.activeuserscount);
                    //$(".total-active-users").text(data.activeuserscount);
                },
                'json'
            );

            setTimeout(function(){
              $('.animate-number').each(function(){
                $(this).animateNumbers($(this).attr("data-value"), true, parseInt($(this).attr("data-duration")));
              });
            }, 1000*3);

            //loop on current count
           setInterval(function(){

            var token = $("#tokenkey").val();
            var trackingcodepin = "<?php echo md5(\Auth::user()->id).md5('demo'); ?>";
            var base_url = window.location.origin;

               //check users
                $.post(
                    base_url+"/user/access/users/countonline",
                    {'_token':token,'trackingcode':trackingcodepin},
                    function(data,status,xhr){
                        $(".total-active-users").attr('data-value', data.activeuserscount);
                        $(".total-active-users").text(data.activeuserscount);
                    },
                    'json'
                );


              //check today expire plans
              //default check total today expire plans
            $.post(
                base_url+"/chartPlan/todayexpirecount",
                {'_token':token,'trackingcode':trackingcodepin},
                function(data,status,xhr){
                    $(".total-today-expire-plans").attr('data-value', data.todayexpireplans);
                    $(".total-today-expire-plans").text(data.todayexpireplans);
                },
                'json'
            );

          }, 1000*60*5);

    });
</script>

</body>

<!-- Mirrored from hubancreative.com/projects/templates/coco/corporate/forms.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Jun 2016 20:04:50 GMT -->
</html>
