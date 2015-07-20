@extends(((Request::ajax()) ? 'panel::layouts.ajax' : 'panel::layouts.master'))

@section('head')
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset_version('assets/plugins/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset_version('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet" />
    <link href="{{ asset_version('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset_version('assets/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css') }}" rel="stylesheet"/>
    <!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection

@section('content')
    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        {!! Breadcrumbs::renderIfExists() !!}
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Form edit event</h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Informasi event</h4>
                    </div>
                    <div class="panel-body panel-form">
                        {!! Former::open()->route('panel.event.update', $event->getWrappedObject())->class('form-horizontal form-bordered')->data_pjax() !!}
                        <?php Former::populate( $event ); ?>
                        @include('event::panel.form')
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
        var handleDatepicker = function() {
            $('.datepicker-autoClose').datepicker({
                todayHighlight: true,
                autoclose: true
            });
        };

        var handleFormTimePicker = function () {
            "use strict";
            $('.timepicker').timepicker({
                showMeridian: false,
                showInputs: false,
                disableFocus: true
            });
        };

        $.getScript('{{ asset_version('assets/plugins/form/jquery.form.js') }}');
        $.getScript('{{ asset_version('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}', function() {
            handleDatepicker();
        });
        $.getScript('{{ asset_version('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}', function() {
            handleFormTimePicker();
        });
        $.getScript('{{ asset_version('assets/plugins/bootstrap-markdown/js/bootstrap-markdown.js') }}');
        $.getScript('{{ asset_version('assets/plugins/marked/marked.min.js') }}');
    </script>
    <!-- ================== END PAGE LEVEL JS ================== -->
@endsection
