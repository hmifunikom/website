<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <link href="{{ asset_version('assets/admin/css/style.min.css') }}" rel="stylesheet" />
    <link href="{{ asset_version('assets/admin/css/invoice-print.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset_version('assets/admin/css/theme/blue.css') }}" rel="stylesheet" id="theme"/>
    <style>
        body {
            background: #fff;
        }
        .invoice-price .invoice-price-right {
            width: 40%;
        }
    </style>
</head>
<body class="no-bg">
    <div class="invoice">
        <div class="invoice-company" style="padding-bottom: 20px">
            HMIF Unikom
        </div>
        <table width="100%" class="invoice-header" style="margin: 0px">
            <tr>
                <td width="33%" class="invoice-from">
                    <small>from</small>
                    <address class="m-t-5 m-b-5">
                        <strong>HMIF Unikom</strong><br/>
                        Jl. Dipatiukur No.112 R.4416<br/>
                        Bandung, 40132<br/>
                        Telp: 022 96072227
                    </address>
                </td>
                <td width="33%" class="invoice-to">
                    <small>to</small>
                    <address class="m-t-5 m-b-5">
                        <strong>{{ $entity->nama_penerima }}</strong><br/>
                        {{ $entity->alamat }}<br/>
                        Hp: {{ $entity->no_hp }}
                    </address>
                </td>
                <td width="33%" class="invoice-date">
                    <small>Invoice</small>
                    <div class="date m-t-5">{{ $entity->tanggal_diterbitkan }}</div>
                    <div class="invoice-detail">
                        #{{ $entity->getRouteKey() }}<br/>
                    </div>
                </td>
            </tr>
        </table>
        <div class="invoice-content">
            <div class="table-responsive">
                <table class="table table-invoice" width="100%">
                    <thead>
                    <tr>
                        <th>ITEM</th>
                        <th>HARGA</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td width="75%">
                            {{ $entity->invoiceable->getItemName() }}<br/>
                            <small>{{ $entity->invoiceable->getItemDescription() }}</small>
                        </td>
                        <td width="40%">{{ to_rp($entity->invoiceable->getItemPrice()) }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <table class="invoice-price">
                <tr>
                <td class="invoice-price-left"></td>
                <td width="40%" class="invoice-price-right">
                    <small>TOTAL</small>
                    {{ $entity->total_rp }}
                </td>
                </tr>
            </table>
        </div>
        <div class="invoice-note" style="padding-bottom: 20px">
            * Pembayaran dilakukan max seminggu setelah tanggal invoice dan H-2 dari tanggal acara.
        </div>
        <div class="invoice-footer text-muted">
            <p class="text-center m-b-5">
                TERIMA KASIH
            </p>

            <p class="text-center">
                <span class="m-r-10"><i class="fa fa-globe"></i> hmifunikom.org</span>
                <span class="m-r-10"><i class="fa fa-phone"></i> T:022 96072227</span>
                <span class="m-r-10"><i class="fa fa-envelope"></i> humas@hmifunikom.org</span>
            </p>
        </div>
    </div>
</body>
</html>