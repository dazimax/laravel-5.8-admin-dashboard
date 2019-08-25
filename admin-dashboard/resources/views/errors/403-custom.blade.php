<!DOCTYPE html>
<html>
    <head>
        <title>You don't have permission to access thig page.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }

            .goback{
                color: #fff;
                border: 2px solid #34b1c4;
                background-color: #34b1c4;
                cursor: pointer;
                display: inline-block;
                font-size: 14px;
                font-weight:700;
                margin-top:10px;
                padding: 16px 30px;
                position: relative;
                text-transform: uppercase;
                -webkit-border-radius: 3px 3px;
                -moz-border-radius: 3px 3px;
                border-radius: 3px 3px;
                transition: all .50s ease-in-out;
                -moz-transition: all .50s ease-in-out;
                -webkit-transition: all .50s ease-in-out;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">You don't have permission to access this page.</div>
                <a class="goback" href="{{ URL::previous() }}">Go back</a>
            </div>
        </div>
    </body>
</html>
