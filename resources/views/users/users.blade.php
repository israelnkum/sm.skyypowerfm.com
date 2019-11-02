@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-2">
                    <h3>Users</h3>
                </div>
                <div class="col-md-6">
                    <form class="needs-validation" novalidate action="{{route('search-users')}}" method="get">
                        @csrf
                        <div class="form-group row mb-1">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="text" name="search" required class="form-control p-2" id="" placeholder="Search by Email | Username | Name | Phone">
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
                    @if(!empty($users))
                        <a href="{{route('all-users')}}">All Users</a>
                    @endif
                    <button class="btn btn-primary  waves-effect waves-light"  data-toggle="modal" data-target=".bs-example-modal-sm" type="button" >
                        <i class="ti-user mr-1"></i> New User
                    </button>
                </div>
            </div>
            <div class="page-header-tab mb-1"></div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box ">
                        <div class="row ">
                            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form method="POST" action="{{ route('users.store') }}" novalidate class="needs-validation">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title mt-0" id="mySmallModalLabel">New User</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label for="name" >{{ __('Name') }}</label>
                                                        <input id="name" type="text" class="p-2 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="name" >{{ __('Phone Number') }}</label>
                                                        <input type="text" required class="form-control p-2  @error('name') is-invalid @enderror phone_number" autofocus autocomplete="phone_number" value="{{ old('name') }}" name="phone_number" id="phone_number">
                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label for="email">{{ __('Email Address') }}</label>
                                                        <input id="email" type="email" class="p-2 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="username">{{ __('Username') }}</label>
                                                        <input id="username" type="text" class="p-2 form-control @error('username') is-invalid @enderror" name="username" required autocomplete="username">
                                                        @error('username')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="radio_stations_id">{{ __('Radio Station') }}</label>
                                                        <select class="form-control p-2" required name="radio_station_id" id="radio_stations_id">
                                                            <option value="">~Select Radio Station~</option>
                                                            @foreach($radio_stations as $radio_station)
                                                                <option value="{{$radio_station->id}}">{{$radio_station->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('username')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="role">{{ __('Role') }}</label>
                                                        <select class="form-control p-2" name="role" required id="role">
                                                            <option value="">Select Role</option>
                                                            <option value="Admin">Admin</option>
                                                            <option value="User">User</option>
                                                        </select>
                                                        @error('username')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    {{--<div class="col-md-6">
                                                        <label for="password">{{ __('Password') }}</label>
                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>--}}
                                                </div>

                                                {{--<div class="form-group row">
                                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                                    <div class="col-md-6">
                                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                    </div>
                                                </div>--}}

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Add User</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </form>
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                            @if(empty($users))
                                <div class="col-md-12 text-center">
                                    <a href="{{route('all-users')}}">All Users</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($users))
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                {{--<form action="">
                                    <div class="form-group row">
                                        <div class="col-md-3 offset-md-9">
                                            <select class="form-control filter-items" name="" id="">
                                                <option value="">Filter</option>
                                                @foreach($radio_stations as $station)
                                                    <option value="{{$station->id}}">{{$station->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </form>--}}
                                <form action="{{route('delete-users')}}" onsubmit="return confirm('Please Confirm Delete')">
                                    @csrf
                                    <input type="hidden" name="selected_ids" id="user_ids" class="form-control p-2">

                                    <div class="d-flex flex-wrap justify-content-between">
                                        <h4 class="card-title">All Users</h4>
                                        <div class="dropdown dropleft card-menu-dropdown">
                                            <button class="btn btn-link text-danger" type="submit" id="btn-delete-users" disabled> Delete</button>

                                            <button class="btn p-0" type="button" id="dropdown12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical card-menu-btn"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown12" x-placement="left-start">
                                                <a class="dropdown-item" href="{{route('export-users')}}">Export</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="users-table" class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>
                                                </th>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Radio ID</th>
                                                <th>Radio Station</th>
                                                <th>Role</th>
                                                <th>Edit</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php($i =1)
                                            @foreach($users as $user)
                                                @if($user->username != 'israel.nkum')
                                                    <tr>
                                                        <td>

                                                        </td>
                                                        <td>{{$user->id}}</td>
                                                        <td>{{$user->name}}</td>
                                                        <td>{{$user->username}}</td>
                                                        <td>{{$user->email}}</td>
                                                        <td>{{$user->phone_number}}</td>
                                                        <td>{{$user->radio_station->id}}</td>
                                                        <td>{{$user->radio_station->name}}</td>
                                                        <td>{{$user->role}}</td>
                                                        <td>
                                                            <a href="javascript:void(0)" class="btn btn-edit-user"> <i class="mdi mdi-pencil"></i> </a>
                                                        </td>
                                                    </tr>
                                                @endif
                                                @php($i++)
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade edit-user-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="users" id="edit-u-form" novalidate class="needs-validation">
                @csrf
                {!! method_field('put') !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="edit-user-title">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="name" >{{ __('Name') }}</label>
                                <input id="edit-u-name" type="text" class="p-2 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="name" >{{ __('Phone Number') }}</label>
                                <input type="text" required class="form-control p-2  @error('name') is-invalid @enderror phone_number" autofocus autocomplete="phone_number" value="{{ old('name') }}" name="phone_number" id="edit-u-phone">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="email">{{ __('Email Address') }}</label>
                                <input id="edit-u-email" type="email" class="p-2 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                @enderror
                            </div>
                            {{--<div class="col-md-6">
                                <label for="username">{{ __('Username') }}</label>
                                <input id="edit-u-username" type="text" class="p-2 form-control @error('username') is-invalid @enderror" name="username" required autocomplete="username">
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>--}}
                            <div class="col-md-6">
                                <label for="radio_stations_id">{{ __('Radio Station') }}</label>
                                <select class="form-control p-2" required name="radio_station_id" id="edit-u-radio-stations_id">
                                    <option value="">Select Radio Station</option>
                                    @foreach($radio_stations as $radio_station)
                                        <option value="{{$radio_station->id}}">{{$radio_station->name}}</option>
                                    @endforeach
                                </select>
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="role">{{ __('Role') }}</label>
                                <select class="form-control p-2" name="role" required id="edit-u-role">
                                    <option value="">Select Role</option>
                                    <option value="Admin">Admin</option>
                                    <option value="User">User</option>
                                </select>
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{--<div class="col-md-6">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>--}}
                        </div>

                        {{--<div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>--}}

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update User</button>
                    </div>
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
