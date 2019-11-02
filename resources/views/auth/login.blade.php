
@if (date('Y-m-d') >= '2019-12-15')
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
@else
    @extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row mb-0 mt-5  ">
            <div class="col-md-8 mt-2">
                <h3 class="text-uppercase">SCHEDULE MASTER</h3>
            </div>
            <div class="col-md-4 text-right">
                <form action="get" method="get">
                    {{--                    <select class="form-control" name="radio_station_id" id="radio-station-id">--}}
                    {{--                        <option value=""></option>--}}
                    {{--                        @foreach($radio_stations as $stations)--}}
                    {{--                            <option value="{{$stations->id}}">{{$stations->name}}</option>--}}
                    {{--                        @endforeach--}}
                    {{--                    </select>--}}
                </form>
                <a class="btn " href="{{route('play-commercials.create')}}">Today's Commercial</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 mt-5 mb-5 offset-md-4">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="p-2">
                            <div class="text-center">
                                <img src="{{asset('public/login.png')}}" class="img-fluid" height="auto" width="70" alt="">
                            </div>
                        </div>
                        <div class="p-2">
                            <form class="form-horizontal m-t-20" method="post" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-12">
                                        <input id="username"  class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus type="text"  placeholder="Username">
                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-12">
                                        <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember"  {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="customCheck1">Remember me</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group text-center row m-t-20">
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                                    </div>
                                </div>

                                {{-- <div class="form-group m-t-10 mb-0 row">
                                     <div class="col-sm-7 m-t-20">
                                         <a href="{{route('password.request')}}" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                     </div>
                                 </div>--}}
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
@endsection
@endif
