@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-2">
                    <h3>Advertisement</h3>
                </div>
                <div class="col-md-6">
                    <form class="needs-validation" novalidate action="{{route('search-adverts')}}" method="get">
                        @csrf
                        <div class="form-group row mb-1">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="text" name="search" required class="form-control p-2" id="" placeholder="Search by Advert Name | Number">
                                    <div class="input-group-prepend">
                                        <button type="submit" class="btn input-group-text p-2"><i class="mdi mdi-magnify"></i></button>
                                    </div>
                                    <div class="invalid-feedback">
                                        Search by advert name or number
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-4 text-right">
                    @if(!empty($adverts))
                        <a href="{{route('all-adverts')}}">All Adverts</a>
                    @endif
                    <button class="btn btn-primary p-2 waves-effect waves-light"  data-toggle="modal" data-target=".bs-example-modal-sm" type="button" >
                        <i class="ti-user mr-1"></i> New Advert
                    </button>
                </div>
            </div>
            <div class="page-header-tab mb-1"></div>
            <div class="row mt-3">
                <div class="col-sm-12">
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
                                            <div class="col-sm-12 mt-1">
                                                <label for="customer_id">Radio Station</label>
                                                <select required name="radio_station_id" style="width: 100%" class="form-control js-example-basic-single w-100" id="station-advert">
                                                    <option value=""></option>
                                                    @foreach($radio_stations as $radio_station)
                                                        @if(Auth::user()->role =="Admin")
                                                        @else
                                                            @if(Auth::user()->radio_station_id == $radio_station->id)
                                                                <option selected value="{{$radio_station->id}}">{{$radio_station->name}}</option>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Radio Station required
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <label for="customer_id">Agency</label>
                                                <select required name="agencies_id" class="form-control js-example-basic-single" style="width: 100%" id="agencies_id-advert">
                                                    <option value=""></option>
                                                    @foreach($agencies as $agency)
                                                        <option value="{{$agency->id}}">{{$agency->agency_name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Agency required
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <label for="example-text-input">Audio File</label>
                                                <input class="form-control-file border p-1" name="audio_file" type="file" accept="audio/*" id="example-text-input">
                                                <div class="invalid-feedback">
                                                    File required
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add Advert</button>
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
                                        <table id="advert_table" class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">AD. #</th>
                                                <th scope="col">Agency ID</th>
                                                <th scope="col">Agency</th>
                                                <th scope="col">File</th>
                                                <th scope="col">Station_id</th>
                                                <th scope="col">Station</th>
                                                <th scope="col">Edit</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php($i =1)
                                            @foreach($adverts as $advert)
                                                @if(Auth::user()->radio_station_id == $advert->radio_station_id)
                                                    <tr>
                                                        <td>{{$advert->id}}</td>
                                                        <td>{{$advert->name}}</td>
                                                        <td>{{$advert->advert_number}}</td>
                                                        <td>{{$advert->agency_id}}</td>
                                                        <td>{{$advert->agency->agency_name}}</td>
                                                        <td>
                                                            @if($advert->audio_file == "Upload file")
                                                                Upload File
                                                            @else
                                                                <audio controls>
                                                                    <source src="{{asset('public/audio_files/'.$advert->audio_file)}}" type="audio/mp3">
                                                                    Your browser does not support the audio element.
                                                                </audio>
                                                            @endif
                                                        </td>
                                                        <td>{{$advert->radio_station->id}}</td>
                                                        <td>{{$advert->radio_station->name}}</td>
                                                        <td>
                                                            <a href="javascript:void(0)" class="btn edit-advert"> <i class="mdi mdi-pencil"></i> </a>
                                                        </td>
                                                    </tr>
                                                @endif
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

    <div class="modal fade edit-advert-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="adverts" id="edit-advert-form" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                {!! method_field('put') !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="advert-title">Edit Advert</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-12 mb-2">
                                <label for="example-text-input">Advert Name</label>
                                <input class="form-control p-2" name="name" type="text" required id="edit-ad-name">
                                <div class="invalid-feedback">
                                    Advert Name required
                                </div>
                            </div>
                            <div class="col-sm-12 mt-1">
                                <label for="customer_id">Radio Station</label>
                                <select required name="radio_station_id" style="width: 100%" class="form-control js-example-basic-single w-100" id="edit-ad-station">
                                    <option value=""></option>
                                    @foreach($radio_stations as $radio_station)
                                        @if(Auth::user()->role =="Admin")
                                            <option value="{{$radio_station->id}}">{{$radio_station->name}}</option>
                                        @else
                                            @if(Auth::user()->radio_station_id == $radio_station->id)
                                                <option selected value="{{$radio_station->id}}">{{$radio_station->name}}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Radio Station required
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label for="customer_id">Agency</label>
                                <select required name="agencies_id" class="form-control js-example-basic-single" style="width: 100%" id="edit-ad-agency">
                                    <option value=""></option>
                                    @foreach($agencies as $agency)
                                        @if(Auth::user()->role =="Admin")
                                            <option value="{{$agency->id}}">{{$agency->agency_name}}</option>
                                        @else
                                            @if(Auth::user()->radio_station_id == $agency->radio_station_id)
                                                <option value="{{$agency->id}}">{{$agency->agency_name}}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Agency required
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label for="example-text-input">Audio File</label>
                                <input class="form-control-file border p-1" name="audio_file" type="file" accept="audio/*" id="edit-ad-file">
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
@endsection
