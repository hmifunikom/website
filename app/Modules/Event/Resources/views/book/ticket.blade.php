<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="{{ asset('assets/css/ticket.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="ticket">
        <table width="100%" cellpadding="10" cellspacing="0">
            <tr>
                <td colspan="2">
                    <table class="noborder">
                        <tr>
                            <td width="100px">
                                <img src="{{ asset('assets/images/logo.png') }}" />
                            </td>
                            <td>
                                <div class="big-title">HMIF UNIKOM</div>
                                <div>Jl. Dipatiukur No.112 Bandung Gedung 4 Lantai 4 Ruang 16 (R.4416)
                                </div>

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="big-title">{{ $event->nama_acara }}</div>
                    {{ 
                        Typography::horizontal_dl(
                            array(
                                'Tempat'          => $event->tempat,
                                'Tanggal & Waktu' => $event->tgl->toDateString().' @ '.Helper::implode($event->waktu, 'waktu'),
                            )
                        )
                    }}

                    {{ 
                        Typography::horizontal_dl(
                            array(
                                'Nama Peserta' => $ticket->nama_peserta,
                                'Kategori'     => Lang::get('messages.event.'.$ticket->kategori),
                                'NIM'          =>  $ticket->nim,
                            )
                        )
                    }}
                </td>
            </tr>
            <tr>
                <td>
                    {{ 
                        Typography::horizontal_dl(
                            array(
                                'Nama Peserta' => $ticket->nama_peserta,
                            )
                        )
                    }}
                </td>
                <td width="100px">
                    <img src="{{ asset('media/qr/'.$ticket->ticket.'.jpg') }}" width="100" />
                </td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>