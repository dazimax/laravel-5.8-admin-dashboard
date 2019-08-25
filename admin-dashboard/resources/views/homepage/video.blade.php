<!--begin container-->
<div class="container">

    @if (isset($cmspages))
    <?php
    $isContentHas = false;
    ?>

    @foreach ($cmspages as $cmspage)

    @if (strtolower($cmspage->identifier) == 'video')

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
    <div class="row">

        <!--begin col-md-6-->
        <div class="col-md-6 margin-top-35 margin-bottom-30">

            <h3 class="medium-title">Watch the video presentation.</h3>

            <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia magni dolores eos qui ratione sequi nesciunt. Neque porro quisquam est, qui ipsum quiaim netsum. Consequuntur sequimagni.</p>

            <p>Consequuntur magni netsum es qui ratione sequi nesciunt. Neque vetim quisquat, quia voluptas quistri ipsum quiaim  magni eti ratione.</p>

            <a href="#" class="btn btn-lg btn-blue small margin-top-10">Discover More</a>

        </div>
        <!--end col-sm-6-->

        <!--begin col-md-6-->
        <div class="col-md-6 margin-top-30 margin-bottom-30">

            <iframe src="http://player.vimeo.com/video/125804170?title=0&amp;byline=0&amp;portrait=0" height="312" width="555"></iframe>

        </div>
        <!--end col-sm-6-->

    </div>
    <!--end row-->

    <?php
    }
    ?>
    @endif

</div>
<!--end container-->