<!--begin container-->
<div class="container">

    @if (isset($cmspages))
    <?php
    $isContentHas = false;
    ?>

    @foreach ($cmspages as $cmspage)

    @if (strtolower($cmspage->identifier) == 'topbanner')

    <?php
    $isContentHas = true;
    ?>

    <!--begin row-->
    <div class="row">

        <!--begin col-md-12-->
        <div class="col-md-12 text-center padding-top-80">

            <h1 class="home-title wow fadeIn" data-wow-delay="0.5s">{{ $cmspage->title }}</h1>

            {!! $cmspage->content !!}

        </div>
        <!--end col-md-12-->

    </div>
    <!--end row-->

    @endif

    @endforeach

    <?php
    if($isContentHas == false){
    //default content
    ?>

    <!--begin row-->
    <div class="row">

        <!--begin col-md-12-->
        <div class="col-md-12 text-center padding-top-80" style="margin-bottom:20px">

            <h1 class="home-title wow fadeIn" data-wow-delay="0.5s">WELCOME TO FRONT-END</h1>

            <p class="home-subtitle wow fadeIn" data-wow-delay="1s">
                Demo content goes here..
            </p>

            <!--  <a href="#login" class="btn btn-lg btn-margin btn-white scrool wow fadeIn" data-wow-delay="1.5s">Register Today!</a> -->

            <a href="#login" class="btn btn-lg btn-white-transparent scrool wow fadeIn" data-wow-delay="1.75s">Discover More!</a>
            <!-- <a href="#login" class="btn btn-lg btn-margin btn-white scrool wow fadeIn" data-wow-delay="1.5s"> Login!</a> -->
            <!-- <button href="#login"  data-toggle="modal" class="demo btn btn-blue">
                          Login
                       </button> -->

            <!-- <img src="homepage/images/browsers.png" alt="Browsers" class="width-100 padding-top-50 wow bounceInUp" data-wow-delay="2.5s"> -->

        </div>
        <!--end col-md-12-->

    </div>
    <!--end row-->

    <?php
    }
    ?>
    @endif

</div>
<!--end container-->