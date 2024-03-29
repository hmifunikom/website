@extends(((Request::ajax()) ? 'panel::layouts.ajax' : 'panel::layouts.master'))

@section('head')
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset_link('css.password-indicator') }}" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection

@section('content')
    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        {!! Breadcrumbs::renderIfExists() !!}
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Form edit user HMIF</h1>
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
                        {!! Former::open()->route('panel.user.update', [$user->getWrappedObject()])->class('form-horizontal form-bordered')->data_pjax() !!}
                        <?php Former::populate( $user ); $anggota = $user->userable; ?>
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

        $.getScript('{{ asset_link('js.password-indicator') }}', function() {
            handleFormPasswordIndicator();
        });
    </script>
    <!-- ================== END PAGE LEVEL JS ================== -->
@endsection