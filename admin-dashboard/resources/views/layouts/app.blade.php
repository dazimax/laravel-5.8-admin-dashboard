<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@section('title')Demo @show</title>

    <!-- css -->
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" >
    <link href="homepage/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/pnotify.custom.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/fonts/lato.css">

    <!-- js -->
    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}" ></script>
    <script src="js/pnotify.custom.min.js"></script>
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">

{{-- content goes here --}}
@yield('content')

</body>
</html>
