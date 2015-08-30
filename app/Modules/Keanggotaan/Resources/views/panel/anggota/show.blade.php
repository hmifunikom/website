@extends(((Request::ajax()) ? 'panel::layouts.ajax' : 'panel::layouts.master'))

@section('head')
    <link href="{{ asset_link('css.jquery-fileupload') }}" rel="stylesheet"/>
@endsection

@section('content')
    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        {!! Breadcrumbs::renderIfExists() !!}
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Profil Anggota</h1>
        <!-- end page-header -->

        <!-- begin profile-container -->
        <div class="profile-container">
            <!-- begin profile-section -->
            <div class="profile-section">
                <!-- begin profile-left -->
                <div class="profile-left">
                    <!-- begin profile-image -->
                    <div class="profile-image">
                        <img id="avatar" src="{{ $anggota->avatar }}" />
                        <i class="fa fa-user hide"></i>
                    </div>
                    <!-- end profile-image -->
                    <div class="m-b-10">
                        @if(Authority::can('update', $anggota->getWrappedObject()))
                        <span class="btn btn-warning btn-block btn-sm fileinput-button">
                            <span>Ubah Foto Profil</span>
                            <input id="fileupload" type="file" name="avatarupload">
                        </span>
                        @endif
                    </div>
                    <div class="m-b-10">
                        @if(Authority::can('update', $anggota->getWrappedObject()))
                            {!! Button::primary('Edit Profil')->asLinkTo(route('panel.keanggotaan.anggota.edit', $anggota->getWrappedObject()))->withAttributes(['data-pjax'])->block()->small() !!}
                        @endif
                    </div>
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
                                        <h4>{{ $anggota->nama }}<small>{{ $anggota->divisi->singkatan }}</small></h4>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="field">NIM</td>
                                    <td>{{ $anggota->nim }}</td>
                                </tr>
                                <tr>
                                    <td class="field">Angkatan</td>
                                    <td>{{ $anggota->nim->angkatan }}</td>
                                </tr>

                                <tr class="divider">
                                    <td colspan="2"></td>
                                </tr>

                                <tr>
                                    <td class="field">Jabatan</td>
                                    <td>{{ $anggota->jabatan }}</td>
                                </tr>
                                <tr>
                                    <td class="field">Status</td>
                                    <td>{{ $anggota->status_hima }}</td>
                                </tr>

                                <tr class="divider">
                                    <td colspan="2"></td>
                                </tr>

                                <tr>
                                    <td class="field">Jenis Kelamin</td>
                                    <td>{{ $anggota->jenis_kelamin or 'Tidak diketahui' }}</td>
                                </tr>
                                <tr>
                                    <td class="field">Tempat, Tanggal Lahir</td>
                                    <td>{{ $anggota->tempat_lahir or '-' }} @ {{ $anggota->tanggal_lahir_full or '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="field">Agama</td>
                                    <td>{{ $anggota->agama or 'Tidak diketahui' }}</td>
                                </tr>
                                <tr>
                                    <td class="field">Alamat Saat Ini</td>
                                    <td>{{ $anggota->alamat or '-' }}</td>
                                </tr>

                                <tr class="divider">
                                    <td colspan="2"></td>
                                </tr>

                                <tr>
                                    <td class="field">Email</td>
                                    <td>{{ $anggota->email or '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="field">No Handphone</td>
                                    <td>{{ $anggota->no_hp or '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="field">{!! Icon::facebook() !!}</td>
                                    <td>
                                        @if($anggota->link_facebook)
                                            {!! $anggota->link_facebook(true) !!}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">{!! Icon::twitter() !!}</td>
                                    <td>
                                        @if($anggota->link_twitter)
                                            {!! $anggota->link_twitter(true) !!}
                                        @else
                                            -
                                        @endif
                                    </td>
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
        </div>
        <!-- end profile-container -->
    </div>
    <!-- end #content -->
@endsection

@section('javascript')
    <script>
        var handleJqueryFileUpload = function() {
            'use strict';

            // Change this to the location of your server-side upload handler:
            var url = '{{ route('panel.keanggotaan.avatar.store', $anggota->getWrappedObject()) }}';

            $('#fileupload').fileupload({
                url: url,
                dataType: 'json',
                maxFileSize: 1500000,
                acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
                xhrFields: {withCredentials: true},
                done: function (e, data) {
                    $('#avatar').attr('src', data.result.path).show();
                    handleNotification(data.result.msg.title, data.result.msg.text, data.result.msg.sticky);
                },
                fail: function (e, data) {
                    handleErrorNotification('Foto profil gagal diupload!')
                }
            }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
        };

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