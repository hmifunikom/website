@extends(((Request::ajax()) ? 'panel::layouts.ajax' : 'panel::layouts.master'))

@section('head')
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset_link('css.datepicker') }}" rel="stylesheet"/>
    <link href="{{ asset_link('css.datepicker3') }}" rel="stylesheet"/>
    <link href="{{ asset_link('css.bootstrap-timepicker') }}" rel="stylesheet"/>
    <link href="{{ asset_link('css.bootstrap-markdown') }}" rel="stylesheet"/>
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

        $.getScript('{{ asset_link('js.jquery-form') }}');
        $.getScript('{{ asset_link('js.bootstrap-datepicker') }}', function () {
            handleDatepicker();
        });
        $.getScript('{{ asset_link('js.bootstrap-timepicker') }}', function () {
            handleFormTimePicker();
        });
        $.getScript('{{ asset_link('js.bootstrap-markdown') }}');
        $.getScript('{{ asset_link('js.marked') }}');
    </script>
    <!-- ================== END PAGE LEVEL JS ================== -->
@endsection
