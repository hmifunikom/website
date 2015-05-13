@extends('email::layouts.email')

@section('content')
    <table class="twelve columns">
        <tr>
            <td>
                <h4>{{ $data->title }}</h4>

                <p class="m-b-5">Dear <strong>{{ $data->name }}</strong>,</p>

                <p class="m-b-10">Terima kasih telah melakukan pembayaran atas transaksi anda sebelumnya. Berikut adalah rincian transaksi : </p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="m-b-5">Tanggal transaksi : {{ $invoice->tanggal_diterbitkan }}</p>
                <table class="table table-invoice panel m-b-10" width="100%">
                    <thead>
                    <tr>
                        <th>Item</th>
                        <th>Harga</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td width="75%">
                            {{ $invoice->invoiceable->getItemName() }}<br/>
                            <small>{{ $invoice->invoiceable->getItemDescription() }}</small>
                        </td>
                        <td width="40%">{{ to_rp($invoice->invoiceable->getItemPrice()) }}</td>
                    </tr>
                    <tr>
                        <td width="75%">
                            <strong>Total</strong>
                        </td>
                        <td width="40%">{{ $invoice->total_rp }}</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <p class="last">
                    <strong>Tiket bisa didapatkan pada attachment yang disertakan dalam email ini.</strong>
                    <br><br>
                    Terima kasih,<br>
                    HMIF Unikom
                </p>
            </td>
        </tr>
    </table>
@stop