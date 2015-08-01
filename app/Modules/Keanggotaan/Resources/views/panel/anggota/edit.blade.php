@extends(((Request::ajax()) ? 'panel::layouts.ajax' : 'panel::layouts.master'))

@section('head')
    <link href="{{ asset_link('css.datepicker') }}" rel="stylesheet"/>
    <link href="{{ asset_link('css.datepicker3') }}" rel="stylesheet"/>
@endsection

@section('content')
    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        {!! Breadcrumbs::renderIfExists() !!}
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Form edit anggota HMIF</h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Informasi anggota HMIF</h4>
                    </div>
                    <div class="panel-body panel-form">
                        {!! Former::open()->route('panel.keanggotaan.anggota.update', [$anggota->getWrappedObject()])->class('form-horizontal form-bordered')->data_pjax() !!}
                        <?php Former::populate( $anggota ); ?>
                        @include('keanggotaan::panel.anggota.form', ['viewedit' => true])
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
        var handleDatepicker = function () {
            $('.datepicker-autoClose').datepicker({
                autoclose: true
            });
        };

        $.getScript('{{ asset_link('js.bootstrap-datepicker') }}', function () {
            handleDatepicker();
        });
    </script>
    <!-- ================== END PAGE LEVEL JS ================== -->
@endsection