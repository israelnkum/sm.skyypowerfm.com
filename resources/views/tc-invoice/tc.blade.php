@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-md-6">
                    <h3>Transaction Certificate</h3>
                </div>
                <div class="col-md-6">
                    <form class="needs-validation" novalidate action="{{route('filter-tc-orders')}}" method="get">
                        @csrf
                        <div class="form-group row mb-1">
                            {{--<div class="col-md-4 mr-0">
                                <small class="text-danger">Agency</small>
                                <select class="form-control p-0  js-example-basic-single" style="width: 100%" name="agency_id" id="tc-agencies" required>
                                    <option value="">Select Agency</option>
                                    @foreach($agency as $agent)
                                        <option value="{{$agent->id}}">{{$agent->agency_name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Station is required
                                </div>
                            </div>--}}
                            <div class="col-md-4 text-right">
                                <label for="tc-orders" class="mt-3">Agency</label>
                            </div>
                            <div class="col-md-8 ml-0">
                                <div class="form-group">
                                    <div class="input-group">
                                        <select class="form-control p-0  js-example-basic-single" name="agency_id" id="tc-agencies"  required>
                                            <option value="">Select</option>
                                            @foreach($agency as $agent)
                                                <option value="{{$agent->id}}">{{$agent->agency_name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-prepend">
                                            <button type="submit" title="Filter Orders" class="btn btn-success  p-2"><i class="mdi mdi-filter"></i></button>
                                        </div>
                                        <div class="invalid-feedback">
                                            Please select an Agency
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="page-header-tab mb-1"></div>
            <div class="row">
                @if(!empty($orders))
                    <div class="col-md-4">
                        <form class="needs-validation" novalidate action="{{route('tc-s.create')}}" method="get">
                            @csrf
                            <div class="form-group row mb-1">
                                <input type="hidden" value="{{$agency_id}}" name="agency_id">
                                <div class="col-md-8 ml-0">
                                    <div class="form-group">
                                        <label for="tc-orders" class="mt-3">Orders</label>
                                        <div class="input-group">
                                            <select class="form-control p-0  js-example-basic-single" name="order_number" id="tc-orders"  required>
                                                <option value="">Select </option>
                                                @foreach($orders as $order)
                                                    <option value="{{$order->order_number}}">{{$order->order_number}}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-prepend">
                                                <button type="submit" title="Generate TC" class="btn btn-success  p-2"><i class="mdi mdi-receipt"></i></button>
                                            </div>
                                            <div class="invalid-feedback">
                                                Please select an Order
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
                @if(!empty($selected_agency))
                    <div class="col-md-8 pl-0">
                        <div class="card px-2">
                            <div class="card-body">
                                <div class="content-print">
                                    <div class="container d-flex  justify-content-between align-items-center">

                                        <div class="col-lg-2 pl-0">
                                            <img height="auto" width="200" src=" {{asset('public/uploads/'.$selected_agency->radio_station->logo)}}" class="img-fluid" alt="">
                                        </div>
                                        <div class="col-lg-5 text-center">
                                            <h4 class="display-4 ">Transmission Certificate</h4>
                                        </div>
                                        <div class="col-lg-3 pr-0">
                                            <p class="text-right  mb-0">{{$selected_agency->radio_station->name}}</p>
                                            <p class="text-right  mb-0">{{$selected_agency->radio_station->address}}</p>
                                            <p class="text-right  mb-0">{{$selected_agency->radio_station->phone_number}}</p>
                                        </div>
                                    </div>
                                    <div class="container d-flex  justify-content-between align-items-center">
                                        <div class="col-lg-6 p-0 m-0" style="height: 10px; background: red  ; color: black"></div>
                                        <div class="col-lg-4 p-0 " style="height: 10px; background: darkblue"></div>
                                        <div class="col-lg-2 p-0" style="height: 10px; background: yellow"></div>
                                    </div>

                                    <div class="container d-flex  justify-content-between align-items-center">

                                        <div class="col-lg-4 mt-3">
                                           <p> <b>Date:</b>      {{\Carbon\Carbon::parse(strtotime(date('Y-m-d')))->format('D dS M Y')}}</p>
                                            <p> <b>Time:</b> {{date('h:i:s')}}</p>
                                        </div>
                                        <div class="col-md-8 text-right mt-3">
                                            <h6 class="font-weight-normal"><b>Agency:</b> {{$selected_agency->agency_name}}</h6>
                                            @foreach($tcs as $tc)@endforeach
                                            <h6 class="font-weight-normal"><b>Order Number: </b> {{$tc[0]->order_number}}</h6>
                                        </div>

                                    </div>
                                    <div class="container mt-2 d-flex justify-content-center w-100">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Aired Date</th>
                                                    <th class="text-right">Aired Time</th>
                                                    <th class="text-right">Duration</th>
                                                </tr>
                                                </thead>
                                                @php($totalSpots =0)
                                                @foreach($tcs as $tc)
                                                    <tbody>
                                                    @php($i=1)
                                                    <tr class="text-center">
                                                        <td colspan="4" class="text-uppercase font-weight-bold text-dark">{{$tc[0]->advert->name}}</td>
                                                    </tr>
                                                    @foreach($tc as $tCommission)
                                                        <tr class="text-right">
                                                            <td class="text-left">{{$i}}</td>
                                                            <td class="text-left">{{\Carbon\Carbon::parse(strtotime($tCommission->date_time))->format('D dS M Y')}}</td>
                                                            <td>{{substr($tCommission->date_time,10)}}</td>
                                                            <td>
                                                                <?php
                                                                $audio = new \wapmorgan\Mp3Info\Mp3Info(public_path('audio_files/'.$tCommission->advert->audio_file), true);
                                                                echo floor($audio->duration / 60).' min '.floor($audio->duration % 60).' sec'.PHP_EOL;
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        @php($i++)
                                                    @endforeach
                                                    @php($totalSpots+=count($tc))
                                                    <tr><td colspan="4" class="text-right"><b class="text-dark">Spots Aired:</b> <span class="text-danger">{{$i-1}}</span></td></tr>
                                                    </tbody>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                    <div class="container mt-3 text-center w-100">
                                        <p class="mb-2">Total Spots Aired: {{$totalSpots}}</p>
                                    </div>
                                    <div class="container text-right mt-2 w-100">
                                        <img height="auto" width="100" src=" {{asset('public/uploads/'.$selected_agency->radio_station->signature)}}" class="img-fluid mb-0 p-0" alt="">
                                        <br><small class="mt-0 p-0">.......................................................</small>
                                        <p class=" mb-5"><b>Traffic Executive</b> <br> {{Auth::user()->name}} </p>
                                        <hr>
                                    </div>
                                    <div class="container text-center mt-1 w-100">
                                        <small>&copy {{date('Y')}} | SCHEDULE MASTER | BY ANA TECHNOLOGIES | 024 905 1415</small>
                                    </div>
                                </div>
                                <div class="container w-100">
                                    <div class="row mt-4">
                                  {{--      <div class="col-md-10 p-0 text-right ">
                                            <form action="" class="mr-0">
                                                <button class="btn btn-sm btn-success mr-0" title="Save"><i class="mdi mdi-content-save"></i></button>
                                            </form>
                                        </div>--}}
                                        <div class="col-md-12 text-right ml-0 p-0">
                                            <a href="javascript:void(0)" class="btn btn-sm btn-primary print-tc ml-0" title="Print"><i class="mdi mdi-printer mr-1"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
