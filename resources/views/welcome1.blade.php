
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SCHEDULE MASTER</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('public/css/app.css')}}">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
            font-weight: 700;
            font-family: sans-serif;
            color: black;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body style="background: url({{asset('public/master.jpg')}}) top center; background-size: cover;">
<div class="flex-center position-ref full-height">
{{--    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>


                <a href="{{ route('play-commercials.create') }}">Commercials</a>

            @endauth
        </div>
    @endif--}}

    <div class="content row">
        <div class="col-md-2 offset-md-5">
            <img src="{{asset('public/calendar.png')}}" height="auto" width="100" class="img-fluid mt-5" alt="">
        </div>
        <div class="col-md-12">
            <div class="title">
                SCHEDULE MASTER
                <h4 class="text-danger">TRIAL OVER</h4>
            </div>
        </div>
    </div>
</div>
</body>
</html>
