<div class="sidebar-inner slimscrollleft">
    <!-- Search form -->
<!--    <form role="search" class="navbar-form">-->
<!--        <div class="form-group">-->
<!--            <input type="text" placeholder="Search" class="form-control">-->
<!--            <button type="submit" class="btn search-button"><i class="fa fa-search"></i></button>-->
<!--        </div>-->
<!--    </form>-->
<!--    <div class="clearfix"></div>-->
    <!--- Profile -->
    <div class="profile-info" style="margin-top: 10px;">
        <div class="col-xs-4">
            <a href="/user/profile" class="rounded-image profile-image"><img src="<?php echo (Auth::user()->profileimage != '')?Auth::user()->profileimage:'/assets/img/default_profile.png'; ?>"></a>
        </div>
        <div class="col-xs-8">
            <div class="profile-text">Welcome <b>{{ Auth::user()->name }}</b></div>
        </div>
    </div>
    <!--- Divider -->
    <div class="clearfix"></div>
    <hr class="divider" />
    <div class="clearfix"></div>
    <!--- Divider -->
    <div id="sidebar-menu">
        <ul>
            <!--<li class='has_sub' onclick="window.location='/user/dashboard'">
                <a href='/user/dashboard'><i class='icon-home-3'>
                    </i><span>Dashboard</span> <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                </a>
            </li> -->
            <li class='has_sub'>
                <a href='javascript:void(0);' class="main-menu-item"><i class='icon-user-3'></i><span>Profile</span> <span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                <ul>
                    <li><a class="user-profile" href='/user/profile'><span>View</span></a></li>
                    <li><a class="user-profile-settings" href='/user/profile/settings'><span>Edit</span></a></li>
                </ul>
            </li>
            @if (\Auth::user()->isStaff())
                <li class='has_sub'>
                    <a href='javascript:void(0);' class="main-menu-item">
                        <i class='icon-pencil-3'></i><span>CMS Contents</span>
                            <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                        <li><a class="email-templates" href='/email/templates'><span>Email Templates</span></a></li>
                        <!-- Hide for admins -->
                        <?php if(\Auth::user()->role_id != 2){ ?>
                          <li><a class="user-profile-cms-pages" href='/user/profile/cms/pages'><span>Pages</span></a></li>
                          <li><a class="user-profile-cms-pages-new" href='/user/profile/cms/pages/new'><span>Add New Page</span></a></li>
                        <?php } ?>
                    </ul>
                </li>
            @endif
            
            @if (\Auth::user()->isStaff())
                <li class='has_sub'>
                    <a href='javascript:void(0);' class="main-menu-item"><i class='icon-lock-3'></i><span>User Access</span> <span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                    <ul>
                      <!-- Hide for admins -->
                      <?php if(\Auth::user()->role_id != 2){ ?>   
                        <li><a class="user-access-roles" href='/user/access/roles'><span>User Roles</span></a></li>
                        <li><a class="user-access-users" href='/user/access/users'><span>Staff</span></a></li>
                      <?php } ?>  
                        <li><a class="user-access-clients" href='/user/access/clients'><span>Clients</span></a></li>
                      <!-- Hide for admins -->
                      <?php /*if(\Auth::user()->role_id != 2){ ?>     
                        <li><a class="user-access-activities" href='/user/access/activities'><span>User Activities</span></a></li>
                      <?php } */ ?>
                    </ul>
                </li>
                <!-- Hide for admins -->
                <?php if(\Auth::user()->role_id != 2){ ?>  
                <li class='has_sub'>
                    <a href='javascript:void(0);' class="main-menu-item"><i class='icon-cog'></i><span>Settings</span> <span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                    <ul>
                        <li><a class="settings-configurations" href='/settings/configurations'><span>General Configurations</span></a></li>
                        <li><a class="settings-emailconfigurations" href='/settings/emailconfigurations'><span>Email Configurations</span></a></li>
                    </ul>
                </li>
                <?php } ?>
            @endif
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <div class="clearfix"></div><br><br><br>
</div>
<div class="left-footer">
    <div class="progress progress-xs">
        <div class="progress-bar bg-green-1" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
            <span class="progress-precentage">80%</span>
        </div>
        <a data-toggle="tooltip" title="See task progress" class="btn btn-default md-trigger" data-modal="task-progress"><i class="fa fa-inbox"></i></a>
    </div>
</div>

<script>
  jQuery(document).ready(function(){

      //auto select left side ul li items
      setTimeout(function(){
          var url = window.location.href;
          var uparams = url.split('/');
          var countstart = 3;
          var urlclassname = "";
          for(var i=countstart; i < uparams.length; i++){
              if(i == countstart) urlclassname = uparams[i];
              else urlclassname = urlclassname+"-"+uparams[i];
          }
          if(jQuery('.'+urlclassname).length == 0){
              var urlclassname = "";
              for(var i=countstart; i < uparams.length-1; i++){
                  if(i == countstart) urlclassname = uparams[i];
                  else urlclassname = urlclassname+"-"+uparams[i];
              }
          }
          if(jQuery('.'+urlclassname).length == 0){
              var urlclassname = "";
              for(var i=countstart; i < uparams.length-2; i++){
                  if(i == countstart) urlclassname = uparams[i];
                  else urlclassname = urlclassname+"-"+uparams[i];
              }
          }

          jQuery('.'+urlclassname).parents('.has_sub').find('a').first().click();
          jQuery('.'+urlclassname).addClass('slidebar-selected-item');
          jQuery('.'+urlclassname).parents('.has_sub').find('.main-menu-item').addClass('active');
      }, 500*1);

  });

</script>