<!DOCTYPE html>
<html lang="en">
    <head>
    	<meta charset="utf-8">
    	<title>@section('title')Demo @show</title>
    	<!-- css -->
    	<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" >
        <link href="homepage/css/font-awesome.min.css" rel="stylesheet">
        <link href="css/pnotify.custom.min.css" rel="stylesheet">

    	<!-- js -->
    	<script type="text/javascript" src="{{ URL::asset('js/app.js') }}" ></script>
        <script src="js/pnotify.custom.min.js"></script>
    </head>
    <body>
    	@include('partials.header')
    	@yield('content')	
    	@include('partials.footer')
    </body>
</html>
