<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <link href="{{ asset_version('assets/css/style.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset_version('assets/css/theme/blue.css') }}" rel="stylesheet" id="theme"/>
    <link href="{{ asset_version('assets/css/ticket.css') }}" rel="stylesheet">
    <style>
        body {
            background: #fff;
        }
    </style>
</head>
<body class="no-bg">
    <div class="container">
        <div class="ticket">
            <table width="100%" cellpadding="10" cellspacing="0">
                <tr>
                    <td>
                        <br>
                        <table class="noborder">
                            <tr>
                                <td width="100px">
                                    <img src="{{ asset_version('assets/images/logo.png') }}"/>
                                </td>
                                <td>
                                    <div class="big-title">HMIF Unikom</div>
                                    <div>Jl. Dipatiukur No.112 R.4416 Bandung, 40132 Telp: 022 96072227
                                    </div>

                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="100px">
                        <img src="data:image/png;base64,{{ $entity->qr }}" width="100" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="big-title">{{ $entity->ticket->event->nama_acara }}</div>
                        <table class="noborder" width="100%">
                            <tr>
                                <td width="20%">
                                    <dt>Tempat</dt>
                                    <dd>{{ $entity->ticket->event->tempat }}</dd>
                                </td>
                                <td>
                                    <dt>Tanggal & Waktu</dt>
                                    <dd>{{ $entity->ticket->event->mulai_full }}</dd>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <dt>Kode Peserta</dt>
                                    <dd>{{ $entity->kode }}</dd>
                                </td>
                                <td width="30%">
                                    <dt>Nama Peserta</dt>
                                    <dd>{{ $entity->nama_peserta }}</dd>
                                </td>
                                <td>
                                    <dt>Kategori</dt>
                                    <dd>{{ $entity->ticket->nama_tiket }}</dd>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>