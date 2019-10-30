@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-2">
                    <h3>Agencies</h3>
                </div>
                <div class="col-md-6">
                    <form class="needs-validation" novalidate action="" method="get">
                        @csrf
                        <div class="form-group row mb-1">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="text" required class="form-control p-2" id="" placeholder="Type to search in programs">
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
                    <button class="btn btn-primary p-1  waves-effect waves-light"  data-toggle="modal" data-target=".bs-example-modal-sm" type="button" >
                        <i class="ti-user mr-1"></i> New Agency
                    </button>
                </div>
            </div>
            <div class="page-header-tab mb-1"></div>
            <div class="row mt-3">
                <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{route('agency.store')}}" method="post" class="needs-validation" novalidate>
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="mySmallModalLabel">New Agency</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label for="example-text-input">Agency Name</label>
                                            <input class="p-2 form-control" name="agency_name" type="text" required id="example-text-input">
                                            <div class="invalid-feedback">
                                                Company Name required
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="example-text-input">Address</label>
                                            <input class="p-2 form-control" name="address" type="text" id="example-text-input">
                                            <div class="invalid-feedback">
                                                Address required
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="example-text-input">Fax</label>
                                            <input class="p-2 form-control" name="fax" type="text" id="example-text-input">
                                            <div class="invalid-feedback">
                                                Fax required
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="example-text-input">Email</label>
                                            <input class="p-2 form-control" name="email" type="email" id="example-text-input">
                                            <div class="invalid-feedback">
                                                Type correct email
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="example-text-input">Phone Number</label>
                                            <input class="p-2 form-control phone_number" name="phone_number" type="text" required id="example-text-input">
                                            <div class="invalid-feedback">
                                                Phone Number required
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="example-text-input">Contact Person(s)</label>
                                            <input class="p-2 form-control" name="contact_person" type="text" required id="example-text-input">
                                            <div class="invalid-feedback">
                                                Customer Name required
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="radio-station">Radio Station</label>
                                            <select class="form-control p-1" name="radio_station_id" required id="radio-station">
                                                <option value="">Select Radio Station</option>
                                                @foreach($radio_stations as $radio_station)
                                                    <option value="{{$radio_station->id}}">{{$radio_station->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Radio Station is required
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="radio-station">Discount</label>
                                            <input type="number" class="form-control" name="discount" id="discount" step="any" value="0" min="0">
                                            <div class="invalid-feedback">
                                                Discount is required
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
                @if(empty($agencies))
                    <div class="col-md-12 text-center">
                        <a href="{{route('all-agencies')}}">All Agencies</a>
                    </div>
                @endif
            </div>
            @if(!empty($agencies))
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <form action="{{route('delete-agencies')}}" onsubmit="return confirm('Please Confirm Delete')">
                                @csrf
                                <input type="hidden" class="form-control" name="selected_agencies" id="selected_agencies">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h4 class="mt-0 header-title mb-4">All Agencies</h4>
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
                                                <th scope="col">Address</th>
                                                <th scope="col">Fax</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Discount</th>
                                                <th scope="col">Station ID</th>
                                                <th scope="col">Contact Person</th>
                                                <th scope="col">Station</th>
                                                <th scope="col">Edit</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php($i =1)
                                            @foreach($agencies as $agency)
                                                <tr>
                                                    <td>

                                                    </td>
                                                    <td>{{$agency->id}}</td>
                                                    <td>{{$agency->agency_name}}</td>
                                                    <td>{{$agency->address}}</td>
                                                    <td>{{$agency->fax}}</td>
                                                    <td>{{$agency->email}}</td>
                                                    <td>{{$agency->phone_number}}</td>
                                                    <td>{{$agency->discount}}</td>
                                                    <td>{{$agency->radio_station->id}}</td>
                                                    <td>{{$agency->contact_person}}</td>
                                                    <td>{{$agency->radio_station->name}}</td>
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
                                    @foreach($radio_stations as $radio_station)
                                        <option value="{{$radio_station->id}}">{{$radio_station->name}}</option>
                                    @endforeach
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
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                    </div>
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
