<!--begin story-->
<section class="section-grey small-padding-bottom story" id="features">

    <!--begin container-->
    <div class="container">

    @if (isset($cmspages))
    <?php
    $isContentHas = false;
    ?>

    @foreach ($cmspages as $cmspage)

    @if (strtolower($cmspage->identifier) == 'features')

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

        <!--begin row-->
        <div class="row margin-bottom-50">

            <!--begin col-md-12-->
            <div class="col-md-12 text-center">
                <h2 class="section-title">Amazing Features</h2>

                <div class="separator_wrapper">
                    <i class="icon icon-star-two red"></i>
                </div>

                <p class="section-subtitle">There are many variations of passages of Lorem Ipsum available, but the majority<br>have suffered alteration, by injected humour, or new randomised words.</p>
            </div>
            <!--end col-md-12-->

        </div>
        <!--end row-->

        <!--begin row-->
        <div class="row">

            <!--begin col-md-6 col-sm-12-->
            <div class="col-md-6 col-sm-12">

                <!--begin story-block-->
                <div class="story-block story-left">

                    <!--begin story-text-->
                    <div class="story-text">

                        <h4>Flat Modern Design</h4>

                        <p>Lorem ipsum dolor sita amet, consectetur elitum suspendise rutrum eleifend arcu situm net amet magni sequi tempor.</p>

                    </div>
                    <!--end story-text-->

                    <!--begin story-image-->
                    <div class="story-image">

                        <img src="homepage/images/icons/icon2.png" alt="">

                    </div>
                    <!--end story-image-->

                    <span class="story-arrow"></span>

                    <span class="h-line"></span>

                </div>
                <!--end story-block-->

            </div>
            <!--end col-md-6 col-sm-12-->

            <!--begin col-md-6 col-sm-12-->
            <div class="col-md-6 col-sm-12">

                <!--begin story-block-->
                <div class="story-block story-right">

                    <!--begin story-text-->
                    <div class="story-text">

                        <h4>Multipurpose Template</h4>

                        <p>Lorem ipsum dolor sita amet, consectetur elitum suspendise rutrum eleifend arcu situm net amet magni sequi tempor.</p>

                    </div>
                    <!--end story-text-->

                    <!--begin story-image-->
                    <div class="story-image">

                        <img src="homepage/images/icons/icon3.png" alt="">

                    </div>
                    <!--end story-image-->

                    <span class="story-arrow"></span>

                    <span class="h-line"></span>

                </div>
                <!--end story-block-->

            </div>
            <!--end col-md-6 col-sm-12-->

        </div>
        <!--end row-->

        <!--begin row-->
        <div class="row">

            <!--begin col-md-6 col-sm-12-->
            <div class="col-md-6 col-sm-12">

                <!--begin story-block-->
                <div class="story-block story-left">

                    <!--begin story-text-->
                    <div class="story-text">

                        <h4>Documentation Included</h4>

                        <p>Lorem ipsum dolor sita amet, consectetur elitum suspendise rutrum eleifend arcu situm net amet magni sequi tempor.</p>

                    </div>
                    <!--end story-text-->

                    <!--begin story-image-->
                    <div class="story-image">

                        <img src="homepage/images/icons/icon8.png" alt="">

                    </div>
                    <!--end story-image-->

                    <span class="story-arrow"></span>

                    <span class="h-line"></span>

                </div>
                <!--end story-block-->

            </div>
            <!--end col-md-6 col-sm-12-->

            <!--begin col-md-6 col-sm-12-->
            <div class="col-md-6 col-sm-12">

                <!--begin story-block-->
                <div class="story-block story-right">

                    <!--begin story-text-->
                    <div class="story-text">

                        <h4>Working Newsletter</h4>

                        <p>Lorem ipsum dolor sita amet, consectetur elitum suspendise rutrum eleifend arcu situm net amet magni sequi tempor.</p>

                    </div>
                    <!--end story-text-->

                    <!--begin story-image-->
                    <div class="story-image">

                        <img src="homepage/images/icons/icon4.png" alt="">

                    </div>
                    <!--end story-image-->

                    <span class="story-arrow"></span>

                    <span class="h-line"></span>

                </div>
                <!--end story-block-->

            </div>
            <!--end col-md-6 col-sm-12-->

        </div>
        <!--end row-->

        <!--begin row-->
        <div class="row">

            <!--begin col-md-6 col-sm-12-->
            <div class="col-md-6 col-sm-12">

                <!--begin story-block-->
                <div class="story-block story-left last">

                    <!--begin story-text-->
                    <div class="story-text">

                        <h4>Well Explained Code</h4>

                        <p>Lorem ipsum dolor sita amet, consectetur elitum suspendise rutrum eleifend arcu situm net amet magni sequi tempor.</p>

                    </div>
                    <!--end story-text-->

                    <!--begin story-image-->
                    <div class="story-image">

                        <img src="homepage/images/icons/icon9.png" alt="">

                    </div>
                    <!--end story-image-->

                    <span class="story-arrow"></span>

                    <span class="h-line"></span>

                </div>
                <!--end story-block-->

            </div>
            <!--end col-md-6 col-sm-12-->

            <!--begin col-md-6 col-sm-12-->
            <div class="col-md-6 col-sm-12">

                <!--begin story-block-->
                <div class="story-block story-right last">

                    <!--begin story-text-->
                    <div class="story-text">

                        <h4>24/7 Support</h4>

                        <p>Lorem ipsum dolor sita amet, consectetur elitum suspendise rutrum eleifend arcu situm net amet magni sequi tempor.</p>

                    </div>
                    <!--end story-text-->

                    <!--begin story-image-->
                    <div class="story-image">

                        <img src="homepage/images/icons/icon0.png" alt="">

                    </div>
                    <!--end story-image-->

                    <span class="story-arrow"></span>

                    <span class="h-line"></span>

                </div>
                <!--end story-block-->

            </div>
            <!--end col-md-6 col-sm-12-->

        </div>
        <!--end row-->

    <?php
    }
    ?>
    @endif

    </div>
    <!--end container-->

</section> 
<!--end story-->
