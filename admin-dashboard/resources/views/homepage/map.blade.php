<div class="newsletter_wrapper" id="map">

    <!--begin container-->
    <div class="container">
      <?php
       $isContentHas = false;
      ?>
      @if (isset($cmspages))
         @foreach ($cmspages as $cmspage)

        @if (strtolower($cmspage->identifier) == 'findushere')
        <?php
            $isContentHas = true;
        ?>
        <div class="row margin-top-50">

            <!--begin col-md-10-->
            <div class="col-md-10 col-md-offset-1 text-center">
                <h2 class="section-title grey">{{ $cmspage->title }}</h2>

                <div class="separator_wrapper_white">
                    <i class="icon icon-star-two grey"></i>
                </div>

                <!--<p class="section-subtitle grey">There are many variations of passages of Lorem Ipsum available, but the majority<br>have suffered alteration, by injected humour, or new randomised words.</p>-->
            </div>
            <!--end col-md-10-->

        </div>

        <!--begin newsletter_box-->
        <div class="newsletter_box">

            <!--begin row-->
            <div class="row">

                <!--begin col-md-3-->
                {!! $cmspage->content !!}
                <!--end col-md-9 -->

            </div>
            <!--end row -->

        </div>
        <!--end newsletter_box -->

        @endif

        @endforeach

        <?php
          if($isContentHas == false){
              //default content
            ?>

              <div class="row margin-top-50">

                  <!--begin col-md-10-->
                  <div class="col-md-10 col-md-offset-1 text-center">
                      <h2 class="section-title grey">Find us Here</h2>

                      <div class="separator_wrapper_white">
                          <i class="icon icon-star-two grey"></i>
                      </div>

                      <!--<p class="section-subtitle grey">There are many variations of passages of Lorem Ipsum available, but the majority<br>have suffered alteration, by injected humour, or new randomised words.</p>-->
                  </div>
                  <!--end col-md-10-->

              </div>

              <!--begin newsletter_box-->
              <div class="newsletter_box">

                  <!--begin row-->
                  <div class="row">

                      <!--begin col-md-3-->
                      <div class="col-md-9">

                          <!--<div class="row">-->
                          <center>
                              <center>
                                  <div id="gmap-1" class="map-box">
                                     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.7733958920358!2d79.8531824141946!3d6.917672720375936!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2596b1c2ae5b1%3A0x872e9262f485d782!2sColombo+City+Centre!5e0!3m2!1sen!2slk!4v1566521218682!5m2!1sen!2slk" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>  
                                  </div>
                              </center>
                          </center>
                      </div>
                      <!--end col-md-3 -->

                      <!--begin col-md-9 -->
                      <div class="col-md-3">

                          <!--begin newsletter_info -->
                          <!--<div class="newsletter_info">-->
                          <p style="font-size: 16px;"><b>Address</b></p>
                          <p style="font-size: 14px;">Address Line 1,
                              <br>Address Line 2</p>
                          <p style="font-size: 16px;"><b>Contacts</b>
                          <p style="font-size: 14px;">E-mail: info@domain.com
                          </p>
                          <!--</div>-->
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


    </div>
    <!--begin container-->

</div>
<!--end contact-->
