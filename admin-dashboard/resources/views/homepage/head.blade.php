<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

@if (isset($cmspages))
<?php
$isContentHas = false;
?>

@foreach ($cmspages as $cmspage)

@if (strtolower($cmspage->identifier) == 'metadata')

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
    <meta name="keywords" content="">
    <meta name="description" content="">

    <title>Demo</title>

<?php
}
?>
@endif


<!-- Loading Bootstrap -->
<link href="homepage/css/bootstrap.css" rel="stylesheet">

<!-- Font Awesome -->
<link href="homepage/css/fonts.css" rel="stylesheet">
<link href="homepage/css/font-awesome.min.css" rel="stylesheet">

<!-- Loading Template CSS -->
<link href="homepage/css/style.css" rel="stylesheet">
<link href="homepage/css/animate.css" rel="stylesheet">
<link href="homepage/css/style-magnific-popup.css" rel="stylesheet">

<!-- Loading Layer Slider -->
<link href="homepage/layerslider/css/layerslider.css" rel="stylesheet">

<link href="css/pnotify.custom.min.css" rel="stylesheet">
<link href="css/custom.css" rel="stylesheet">


<!-- Google Fonts -->
<link href='css/fonts/roboto.css' rel='stylesheet' type='text/css'>
<link href='css/fonts/opensans.css' rel='stylesheet' type='text/css'>

<!-- Font Favicon -->
<link rel="shortcut icon" href="images/favicon.ico">

<script src="homepage/js/jquery-1.11.3.min.js"></script>
<script src="homepage/js/bootstrap.min.js"></script>
<script src="js/pnotify.custom.min.js"></script>
<script src="js/common.js"></script>
<script src="homepage/js/homepage.js"></script>
<script src='js/google-capcha/api.js'></script>

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

<!--headerIncludes-->

<!--        <script type="text/javascript">
            var RecaptchaOptions = {
                theme: 'custom',
                custom_theme_widget: 'responsive_recaptcha'
            };
        </script>-->
