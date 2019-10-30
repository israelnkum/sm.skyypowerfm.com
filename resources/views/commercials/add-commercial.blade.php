@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <h3>Add Commercials</h3>
                </div>
                @if(!empty($programs))
                    <div class="col-md-6 ">
                        <form action="{{route('commercials.create')}}"  class="needs-validation" method="get" novalidate>
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-4 pr-0">
                                    <select required class="form-control  mr-0 p-2 select-station w-100"  name="radio-station" id="select-radio-top">
                                        <option value=""></option>
                                        @foreach($radio_station as $station)
                                            <option value="{{$station->id}}">{{$station->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Select Station
                                    </div>
                                </div>
                                <div class="col-md-2 pl-0 pr-0">
                                    <select class="form-control select-day p-1 ml-0"  style="width: 100%" name="day_of_week" required id="day-of-week-top">
                                        <option value=""></option>
                                        @for($i = 7; $i >=1; $i--)
                                            <option value="{{\Carbon\Carbon::now()->subDays($i)->format('l')}}">{{\Carbon\Carbon::now()->subDays($i)->format('D')}}</option>
                                        @endfor
                                    </select>
                                    <div class="invalid-feedback">
                                        Day is required
                                    </div>
                                </div>
                                <div class="col-md-4 pl-0 text-left">
                                    <button type="submit" class="btn btn-primary mb-2">
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-sm btn-danger" href="{{route('commercials.create')}}">Change Station</a>
                    </div>
                @endif
            </div>
            @if($hasPrograms =="No")
                <div class="row mt-5">
                    <div class="col-md-12 text-center text-danger mb-3">
                        Please select Radio Station and a Day
                    </div>
                    <div class="col-md-6 offset-md-4 text-center">
                        <form action="{{route('commercials.create')}}"  class=" needs-validation" method="get" novalidate>
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-4 pr-0">
                                    <select required class="form-control  mr-0 p-2 select-station w-100"  name="radio-station" id="select-radio">
                                        <option value=""></option>
                                        @foreach($radio_station as $station)
                                            <option value="{{$station->id}}">{{$station->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Select Station
                                    </div>
                                </div>
                                <div class="col-md-3 pl-0 pr-0">
                                    <select class="form-control select-day p-1 ml-0"  style="width: 100%" name="day_of_week" required id="day-of-week">
                                        <option value=""></option>
                                        @for($i = 7; $i >=1; $i--)
                                            <option value="{{\Carbon\Carbon::now()->subDays($i)->format('l')}}">{{\Carbon\Carbon::now()->subDays($i)->format('D')}}</option>
                                        @endfor
                                    </select>
                                    <div class="invalid-feedback">
                                        Day is required
                                    </div>
                                </div>
                                <div class="col-md-4 pl-0 text-left">
                                    <button type="submit" class="btn btn-primary mb-2">
                                        Filter
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            @endif
            @if($hasPrograms =="Yes")
                @if(count($programs) !=0 )
                    <div class="row">
                        <div class="col-md-8 text-uppercase text-center">
                            Radio Station:  <span class="text-danger">{{$programs[0]->radio_station->name}}</span>
                            | Day: <span class="text-danger">{{$programs[0]->day}}</span>
                        </div>
                        <div class="col-md-4">
                            {{\Carbon\Carbon::parse(strtotime($dayOfWeek))->format('D dS M Y')}}
                        </div>
                        <div class="col-md-12">
                            <div class="accordion accordion-bordered" id="accordion-2" role="tablist">
                                @foreach($programs as $program)
                                    <div class="card">
                                        <div class="card-header" role="tab" id="heading-4">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    {{$program->start_time}} -  {{$program->end_time}}
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0">
                                                        <a data-toggle="collapse" href="#collapse-{{$program->id}}" aria-expanded="false" aria-controls="collapse-4">
                                                            {{$program->program_name}}
                                                        </a>
                                                    </h6>

                                                </div>

                                            </div>
                                        </div>
                                        <div id="collapse-{{$program->id}}" class="collapse" role="tabpanel" aria-labelledby="heading-4" data-parent="#accordion-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h4>Recent Schedules</h4>
                                                        <div class="table-responsive">
                                                            <table class="table table-sm table-bordered ">
                                                                <tbody>
                                                                @foreach($program->commercials as $comm)
                                                                    <tr>
                                                                        <td >{{$comm->advert->name}}</td>
                                                                        <td >{{$comm->time}}</td>

                                                                        <td class="">
                                                                            <form class="">
                                                                                @csrf
                                                                                <button class="btn text-danger p-0">
                                                                                    <i title="Delete"  class="mdi mdi-delete"></i>
                                                                                </button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="font-weight-lighter text-danger">Add New</h5>
                                                        <form action="{{route('commercials.store')}}" novalidate method="post" class=" needs-validation">
                                                            @csrf
                                                            <input class="form-control" type="hidden" name="radio_station_id" value="{{$program->radio_station_id}}" >
                                                            <input name="program_id" value="{{$program->id}}" type="hidden" class="form-control">
                                                            <div class="form-group row">
                                                                <div class="col-md-7">
                                                                    <select required style="width: 100%" class="form-control p-2 select-advert w-100"  name="data" id="select-advert-{{$program->id}}">
                                                                        <option value=""></option>
                                                                        @foreach($orders as $order)
                                                                            <option value="{{$order->id.",".$order->advert->id.",".$order->agency_id}}">{{$order->advert->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <div class="invalid-feedback">
                                                                        Select Advert
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 pl-0">
                                                                    <select required style="width: 100%"  class="form-control p-2 select-time w-100"  name="time" id="select-time-{{$program->id}}">
                                                                        <option value=""></option>
                                                                        @php
                                                                            $desiredtimes = 200; // desired times
                                                                            $startdate=strtotime($program->start_time);
                                                                            $end_date=strtotime($program->end_time);

                                                                            $currentdate=$startdate;
                                                                            for ($i = 0; $i < $desiredtimes; $i++){ //loop desired times
                                                                              if (date('h:i A', $currentdate) != date('h:i A', $end_date)){
                                                                                echo "<option value='".date('h:i A', $currentdate)."'>".date('h:i A', $currentdate)."</option>";
                                                                                $currentdate = strtotime("+5 minutes", $currentdate); //increment the current date
                                                                                }
                                                                            }
                                                                         echo "<option value=".date('h:i A', $currentdate).">".date('h:i A', $currentdate)."</option>";

                                                                        @endphp

                                                                    </select>
                                                                    <div class="invalid-feedback">
                                                                        Select Time
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="date" class="form-control"  value="{{date('Y-m-d',strtotime($dayOfWeek))}}">
                                                                <div class="col-md-1 p-0">
                                                                    <button class="btn btn-primary p-1" type="submit">Add</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                @elseif(count($programs) ==0)
                    <div class="text-center">
                        <h4 class="display-4">Oops! No Program(s) Found</h4>
                    </div>
                @endif
            @endif
        </div>
    </div>

    <div class="modal fade edit-customer-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <form action="customers" id="edit-customer-form" method="post" class="needs-validation" novalidate>
                @csrf
                {!! method_field('put') !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title mt-0" id="edit-title">Edit Commercial</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="edit-name">Name</label>
                                <input class="form-control" name="name" type="text" required id="edit-name">
                                <div class="invalid-feedback">
                                    Customer Name required
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <label for="edit-email">Email</label>
                                <input class="form-control" name="email" type="email" id="edit-email">
                                <div class="invalid-feedback">
                                    Type correct email
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <label for="edit-phone_number">Phone Number</label>
                                <input class="form-control" name="phone_number" type="text" required id="edit-phone_number">
                                <div class="invalid-feedback">
                                    Phone Number required
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <label for="edit-company">Company Name</label>
                                <input class="form-control" name="company"  type="text" required id="edit-company">
                                <div class="invalid-feedback">
                                    Company Name required
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update Info</button>
                    </div>
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
