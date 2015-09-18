@extends(((Request::ajax()) ? 'panel::layouts.ajax' : 'panel::layouts.master'))

@section('head')
    <!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
    <link href="{{ asset_link('css.bootstrap-markdown') }}" rel="stylesheet"/>
    <link href="{{ asset_link('css.jquery-fileupload') }}" rel="stylesheet"/>
    <link href="{{ asset_link('css.jquery-cropbox') }}" rel="stylesheet"/>
    <!-- ================== END PAGE LEVEL CSS STYLE ================== -->

    <style>
        .image-container {
            position: relative;
        }

        .image-container .image-photo {
            text-align: center;
            background-color: #ddd;
            padding: 20px;
            margin-bottom: 20px;
        }

        .image-container .image-photo img{
            max-width:100%;
        }
    </style>

@endsection

@section('content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        {!! Breadcrumbs::renderIfExists() !!}
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Setting</h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Main Background</h4>
                    </div>
                    <div class="panel-body panel-form">
                        <!-- begin profile-container -->
                        <div class="profile-container">
                            <div class="image-container">
                                <div class="image-photo"><img src="{{ asset_version('media/images/' . settings('hmif_main_background')) }}"></div>
                                <div class="row">
                                    <div class="col-md-3 m-t-10">
                                        <span class="cover-not-cropping btn btn-warning btn-block btn-sm fileinput-button">
                                            <span>Ubah Foto</span>
                                            <input id="hmif_main_background" class="fileupload" type="file" name="hmif_main_background">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end profile-container -->
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-12 -->
        </div>
        <!-- end row -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Visi & Misi HMIF</h4>
                    </div>
                    <div class="panel-body panel-form">
                        {!! Former::open()->route('panel.setting.update')->class('form-horizontal form-bordered')->data_pjax() !!}
                        <input type="hidden" name="fields" value="hmif_visi,hmif_misi">
                        {!! Former::textarea('hmif_visi')->value(settings('hmif_visi'))->label('Visi')->data_provide('markdown')->data_iconlibrary("fa")->data_resize('vertical') !!}
                        {!! Former::textarea('hmif_misi')->value(settings('hmif_misi'))->label('Misi')->data_provide('markdown')->data_iconlibrary("fa")->data_resize('vertical') !!}
                        {!! Former::actions( Button::primary('Simpan')->submit(), Button::withValue('Reset')->reset() ) !!}
                        {!! Former::close() !!}
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-12 -->
        </div>
        <!-- end row -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Background Visi & Misi HMIF</h4>
                    </div>
                    <div class="panel-body panel-form">
                        <!-- begin profile-container -->
                        <div class="profile-container">
                            <div class="image-container">
                                <div class="image-photo"><img src="{{ asset_version('media/images/' . settings('hmif_visimisi_background')) }}"></div>
                                <div class="row">
                                    <div class="col-md-3 m-t-10">
                                        <span class="cover-not-cropping btn btn-warning btn-block btn-sm fileinput-button">
                                            <span>Ubah Foto</span>
                                            <input id="hmif_visimisi_background" class="fileupload" type="file" name="hmif_visimisi_background">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end profile-container -->
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-12 -->
        </div>
        <!-- end row -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Tagline HMIF</h4>
                    </div>
                    <div class="panel-body panel-form">
                        {!! Former::open()->route('panel.setting.update')->class('form-horizontal form-bordered')->data_pjax() !!}
                        <input type="hidden" name="fields" value="hmif_leader_quote">
                        {!! Former::text('hmif_leader_quote')->value(settings('hmif_leader_quote'))->label('Quote leader') !!}
                        {!! Former::actions( Button::primary('Simpan')->submit(), Button::withValue('Reset')->reset() ) !!}
                        {!! Former::close() !!}
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-12 -->
        </div>
        <!-- end row -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Keanggotaan Background</h4>
                    </div>
                    <div class="panel-body panel-form">
                        <!-- begin profile-container -->
                        <div class="profile-container">
                            <div class="image-container">
                                <div class="image-photo"><img src="{{ asset_version('media/images/' . settings('hmif_keanggotaan_background')) }}"></div>
                                <div class="row">
                                    <div class="col-md-3 m-t-10">
                                        <span class="cover-not-cropping btn btn-warning btn-block btn-sm fileinput-button">
                                            <span>Ubah Foto</span>
                                            <input id="hmif_keanggotaan_background" class="fileupload" type="file" name="hmif_keanggotaan_background">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end profile-container -->
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-12 -->
        </div>
        <!-- end row -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Contact HMIF</h4>
                    </div>
                    <div class="panel-body panel-form">
                        {!! Former::open()->route('panel.setting.update')->class('form-horizontal form-bordered')->data_pjax() !!}
                        <input type="hidden" name="fields" value="hmif_contact">
                        {!! Former::textarea('hmif_contact')->value(settings('hmif_contact'))->label('Contact')->data_provide('markdown')->data_iconlibrary("fa")->data_resize('vertical') !!}
                        {!! Former::actions( Button::primary('Simpan')->submit(), Button::withValue('Reset')->reset() ) !!}
                        {!! Former::close() !!}
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-12 -->
        </div>
        <!-- end row -->
    </div>
@stop

@section('javascript')
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script>
        var handleJqueryFileUpload = function() {
            'use strict';

            var url = '{{ route('panel.setting.update.image') }}';

            $('.image-container').each(function() {
                var image = $(this).find('img');
                var input_tag = $(this).find('.fileupload');

                var name = input_tag.attr('id');

                $('#' + name).fileupload({
                    url: url,
                    dataType: 'json',
                    maxFileSize: 1500000,
                    acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
                    xhrFields: {withCredentials: true},
                    formData: {fields: name, image: true},

                    done: function (e, data) {
                        image.attr('src', data.result.path).show();
                        handleNotification(data.result.msg.title, data.result.msg.text, data.result.msg.sticky);
                    },
                    fail: function (e, data) {
                        handleErrorNotification('Foto gagal diupload!')
                    }
                }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
            });
        };

        $(document).ready(function() {
            $.getScript('{{ asset_link('js.bootstrap-markdown') }}');
            $.getScript('{{ asset_link('js.marked') }}');

            $.getScript('{{ asset_link('js.jquery-fileupload-tmpl') }}').done(function() {
                $.getScript('{{ asset_link('js.jquery-fileupload-iframe') }}').done(function () {
                    $.getScript('{{ asset_link('js.jquery-fileupload') }}').done(function () {
                        $.getScript('{{ asset_link('js.jquery-fileupload-process') }}').done(function () {
                            $.getScript('{{ asset_link('js.jquery-fileupload-validate') }}').done(function () {
                                if ($.browser.msie && parseFloat($.browser.version) >= 8 && parseFloat($.browser.version) < 10) {
                                    $.getScript('{{ asset_link('js.jquery-fileupload-xdr') }}').done(function () {
                                        handleJqueryFileUpload();
                                    });
                                } else {
                                    handleJqueryFileUpload();
                                }
                            });
                        });
                    });
                });
            });
        });
    </script>
    <!-- ================== END PAGE LEVEL JS ================== -->
@endsection