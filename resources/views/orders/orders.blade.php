@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-6">
                    <h3>Orders</h3>
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
                                    <i class="ti-user mr-1"></i> New Order
                                </button>
                            </div>
                            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{route('orders.store')}}" method="post" class="needs-validation" novalidate>
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title mt-0" id="mySmallModalLabel">New Order</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label for="example-text-input">Received Date</label>
                                                        <div class="input-group">
                                                            <input type="text" name="received_date" required class="form-control p-2 datetimepicker-input" id="datetimepicker1" data-toggle="datetimepicker" data-target="#datetimepicker1"/>
                                                            <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                                            <div class="invalid-feedback">
                                                                Date required
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="radio-station">Radio Station</label>
                                                        <select class="form-control p-1  js-example-basic-single" style="width: 100%" name="radio_station_id" id="select-radio-station" required>
                                                            <option value="">Select Station</option>
                                                            @foreach($radio_stations as $radio_station)
                                                                <option value="{{$radio_station->id}}">{{$radio_station->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Station is required
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="radio-station">Agency</label>
                                                        <select class="form-control p-1 agency-order js-example-basic-single" style="width: 100%" name="agency_id" required id="agency-order">
                                                            <option value="">Select Agency</option>
                                                           {{-- @foreach($agencies as $agency)
                                                                <option value="{{$agency->id}}">{{$agency->agency_name}}</option>
                                                            @endforeach--}}
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Agency is required
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="adverts-order">Adverts</label>
                                                        <select class="form-control p-1 js-example-basic-single" style="width: 100%" id="adverts-order" required name="advert_id">
                                                            <option value="">Select Advert</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Agency is required
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="example-text-input">Start Date</label>
                                                        <div class="input-group date"  id="datetimepicker6" data-target-input="nearest">
                                                            <div class="input-group" data-target="#datetimepicker6" data-toggle="datetimepicker">
                                                                <input type="text" name="start_date" required class="form-control datetimepicker-input" data-target="#datetimepicker6"/>
                                                                <div class="input-group-addon input-group-append"><i class="mdi mdi-clock input-group-text"></i></div>
                                                                <div class="invalid-feedback" >
                                                                    Start Date and Time required
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="example-text-input">End Date</label>
                                                        <div class="input-group date"  id="datetimepicker7" data-target-input="nearest">
                                                            <div class="input-group" data-target="#datetimepicker7" data-toggle="datetimepicker">
                                                                <input required type="text" name="end_date" class="form-control datetimepicker-input" data-target="#datetimepicker7"/>
                                                                <div class="input-group-addon input-group-append"><i class="mdi mdi-clock input-group-text"></i></div>
                                                                <div class="invalid-feedback">
                                                                    End Date and Time required
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Add Order</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </form>
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                           {{-- @if(empty($orders))
                                <div class="col-md-12 text-center">
                                    <a href="{{route('all-orders')}}">All orders</a>
                                </div>
                            @endif--}}
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($orders))
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <form action="{{route('delete-orders')}}" onsubmit="return confirm('Please Confirm Delete')">
                                @csrf
                                <input type="hidden" class="form-control" name="selected_orders" id="selected_orders">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h4 class="mt-0 header-title mb-4">All orders</h4>
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
                                                <th scope="col">Order #</th>
                                                <th scope="col">Agency</th>
                                                <th scope="col">Advert</th>
                                                <th scope="col">Date Received</th>
                                                <th scope="col">Start Date</th>
                                                <th scope="col">End Date</th>
                                                <th scope="col">Station ID</th>
                                                <th scope="col">Station</th>
                                                <th scope="col">Edit</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php($i =1)
                                            @foreach($orders as $order)
                                                <tr>
                                                    <td>
                                                    </td>
                                                    <td>{{$order->id}}</td>
                                                    <td>{{$order->order_number}}</td>
                                                    <td>{{$order->agency->agency_name}}</td>
                                                    <td>{{$order->advert->name}}</td>
                                                    <td>{{$order->received_date}}</td>
                                                    <td>{{$order->start_date}}</td>
                                                    <td>{{$order->start_date}}</td>
                                                    <td>{{$order->radio_station->id}}</td>
                                                    <td>{{$order->radio_station->name}}</td>
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
            <form action="orders" id="edit-agency-form" method="post" class="needs-validation" novalidate>
                @csrf
                {!! method_field('put') !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="agency-title">New Order</h5>
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
                                    {{--@foreach($radio_stations as $radio_station)
                                        <option value="{{$radio_station->id}}">{{$radio_station->name}}</option>
                                    @endforeach--}}
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
