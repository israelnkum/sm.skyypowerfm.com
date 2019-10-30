@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <h3>Commercials</h3>
                </div>
                <div class="col-md-6">
                    <form class="needs-validation" novalidate action="" method="get">
                        @csrf
                        <div class="form-group row">
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
                    <a href="{{route('commercials.create')}}" class="btn btn-primary p-2  waves-effect waves-light"  role="button" >
                        <i class="mdi mdi-plus-circle mr-1"></i> Add Commercial
                    </a>
                </div>
            </div>
            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{route('commercials.store')}}" enctype="multipart/form-data" method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title mt-0" id="mySmallModalLabel">New Commercial</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-2">
                                        <label for="example-text-input">Name</label>
                                        <input class="form-control" name="name" type="text" required id="example-text-input">
                                        <div class="invalid-feedback">
                                            Commercial Name required
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-2">
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
                                    </div>


                                    <div class="col-sm-12">
                                        <label for="example-text-input">Audio File</label>
                                        <input class="form-control-file border p-1" name="audio_file" type="file" accept="audio/*" required id="example-text-input">
                                        <div class="invalid-feedback">
                                            File required
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="customer_id">Customer</label>
                                        <select required name="customer_id" class="form-control" id="customer_id">
                                            <option value="">~Select~</option>
                                            {{--@foreach($customers as $customer)
                                                <option value="{{$customer->id}}">{{$customer->name}}</option>
                                            @endforeach--}}
                                        </select>
                                        <div class="invalid-feedback">
                                            Customer required
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Add Commercial</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </form>
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            @if(empty($commercials))
                <div class="col-md-12 text-center">
                    <a href="{{route('all-commercials')}}">Get all Commercials</a>
                </div>
            @endif
            @if(empty($commercials))
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mt-0 header-title mb-4">In Queue</h4>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a href="#" class="text-decoration-none text-dark font-20"><i class="mdi mdi-refresh"></i></a>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="" class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Time</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {{--     @php($i =1)
                                             @foreach($agencies as $customer)
                                                 <tr>
                                                     <td>
                                                         <div class="custom-control custom-checkbox">
                                                             <input type="checkbox" value="{{$customer->id}}" name="customer_ids[]" class="custom-control-input checkCustomerItem" id="check{{$customer->id}}">
                                                             <label class="custom-control-label" for="check{{$customer->id}}"></label>
                                                         </div>
                                                     </td>
                                                     <td>{{$i}}</td>
                                                     <td>{{$customer->name}}</td>
                                                     <td>{{$customer->email}}</td>
                                                     <td>{{$customer->phone_number}}</td>
                                                     <td>{{$customer->company}}</td>
                                                     <td>{{$customer->id}}</td>
                                                     <td>
                                                         <a href="#" class="btn edit-customer"> <i class="mdi mdi-pencil"></i> </a>
                                                     </td>
                                                 @php($i++)
                                             @endforeach--}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card">
                            <form action="">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4 class="mt-0 header-title mb-4">Recent Schedules</h4>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <button class="btn btn-danger" type="submit" id="btn-delete-customers" disabled><i class="mdi mdi-trash-can-outline"></i> Delete</button>
                                        </div>
                                    </div>
                                    <table id="tbl-recent-schedules" class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="checkAllItems">
                                                    <label class="custom-control-label" for="checkAllItems"></label>
                                                </div>
                                            </th>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Audio File</th>
                                            <th scope="col">Schedule Date</th>
                                            {{--<th scope="col">Date Played</th>--}}
                                            <th scope="col">ID</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($i =1)
                                      {{--  @foreach($recent_schedules as $commercial)
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" value="{{$commercial->id}}" name="commercial_ids[]" class="custom-control-input checkCommercialItem" id="check{{$commercial->id}}">
                                                        <label class="custom-control-label" for="check{{$commercial->id}}"></label>
                                                    </div>
                                                </td>
                                                <td>{{$i}}</td>
                                                <td>{{$commercial->name}}</td>
                                                <td>
                                                    <audio controls>
                                                        <source src="{{asset('public/audio_files/'.$commercial->audio_file)}}" type="audio/mp3">
                                                        Your browser does not support the audio element.
                                                    </audio>
                                                </td>
                                                <td>{{$commercial->schedule_date}}</td>
                                                --}}{{--<td>{{$commercial->date_played}}</td>--}}{{--
                                                <td>{{$commercial->id}}</td>
                                                <td>
                                                    <a href="#" class="btn edit-customer"> <i class="mdi mdi-pencil"></i> </a>
                                                </td>
                                            @php($i++)
                                        @endforeach--}}
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            @if(!empty($commercials))
                <div class="row">
                    <div class="col-xl-10 offset-md-1">
                        <div class="card">
                            <form action="{{route('delete-customers')}}" onsubmit="return confirm('Please Confirm Delete')">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h4 class="mt-0 header-title mb-4">All Commercials</h4>
                                        </div>
                                        <div class="col-md-8 text-right">

                                            <button class="btn btn-danger" type="submit" id="btn-delete-customers" disabled><i class="mdi mdi-trash-can-outline"></i> Delete</button>

                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="customers_table" class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th scope="col">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="checkAllItems">
                                                        <label class="custom-control-label" for="checkAllItems"></label>
                                                    </div>
                                                </th>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Audio File</th>
                                                <th scope="col">Schedule Date</th>
                                                <th scope="col">Date Played</th>
                                                <th scope="col">ID</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php($i =1)
                                            @foreach($commercials as $commercial)
                                                <tr>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" value="{{$commercial->id}}" name="commercial_ids[]" class="custom-control-input checkCommercialItem" id="check{{$commercial->id}}">
                                                            <label class="custom-control-label" for="check{{$commercial->id}}"></label>
                                                        </div>
                                                    </td>
                                                    <td>{{$i}}</td>
                                                    <td>{{$commercial->name}}</td>
                                                    <td>Audio File</td>
                                                    <td>{{$commercial->schedule_date}}</td>
                                                    <td>{{$commercial->date_played}}</td>
                                                    <td>{{$commercial->id}}</td>
                                                    <td>
                                                        <a href="#" class="btn edit-customer"> <i class="mdi mdi-pencil"></i> </a>
                                                    </td>
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
