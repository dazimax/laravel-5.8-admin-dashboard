<!-- ============================================================== -->
<!-- Start Content here -->
<!-- ============================================================== -->
<div class="content">
<!-- Start info box -->
<div class="row top-summary">

    @if (\Auth::user()->isStaff())
        <div class="col-lg-3 col-md-6">
            <div class="widget blue-1 animated fadeInDown">
                <div class="widget-content padding">
                    <div class="widget-icon">
                        <i class="fa fa-usd"></i>
                    </div>
                    <div class="text-box">
                        <p class="maindata">TOTAL <b>SUBSCRIPTIONS</b></p>
                        <h2><span class="animate-number total-active-plans" data-value="1" data-duration="3000">0</span></h2>
                        <div class="clearfix"></div>
                    </div>
                </div>
    <!--            <div class="widget-footer">-->
    <!--                <div class="row">-->
    <!--                    <div class="col-sm-12">-->
    <!--                        <i class="fa fa-caret-up rel-change"></i> <b>39%</b> increase in traffic-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="clearfix"></div>-->
    <!--            </div>-->
            </div>
        </div>
    @endif

    @if (\Auth::user()->isStaff())
        <div class="col-lg-3 col-md-6">

            <div class="widget red-1 animated fadeInDown">
                <div class="widget-content padding">
                    <div class="widget-icon">
                        <i class="fa fa-bell-o"></i>
                    </div>
                    <div class="text-box">
                        <p class="maindata">TODAY'S <b> EXPIRE SUBSRIPTIONS</b></p>
                        <h2><span class="animate-number total-today-expire-plans" data-value="1" data-duration="3000">0</span></h2>
                        <div class="clearfix"></div>
                    </div>
                </div>
    <!--            <div class="widget-footer">-->
    <!--                <div class="row">-->
    <!--                    <div class="col-sm-12">-->
    <!--                        <i class="fa fa-caret-up rel-change"></i> <b>39%</b> increase in traffic-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="clearfix"></div>-->
    <!--            </div>-->
            </div>
        </div>
    @endif
    <!-- @if (\Auth::user()->isStaff())
        <div class="col-lg-3 col-md-6">
            <div class="widget lightblue-1 animated fadeInDown">
                <div class="widget-content padding">
                    <div class="widget-icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="text-box">
                        <p class="maindata">TOTAL <b>ACTIVE USERS</b></p>
                        <h2><span class="animate-number total-active-users" data-value="1" data-duration="3000">0</span></h2>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    @endif -->
    <input type="hidden" name="_token" id="tokenkey" value="{{ csrf_token() }}">

</div>
<!-- End of info box -->

    <script>
        $(document).ready(function(){

            setTimeout(function(){
              $('.animate-number').each(function(){
                $(this).animateNumbers($(this).attr("data-value"), true, parseInt($(this).attr("data-duration")));
              });
            }, 1000*3);
        });
    </script>

<!-- Footer Start -->
