@extends(((Request::ajax()) ? 'panel::layouts.ajax' : 'panel::layouts.master'))

@section('head')
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset_version('assets/plugins/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet"/>
    <link href="{{ asset_version('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet"/>
    <link href="{{ asset_version('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}"
          rel="stylesheet"/>
    <link href="{{ asset_version('assets/plugins/bootstrap-wizard/css/bwizard.min.css') }}" rel="stylesheet"/>
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
        <h1 class="page-header">Form tambah event</h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Wizard tambah event</h4>
                    </div>
                    <div class="panel-body">
                        <div id="wizard">
                            <ol>
                                <li>
                                    Informasi
                                    <small>Informasi mengenai event yang akan diadakan.</small>
                                </li>
                                <li>
                                    Tiket
                                    <small>Tiket yang disediadakan dalam event.
                                    </small>
                                </li>
                                <li>
                                    Selesai
                                    <small>Event dan tiket selesai dibuat.</small>
                                </li>
                            </ol>
                            <!-- begin wizard step-1 -->
                            <div class="wizard-step-1">
                                {!! Former::open()->route('panel.event.store')->class('form-horizontal')->data_pjax()->data_pjax_success('handleSuccessStep0') !!}
                                <fieldset>
                                    <legend class="pull-left width-full">Informasi</legend>
                                    <!-- begin row -->
                                    <div class="row">
                                        <!-- begin col-4 -->
                                        <div class="col-md-12">
                                            @include('event::panel.form')
                                        </div>
                                        <!-- end col-4 -->
                                    </div>
                                    <!-- end row -->
                                </fieldset>
                                {!! Former::close() !!}
                            </div>
                            <!-- end wizard step-1 -->
                            <!-- begin wizard step-2 -->
                            <div class="wizard-step-2">
                                {!! Former::open()->route('panel.event.store')->class('form-horizontal')->data_pjax()->data_pjax_success('handleSuccessStep1')->id('form-ticket') !!}
                                <fieldset>
                                    <legend class="pull-left width-full">Tiket</legend>
                                    <!-- begin row -->
                                    <div class="row">
                                        <!-- begin col-12 -->
                                        <div class="col-md-12">
                                            @include('event::panel.ticket.form')
                                            <span>*Tiket tambahan bisa dibuat ketika wizard ini selesai.</span>
                                        </div>
                                        <!-- end col-12 -->
                                    </div>
                                    <!-- end row -->
                                </fieldset>
                                {!! Former::close() !!}
                            </div>
                            <!-- end wizard step-2 -->
                            <!-- begin wizard step-3 -->
                            <div class="wizard-step-3">
                                <div class="jumbotron m-b-0 text-center">
                                    <h1>Sukses</h1>

                                    <p>Event beserta tiketnya sukses telah disimpan. <br>Silahkan lihat halaman event yang telah dibuat atau tambahkan poster dan tiket tambahan lainnya.</p>

                                    <p>
                                        {!! Button::success('Buka Halaman Event')->withAttributes(['id' => 'link-event', 'target' => '_blank'])->asLinkTo('#')->large()->addClass(['m-r-10']) !!}
                                        {!! Button::primary('Tambah Poster & Tiket')->withAttributes(['id' => 'link-add-more', 'data-pjax'])->asLinkTo('#')->large() !!}
                                    </p>
                                </div>
                            </div>
                            <!-- end wizard step-3 -->
                        </div>
                        <div class="clearfix"></div>
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

        var wizard_step = [];
        var handleBootstrapWizardsValidation = function () {
            "use strict";
            $("#wizard").bwizard({
                backBtnText: '',
                nextBtnText: '',

                validating: function (e, ui) {
                    console.log(e, ui);
                    if (ui.nextIndex == 0) {
                        return false;
                    } else if (ui.nextIndex == 1) {
                        if(wizard_step[0]) return true;

                        return false;

                    } else if (ui.nextIndex == 2) {
                        if(wizard_step[1]) return true;

                        return false;
                    }
                }
            });

            $('#wizard .well').addClass('m-b-0');
        };

        var handleSuccessStep0 = function(data, status, xhr) {
            wizard_step[0] = true;

            $('#form-ticket').attr('action', data.nextaction);

            $('#wizard').bwizard('next');
        };

        var handleSuccessStep1 = function(data, status, xhr) {
            wizard_step[1] = true;

            $('#link-event').attr('href', data.linkevent);
            $('#link-add-more').attr('href', data.linkaddmore);

            $('#wizard').bwizard('next');
        };

        $.getScript('{{ asset_version('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}', function () {
            handleDatepicker();
        });
        $.getScript('{{ asset_version('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}', function () {
            handleFormTimePicker();
        });
        $.getScript('{{ asset_version('assets/plugins/bootstrap-wizard/js/bwizard.js') }}').done(function () {
            handleBootstrapWizardsValidation();
        });
        $.getScript('{{ asset_version('assets/plugins/bootstrap-markdown/js/bootstrap-markdown.js') }}');
        $.getScript('{{ asset_version('assets/plugins/marked/marked.min.js') }}');
    </script>
    <!-- ================== END PAGE LEVEL JS ================== -->
@endsection
