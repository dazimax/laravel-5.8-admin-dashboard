<!--begin footer -->
<div class="footer">

    <!--begin container -->
    <div class="container">

        @if (isset($cmspages))
        <?php
        $isContentHas = false;
        $pagecontent = '';
        ?>

        @foreach ($cmspages as $cmspage)
            @if (strtolower($cmspage->identifier) == 'footer')
                <?php
                $pagecontent = $cmspage->content;
                $isContentHas = true;
                echo $pagecontent;
                ?>
            @endif
        @endforeach
        @endif


        <?php
        if($isContentHas == false){
        //default content
        ?>

            <!--begin row -->
            <div class="row">

                <!--begin col-md-12 -->
                <div class="col-md-12 text-center">

                    <!--begin copyright -->
                    <div class="copyright">
                        <!-- <p>Copyright © 2019.</p> -->

                    </div>
                    <!--end copyright -->

                    <!--begin footer_social -->
                    <ul class="footer_social">
                        <li>
                            <a href="#">
                                <i class="icon icon-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon icon-pinterest"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon icon-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon icon-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon icon-skype"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon icon-dribble"></i>
                            </a>
                        </li>
                    </ul>
                    <!--end footer_social -->

                </div>
                <!--end col-md-6 -->

            </div>
            <!--end row -->

        <?php
        }
        ?>

    </div>
    <!--end container -->

</div>
<!--end footer -->