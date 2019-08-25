<div class="topbar-left">
    <div class="logo">
        <h1><a href="#"><img src="{{ URL::asset('assets/img/logo.png') }}" alt="Logo"></a></h1>
    </div>
    <button class="button-menu-mobile open-left">
        <i class="fa fa-bars"></i>
    </button>
</div>
<!-- Button mobile view to collapse sidebar menu -->
<div class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-collapse2">
<!--            <ul class="nav navbar-nav hidden-xs">-->
<!--                <li class="dropdown">-->
<!--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-th"></i></a>-->
<!--                    <div class="dropdown-menu grid-dropdown">-->
<!--                        <div class="row stacked">-->
<!--                            <div class="col-xs-4">-->
<!--                                <a href="javascript:;" data-app="notes-app" data-status="active"><i class="icon-edit"></i>Notes</a>-->
<!--                            </div>-->
<!--                            <div class="col-xs-4">-->
<!--                                <a href="javascript:;" data-app="todo-app" data-status="active"><i class="icon-check"></i>Todo List</a>-->
<!--                            </div>-->
<!--                            <div class="col-xs-4">-->
<!--                                <a href="javascript:;" data-app="calc" data-status="inactive"><i class="fa fa-calculator"></i>Calculator</a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="row stacked">-->
<!--                            <div class="col-xs-4">-->
<!--                                <a href="javascript:;" data-app="weather-widget" data-status="active"><i class="icon-cloud-3"></i>Weather</a>-->
<!--                            </div>-->
<!--                            <div class="col-xs-4">-->
<!--                                <a href="javascript:;" data-app="calendar-widget2" data-status="active"><i class="icon-calendar"></i>Calendar</a>-->
<!--                            </div>-->
<!--                            <div class="col-xs-4">-->
<!--                                <a href="javascript:;" data-app="stock-app" data-status="inactive"><i class="icon-chart-line"></i>Stocks</a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="clearfix"></div>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li class="language_bar dropdown hidden-xs">-->
<!--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">English (US) <i class="fa fa-caret-down"></i></a>-->
<!--                    <ul class="dropdown-menu pull-right">-->
<!--                        <li><a href="#">German</a></li>-->
<!--                        <li><a href="#">French</a></li>-->
<!--                        <li><a href="#">Italian</a></li>-->
<!--                        <li><a href="#">Spanish</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--            </ul>-->
            <ul class="nav navbar-nav navbar-right top-navbar">
                <li class="dropdown iconify hide-phone"><a href="#" onclick="javascript:toggle_fullscreen()"><i class="icon-resize-full-2"></i></a></li>
                <li class="dropdown topbar-profile">
                    <a href="/user/profile" class="dropdown-toggle" data-toggle="dropdown"><span class="rounded-image topbar-profile-image"><img src="<?php echo (Auth::user()->profileimage != '')?Auth::user()->profileimage:'/assets/img/default_profile.png'; ?>"></span> <strong>{{ Auth::user()->name }}</strong> <i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu">
<!--                        <li><a href="#">My Profile</a></li>-->
<!--                        <li><a href="#">Change Password</a></li>-->
<!--                        <li><a href="#">Account Setting</a></li>-->
<!--                        <li class="divider"></li>-->
                        <li><a href="#"><i class="icon-help-2"></i> Help</a></li>
<!--                        <li><a href="lockscreen.html"><i class="icon-lock-1"></i> Lock me</a></li>-->
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
<!--                <li class="right-opener">-->
<!--                    <a href="javascript:;" class="open-right"><i class="fa fa-angle-double-left"></i><i class="fa fa-angle-double-right"></i></a>-->
<!--                </li>-->
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</div>