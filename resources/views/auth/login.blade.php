<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    {!! Head::render() !!}
    @include('panel::partials.head')
    <meta name="_token" content="{{ csrf_token() }}" />
</head>
<body class="pace-top bg-white">
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade in"><span class="spinner"></span></div>
    <!-- end #page-loader -->

    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin login -->
        <div class="login login-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed">
                <div class="news-image">
                    <img src="{{ asset_version('assets/images/login-bg.jpg') }}" data-id="login-cover-image" alt="" />
                </div>
            </div>
            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="right-content">
                <!-- begin login-header -->
                <div class="login-header">
                    <div class="brand">
                        <span class="brand-logo no-border">
                    <img src="{{ asset_version('assets/images/logo.png') }}" class="m-b-10" height="30px">
                </span> HMIF Unikom
                        <small>Halaman login</small>
                    </div>
                    <div class="icon">
                        <i class="fa fa-sign-in"></i>
                    </div>
                </div>
                <!-- end login-header -->
                <!-- begin login-content -->
                <div class="login-content">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" class="margin-bottom-0" action="{{ url('/auth/login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group m-b-15">
                            <input name="email" type="email" class="form-control input-lg" placeholder="Alamat Email" value="{{ old('email') }}" />
                        </div>
                        <div class="form-group m-b-15">
                            <input name="password" type="password" class="form-control input-lg" placeholder="Password" />
                        </div>
                        <div class="form-group m-b-15">
                            {!! Recaptcha::render() !!}
                        </div>
                        <div class="login-buttons">
                            <button type="submit" class="btn btn-success btn-block btn-lg">Masuk</button>
                        </div>
                        <hr />
                        <p class="text-center text-inverse">
                            &copy; 2015 Himpunan Mahasiswa Teknik Informatika Universitas Komputer Indonesia - All Right Reserved
                        </p>
                    </form>
                </div>
                <!-- end login-content -->
            </div>
            <!-- end right-container -->
        </div>
        <!-- end login -->
    </div>
    <!-- end page container -->

    @include('panel::partials.javascript')

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="{{ asset_version('assets/admin/js/apps.min.js') }}"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->

    <script>
        $(document).ready(function() {
            App.init();
            {!! show_notification() !!}
        });
    </script>
</body>
</html>
