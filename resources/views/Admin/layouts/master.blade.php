<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('app.name')}} | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('public')}}/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('public')}}/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('public')}}/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('public')}}/admin/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('public')}}/admin/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('public')}}/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('public')}}/admin/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="{{asset('public')}}/admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('public')}}/admin/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{asset('public')}}/assets/css/custom.css">
    @yield('style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{asset('public')}}/admin/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
@include('Admin.layouts.header')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
@include('Admin.layouts.sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('content')
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@include('Admin.layouts.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('public')}}/admin/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('public')}}/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('public')}}/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{asset('public')}}/admin/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{asset('public')}}/admin/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{asset('public')}}/admin/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{asset('public')}}/admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('public')}}/admin/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{asset('public')}}/admin/plugins/moment/moment.min.js"></script>
<script src="{{asset('public')}}/admin/plugins/daterangepicker/daterangepicker.js"></script>
<script src="{{asset('public')}}/admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('public')}}/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{asset('public')}}/admin/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{asset('public')}}/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('public')}}/admin/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('public')}}/admin/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('public')}}/admin/dist/js/pages/dashboard.js"></script>
@yield('script')
<script type="text/javascript">
    $(function(){
        // this will get the full URL at the address bar
        var url = window.location.href;

        // passes on every "a" tag
        $(".nav-sidebar a").each(function() {
            // checks if its the same on the address bar
            if(url == (this.href)) {
                $(this).closest("ul").closest("li").addClass("current-menu-main");
                $(this).closest("li").addClass("current-menu");
            }
        });
    });
</script>
<style type="text/css">
    li.current-menu-main > a, li.current-menu-main > ul > li.nav-item a{
        color:#fff !important;}
    li.current-menu-main > ul{
        display:block !important;}
</style>
<script>
    //close the alert after 3 seconds.
    $(document).ready(function(){
        setTimeout(function() {
            $(".alert").alert('close');
        }, 4000);
    });
</script>
</body>
</html>
