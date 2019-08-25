
<!--begin contact -->
<section class="section-dark" id="contact">

    <!--begin container-->
    <div class="container">
      @if (isset($cmspages))
      <?php
      $isContentHas = false;
      ?>

       @foreach ($cmspages as $cmspage)

        @if (strtolower($cmspage->identifier) == 'contactus')

        <?php
        $isContentHas = true;
        ?>

        <!--begin row-->
        <div class="row margin-bottom-50">

            <!--begin col-md-10-->
            <div class="col-md-10 col-md-offset-1 text-center">
                <h2 class="section-title white">{{ $cmspage->title }}</h2>

                <div class="separator_wrapper_white">
                    <i class="icon icon-star-two white"></i>
                </div>

                {!! $cmspage->content !!}
            </div>
            <!--end col-md-10-->

        </div>
        <!--end row-->

        <!--begin row-->

        <div class="contact-info">
            <!--begin contact form -->
            <form id="home-contact-form" class="contact" action="<?php echo action('HomePageController@postContact'); ?>" method="post">

                <!--begin col-md-6-->
                <div class="col-md-6">
                    <input class="contact-input white-input" required="" name="contactName" placeholder="Full Name*" type="text">
                    <input class="contact-input white-input" required="" name="contactEmail" placeholder="Email Adress*" type="email">
                    <input class="contact-input white-input" required="" name="contactPhone" placeholder="Phone Number*" type="text">
                    {{ csrf_field() }}
                </div>
                <!--end col-md-6-->

                <!--begin col-md-6-->
                <div class="col-md-6">
                    <textarea class="contact-commnent white-input" rows="2" cols="20" name="contactMessage" placeholder="Your Message..."></textarea>
                </div>
                <!--end col-md-6-->

                <!--begin col-md-12-->
                <div class="col-md-12">
                    <input value="Send Message" id="submit-button" class="contact-submit" type="submit">
                </div>


            </form>
            <!--end contact form -->

        </div>
        <!--begin row-->

        <!--end row-->
        @endif

        @endforeach

        <?php
        if($isContentHas == false){
            //default content
            ?>
            <!--begin row-->
            <div class="row margin-bottom-50">

                <!--begin col-md-10-->
                <div class="col-md-10 col-md-offset-1 text-center">
                    <h2 class="section-title white">Get In Touch</h2>

                    <div class="separator_wrapper_white">
                        <i class="icon icon-star-two white"></i>
                    </div>

                    <p class="section-subtitle grey">Demo Content goes here..</p>
                </div>
                <!--end col-md-10-->

            </div>
            <!--end row-->

            <!--begin row-->

            <div class="contact-info">
                <!--begin contact form -->
                <form id="home-contact-form" class="contact" action="<?php echo action('HomePageController@postContact'); ?>" method="post">

                    <!--begin col-md-6-->
                    <div class="col-md-6">
                        <input class="contact-input white-input" required="" name="contactName" placeholder="Full Name*" type="text">
                        <input class="contact-input white-input" required="" name="contactEmail" placeholder="Email Adress*" type="email">
                        <input class="contact-input white-input" required="" name="contactPhone" placeholder="Phone Number*" type="text">
                        {{ csrf_field() }}
                    </div>
                    <!--end col-md-6-->

                    <!--begin col-md-6-->
                    <div class="col-md-6">
                        <textarea class="contact-commnent white-input" rows="2" cols="20" name="contactMessage" placeholder="Your Message..."></textarea>
                    </div>
                    <!--end col-md-6-->

                    <!--begin col-md-12-->
                    <div class="col-md-12">
                        <input value="Send Message" id="submit-button" class="contact-submit" type="submit">
                    </div>


                </form>
                <!--end contact form -->

            </div>
            <!--begin row-->

        <?php
        }
        ?>
        @endif

    </div>
    <!--end container-->

</section>

