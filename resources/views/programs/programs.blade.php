@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-2">
                    <h3>Programs</h3>
                </div>
                <div class="col-md-6">
                    <form class="needs-validation" novalidate action="{{route('search-programs')}}" method="get">
                        @csrf
                        <div class="form-group row mb-1">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input name="search" type="text" required class="form-control p-2" id="" placeholder="Search Program Name">
                                    <div class="input-group-prepend">
                                        <button type="submit" class="btn input-group-text p-2"><i class="mdi mdi-magnify"></i></button>
                                    </div>
                                    <div class="invalid-feedback">
                                        Search by program name
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-4 text-right">
                    <button class="btn btn-primary p-2  waves-effect waves-light"  data-toggle="modal" data-target=".bs-example-modal-sm" type="button" >
                        <i class="mdi mdi-plus-circle mr-1"></i> New Program
                    </button>
                </div>
            </div>
            <div class="page-header-tab mb-1"></div>
            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="mySmallModalLabel">New/Upload Program</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{--<div class="row mb-2">
                                <div class="col-md-6">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" class="text-decoration-none" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                            New Program
                                        </a>
                                    </h5>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-0">
                                        <a class="collapsed text-decoration-none"  data-toggle="collapse" href="#collapse-5" aria-expanded="false" aria-controls="collapse-5">
                                            Upload Program(s)
                                        </a>
                                    </h5>
                                </div>
                            </div>--}}
                            <div class="accordion accordion-bordered" id="accordion-2" role="tablist">

                                <div id="collapse-4" class="collapse show" role="tabpanel" aria-labelledby="heading-4" data-parent="#accordion-2">
                                    <form action="{{route('programs.store')}}" method="post" class="needs-validation" novalidate>
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label for="example-text-input">Program Name</label>
                                                <input class="p-2 form-control" name="program_name" type="text" required id="example-text-input">
                                                <div class="invalid-feedback">
                                                    Program Name required
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-1">
                                                <label for="radio-station">Radio Station</label>
                                                <select class="form-control js-example-basic-single p-0" style="width: 100%" name="radio_station_id" required>
                                                    <option value="">Radio Station</option>
                                                    @foreach($radio_stations as $radio_station)
                                                        <option value="{{$radio_station->id}}">{{$radio_station->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Radio Station is required
                                                </div>
                                            </div>
                                            {{--                                    {{\Carbon\Carbon::now()->subDays(1)->format('l')}}--}}
                                            <div class="col-md-6 mt-1">
                                                <label for="day-of-week">Day(s)</label>
                                                <select class="form-control js-example-basic-multiple p-1" multiple style="width: 100%" name="day_of_week[]" required id="day-of-week">
                                                    @for($i = 7; $i >=1; $i--)
                                                        <option value="{{\Carbon\Carbon::now()->subDays($i)->format('l')}}">{{\Carbon\Carbon::now()->subDays($i)->format('l')}}</option>
                                                    @endfor
                                                </select>
                                                <div class="invalid-feedback">
                                                    Day is required
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="example-text-input">Start Time</label>
                                                <div class="input-group date"  id="start-time" data-target-input="nearest">
                                                    <div class="input-group" data-target="#start-time" data-toggle="datetimepicker">
                                                        <input type="text" name="start_time" required class="form-control datetimepicker-input" data-target="#start-time"/>
                                                        <div class="input-group-addon input-group-append"><i class="mdi mdi-clock input-group-text"></i></div>
                                                        <div class="invalid-feedback" >
                                                            Start Time required
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="example-text-input">End Time</label>
                                                <div class="input-group date"  id="end-time" data-target-input="nearest">
                                                    <div class="input-group" data-target="#end-time" data-toggle="datetimepicker">
                                                        <input required type="text" name="end_time" class="form-control datetimepicker-input" data-target="#end-time"/>
                                                        <div class="input-group-addon input-group-append"><i class="mdi mdi-clock input-group-text"></i></div>
                                                        <div class="invalid-feedback">
                                                            End Time required
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <label for="example-text-input">Presenter</label>
                                                <input class="p-2 form-control " name="presenter" type="text" id="presenter">
                                                <div class="invalid-feedback">
                                                    Presenter required
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-right mt-2">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Add Program</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="collapse-5" class="collapse" role="tabpanel" aria-labelledby="heading-5" data-parent="#accordion-2">
                                    <form action="{{route('upload-programs')}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label for="">Select File</label>
                                                <input type="file" name="file" required class="form-control form-control-file">
                                                <div class="invalid-feedback">
                                                    Select a file
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-1">
                                                <label for="radio-station">Radio Station</label>
                                                <select class="form-control js-example-basic-single p-0" style="width: 100%" name="radio_station_id" id="radio-station" required>
                                                    <option value="">Radio Station</option>
                                                    @foreach($radio_stations as $radio_station)
                                                        <option value="{{$radio_station->id}}">{{$radio_station->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Radio Station is required
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-right mt-2">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Upload</button>
                                            </div>

                                            <div class="col-md-12">
                                                <a href="javascript:void(0)" class="text-decoration-none">Download Upload Format</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </div><!-- /.modal-content -->

                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <div class="row mt-3">
                <div class="col-sm-12 text-center">
                    <div class="page-title-box ">
                        @if(empty($programs))
                            <a href="{{route('all-programs')}}">All programs</a>
                        @endif

                        {{--<select class="form-control" name="get_programs" id="get-programs">
                            <option value="All">All</option>
                            @foreach($radio_stations as $radio_station)
                                <option value="{{$radio_station->id}}">{{$radio_station->name}}</option>
                            @endforeach
                        </select>--}}
                    </div>
                </div>
            </div>
            @if(!empty($programs))
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <input type="hidden" class="form-control" name="selected_programs" id="selected_programs">
                            <div class="card-body">
                                <div class="row p-0">
                                    <div class="col-md-4">
                                        <h4 class="mt-0 header-title mb-4">All programs</h4>
                                    </div>
                                    <div class="col-md-2 offset-md-6">
                                        <form action="{{route('filter-programs')}}" method="get" id="filter-programs-form">
                                            <select class="form-control filter-items" name="filter_programs" id="filter-programs">
                                                <option value="">Filter</option>
                                                @foreach($radio_stations as $radio)
                                                    <option value="{{$radio->id}}">{{$radio->name}}</option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </div>
                                </div>
                                <div class="accordion accordion-bordered" id="all-programs-accordion" role="tablist">
                                    @php($i=1)
                                    @foreach($programs as $group => $program)
                                        <div class="card  border-0 p-0">
                                            <div class="card-header p-1" role="tab" id="heading-4">
                                                <div class="d-flex justify-content-between p-0 align-items-center">
                                                    <a data-toggle="collapse" href="#group-{{$i}}" aria-expanded="false" aria-controls="collapse-4">
                                                        {{$group}}

                                                    </a>
                                                    {{--Delete whole program for all days--}}
                                                    <form class="p-0" onsubmit="return confirm('NOTE:\n All Commercials Under this program will also be deleted\n Please Confirm Delete!')" action="{{route('delete-programs')}}" method="post">
                                                        @csrf
                                                        @foreach($program as $pro)
                                                            <input name="programs_ids[]" type="hidden" value="{{$pro->id}}">
                                                        @endforeach
                                                        <button title="Delete {{$group}}" class="btn btn-link text-danger text-decoration-none" type="submit">
                                                            <i class="mdi mdi-trash-can-outline"></i> Delete
                                                        </button>
                                                    </form>
                                                    {{--End Delete whole program for all days--}}
                                                </div>
                                            </div>
                                            <div id="group-{{$i}}" class="collapse" role="tabpanel" aria-labelledby="heading-4" data-parent="#all-programs-accordion">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <table class="table table-borderless">
                                                                <tr>
                                                                    <th>Day</th>
                                                                    <th>Start time</th>
                                                                    <th>End Time</th>
                                                                    <th>Delete</th>
                                                                </tr>
                                                                <tbody>
                                                                @foreach($program as $pro)
                                                                    <tr>
                                                                        <td>{{$pro->day}}</td>
                                                                        <td>{{$pro->start_time}}</td>
                                                                        <td>{{$pro->end_time}}</td>
                                                                        <td>
                                                                            {{--Delete whole program for a specific day--}}
                                                                            <form onsubmit="return confirm('Please Confirm Delete')" method="post" action="{{route('programs.destroy',$pro->id)}}">
                                                                                @csrf
                                                                                {!! method_field('delete') !!}
                                                                                <button class="btn btn-sm" title="Delete {{$group}} for {{$pro->day}}'s" >
                                                                                    <i class="mdi mdi-trash-can text-danger"></i>
                                                                                </button>
                                                                            </form>
                                                                            {{--End Delete whole program for a specific day--}}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php($i++)
                                    @endforeach
                                </div>
                                {{-- <div class="table-responsive">
                                     <table id="program_table" class="table table-hover">
                                         <thead>
                                         <tr>
                                             <th></th>
                                             <th scope="col">ID</th>
                                             <th scope="col">#</th>
                                             <th scope="col">Name</th>
                                             <th scope="col">Station ID</th>
                                             <th scope="col">Station</th>
                                             <th scope="col">Day</th>
                                             <th scope="col">Start Time</th>
                                             <th scope="col">End Time</th>
                                             <th scope="col">Duration</th>
                                             <th scope="col">Presenter</th>
                                             <th scope="col">Edit</th>
                                         </tr>
                                         </thead>
                                         <tbody>
                                         @php($i =1)
                                         @foreach($programs as $group => $program)
                                             --}}{{--                                                {{$program[0]->id}}--}}{{--
                                             {{$group}}
                                             @foreach($program as $prog)
                                                 --}}{{--<tr>
                                                     <td>
                                                     </td>
                                                     <td>{{$prog->id}}</td>
                                                     <td>{{$i}}</td>
                                                     <td>{{$program->program_name}}</td>
                                                     <td>{{$program->radio_station_id}}</td>
                                                     <td>{{$program->radio_station->name}}</td>
                                                     <td>{{$program->day}}</td>
                                                     <td>{{$program->start_time}}</td>
                                                     <td>{{$program->end_time}}</td>
                                                     <td>{{$program->duration}} hours</td>
                                                     <td>{{$program->presenter}}</td>
                                                     <td>
                                                         <a href="javascript:void(0)" class="btn edit-program"> <i class="mdi mdi-pencil"></i> </a>
                                                     </td>
                                                 </tr>--}}{{--
                                             @endforeach
                                             @php($i+=2)
                                         @endforeach
                                         </tbody>
                                     </table>
                                 </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade edit-program-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="programs" id="edit-program-form" method="post" class="needs-validation" novalidate>
                @csrf
                {!! method_field('put') !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="program-title">New program</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="example-text-input">program Name</label>
                                <input class="p-2 form-control" name="program_name" type="text" required id="edit-program-name">
                                <div class="invalid-feedback">
                                    Company Name required
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="example-text-input">Address</label>
                                <input class="p-2 form-control" name="address" type="text" id="edit-program-address">
                                <div class="invalid-feedback">
                                    Address required
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="example-text-input">Fax</label>
                                <input class="p-2 form-control" name="fax" type="text" id="edit-program-fax">
                                <div class="invalid-feedback">
                                    Fax required
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="example-text-input">Email</label>
                                <input class="p-2 form-control" name="email" type="email" id="edit-program-email">
                                <div class="invalid-feedback">
                                    Type correct email
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="example-text-input">Phone Number</label>
                                <input class="p-2 form-control phone_number" name="phone_number" type="text" required id="edit-program-phone">
                                <div class="invalid-feedback">
                                    Phone Number required
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="example-text-input">Contact Person(s)</label>
                                <input class="p-2 form-control" name="contact_person" type="text" required id="edit-program-contact-person">
                                <div class="invalid-feedback">
                                    Customer Name required
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="radio-station">Radio Station</label>
                                <select class="form-control p-1" name="radio_station_id" required id="edit-program-radio-station">
                                    <option value="">Select Radio Station</option>
                                    {{-- @foreach($radio_stations as $radio_station)
                                         <option value="{{$radio_station->id}}">{{$radio_station->name}}</option>
                                     @endforeach--}}
                                </select>
                                <div class="invalid-feedback">
                                    Radio Station is required
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="radio-station">Discount</label>
                                <input type="number" class="form-control" name="discount" id="edit-program-discount" step="any" value="0" min="0">
                                <div class="invalid-feedback">
                                    Radio Station is required
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add program</button>
                    </div>
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
