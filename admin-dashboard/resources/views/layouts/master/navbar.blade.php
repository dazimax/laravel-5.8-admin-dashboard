<div class="topbar-left">
    <div class="logo">
        <h1><a href="#"><img src="<?php echo (isset($site_settings['logo_image']))?$site_settings['logo_image']:'/assets/img/logo.png'; ?>" alt="Logo"></a></h1>
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
<!--                Notification area-->
                <li class="dropdown iconify hide-phone notify-ul-box">
                    <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-globe"></i><span class="label label-danger absolute">0</span></a> -->
<!--                    <ul class="dropdown-menu dropdown-message notify-ul-messages">-->
<!--                        <li class="dropdown-header notif-header"><i class="icon-bell-2"></i> New Notifications<a class="pull-right" href="#"><i class="fa fa-cog"></i></a></li>-->
<!--                        <li class="unread">-->
<!--                            <a href="#">-->
<!--                                <p><strong>John Doe</strong> Uploaded a photo <strong>"DSC000254.jpg"</strong>-->
<!--                                    <br><i>2 minutes ago</i>-->
<!--                                </p>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li class="unread">-->
<!--                            <a href="#">-->
<!--                                <p><strong>John Doe</strong> Created an photo album  <strong>"Fappening"</strong>-->
<!--                                    <br><i>8 minutes ago</i>-->
<!--                                </p>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <p><strong>John Malkovich</strong> Added 3 products-->
<!--                                    <br><i>3 hours ago</i>-->
<!--                                </p>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <p><strong>Sonata Arctica</strong> Send you a message <strong>"Lorem ipsum dolor..."</strong>-->
<!--                                    <br><i>12 hours ago</i>-->
<!--                                </p>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <p><strong>Johnny Depp</strong> Updated his avatar-->
<!--                                    <br><i>Yesterday</i>-->
<!--                                </p>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li class="dropdown-footer">-->
<!--                            <div class="btn-group btn-group-justified">-->
<!--                                <div class="btn-group">-->
<!--                                    <a href="#" class="btn btn-sm btn-primary"><i class="icon-ccw-1"></i> Refresh</a>-->
<!--                                </div>-->
<!--                                <div class="btn-group">-->
<!--                                    <a href="#" class="btn btn-sm btn-danger"><i class="icon-trash-3"></i> Clear All</a>-->
<!--                                </div>-->
<!--                                <div class="btn-group">-->
<!--                                    <a href="#" class="btn btn-sm btn-success">See All <i class="icon-right-open-2"></i></a>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </li>-->
<!--                    </ul>-->
                </li>

<!--                Message Area-->
<!--                <li class="dropdown iconify hide-phone">-->
<!--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i><span class="label label-danger absolute">3</span></a>-->
<!--                    <ul class="dropdown-menu dropdown-message">-->
<!--                        <li class="dropdown-header notif-header"><i class="icon-mail-2"></i> New Messages</li>-->
<!--                        <li class="unread">-->
<!--                            <a href="#" class="clearfix">-->
<!--                                <img src="images/users/chat/2.jpg" class="xs-avatar ava-dropdown" alt="Avatar">-->
<!--                                <strong>John Doe</strong><i class="pull-right msg-time">5 minutes ago</i><br>-->
<!--                                <p>Duis autem vel eum iriure dolor in hendrerit ...</p>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li class="unread">-->
<!--                            <a href="#" class="clearfix">-->
<!--                                <img src="images/users/chat/1.jpg" class="xs-avatar ava-dropdown" alt="Avatar">-->
<!--                                <strong>Sandra Kraken</strong><i class="pull-right msg-time">22 minutes ago</i><br>-->
<!--                                <p>Duis autem vel eum iriure dolor in hendrerit ...</p>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#" class="clearfix">-->
<!--                                <img src="images/users/chat/3.jpg" class="xs-avatar ava-dropdown" alt="Avatar">-->
<!--                                <strong>Zoey Lombardo</strong><i class="pull-right msg-time">41 minutes ago</i><br>-->
<!--                                <p>Duis autem vel eum iriure dolor in hendrerit ...</p>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li class="dropdown-footer"><div class=""><a href="#" class="btn btn-sm btn-block btn-primary"><i class="fa fa-share"></i> See all messages</a></div></li>-->
<!--                    </ul>-->
<!--                </li>-->

<!--                Other boxes-->
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
                        <!-- <li><a href="{{ URL::to('auth/logout') }}" class="md-trigger" data-modal="logout-modal"><i class="icon-logout-1"></i> Logout</a></li> -->
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="icon-logout-1"></i> {{ __('Logout') }}</a>
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