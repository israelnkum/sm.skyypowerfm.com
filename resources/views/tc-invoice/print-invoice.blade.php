@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-md-6">
                    <h3>Invoice</h3>
                </div>
                <div class="col-md-6">
                    <form class="needs-validation" novalidate action="{{route('filter-invoice-orders')}}" method="get">
                        @csrf
                        <div class="form-group row mb-1">
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
                        <form class="needs-validation" novalidate action="{{route('invoice.create')}}" method="get">
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
                    <div class="col-md-12 pl-0">
                        <div class="card px-2">
                            <div class="card-body">
                                <div class="content-print">
                                    <div class="container d-flex  justify-content-between align-items-center">

                                        <div class="col-lg-2 pl-0">
                                            <img height="auto" width="200" src=" {{asset('public/uploads/'.$selected_agency->radio_station->logo)}}" class="img-fluid" alt="">
                                        </div>
                                        <div class="col-lg-5 text-center">
                                            <h4 class="display-4 ">Invoice</h4>
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
                                            <h6 class="font-weight-normal"><b>Bill To:</b> {{$selected_agency->agency_name}}</h6>
                                            <h6 class="font-weight-normal"><b>Tel:</b> {{$selected_agency->phone_number}}</h6>
                                            <h6 class="font-weight-normal"><b>Email:</b> {{$selected_agency->email}}</h6>
                                           </div>

                                    </div>
                                    <div class="container d-flex  justify-content-between align-items-center">
                                        <form class="needs-validation" novalidate method="post" action="{{route('invoice.store')}}">
                                            @csrf
                                            <input type="hidden" name="radio_station_id" value="{{$selected_agency->radio_station->id}}">
                                            <input type="hidden" name="agency_id" value="{{$selected_agency->id}}">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="description">Description</label>
                                                    <input type="text" readonly required class="form-control p-2" id="description" value="@if(!empty($data)) @foreach($data as $datum) {{$datum->advert->name}}, @endforeach @endif"  name="description">
                                                    <div class="invalid-feedback">
                                                        Name is required
                                                    </div>
                                                </div>
                                                <div class="col-md-1 ml-0">
                                                    <label  for="percentage">Qty</label>
                                                    <input type="number" required class="form-control p-2 qty" value="1" min="1" id="qty" name="qty">
                                                    <div class="invalid-feedback">
                                                        Quantity is required
                                                    </div>
                                                </div>
                                                <div class="col-md-2 ml-0">
                                                    <label  for="percentage">Unit Price</label>
                                                    <input type="number" required class="form-control p-2 unit_price" value="0" min="1" id="unit_price" name="unit_price">
                                                    <div class="invalid-feedback">
                                                        Unit Price required
                                                    </div>
                                                </div>
                                                <div class="col-md-2 ml-0">
                                                    <label  for="percentage">Total</label>
                                                    <input type="text" required class="form-control p-2" id="total_price" name="total_price">
                                                    <div class="invalid-feedback">
                                                        Total required
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-4 offset-md-4">
                                                    <table class="table table-borderless">
                                                        <tbody class="p-1">
                                                        @foreach($taxes as $tax)
                                                            <tr >
                                                                <td class="p-1">
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <b>{{$tax->value}}%</b>
                                                                            <input type="checkbox" class="form-check-input" id="{{strtolower($tax->name)}}" checked>
                                                                            &nbsp; &nbsp; {{$tax->name}}
                                                                        </label>
                                                                    </div>
                                                                    <input type="hidden" name="{{strtolower($tax->name)}}" id="{{strtolower($tax->name)}}-value" value="{{$tax->value}}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" id="{{strtolower($tax->name)}}-amount" name="{{strtolower($tax->name)}}_amount" data-inputmask="'alias': 'currency'" readonly class="form-control p-2">
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>
                                                        <label for="taxable-amt">Taxable Amount</label>
                                                        <input type="text" name="taxable_amt" readonly class="form-control p-2" data-inputmask="'alias': 'currency'"  id="taxable-amt">
                                                    </p>
                                                    <p>
                                                        <label for="total">Total</label>
                                                        <input type="text" name="total_amt" readonly class="form-control p-2" data-inputmask="'alias': 'currency'"  id="total-amt">
                                                    </p>
                                                </div>

                                            </div>
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-sm btn-primary ml-0" title="Print"><i class="mdi mdi-printer mr-1"></i></button>
                                            </div>
                                            {{--<div data-repeater-list="taxes">
                                                <div data-repeater-item class="d-flex mb-2">
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="name">Name</label>
                                                            <input type="text" required class="form-control p-2" id="name" name="tax_name">
                                                            <div class="invalid-feedback">
                                                                Name is required
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1 ml-0">
                                                            <label  for="percentage">Qty</label>
                                                            <input type="number" required class="form-control p-2" id="name" name="tax_name">
                                                            <div class="invalid-feedback">
                                                                Name is required
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 ml-0">
                                                            <label  for="percentage">Unit Price</label>
                                                            <input type="number" required class="form-control p-2" id="name" name="tax_name">
                                                            <div class="invalid-feedback">
                                                                Name is required
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1 ml-0">
                                                            <label  for="percentage">Total</label>
                                                            <input type="text" required class="form-control p-2" id="name" name="tax_name">
                                                            <div class="invalid-feedback">
                                                                Name is required
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
                                            </div>--}}
                                        </form>
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
