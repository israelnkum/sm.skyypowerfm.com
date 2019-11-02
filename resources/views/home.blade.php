@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-6 mb-4 mb-xl-0">
                        <h3>Home</h3>
                    </div>

                </div>
                <div class="page-header-tab mt-4">
                    <div class="row mt-2 ">
                        <div class="col-md-1 offset-md-3 text-center">
                            <a role="button" href="{{route('commercials.index')}}" style="border-radius: 50px;" class="btn p-4  text-center  btn-dark">
                                <i class="mdi mdi-playlist-music menu-icon"></i>
                            </a>
                            <p>Commercials</p>
                        </div>
                        <div class="col-md-1 text-center">
                            <a role="button" href="{{route('orders.index')}}" style="border-radius: 50px;" class="btn p-4  text-center  btn-primary">
                                <i class="mdi mdi-book-open menu-icon"></i>
                            </a>
                            <p>Orders</p>
                        </div>
                        <div class="col-md-1 text-center">
                            <a role="button" href="{{route('adverts.index')}}" style="border-radius: 50px;" class="btn p-4  text-center  btn-success">
                                <i class="mdi mdi-playlist-edit menu-icon"></i>
                            </a>
                            <p>Adverts</p>
                        </div>
                        <div class="col-md-1 text-center">
                            <a role="button" href="{{route('agency.index')}}" style="border-radius: 50px;" class="btn p-4  text-center  btn-info">
                                <i class="mdi mdi-home-account menu-icon"></i>
                            </a>
                            <p>Agencies</p>
                        </div>
                        <div class="col-md-1 text-center">
                            <a role="button" href="{{route('programs.index')}}" style="border-radius: 50px;" class="btn p-4  text-center  btn-warning">
                                <i class="mdi mdi-playlist-edit menu-icon"></i>
                            </a>
                            <p>Programs</p>
                        </div>
                        <div class="col-md-1 text-center">
                            <a role="button" href="{{route('tc-s.index')}}" style="border-radius: 50px;" class="btn p-4  text-center  btn-danger">
                                <i class="mdi mdi-view-headline menu-icon"></i>
                            </a>
                            <p>TC's</p>
                        </div>
                        <div class="col-md-1 text-center">
                            <a role="button" href="{{route('invoice.index')}}" style="border-radius: 50px;" class="btn p-4  text-center  btn-secondary">
                                <i class="mdi mdi-view-headline menu-icon"></i>
                            </a>
                            <p>Invoice</p>
                        </div>
                    </div>
                </div>
                <div class="tab-content tab-transparent-content pb-0">
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between">
                                        <h4 class="card-title">Orders</h4>
                                        <div class="dropdown dropleft card-menu-dropdown">
                                            <button class="btn p-0" type="button" id="dropdown12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical card-menu-btn"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown12" x-placement="left-start">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="orders-table" class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Order Number</th>
                                                <th>
                                                    <table class="table table-borderless text-center">
                                                        <tbody>
                                                        <tr>
                                                            <td class="font-weight-bold"><h6 class="ml-5">Advert</h6></td>
                                                            <td class="font-weight-bold"><h6 class="ml-5">Received Date</h6></td>
                                                            <td class="font-weight-bold"><h6 class="ml-0">Start Date</h6></td>
                                                            <td class="font-weight-bold">End Date</td>
                                                            <td class="font-weight-bold">Action</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php($i=1)
                                            @foreach($orders as $group => $order)
                                                <tr>
                                                    <td>{{$group}}</td>
                                                    <td>
                                                        <table  class="table table-borderless text-center">
                                                            <tbody>
                                                            @foreach($order as $ord)
                                                                <tr>
                                                                    <td>{{$ord->advert->name}}</td>
                                                                    <td>{{$ord->received_date}}</td>
                                                                    <td>{{$ord->start_date}}</td>
                                                                    <td>{{$ord->end_date}}</td>
                                                                    <td width="10">
                                                                        <form method="post" action="{{route('orders.destroy', $ord->id)}}">
                                                                            {!! method_field('delete') !!}
                                                                            @csrf
                                                                            <button class="btn p-1 btn-link text-danger">Delete</button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table></td>
                                                @php($i++)
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
                    Tab Item
                </div>
                <div class="tab-pane fade" id="returns-1" role="tabpanel" aria-labelledby="returns-tab">
                    Tab Item
                </div>
                <div class="tab-pane fade" id="more" role="tabpanel" aria-labelledby="more-tab">
                    Tab Item
                </div>
            </div>
        </div>
    </div>
@endsection
