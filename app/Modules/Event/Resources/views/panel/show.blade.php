@extends(((Request::ajax()) ? 'panel::layouts.ajax' : 'panel::layouts.master'))

@section('head')
    <link href="{{ asset_version('assets/plugins/jquery-file-upload/css/jquery.fileupload.css') }}" rel="stylesheet"/>

@endsection

@section('content')
    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        {!! Breadcrumbs::renderIfExists() !!}
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">{{ $event->nama_acara }}</h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                @include('event::panel.tabs')
                <div class="tab-content no-bg p-0">
                    <div class="tab-pane fade active in" id="nav-pills-tab-1">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="panel panel-inverse">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Poster event</h4>
                                    </div>
                                    <div class="panel-toolbar">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                @if($event->poster)
                                                    {!! Former::inline_open()->route('panel.event.poster.destroy', $event->getWrappedObject())->id('poster-delete')->data_pjax()->data_confirm('Hapus poster event?')->data_pjax_success('handlePosterRemove') !!}
                                                @else
                                                    {!! Former::inline_open()->route('panel.event.poster.destroy', $event->getWrappedObject())->id('poster-delete')->addClass('collapse')->data_pjax()->data_confirm('Hapus poster event?')->data_pjax_success('handlePosterRemove') !!}
                                                @endif

                                                {!! Button::danger(Icon::trashO() . ' Hapus poster')->small()->submit() !!}
                                                {!! Former::close() !!}
                                            </div>
                                            <div class="col-xs-6 text-right">
                                                <span class="btn btn-sm btn-success fileinput-button">
                                                    {!! Icon::upload() !!}
                                                    <span>Unggah poster</span>
                                                    <input id="fileupload" type="file" name="posterupload">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="img-container">
                                            @if($event->poster)
                                                <img src="{{ asset_version('media/images/'.$event->poster) }}" alt="{{ $event->nama_acara }} Poster" class="img-thumbnail" id="poster">
                                                <span id="no-poster" class="collapse">Belum ada poster.</span>
                                            @else
                                                <img src="" alt="{{ $event->nama_acara }} Poster" class="img-thumbnail collapse" id="poster">
                                                <span id="no-poster">Belum ada poster.</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="panel panel-inverse">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Informasi event</h4>
                                    </div>
                                    <div class="panel-toolbar text-right">
                                        {!! Button::primary(Icon::pencil() . ' Edit informasi event')->small()->asLinkTo(route('panel.event.edit', $event->getWrappedObject()))->withAttributes(['data-pjax']) !!}
                                    </div>
                                    <div class="panel-body">
                                        <dl class="dl-horizontal">
                                            <dt>Nama acara</dt>
                                            <dd>{{ $event->nama_acara }}</dd>
                                            <dt>Waktu acara</dt>
                                            <dd>{{ $event->mulai_full }}</dd>
                                            <dt>Tempat</dt>
                                            <dd>{{ $event->tempat }}</dd>
                                            <dt>Info</dt>
                                            <dd>{{ parsedown($event->info, true) }}</dd>
                                            <dt>Program kerja</dt>
                                            <dd>{{ $event->pj }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-pills-tab-2">
                        <h3 class="m-t-10">Nav Pills Tab 2</h3>

                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Integer ac dui eu felis hendrerit lobortis. Phasellus elementum, nibh eget adipiscing
                            porttitor,
                            est diam sagittis orci, a ornare nisi quam elementum tortor.
                            Proin interdum ante porta est convallis dapibus dictum in nibh.
                            Aenean quis massa congue metus mollis fermentum eget et tellus.
                            Aenean tincidunt, mauris ut dignissim lacinia, nisi urna consectetur sapien,
                            nec eleifend orci eros id lectus.
                        </p>
                    </div>
                    <div class="tab-pane fade" id="nav-pills-tab-3">
                        <h3 class="m-t-10">Nav Pills Tab 3</h3>

                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Integer ac dui eu felis hendrerit lobortis. Phasellus elementum, nibh eget adipiscing
                            porttitor,
                            est diam sagittis orci, a ornare nisi quam elementum tortor.
                            Proin interdum ante porta est convallis dapibus dictum in nibh.
                            Aenean quis massa congue metus mollis fermentum eget et tellus.
                            Aenean tincidunt, mauris ut dignissim lacinia, nisi urna consectetur sapien,
                            nec eleifend orci eros id lectus.
                        </p>
                    </div>
                    <div class="tab-pane fade" id="nav-pills-tab-4">
                        <h3 class="m-t-10">Nav Pills Tab 4</h3>

                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Integer ac dui eu felis hendrerit lobortis. Phasellus elementum, nibh eget adipiscing
                            porttitor,
                            est diam sagittis orci, a ornare nisi quam elementum tortor.
                            Proin interdum ante porta est convallis dapibus dictum in nibh.
                            Aenean quis massa congue metus mollis fermentum eget et tellus.
                            Aenean tincidunt, mauris ut dignissim lacinia, nisi urna consectetur sapien,
                            nec eleifend orci eros id lectus.
                        </p>
                    </div>
                </div>
            </div>
            <!-- end col-12 -->
        </div>
        <!-- end row -->
    </div>
    <!-- end #content -->
@endsection

@section('javascript')
    <script>
        var handleJqueryFileUpload = function() {
            'use strict';

            // Change this to the location of your server-side upload handler:
            var url = '{{ route('panel.event.poster.store', $event->getWrappedObject()) }}';

            $('#fileupload').fileupload({
                url: url,
                dataType: 'json',
                maxFileSize: 1500000,
                acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
                xhrFields: {withCredentials: true},
                done: function (e, data) {
//                    $.each(data.result.files, function (index, file) {
//                        $('<p/>').text(file.name).appendTo('#files');
//                    });
                    //handleNotification('Sukses!', 'Poster sukses disimpan!')
                    $('#poster').attr('src', data.result.path).show();
                    $('#no-poster').hide();
                    $('#poster-delete').show();
                    handleNotification(data.result.msg.title, data.result.msg.text, data.result.msg.sticky);
                },
                fail: function (e, data) {
                    handleErrorNotification('Poster gagal diupload!')
                },
                progressall: function (e, data) {
//                    var progress = parseInt(data.loaded / data.total * 100, 10);
//                    $('#progress .progress-bar').css(
//                            'width',
//                            progress + '%'
//                    );
                }
            }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

            // Initialize the jQuery File Upload widget:
//            $('#fileupload').fileupload({
//                autoUpload: false,
//                disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
//                maxFileSize: 5000000,
//                acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
//                // Uncomment the following to send cross-domain cookies:
//                //xhrFields: {withCredentials: true},
//            });

            // Enable iframe cross-domain access via redirect option:
//            $('#fileupload').fileupload(
//                    'option',
//                    'redirect',
//                    window.location.href.replace(
//                            /\/[^\/]*$/,
//                            '/cors/result.html?%s'
//                    )
//            );

//            // Upload server status check for browsers with CORS support:
//            if ($.support.cors) {
//                $.ajax({
//                    type: 'HEAD'
//                }).fail(function () {
//                    $('<div class="alert alert-danger"/>').text('Upload server currently unavailable - ' + new Date()).appendTo('#fileupload');
//                });
//            }

            // Load & display existing files:
            //$('#fileupload').addClass('fileupload-processing');
//            $.ajax({
//                // Uncomment the following to send cross-domain cookies:
//                xhrFields: {withCredentials: true},
//                url: $('#fileupload').fileupload('option', 'url'),
//                dataType: 'json',
//                context: $('#fileupload')[0]
//            }).always(function () {
//                $(this).removeClass('fileupload-processing');
//            }).done(function (result) {
//                $(this).fileupload('option', 'done')
//                        .call(this, $.Event('done'), {result: result});
//            });
        };

        var handlePosterRemove = function(data, status, xhr) {
            $('#poster').hide();
            $('#no-poster').show();
            $('#poster-delete').hide();
            handleNotification(data.msg.title, data.msg.text, data.msg.sticky);
        }

        $.getScript('{{ asset_version('assets/plugins/jquery-file-upload/js/vendor/tmpl.min.js') }}').done(function() {
            $.getScript('{{ asset_version('assets/plugins/jquery-file-upload/js/jquery.iframe-transport.js') }}').done(function() {
                $.getScript('{{ asset_version('assets/plugins/jquery-file-upload/js/jquery.fileupload.js') }}').done(function() {
                    $.getScript('{{ asset_version('assets/plugins/jquery-file-upload/js/jquery.fileupload-process.js') }}').done(function () {
                        $.getScript('{{ asset_version('assets/plugins/jquery-file-upload/js/jquery.fileupload-validate.js') }}').done(function () {
                            if ($.browser.msie && parseFloat($.browser.version) >= 8 && parseFloat($.browser.version) < 10) {
                                $.getScript('{{ asset_version('assets/plugins/jquery-file-upload/js/cors/jquery.xdr-transport.js') }}').done(function () {
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
    </script>
@endsection