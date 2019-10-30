@extends('layouts.app')
@section('content')
    <div class=" container-scroller">
        <div class="container-fluid ">
            <div class="main-panel w-100  documentation">
                <div class="content-wrapper">
                    <div class="container-fluid">
                        <div class="row mb-0 mt-5">
                            <div class="col-md-12 text-center mt-5">
                                <h3 class="text-uppercase">Select radio Station</h3>
                            </div>
                        </div>
                        <hr class="mt-0">
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
                        <div class="row mb-0 mt-5">
                            <div class="col-md-12 text-center mt-5">
                                <a class="btn " href="{{route('login')}}">Go Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
