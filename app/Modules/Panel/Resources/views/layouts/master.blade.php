<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    @include('panel::partials.head')
    @yield('head')
</head>
<body class="flat-black">
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade in"><span class="spinner"></span></div>
    <!-- end #page-loader -->

    <!-- begin #page-container -->
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
        @include('panel::partials.header')

        @include('panel::partials.sidebar')

        <!-- begin #ajax-content -->
        <div id="ajax-content">@yield('content')</div>
        <!-- end #ajax-content -->

        <!-- begin #footer -->
        <div id="footer" class="footer">
            &copy; 2015 Himpunan Mahasiswa Teknik Informatika Universitas Komputer Indonesia - All Right Reserved
        </div>
        <!-- end #footer -->

        <!-- begin scroll to top btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
        <!-- end scroll to top btn -->
    </div>
    <!-- end page container -->

    @include('panel::partials.javascript')

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="{{ asset_version('assets/js/apps.min.js') }}"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->

    <script>
        $(document).ready(function() {
            App.init();
            {!! show_notification() !!}
        });
    </script>

    @yield('javascript')
</body>
</html>