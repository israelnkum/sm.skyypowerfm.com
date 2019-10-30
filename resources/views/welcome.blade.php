
{{--<!DOCTYPE html>
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
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>


                <a href="{{ route('play-commercials.create') }}">Commercials</a>

            @endauth
        </div>
    @endif

    <div class="content row">
        <div class="col-md-2 offset-md-5">
            <img src="{{asset('public/calendar.png')}}" height="auto" width="100" class="img-fluid mt-5" alt="">
        </div>
        <div class="col-md-12">
            <div class="title">
                SCHEDULE MASTER
            </div>
        </div>
    </div>
</div>
</body>
</html>--}}
@extends('layouts.app')
@section('content')
    <div class=" container-scroller">
        <div class="container-fluid ">
            <div class="main-panel w-100  documentation">
                <div class="content-wrapper">
                    <div class="container-fluid">
                        <div class="row mb-0 mt-2  ">
                            <div class="col-md-4 mt-2">
                                <h3 class="text-uppercase">Today's Commercial</h3>
                            </div>
                            <div class="col-md-4  mt-2  text-center">
                                @if(!empty($commercials) )
                                    @foreach($commercials as $groups)

                                    @endforeach
                                    <h3 class="text-uppercase text-danger">
                                        {{\Carbon\Carbon::parse(strtotime($groups[0]->date))->format('D dS M Y')}}
                                    </h3>
                                @endif
                            </div>
                            <div class="col-md-4 text-right">
                                <a class="btn " href="{{route('login')}}">Login</a>
                            </div>
                        </div>
                        <hr class="mt-0">
                        @if(!empty($commercials))
                            <div class="row">
                                <div class="col-12 text-center">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-sm table-bordered table-active">
                                            <tr>
                                                <th>Advert</th>
                                                <th>Time</th>
                                                <th>Play</th>
                                            </tr>
                                            <tbody>
                                            @php($i=1)
                                            @foreach($commercials as $groups)
                                                <tr class="bg-primary text-white">
                                                    <td colspan="3" class="text-white">{{$groups[0]->program->program_name}}</td>
                                                </tr>
                                                @foreach($groups as $commercial)
                                                    <tr>
                                                        <td >{{$commercial->advert->name}}</td>
                                                        <td >{{$commercial->time}}</td>
                                                        @if($commercial->advert->audio_file == "Upload file")
                                                            <td class="text-danger">
                                                                No Audio File
                                                            </td>
                                                        @else
                                                            <td class="">
                                                                <form class="" id="play-commercial-form{{$i}}">
                                                                    @csrf
                                                                    <div class="form-group row d-none">
                                                                        <div class="col-md-4">
                                                                            <input type="hidden" name="advert_id" value="{{$commercial->advert_id}}">
                                                                            <input type="hidden" name="order_id" value="{{$commercial->order_id}}">
                                                                            <input type="hidden" name="agency_id" value="{{$commercial->agency_id}}">
                                                                            <input name="audio_file" id="audio_file" class="form-control" type="hidden" value="{{$commercial->advert->audio_file}}">
                                                                        </div>
                                                                    </div>
                                                                    <button class="btn p-0">
                                                                        <i style="font-size: 25px;" title="Play"  class="mdi mdi-play-circle"></i>
                                                                    </button>
                                                                </form>
                                                                <audio style="display: none; padding: 0" id="play{{$i}}" controls>
                                                                    <source src="{{asset('public/audio_files/'.$commercial->advert->audio_file)}}" type="audio/mp3">
                                                                    Your browser does not support the audio element.
                                                                </audio>
{{--                                                                                                                                 <i style="font-size: 25px; cursor: pointer" title="Play" onclick="document.getElementById('play{{$commercial->id}}').play()" class="mdi mdi-play-circle"></i>--}}
                                                            </td>
                                                        @endif
                                                    </tr>
                                                    @php($i++)
                                                @endforeach
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row mt-5">
                                <div class="col-md-12 mt-5 text-center">
                                    <h2 class="text-danger font-weight-lighter mt-5">Oops! No Schedules Found</h2>
                                </div>
                                <div class="col-md-4 offset-md-4">
                                    <form class="needs-validation" novalidate action="{{route('play-commercials.index')}}" method="get">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <select style="width: 100%" required name="radio_station_id" id="radio-station-id" class="form-control select-station">
                                                    <option value=""></option>
                                                    @foreach($radio_stations as $stations)
                                                        <option value="{{$stations->id}}">{{$stations->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Select Station
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-center mt-2">
                                                <button type="submit" class="btn btn-primary">Get Commercials</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


