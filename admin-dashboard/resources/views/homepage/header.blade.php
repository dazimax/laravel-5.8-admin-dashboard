<!--begin header -->
<header class="header">

    <!--begin nav -->
    <nav class="navbar navbar-default navbar-fixed-top">

        <!--begin container -->
        <div class="container">

            @if (isset($cmspages))
            <?php
            $isContentHas = false;
            ?>

            @foreach ($cmspages as $cmspage)

            @if (strtolower($cmspage->identifier) == 'header')

            <?php
            $isContentHas = true;
            ?>

            {!! $cmspage->content !!}

            @endif

            @endforeach

            <?php
            if($isContentHas == false){
            //default content
            ?>


            <!--begin navbar -->
            <div class="navbar-header">
                <button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a href="#" class="navbar-brand brand scrool"><img width="55" src="homepage/images/logo.png" ></a>
            </div>

            <div id="navbar-collapse-02" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">			      
                    <li><a href="#home_wrapper">Home</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li>
                        @if(isset(Auth::user()->name))
                            <a href="/user/profile" onclick="window.location.href='/user/profile'">Profile</a>
                        @else
                            <a href="#login">Login</a>
                        @endif
                    </li>
                </ul>
            </div>
            <!--end navbar -->

            <?php
            }
            ?>
            @endif

        </div>
        <!--end container -->

    </nav>
    <!--end nav -->

</header>
<!--end header -->