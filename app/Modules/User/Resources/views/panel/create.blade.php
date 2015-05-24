@extends(((Request::ajax()) ? 'panel::layouts.ajax' : 'panel::layouts.master'))

@section('head')
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset_version('assets/plugins/password-indicator/css/password-indicator.css') }}" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection

@section('content')
    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        {!! Breadcrumbs::renderIfExists() !!}
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Form tambah user HMIF</h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Informasi user</h4>
                    </div>
                    <div class="panel-body panel-form">
                        {!! Former::open()->route('panel.user.store', ['nim' => $anggota->nim->nim])->class('form-horizontal form-bordered')->data_pjax() !!}
                        <?php Former::populate( $anggota ); ?>
                        @include('user::panel.form')
                        {!! Former::close() !!}
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-12 -->
        </div>
        <!-- end row -->
    </div>
    <!-- end #content -->
@endsection

@section('javascript')
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script>
        var handleFormPasswordIndicator = function() {
            "use strict";
            $('#password-indicator-default').passwordStrength();
        };

        $.getScript('{{ asset_version('assets/plugins/password-indicator/js/password-indicator.js') }}', function() {
            handleFormPasswordIndicator();
        });
    </script>
    <!-- ================== END PAGE LEVEL JS ================== -->
@endsection
