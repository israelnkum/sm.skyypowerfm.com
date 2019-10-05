@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-6">
                    <h3>Advertisement</h3>
                </div>
            </div>
            <div class="page-header-tab mb-1"></div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box ">
                        <div class="row ">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-6">
                                <form class="needs-validation" novalidate action="" method="get">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="input-group mb-2 mr-sm-2">
                                                <input type="text" required class="form-control" id="" placeholder="Type to search">
                                                <div class="input-group-prepend">
                                                    <button type="submit" class="btn input-group-text"><i class="mdi mdi-magnify"></i></button>
                                                </div>
                                                <div class="invalid-feedback">
                                                    Type something to search
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-4 text-right">
                                <button class="btn btn-primary  waves-effect waves-light"  data-toggle="modal" data-target=".bs-example-modal-sm" type="button" >
                                    <i class="ti-user mr-1"></i> New Advert
                                </button>
                            </div>
                            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{route('adverts.store')}}" enctype="multipart/form-data" method="post" class="needs-validation" novalidate>
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title mt-0" id="mySmallModalLabel">New Advert</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <div class="col-sm-12 mb-2">
                                                        <label for="example-text-input">Advert Name</label>
                                                        <input class="form-control p-2" name="name" type="text" required id="example-text-input">
                                                        <div class="invalid-feedback">
                                                            Advert Name required
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <label for="customer_id">Agency</label>
                                                        <select required name="agencies_id" class="form-control js-example-basic-single" style="width: 100%" id="agencies_id">
                                                            <option value=""></option>
                                                            @foreach($agencies as $agency)
                                                                <option value="{{$agency->id}}">{{$agency->agency_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Agency required
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 mt-1">
                                                        <label for="customer_id">Radio Station</label>
                                                        <select required name="radio_station_id" style="width: 100%" class="form-control js-example-basic-single w-100" id="radio_station_id">
                                                            <option value=""></option>
                                                            @foreach($radio_stations as $radio)
                                                                <option value="{{$radio->id}}">{{$radio->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Radio Station required
                                                        </div>
                                                    </div>
                                                    {{--<div class="col-sm-6 mb-2">
                                                        <label for="example-text-input">Date</label>
                                                        <div class="input-group">
                                                            <input type="text" name="schedule_date" required class="form-control datetimepicker-input" id="datetimepicker1" data-toggle="datetimepicker" data-target="#datetimepicker1"/>
                                                            <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                                            <div class="invalid-feedback">
                                                                Date required
                                                            </div>
                                                        </div><!-- input-group -->
                                                    </div>

                                                    <div class="col-sm-6 mb-2">
                                                        <label for="example-text-input">Time</label>
                                                        <div class="input-group">
                                                            <input type="text" name="schedule_time" required class="form-control datetimepicker-input" id="datetimepicker5" data-toggle="datetimepicker" data-target="#datetimepicker5"/>
                                                            <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                                            <div class="invalid-feedback">
                                                                Time required
                                                            </div>
                                                        </div><!-- input-group -->
                                                    </div>--}}
                                                    <div class="col-sm-12">
                                                        <label for="example-text-input">Audio File</label>
                                                        <input class="form-control-file border p-1" name="audio_file" type="file" accept="audio/*" required id="example-text-input">
                                                        <div class="invalid-feedback">
                                                            File required
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Add Agency</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </form>
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                            @if(empty($adverts))
                                <div class="col-md-12 text-center">
                                    <a href="{{route('all-adverts')}}">All Adverts</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($adverts))
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form action="{{route('delete-advert')}}" onsubmit="return confirm('Please Confirm Delete')">
                                @csrf
                                <input type="hidden" class="form-control" name="selected_agencies" id="selected_agencies">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h4 class="mt-0 header-title mb-4">All Adverts</h4>
                                        </div>
                                        <div class="col-md-8 text-right">
                                            <button class="btn btn-link text-danger text-decoration-none" type="submit" id="btn-delete-agency" disabled><i class="mdi mdi-trash-can-outline"></i> Delete</button>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="agency_table" class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th scope="col">ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">AD. #</th>
                                                <th scope="col">Agency</th>
                                                <th scope="col">File</th>
                                                <th scope="col">Station</th>
                                                <th scope="col">Edit</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php($i =1)
                                            @foreach($adverts as $advert)
                                                <tr>
                                                    <td>
                                                    </td>
                                                    <td>{{$advert->id}}</td>
                                                    <td>{{$advert->name}}</td>
                                                    <td>{{$advert->advert_number}}</td>
                                                    <td>{{$advert->agency->agency_name}}</td>
                                                    <td>
                                                        <audio controls>
                                                            <source src="{{asset('public/audio_files/'.$advert->audio_file)}}" type="audio/mp3">
                                                            Your browser does not support the audio element.
                                                        </audio>
                                                    </td>
                                                    <td>{{$advert->radio_station->name}}</td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="btn edit-agency"> <i class="mdi mdi-pencil"></i> </a>
                                                    </td>
                                                </tr>
                                                @php($i++)
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade edit-agency-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="agencies" id="edit-agency-form" method="post" class="needs-validation" novalidate>
                @csrf
                {!! method_field('put') !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="agency-title">New Agency</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="example-text-input">Agency Name</label>
                                <input class="p-2 form-control" name="agency_name" type="text" required id="edit-agency-name">
                                <div class="invalid-feedback">
                                    Company Name required
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="example-text-input">Address</label>
                                <input class="p-2 form-control" name="address" type="text" id="edit-agency-address">
                                <div class="invalid-feedback">
                                    Address required
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="example-text-input">Fax</label>
                                <input class="p-2 form-control" name="fax" type="text" id="edit-agency-fax">
                                <div class="invalid-feedback">
                                    Fax required
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="example-text-input">Email</label>
                                <input class="p-2 form-control" name="email" type="email" id="edit-agency-email">
                                <div class="invalid-feedback">
                                    Type correct email
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="example-text-input">Phone Number</label>
                                <input class="p-2 form-control phone_number" name="phone_number" type="text" required id="edit-agency-phone">
                                <div class="invalid-feedback">
                                    Phone Number required
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="example-text-input">Contact Person(s)</label>
                                <input class="p-2 form-control" name="contact_person" type="text" required id="edit-agency-contact-person">
                                <div class="invalid-feedback">
                                    Customer Name required
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="radio-station">Radio Station</label>
                                <select class="form-control p-1" name="radio_station_id" required id="edit-agency-radio-station">
                                    <option value="">Select Radio Station</option>

                                </select>
                                <div class="invalid-feedback">
                                    Radio Station is required
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="radio-station">Discount</label>
                                <input type="number" class="form-control" name="discount" id="edit-agency-discount" step="any" value="0" min="0">
                                <div class="invalid-feedback">
                                    Radio Station is required
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add Agency</button>
                    </div>
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
