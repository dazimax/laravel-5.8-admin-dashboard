<!DOCTYPE html>
<html lang="en">

    <head>
        @include('homepage.head')
    </head>
    <body>
        <div id="ajax-loader" class="loaderOverlay hidden">
            <div class="loader"></div>
        </div>
        <!--begin loader -->
        <div id="loader">
            <div class="sk-three-bounce">
                <div class="sk-child sk-bounce1"></div>
                <div class="sk-child sk-bounce2"></div>
                <div class="sk-child sk-bounce3"></div>
            </div>
        </div>
        <!--end loader -->

        <!-- header -->
        @include('homepage.header')

        <!--begin home_wrapper -->
        <section id="home_wrapper" class="home-wrapper">

            <!--begin gradient_overlay -->
            <div class="gradient_overlay"></div>
            <!--end gradient_overlay -->

            <!-- top banner -->
            @include('homepage.topbanner')

            <!--begin newsletter_wrapper-->

            <!--begin section-white -->
            <section class="section-white medium-padding">

            <!-- video presentation -->
                @include('homepage.video')

                @include('homepage.features')      

                @include('homepage.aboutus')      

                @include('homepage.contactus')      

                @include('homepage.map')      

                @include('homepage.login')      

                @include('homepage.footer')      

            </section>

        </section>



        <!-- Load JS here for greater good =============================-->

        <script src="homepage/js/jquery.magnific-popup.min.js"></script>
        <script src="homepage/js/jquery.nav.js"></script>
        <script src="homepage/js/jquery.scrollTo-min.js"></script>
        <script src="homepage/js/SmoothScroll.js"></script>
        <script src="homepage/js/wow.js"></script>

        <!-- begin layerslider script-->
        <script src="homepage/layerslider/js/greensock.js"></script>
        <script src="homepage/layerslider/js/layerslider.transitions.js"></script>
        <script src="homepage/layerslider/js/layerslider.kreaturamedia.jquery.js"></script>

        <!--reCaptcha-->
        <script src="js/google-capcha/api.js" async defer></script>

        <!-- begin custom script-->
        <script src="homepage/js/custom.js"></script>
        <script src="homepage/js/plugins.js"></script>
    </body>
</html>


