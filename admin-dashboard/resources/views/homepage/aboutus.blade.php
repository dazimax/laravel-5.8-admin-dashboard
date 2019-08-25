<!----------------------------------------------------------  About Us ----------------------------------------------------------------------!>		

<!--begin newsletter_wrapper-->
@if (isset($cmspages))
    <?php
        $isContentHas = false;
    ?>

    @foreach ($cmspages as $cmspage)
<div class="newsletter_wrapper" id="about">

    <!--begin container-->
    <div class="container">
        @if (strtolower($cmspage->identifier) == 'aboutus')

        <?php
        $isContentHas = true;
        ?>

        <div class="col-md-10 col-md-offset-1 text-center">
            <h2 class="section-title grey">{{ $cmspage->title }}</h2>

            {!! $cmspage->content !!}

        @endif

    </div>
    <!--begin container-->

</div>
<!--begin newsletter_wrapper-->

    @endforeach

    <?php
    if($isContentHas == false){
    //default content
    ?>
        <div class="col-md-10 col-md-offset-1 text-center">
            <h2 class="section-title grey">About us</h2>
            <div class="separator_wrapper_white">
                <i class="icon icon-star-two grey"></i>
            </div>
            <p class="section-subtitle grey">
                About Us Demo Content goes here..
            </p>
        </div>

        <!--begin newsletter_box-->
        <div class="newsletter_box">
            <!--begin row-->
            <div class="row">
                <!--begin col-md-3-->
                <div class="col-md-3">
                    <!-- <img src="homepage/images/about.png" alt="picture" class="padding-top-25"> -->
                </div>
                <!--end col-md-3 -->
                <!--begin col-md-9 -->
                <div class="col-md-9">
                    <!--begin newsletter_info -->
                    <div class="newsletter_info">
                        <!-- <p>Fresh is fulfilling a global demand, at a local level, for inspired and cost-effective design solutions, resulting in the very best contemporary environments that enhance people’s everyday experiences. Our hardworking, friendly Fresh teams are fully committed to the consistent delivery of Fresh ideas. From offices across the world the Fresh Design International network of agencies provide full design and architectural services. </p> -->
                        <!--end newsletter-form -->
                    </div>
                    <!--end newsletter_info -->
                </div>
                <!--end col-md-9 -->
            </div>
            <!--end row -->
        </div>
        <!--end newsletter_box -->
    <?php
    }
    ?>
@endif
