<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AMALITECH - Schedule Master') }}</title>
    <!-- base:css -->
    <!-- endinject -->

    <link rel="stylesheet" href="{{asset('public/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/dragula.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/jquery.toast.min.css')}}">
{{--    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">--}}
    <link rel="stylesheet" href="{{asset('public/css/select.dataTables.min.css')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('public/css/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/select2.min.css')}}">


    <link rel="stylesheet" href="{{asset('public/css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/tempusdominus-bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/dataTables.bootstrap4.css')}}">
    <link rel="shortcut icon" href="{{asset('public/favicon.ico')}}" />
</head>
<body>


<div class="container-scroller">
    <!-- partial:partials/_horizontal-navbar.html -->
    @if(Auth::check())
        <div class="horizontal-menu">
            <nav class="navbar top-navbar col-lg-12 col-12 p-0">
                <div class="container">
                    <div class="text-left navbar-brand-wrapper d-flex align-items-center justify-content-between">
                        <a class="navbar-brand brand-logo" href="{{route('home')}}"><img  src="{{asset('public/logo-white.png')}}" alt="logo"/></a>
                        <a class="navbar-brand brand-logo-mini" href="{{route('home')}}"><img src="{{asset('public/sm.png')}}" alt="logo"/></a>
                        <span class="text-white">| SKYY POWER FM</span>
                    </div>
                    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                        <ul class="navbar-nav navbar-nav-right">
                            <li class="nav-item dropdown nav-settings d-none d-lg-flex">
                                <a  class="dropdown-toggle text-white text-decoration-none" href="#" data-toggle="dropdown" id="appDropdown">
                                    {{Auth::user()->name}}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="appDropdown">
                                    <a class="dropdown-item">
                                        <i class="mdi mdi-face-profile text-primary"></i>
                                        My Profile
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="mdi mdi-logout text-primary"></i>
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
                            <span class="mdi mdi-menu"></span>
                        </button>
                    </div>
                </div>
            </nav>
            <nav class="bottom-navbar">
                <div class="container">
                    <ul class="nav page-navigation">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('home')}}">
                                <i class="mdi mdi-shield-check menu-icon"></i>
                                <span class="menu-title">Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('commercials.index')}}">
                                <i class="mdi mdi-playlist-music menu-icon"></i>
                                <span class="menu-title">Commercial</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('orders.index')}}">
                                <i class="mdi mdi-book-open menu-icon"></i>
                                <span class="menu-title">Orders</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('adverts.index')}}">
                                <i class="mdi mdi-email menu-icon"></i>
                                <span class="menu-title">Adverts</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('agency.index')}}">
                                <i class="mdi mdi-home-account menu-icon"></i>
                                <span class="menu-title">Agencies</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('programs.index')}}">
                                <i class="mdi mdi-playlist-edit menu-icon"></i>
                                <span class="menu-title">Programs</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="mdi mdi-view-headline menu-icon"></i>
                                <span class="menu-title">TC's/Invoice</span>
                                <i class="menu-arrow"></i></a>
                            <div class="submenu">
                                <ul class="submenu-item">
                                    <li class="nav-item"><a class="nav-link" href="{{route('tc-s.index')}}">TC</a></li>
                                    <li class="nav-item"><a class="nav-link" href="pages/forms/advanced_elements.html">Invoice</a></li>
                               </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('users.index')}}">
                                <i class="mdi mdi-account-multiple menu-icon"></i>
                                <span class="menu-title">Users</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('preferences.index')}}">
                                <i class="mdi mdi-settings menu-icon"></i>
                                <span class="menu-title">System Config</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
@endif
<!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">

        @yield('content')
        <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            @if(Auth::check())
                <div class="footer-wrapper">
                    <footer class="footer">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-center text-sm-left d-block d-sm-inline-block">SCHEDULE MASTER &copy; {{date('Y')}}. All rights reserved. </span>
                            {{--                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Designed by: <a href="https://www.urbanui.com/" target="_blank">UrbanUI</a>. </span>--}}
                        </div>
                    </footer>
                </div>
        @endif
        <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->


<!-- container-scroller -->
<!-- base:js -->
<script src="{{asset('public/js/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- inject:js -->
{{-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> --}}
<script src="{{asset('public/js/off-canvas.js')}}"></script>
<script src="{{asset('public/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('public/js/template.js')}}"></script>
<script src="{{asset('public/js/settings.js')}}"></script>
<script src="{{asset('public/js/todolist.js')}}"></script>
<script src="{{asset('public/js/users.js')}}"></script>
<script src="{{asset('public/js/dashboard.js')}}"></script>
<!-- endinject -->
<script src="{{asset('public/js/jquery.toast.min.js')}}"></script>
<!-- End plugin js for this page -->
<!-- Custom js for this page-->
<script src="{{asset('public/js/toastDemo.js')}}"></script>
<script src="{{asset('public/js/moment.min.js')}}"></script>
<script src="{{asset('public/js/tempusdominus-bootstrap-4.js')}}"></script>
<script src="{{asset('public/js/bootstrap-datepicker.min.js')}}"></script>
<!-- plugin js for this page -->
<script src="{{asset('public/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/js/dataTables.bootstrap4.js')}}"></script>
<!-- End plugin js for this page -->
<!-- Custom js for this page-->
{{-- <script src="http://www.urbanui.com/hiliteui/template/js/data-table.js"></script> --}}
<script src="{{asset('public/js/dataTables.select.min.js')}}"></script>
<!-- Custom js for this page-->
<script src="{{asset('public/js/jquery.repeater.min.js')}}"></script>
<script src="{{asset('public/js/formpickers.js')}}"></script>
<script src="{{asset('public/js/form-repeater.js')}}"></script>
<script src="{{asset('public/js/toastr.min.js')}}"></script>
<script src="{{asset('public/js/select2.min.js')}}"></script>
<script src="{{asset('public/js/select2.js')}}"></script>
<script src="{{asset('public/js/jquery.inputmask.bundle.js')}}"></script>
<script src="{{asset('public/js/inputmask.binding.js')}}"></script>
@if(!\Request::is('orders') && !\Request::is('programs') && !\Request::is('all-programs'))
<script src="{{asset('public/js/mask.init.js')}}"></script>
@endif
<script src="{{asset('public/js/dragula.min.js')}}"></script>
<!-- End plugin js for this page -->
<!-- Custom js for this page-->
<script src="{{asset('public/js/jquery.print.js')}}"></script>
<script src="{{asset('public/js/dragula.js')}}"></script>
<script src="{{asset('public/js/custom.js')}}"></script>
<script src="{{asset('public/js/summernote-bs4.min.js')}}" referrerpolicy="origin"></script>
<script>
    if ($("#summernoteExample").length) {
        $('#summernoteExample').summernote({

            height: 300,
            tabsize: 2
        });

        $('#merge_field').change(function () {
            $("#summernoteExample").summernote('editor.saveRange');

            // Editor loses selected range (e.g after blur)

            $("#summernoteExample").summernote('editor.restoreRange');
            $("#summernoteExample").summernote('editor.focus');
            $("#summernoteExample").summernote('editor.insertText', $('#merge_field').val());

            $('#merge_field').val('').trigger("change")
        });


    }



    if ($("#subscription").length) {
        $('#subscription').summernote({

            height: 100,
            tabsize: 2
        });
    }

</script>
<!-- endinject -->
@toastr_render

<script>
    /*
   * Form Validation
    */
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();


    //Print function
    $('.print-tc').on('click', function() { // select print button with class "print," then on click run callback function
        // window.open();
       // $('.cont').append($('#d_name').text());
        $('.content-print').print();

    });
</script>

</body>
</html>

