<!-- Footer Start -->
<footer id="master-layout-footer">
            <?php 
            if($site_settings =! null && isset($site_settings['system_footer_content'])){
                echo $site_settings['system_footer_content'];
            }else{
            ?>
                Demo &copy; <script>document.write(new Date().getFullYear())</script>  <a href="http://www.digitalspiky.com" target="_blank">DigitalSpiky</a>
                    <div class="footer-links pull-right">
                    <a href="#">About</a><a href="#">Support</a><a href="#">Terms of Service</a><a href="#">Legal</a><a href="#">Help</a><a href="#">Contact Us</a>
                    </div>
                <?php
            }
            ?>
        </footer>

<!-- Footer End -->
</div>
<!-- ============================================================== -->
<!-- End content here -->
<!-- ============================================================== -->

<script>
    var resizefunc = [];
</script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ URL::asset('assets/libs/jqueryui/jquery-ui-1.10.4.custom.min.js') }}"></script>
<script type="text/javascript">
    // Change JQueryUI plugin names to fix name collision with Bootstrap.
    $.widget.bridge('uitooltip', $.ui.tooltip);
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{ URL::asset('assets/libs/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jquery-ui-touch/jquery.ui.touch-punch.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jquery-detectmobile/detect.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jquery-animate-numbers/jquery.animateNumbers.js') }}"></script>
<script src="{{ URL::asset('assets/libs/ios7-switch/ios7.switch.js') }}"></script>
<script src="{{ URL::asset('assets/libs/fastclick/fastclick.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jquery-blockui/jquery.blockUI.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-bootbox/bootbox.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jquery-sparkline/jquery-sparkline.js') }}"></script>
<script src="{{ URL::asset('assets/libs/nifty-modal/js/classie.js') }}"></script>
<script src="{{ URL::asset('assets/libs/sortable/sortable.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-fileinput/bootstrap.file-input.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-select2/select2.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/pace/pace.min.js') }}"></script>
{{--<script src="{{ URL::asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>--}}
<script src="{{ URL::asset('assets/datepicker/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jquery-icheck/icheck.min.js') }}"></script>

<!-- Demo Specific JS Libraries -->
<script src="{{ URL::asset('assets/libs/prettify/prettify.js') }}"></script>

<script src="{{ URL::asset('assets/js/init.js') }}"></script>
<!-- Page Specific JS Libraries -->
<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script src="{{ URL::asset('assets/libs/jquery-gmap3/gmap3.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/google-maps.js') }}"></script>

<script src="{{ URL::asset('assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-inputmask/inputmask.js') }}"></script>
<script src="{{ URL::asset('assets/libs/summernote/summernote.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/forms.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-calendar/js/bic_calendar.min.js') }}"></script>

<!--Add the notification update script-->
<script>
    $(document).ready(function(){

        //enable the calender

        monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        dayNames = ["S", "M", "T", "W", "T", "F", "S"];

        var cTime = new Date(), month = cTime.getMonth()+1, year = cTime.getFullYear();

        var events = [
            {
                "date": "4/"+month+"/"+year,
                "title": 'Meet a friend',
                "link": 'javascript:;',
                "color": 'rgba(255,255,255,0.2)',
                "content": 'Contents here'
            },
            {
                "date": "7/"+month+"/"+year,
                "title": 'Kick off meeting!',
                "link": 'javascript:;',
                "color": 'rgba(255,255,255,0.2)',
                "content": 'Have a kick off meeting with .inc company'
            },
            {
                "date": "19/"+month+"/"+year,
                "title": 'Link to Google',
                "link": 'http://www.google.com',
                "color": 'rgba(255,255,255,0.2)',
            }
        ];

        $('#calendar-widget2').bic_calendar({
            events: events,
            dayNames: dayNames,
            monthNames: monthNames,
            showDays: true,
            displayMonthController: true,
            displayYearController: false,
            popoverOptions:{
                placement: 'top',
                trigger: 'hover',
                html: true
            },
            tooltipOptions:{
                placement: 'top',
                html: true
            }
        });

        $("#bic_calendar").removeClass('row');


        //enable the tool tips
        $( function() {
            $( document ).uitooltip({
                track: true
            });
        });

        //default left menu hide
        $(".button-menu-mobile").click();

        var token = $("input[name='_token']").val();
        var trackingcodepin = "<?php echo md5(\Auth::user()->id).md5('demo'); ?>";
        var base_url = window.location.origin;

        $('.top-navbar').on('click', '#clear-all-notification-btn', function(e) {
            e.preventDefault();
            $.post(
                base_url+"/user/access/clearajaxnotifylistitems",
                {'_token':token,'trackingcode':trackingcodepin},
                function(data,status,xhr){
                    //response
                },
                'text'
            );
        });

        // setInterval(function(){
        //     var token = $("input[name='_token']").val();
        //     var trackingcodepin = "<?php // echo md5(\Auth::user()->id).md5('demo'); ?>";
        //     var base_url = window.location.origin;
        //     $.post(
        //         base_url+"/user/access/ajaxnotifylistitems",
        //         {'_token':token,'trackingcode':trackingcodepin},
        //         function(data,status,xhr){
        //             $(".notify-ul-box").html(data);
        //         },
        //         'text'
        //     );
        // }, 1000*60);

    });
</script>