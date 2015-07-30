<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <style>
        {{ asset_include('assets/admin/css/style.min.css') }}
        {{ asset_include('assets/admin/css/theme/blue.css') }}
        {{ asset_include('assets/admin/css/ticket.css') }}

        body {
            background: #fff;
            font-size:18px;
        }
    </style>
</head>
<body class="no-bg">
    <div class="container">
        <div class="ticket">
            <table width="100%" cellpadding="10" cellspacing="0" border="2">
                <tr>
                    <td>
                        <table class="noborder">
                            <tr>
                                <td width="100px">
                                    <img src="{{ asset_version('assets/images/logo.png') }}" style="line-height: 100px; padding-top:10px;"/>
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
                                <td width="30%">
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
                                <td width="35%">
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