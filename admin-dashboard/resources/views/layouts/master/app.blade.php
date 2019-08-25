<!DOCTYPE html>
<html lang="en">
    <head>
    	<meta charset="utf-8">
    	<title>@section('title')Demo @show</title>
        <!-- css -->
        @include('layouts.master.header')
        <link href="{{ URL::asset('css/pnotify.custom.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/custom.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="wrapper">
            <div id="ajax-loader" class="loaderOverlay hidden">
                <div class="loader"></div>
            </div>
            <div class="topbar">
            	@include('layouts.master.navbar')
            </div>
            <div class="left side-menu">
                @include('layouts.master.sidebar')
            </div>
            <div class="content-page">
                <div class="content">
                        @yield('pageHeading')
                        <div class="row">
                            @yield('content')   
                        </div>
                        <div class="main-footer">
                        	@include('layouts.master.footer')
                        </div>
                </div>
            </div>
            <div class="md-overlay"></div>
       </div> 
    </body>
</html>
