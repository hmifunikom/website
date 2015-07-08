<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    {!! Head::render() !!}
    @include('partials.head')
    @yield('head')
    <meta name="_token" content="{{ csrf_token() }}" />
</head>
<body>
    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin #header -->
        @include('partials.header')
        <!-- end #header -->

        <div id="ajax-content">@yield('content')</div>

        <!-- begin #footer -->
        @include('partials.footer')
        <!-- end #footer -->
    </div>
    <!-- end #page-container -->

    @include('partials.javascript')

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