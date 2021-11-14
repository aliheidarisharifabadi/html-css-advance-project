<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}">
    <title>داشبورد{{ isset($title) ? ' | ' . $title : '' }}</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('assets/plugins/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/bootstrap-extension/css/bootstrap-extension.css')}}" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="{{asset('assets/plugins/sidebar-nav/dist/sidebar-nav.min.css')}}" rel="stylesheet">
    <!-- morris CSS -->
    <link href="{{asset('assets/plugins/morrisjs/morris.css')}}" rel="stylesheet">
    <!-- animation CSS -->
    <link href="{{asset('assets/plugins/animate/animate.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <!-- color CSS -->
    <link href="{{asset('assets/css/colors/default.css')}}" id="theme" rel="stylesheet">
    <!-- Icons -->
    <link href="{{asset('assets/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/linea-icons/css/linea-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/material-design-iconic-font/css/material-design-iconic-font.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/weather-icons/css/weather-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/themify-icons/css/themify-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/simple-line-icons/css/simple-line-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
    @yield('styles')
</head>

<body class="fix-header fix-sidebar">
<!-- Preloader -->
<div class="preloader">
    <svg class="circular" viewbox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
    </svg>
</div>
<div id="wrapper">

    <!-- Navigation -->
    @include('admin.include.nav')

    <!-- Left navbar-header -->
    @include('admin.include.side')

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row bg-title">
                <div class="col-lg-4 col-md-4 col-12">
                    <h4 class="page-title">{{isset($subTitle)?$subTitle:''}}</h4>
                </div>
            </div>

            @yield('content')

            <!-- .right-sidebar -->
            @include('admin.include.setting')
            <!-- /.right-sidebar -->

        </div>

        <!-- Footer -->
        @include('admin.include.footer')

    </div>

</div>
<!-- /#wrapper -->
<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{asset('assets/plugins/bootstrap/dist/js/tether.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-extension/js/bootstrap-extension.min.js')}}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{{asset('assets/plugins/sidebar-nav/dist/sidebar-nav.min.js')}}"></script>
<!--slimscroll JavaScript -->
<script src="{{asset('assets/plugins/jquery.slimscroll/jquery.slimscroll.min.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset('assets/plugins/waves/waves.min.js')}}"></script>
<!--weather icon -->
<script src="{{asset('assets/plugins/skycons/skycons.js')}}"></script>
<!--Counter js -->
<script src="{{asset('assets/plugins/waypoints/lib/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/plugins/counterup/jquery.counterup.min.js')}}"></script>
<!--Morris JavaScript -->
<script src="{{asset('assets/plugins/raphael/raphael-min.js')}}"></script>
<script src="{{asset('assets/plugins/morrisjs/morris.min.js')}}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{asset('assets/js/custom.js')}}"></script>
<!--Extra Script -->
@yield('scripts')
<!--Sweetalert -->
<script src="{{asset('assets/plugins/sweetalert/sweetalert.min.js')}}"></script>
<!-- Include this after the sweet alert js file -->
@include('sweet::alert')
<!--Style Switcher -->
<script src="{{asset('assets/js/style-switcher.js')}}"></script>

</body>

</html>
