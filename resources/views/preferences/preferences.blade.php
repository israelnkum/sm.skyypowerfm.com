@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3>Preferences</h3>
                        </div>
                        <div class="col-md-6 text-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#new-radio-modal">New Radio</button>
                        </div>
                    </div>
                    <div class="page-header-tab mb-1"></div>
                    <div class="row">
                        <div class="col-md-12 col-xl-12 grid-margin stretch-card">
                            <div class="">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#radio-stations" role="tab" aria-controls="radio-stations" aria-selected="true">Radio Stations</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tax" role="tab" aria-controls="tax" aria-selected="false">Tax</a>
                                    </li>
                                    {{--<li class="nav-item">
                                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#invoice" role="tab" aria-controls="invoice" aria-selected="false">Invoice</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#tcs" role="tab" aria-controls="tcs" aria-selected="false">TC's</a>
                                    </li>--}}
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="radio-stations" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            {{--<div class="col-md-3">
                                                <div class="card p-3">
                                                    <div class="">
                                                        <h4 class="card-title">Add Radio Station</h4>
                                                        <form class="needs-validation" enctype="multipart/form-data" novalidate method="post" action="{{route('radio-stations.store')}}">
                                                            @csrf
                                                            <div class="form-group row">
                                                                <div class="col-md-12">
                                                                    <label for="name">Name</label>
                                                                    <input type="text" required class="form-control p-2" id="name" name="name">
                                                                    <div class="invalid-feedback">
                                                                        Name is required
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="address">Address</label>
                                                                    <input type="text" required class="form-control p-2" name="address" id="address">
                                                                    <div class="invalid-feedback">
                                                                        Address is required
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="location">Location</label>
                                                                    <input type="text" class="form-control p-2" name="location" required id="location">
                                                                    <div class="invalid-feedback">
                                                                        Location is required
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="phone_number">Phone Number</label>
                                                                    <input type="text" required class="form-control p-2 phone_number" name="phone_number" id="phone_number">
                                                                    <div class="invalid-feedback">
                                                                        Phone number is required
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="fax">Fax</label>
                                                                    <input type="text" class="form-control p-2" id="fax" name="fax">
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="signature">Signature</label>
                                                                    <input type="file" accept="image/*" class="form-control form-control-file p-2" name="signature" id="signature">
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="logo">Radio Logo</label>
                                                                    <input type="file" accept="image/*" class="form-control p-2" name="logo" id="logo">
                                                                </div>

                                                            </div>

                                                            <button class="btn btn-primary" type="submit">Save</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>--}}
                                            <div class="col-md-12 col-xl-12 grid-margin stretch-card">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form id="delete-radio-stations-form">
                                                            <div class="d-flex flex-wrap justify-content-between">
                                                                <h4 class="card-title">Radio Stations</h4>
                                                                <div class="dropdown dropleft card-menu-dropdown">
                                                                    <button disabled id="btn-delete-radio" class="btn btn-link text-danger text-decoration-none text-right" type="submit">Delete</button>

                                                                    <button class="btn p-0" type="button" id="dropdown12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="mdi mdi-dots-vertical card-menu-btn"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdown12" x-placement="left-start">
                                                                        <a class="dropdown-item" href="#">Export</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="table-responsive">
                                                                <table class="table " id="radio-stations-table">
                                                                    <thead>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th>ID</th>
                                                                        <th>Name</th>
                                                                        <th>Address</th>
                                                                        <th>Location</th>
                                                                        <th>Phone</th>
                                                                        <th>Fax</th>
                                                                        <th>Ad. Prefix</th>
                                                                        <th>Sign.</th>
                                                                        <th>Logo</th>
                                                                        <th>Edit</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                    {{--                                                            <button type="button" class="btn btn-success btn-fw" onclick="showSuccessToast()">Success</button>--}}
                                                                    @php($i = 1)
                                                                    @foreach($radio_stations as $station)
                                                                        <tr>
                                                                            <td></td>
                                                                            <td>{{$station->id}}</td>
                                                                            <td>{{$station->name}}</td>
                                                                            <td>{{$station->address}}</td>
                                                                            <td>{{$station->location}}</td>
                                                                            <td>{{$station->phone_number}}</td>
                                                                            <td>{{$station->fax}}</td>
                                                                            <td>{{$station->ad_prefix}}</td>
                                                                            <td>
                                                                                <img class="img-fluid" src="{{asset('public/uploads/'.$station->signature)}}" alt="Signature">
                                                                            </td>
                                                                            <td>
                                                                                <img class="img-fluid" src="{{asset('public/uploads/'.$station->logo)}}" alt="Logo">
                                                                            </td>

                                                                            <td>
                                                                                <a href="#"   class="mr-1 edit-radio-station text-muted p-2"><i class="mdi mdi-grease-pencil"></i></a>
                                                                            </td>
                                                                        </tr>
                                                                        @php($i+=1)
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tax" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form class="repeater needs-validation" novalidate method="post" action="{{route('taxes.store')}}">
                                                    @csrf
                                                    <div data-repeater-list="taxes">
                                                        <div data-repeater-item class="d-flex mb-2">
                                                            <div class="form-group row">
                                                                <div class="col-md-4">
                                                                    <label for="name">Name</label>
                                                                    <input type="text" required class="form-control" id="name" name="tax_name">
                                                                    <div class="invalid-feedback">
                                                                        Name is required
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label  for="percentage">Value</label>
                                                                    <div class="input-group">
                                                                        <input required type="number" step="0.01" name="tax_value" class="form-control vat" id="percentage" min="0">
                                                                        <div class="input-group-prepend bg-dark">
                                                                            <div class="input-group-text bg-dark text-white">%</div>
                                                                        </div>
                                                                        <div class="invalid-feedback">
                                                                            Value required
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <button data-repeater-delete type="button" class="btn btn-danger btn-sm icon-btn mt-5" >
                                                                        <i class="mdi mdi-delete"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <button data-repeater-create type="button" class="btn btn-info btn-sm icon-btn ml-2 mb-2">
                                                            <i class="mdi mdi-plus"></i>
                                                        </button>
                                                    </div>
                                                    <button class="btn btn-primary" type="submit">Save</button>
                                                </form>
                                                {{--                                                <p id="demo">d</p>--}}
                                            </div>
                                            <div class="col-md-6 grid-margin">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form id="delete-tax-form">
                                                            <div class="d-flex flex-wrap justify-content-between">
                                                                <h4 class="card-title">All Taxes</h4>
                                                                <div class="dropdown dropleft card-menu-dropdown">
                                                                    <button disabled id="btn-delete-tax" class="btn btn-link text-danger text-decoration-none text-right" type="submit">Delete</button>

                                                                    <button class="btn p-0" type="button" id="dropdown12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="mdi mdi-dots-vertical card-menu-btn"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdown12" x-placement="left-start">
                                                                        <a class="dropdown-item" href="#">Export</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="table-responsive">
                                                                <table class="table " id="taxes-table">
                                                                    <thead>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th>ID</th>
                                                                        <th>#</th>
                                                                        <th>Name</th>
                                                                        <th>Value</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                    {{--                                                            <button type="button" class="btn btn-success btn-fw" onclick="showSuccessToast()">Success</button>--}}
                                                                    @php($i = 1)
                                                                    @foreach($taxes as $tax)
                                                                        <tr>
                                                                            <td></td>
                                                                            <td>
                                                                                {{$tax->id}}
                                                                            </td>
                                                                            <td>{!! $i !!}</td>
                                                                            <td>{{$tax->name}}</td>
                                                                            <td>{{$tax->value}}</td>
                                                                            <td>
                                                                                <a href="javascript:void(0)"  class="mr-1 edit-tax text-muted p-2"><i class="mdi mdi-grease-pencil"></i></a>
                                                                            </td>
                                                                        </tr>
                                                                        @php($i+=1)
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="invoice" role="tabpanel" aria-labelledby="contact-tab">
                                        Invoice
                                    </div>
                                    <div class="tab-pane fade" id="tcs" role="tabpanel" aria-labelledby="contact-tab">
                                        TC's
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--Edit Tax Modal--}}
    <div class="modal fade p-0" id="exampleModal-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm p-0" role="document">
            <form id="edit-taxes-form" action="taxes" method="post" class="mb-0 needs-validation p-0" novalidate>
                @csrf
                {!! method_field('put') !!}
                <div class="modal-content p-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="taxes-title">Edit Tax</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mb-0">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="edit-tax-name">Tax Name:</label>
                                <input type="text" name="tax_name" required class="form-control p-2" id="edit-tax-name">
                                <div class="invalid-feedback">
                                    Name required
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="edit-tax-value">Value:</label>
                                <div class="input-group">
                                    <input required type="number" step="0.01" name="tax_value" class="form-control vat" id="edit-tax-value" min="0">
                                    <div class="input-group-prepend bg-dark">
                                        <div class="input-group-text bg-dark text-white">%</div>
                                    </div>
                                    <div class="invalid-feedback">
                                        Value required
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{--End Edit Tax Modal--}}

    {{--Edit Radio Station Modal--}}
    <div class="modal fade p-0" id="edit-radio-station-modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog p-0" role="document">
            <form class="needs-validation" id="edit-radio-station-form" enctype="multipart/form-data" novalidate method="post" action="radio-stations">
                @csrf
                {!! method_field('put') !!}
                <div class="modal-content p-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="radio-title">Edit Radio Station</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mb-0">

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="name" class="text-primary">Name</label>
                                <input type="text" required class="form-control p-2" id="edit-radio-name" name="name">
                                <div class="invalid-feedback">
                                    Name is required
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="address" class="text-primary">Address</label>
                                <input type="text" required class="form-control p-2" name="address" id="edit-radio-address">
                                <div class="invalid-feedback">
                                    Address is required
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="location" class="text-primary">Location</label>
                                <input type="text" class="form-control p-2" name="location" required id="edit-radio-location">
                                <div class="invalid-feedback">
                                    Location is required
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="phone_number" class="text-primary">Phone Number</label>
                                <input type="text" required class="form-control p-2 phone_number" name="phone_number" id="edit-radio-phone_number">
                                <div class="invalid-feedback">
                                    Phone number is required
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="fax" class="text-primary">Fax</label>
                                <input type="text" class="form-control p-2" id="edit-radio-fax" name="fax">
                            </div>
                            <div class="col-md-6">
                                <label for="edit-radio-prefix" class="text-primary">Advert Prefix</label>
                                <input required type="text" minlength="3" maxlength="3" placeholder="eg: SKP" class="form-control p-2" id="edit-radio-prefix" name="prefix">
                                <div class="invalid-feedback">
                                    Prefix required
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="signature" class="text-primary">Signature</label>
                                <input type="file" accept="image/*" class="form-control form-control-file p-2" name="signature" id="edit-radio-signature">
                            </div>
                            <div class="col-md-6">
                                <label for="logo" class="text-primary">Radio Logo</label>
                                <input type="file" accept="image/*" class="form-control p-2" name="logo" id="edit-radio-logo">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{--End Radio Station Modal--}}

    {{--New Radio Station Modal--}}
    <div class="modal fade p-0" id="new-radio-modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog p-0" role="document">
            <form class="needs-validation" id="edit-radio-station-form" enctype="multipart/form-data" novalidate method="post" action="{{route('radio-stations.store')}}">
                @csrf
                <div class="modal-content p-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="radio-title">New Radio Station</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mb-0">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="name" class="text-primary">Name</label>
                                <input type="text" required class="form-control p-2" id="radio-name" name="name">
                                <div class="invalid-feedback">
                                    Name is required
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="address" class="text-primary">Address</label>
                                <input type="text" required class="form-control p-2" name="address" id="radio-address">
                                <div class="invalid-feedback">
                                    Address is required
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="location" class="text-primary">Location</label>
                                <input type="text" class="form-control p-2" name="location" required id="radio-location">
                                <div class="invalid-feedback">
                                    Location is required
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="phone_number" class="text-primary">Phone Number</label>
                                <input type="text" required class="form-control p-2 phone_number" name="phone_number" id="edit-radio-phone_number">
                                <div class="invalid-feedback">
                                    Phone number is required
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="fax" class="text-primary">Fax</label>
                                <input type="text" class="form-control p-2" id="edit-radio-fax" name="fax">
                            </div>
                            <div class="col-md-6">
                                <label for="edit-radio-prefix" class="text-primary">Advert Prefix</label>
                                <input required type="text" minlength="3" maxlength="3" placeholder="eg: SKP" class="form-control p-2" id="radio-prefix" name="prefix">
                                <div class="invalid-feedback">
                                    Prefix required
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="signature" class="text-primary">Signature</label>
                                <input type="file" accept="image/*" class="form-control form-control-file p-2" name="signature" id="edit-radio-signature">
                            </div>
                            <div class="col-md-6">
                                <label for="logo" class="text-primary">Radio Logo</label>
                                <input type="file" accept="image/*" class="form-control p-2" name="logo" id="edit-radio-logo">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{--End New Radio Station Modal--}}
@endsection
