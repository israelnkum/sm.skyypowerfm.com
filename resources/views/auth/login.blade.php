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
