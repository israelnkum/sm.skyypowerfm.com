@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-6 mb-4 mb-xl-0">
                        <h3>Congrats Edwin!</h3>
                        <h6 class="font-weight-normal mb-0 text-muted">You have done 57.6% more sales today.</h6>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center justify-content-md-end">
                            <div class="border-right-dark pr-4 mb-3 mb-xl-0 d-xl-block d-none">
                                <p class="text-muted">Today</p>
                                <h6 class="font-weight-medium text-muted mb-0">23 Aug 2019</h6>
                            </div>
                            <div class="pr-4 pl-4 mb-3 mb-xl-0 d-xl-block d-none">
                                <p class="text-muted">Category</p>
                                <h6 class="font-weight-medium text-muted mb-0">All Categories</h6>
                            </div>
                            <div class="pr-1 mb-3 mb-xl-0">
                                <button type="button" class="btn btn-success btn-icon mr-2"><i class="mdi mdi-filter-variant"></i></button>
                            </div>
                            <div class="pr-1 mb-3 mb-xl-0">
                                <button type="button" class="btn btn-success btn-icon mr-2"><i class="mdi mdi-refresh"></i></button>
                            </div>
                            <div class="mb-3 mb-xl-0">
                                <div class="btn-group dropdown">
                                    <button type="button" class="btn btn-success">14 Aug 2019</button>
                                    <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
                                        <a class="dropdown-item" href="#">2015</a>
                                        <a class="dropdown-item" href="#">2016</a>
                                        <a class="dropdown-item" href="#">2017</a>
                                        <a class="dropdown-item" href="#">2018</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-header-tab mt-xl-4">
                    <div class="col-12 pl-0 pr-0">
                        <div class="row ">
                            <div class="col-12 col-sm-6 mb-xs-4  pt-2 pb-2 mb-xl-0">
                                <ul class="nav nav-tabs tab-transparent" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="users-tab" data-toggle="tab" href="#" role="tab" aria-controls="users" aria-selected="false">Users</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="returns-tab" data-toggle="tab" href="#" role="tab" aria-controls="returns" aria-selected="false">Returns</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="more-tab" data-toggle="tab" href="#" role="tab" aria-controls="more" aria-selected="false">More</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-sm-6 mb-xs-4 mb-xl-0 pt-2 pb-2 text-md-right d-none d-md-block">
                                <div class="d-inline-flex">
                                    <button class="btn d-flex align-items-center">
                                        <i class="mdi mdi-download mr-1"></i>
                                        <span class="text-left font-weight-medium">
                            Download report
                            </span>
                                    </button>
                                    <button class="btn d-flex align-items-center">
                                        <i class="mdi mdi-file-pdf  mr-1"></i>
                                        <span class="font-weight-medium text-left">
                            Export
                            </span>
                                    </button>
                                    <button class="btn d-flex align-items-center pr-0">
                                        <i class="mdi mdi-email-outline  mr-1"></i>
                                        <span class="text-left font-weight-medium">
                            Send as Email
                            </span>
                                    </button>
                                </div>
                            </div>
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
                                        <table class="table center-aligned-table">
                                            <thead>
                                            <tr>
                                                <th class="pl-0">
                                                    <div class="form-check mb-0">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input">
                                                            <i class="input-helper"></i></label>
                                                    </div>
                                                </th>
                                                <th>Order ID</th>
                                                <th>Customer</th>
                                                <th>Product</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="pl-0">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input">
                                                            <i class="input-helper"></i></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <img src="http://www.urbanui.com/hiliteui/template/images/orders/order-1.jpg" alt="image" class="img-rect mr-2">
                                                </td>
                                                <td>
                                                    <div class="text-muted font-weight-medium">6547-3DESC9835</div>
                                                </td>
                                                <td>Nike Hazard</td>
                                                <td>18 May 2019</td>
                                                <td><label class="badge badge-success">Completed</label></td>
                                                <td>
                                                    <a href="#" class="mr-1 text-muted p-2"><i class="mdi mdi-dots-horizontal"></i></a>
                                                    <a href="#" class="mr-1 text-muted p-2"><i class="mdi mdi-grease-pencil"></i></a>
                                                    <a href="#" class="mr-1 text-muted p-2"><i class="mdi mdi-delete"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pl-0">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input">
                                                            <i class="input-helper"></i></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <img src="http://www.urbanui.com/hiliteui/template/images/orders/order-2.jpg" alt="image" class="img-rect mr-2">
                                                </td>
                                                <td>
                                                    <div class="text-muted font-weight-medium">6547-3DESC9835</div>
                                                </td>
                                                <td>iPhone X</td>
                                                <td>13 Aug 2019</td>
                                                <td><label class="badge badge-warning">Delayed</label></td>
                                                <td>
                                                    <a href="#" class="mr-1 text-muted p-2"><i class="mdi mdi-dots-horizontal"></i></a>
                                                    <a href="#" class="mr-1 text-muted p-2"><i class="mdi mdi-grease-pencil"></i></a>
                                                    <a href="#" class="mr-1 text-muted p-2"><i class="mdi mdi-delete"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pl-0">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input">
                                                            <i class="input-helper"></i></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <img src="http://www.urbanui.com/hiliteui/template/images/orders/order-3.jpg" alt="image" class="img-rect mr-2">
                                                </td>
                                                <td>
                                                    <div class="text-muted font-weight-medium">6547-3DESC9835</div>
                                                </td>
                                                <td>Gucci all black</td>
                                                <td>18 Oct 2019</td>
                                                <td><label class="badge badge-danger">Cancelled</label></td>
                                                <td>
                                                    <a href="#" class="mr-1 text-muted p-2"><i class="mdi mdi-dots-horizontal"></i></a>
                                                    <a href="#" class="mr-1 text-muted p-2"><i class="mdi mdi-grease-pencil"></i></a>
                                                    <a href="#" class="mr-1 text-muted p-2"><i class="mdi mdi-delete"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pl-0">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input">
                                                            <i class="input-helper"></i></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <img src="http://www.urbanui.com/hiliteui/template/images/orders/order-4.jpg" alt="image" class="img-rect mr-2">
                                                </td>
                                                <td>
                                                    <div class="text-muted font-weight-medium">6547-3DESC9835</div>
                                                </td>
                                                <td>Vitality shot Mango</td>
                                                <td>16 Sep 2019</td>
                                                <td><label class="badge badge-success">Completed</label></td>
                                                <td>
                                                    <a href="#" class="mr-1 text-muted p-2"><i class="mdi mdi-dots-horizontal"></i></a>
                                                    <a href="#" class="mr-1 text-muted p-2"><i class="mdi mdi-grease-pencil"></i></a>
                                                    <a href="#" class="mr-1 text-muted p-2"><i class="mdi mdi-delete"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pl-0">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input">
                                                            <i class="input-helper"></i></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <img src="http://www.urbanui.com/hiliteui/template/images/orders/order-5.jpg" alt="image" class="img-rect mr-2">
                                                </td>
                                                <td>
                                                    <div class="text-muted font-weight-medium">6547-3DESC9835</div>
                                                </td>
                                                <td>Hero pro cam 7</td>
                                                <td>29 Sep 2019</td>
                                                <td><label class="badge badge-success">Completed</label></td>
                                                <td>
                                                    <a href="#" class="mr-1 text-muted p-2"><i class="mdi mdi-dots-horizontal"></i></a>
                                                    <a href="#" class="mr-1 text-muted p-2"><i class="mdi mdi-grease-pencil"></i></a>
                                                    <a href="#" class="mr-1 text-muted p-2"><i class="mdi mdi-delete"></i></a>
                                                </td>
                                            </tr>
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
