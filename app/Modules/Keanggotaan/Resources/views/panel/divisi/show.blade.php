@extends(((Request::ajax()) ? 'panel::layouts.ajax' : 'panel::layouts.master'))

@section('head')
    <link href="{{ asset_link('css.jquery-fileupload') }}" rel="stylesheet"/>
    <link href="{{ asset_link('css.jquery-cropbox') }}" rel="stylesheet"/>

    <style>
        .profile-cover-container {
            position: relative;
        }

        .profile-cover-container .profile-cover-photo {
            text-align: center;
            background-color: #ddd;
            padding: 20px;
            height: 290px;
            margin-bottom: 20px;
        }

        .profile-cover-container .profile-cover-crop {
            text-align: center;
            background-color: #ccc;
            padding: 20px;
            position: absolute;
            top:0;
            left:0;
            z-index: 2;
            width:100%;
            height: 310px;
        }

        .profile-cover-container .profile-cover-photo img{
            max-width:100%;
        }

        .profile-cover-container .profile-cover-position {
            width: 550px;
            margin: auto;
        }
    </style>
@endsection

    @section('content')
            <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        {!! Breadcrumbs::renderIfExists() !!}
                <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Profil Penanggung Jawab</h1>
        <!-- end page-header -->

        <!-- begin profile-container -->
        <div class="profile-container">
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6 text-right">
                    {!! Button::withValue(Icon::listAlt() . ' Lihat Profil Lengkap')->asLinkTo(route('panel.keanggotaan.anggota.show', $divisi->penanggung_jawab->nim))->withAttributes(['data-pjax']) !!}
                    @if(Authority::can('manage', $divisi->getWrappedObject()))
                    {!! Button::primary(Icon::refresh() . ' Ganti Penanggung Jawab')->asLinkTo(route('panel.keanggotaan.divisi.edit', $divisi->getWrappedObject()))->withAttributes(['data-pjax']) !!}
                    @endif
                </div>
            </div>
            <!-- begin profile-section -->
            <div class="profile-section">
                <!-- begin profile-left -->
                <div class="profile-left">
                    <!-- begin profile-image -->
                    <div class="profile-image">
                        <img id="avatar" src="{{ $divisi->penanggung_jawab->avatar }}" />
                        <i class="fa fa-user hide"></i>
                    </div>
                    <!-- end profile-image -->
                </div>
                <!-- end profile-left -->
                <!-- begin profile-right -->
                <div class="profile-right">
                    <!-- begin profile-info -->
                    <div class="profile-info">
                        <!-- begin table -->
                        <div class="table-responsive">
                            <table class="table table-profile">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>
                                        <h4>{{ $divisi->penanggung_jawab->nama }}<small>{{ $divisi->singkatan }}</small></h4>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="field">NIM</td>
                                    <td>{{ $divisi->penanggung_jawab->nim }}</td>
                                </tr>
                                <tr>
                                    <td class="field">Angkatan</td>
                                    <td>{{ $divisi->penanggung_jawab->nim->angkatan }}</td>
                                </tr>

                                <tr class="divider">
                                    <td colspan="2"></td>
                                </tr>

                                <tr>
                                    <td class="field">Jabatan</td>
                                    <td>{{ $divisi->penanggung_jawab->jabatan }}</td>
                                </tr>
                                <tr>
                                    <td class="field">Status</td>
                                    <td>{{ $divisi->penanggung_jawab->status_hima }}</td>
                                </tr>

                                <tr class="divider">
                                    <td colspan="2"></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <!-- end table -->
                    </div>
                    <!-- end profile-info -->
                </div>
                <!-- end profile-right -->
            </div>
            <!-- end profile-section -->
            @if(Authority::can('coverStore', $divisi->getWrappedObject()))
            <div class="profile-cover-container">
                <div class="profile-cover-photo"><img src="{{ asset_version('media/images/'.$divisi->cover) }}" width="550" height="250"></div>
                <div class="cover-cropping profile-cover-crop collapse">
                    <img src="">
                    <div class="row profile-cover-position">
                        <div class="col-xs-4"><label><input type="radio" name="position" value="left" checked> Left</label></div>
                        <div class="col-xs-4"><label><input type="radio" name="position" value="center"> Center</label></div>
                        <div class="col-xs-4"><label><input type="radio" name="position" value="right"> Right</label></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 m-t-10">
                        <span class="cover-not-cropping btn btn-warning btn-block btn-sm fileinput-button">
                            <span>Ubah Foto Cover</span>
                            <input id="fileuploadcrop" type="file" name="coverupload">
                        </span>
                    </div>
                    <div class="cover-cropping col-md-3 m-t-10 collapse">
                        <a id="cover-crop-batal" class="btn btn-default btn-block btn-sm ">
                            <span>Batal</span>
                        </a>
                    </div>
                    <div class="cover-cropping col-md-3 m-t-10 collapse">
                        <a id="cover-crop-simpan" class="btn btn-primary btn-block btn-sm ">
                            <span>Simpan</span>
                        </a>
                        <input id="fileupload" type="file" name="coverupload" style="display: none;">
                    </div>
                </div>
            </div>
            @endif
        </div>
        <!-- end profile-container -->
    </div>
    <!-- end #content -->
@endsection

@section('javascript')
    <script>
        var handleCropBox = function() {
            var croptarget = $('.profile-cover-container .profile-cover-crop img');

            $('#fileuploadcrop').on('change', function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        croptarget.attr('src', e.target.result);
                        croptarget.cropbox( {width: 550, height: 250, showControls: 'auto' } );
                    }

                    reader.readAsDataURL(this.files[0]);
                }

                showCropWorkspace();
                $(this).val('');
            });

            $('#cover-crop-batal').on('click', function() {
                hideCropWorkspace();
            });

            $('#cover-crop-simpan').on('click', function() {
                var cropboxdata = croptarget.data('cropbox');
                var canvas = document.createElement('canvas'), ctx = canvas.getContext('2d');
                canvas.width = 550;
                canvas.height = 250;
                ctx.drawImage(croptarget.get(0), cropboxdata.result.cropX, cropboxdata.result.cropY, cropboxdata.result.cropW, cropboxdata.result.cropH, 0, 0, cropboxdata.options.width, cropboxdata.options.height);

                var datablob = null;
                canvas.toBlob(function(blob) {datablob = blob}, 'image/jpeg', 1);

                sendFile(datablob);
            });
        };

        var showCropWorkspace = function() {
            $('.cover-cropping').show();
            $('.cover-not-cropping').hide();
        };

        var hideCropWorkspace = function() {
            $('.cover-cropping').hide();
            $('.cover-not-cropping').show();

            $('.profile-cover-container .profile-cover-crop img').data('cropbox').remove();
            $('.profile-cover-container .profile-cover-crop img').attr('src', '');

            $('input[name=position]:checked').removeAttr('checked');
            $('input[name=position][value=left]').attr('checked', 'checked');
        };

        var handleJqueryFileUpload = function() {
            'use strict';

            // Change this to the location of your server-side upload handler:
            var url = '{{ route('panel.keanggotaan.cover.store', $divisi->getWrappedObject()) }}';

            $('#fileupload').fileupload({
                url: url,
                dataType: 'json',
                maxFileSize: 1500000,
                acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
                xhrFields: {withCredentials: true},
                done: function (e, data) {
                    $('.profile-cover-container .profile-cover-photo img').off('load').on('load', function() {
                        handleNotification(data.result.msg.title, data.result.msg.text, data.result.msg.sticky);
                        hideCropWorkspace();
                    }).attr('src', data.result.path);
                },
                fail: function (e, data) {
                    $('.profile-cover-container .profile-cover-crop img').cropbox( {width: 550, height: 250, showControls: 'auto' } );
                    handleErrorNotification('Foto profil gagal diupload!');
                }
            }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
        };

        var sendFile = function(datablob) {
            $('#fileupload').fileupload('send', {
                files: datablob,
                formData: {position: $('input[name=position]:checked').val()}
            });
        };

        $.getScript('{{ asset_link('js.hammer') }}').done(function() {
            $.getScript('{{ asset_link('js.jquery-mousewheel') }}').done(function() {
                $.getScript('{{ asset_link('js.jquery-cropbox') }}').done(function() {
                    $.getScript('{{ asset_link('js.canvas-to-blob') }}').done(function() {
                        handleCropBox();
                    });
                });
            });
        });

        $.getScript('{{ asset_link('js.jquery-fileupload-tmpl') }}').done(function() {
            $.getScript('{{ asset_link('js.jquery-fileupload-iframe') }}').done(function() {
                $.getScript('{{ asset_link('js.jquery-fileupload') }}').done(function() {
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
    </script>
@endsection