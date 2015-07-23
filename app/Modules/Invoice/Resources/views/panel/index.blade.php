@extends(((Request::ajax()) ? 'panel::layouts.ajax' : 'panel::layouts.master'))

@section('head')

@endsection

@section('content')
    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        {!! Breadcrumbs::renderIfExists() !!}
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Daftar invoice</h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Tabel daftar invoice</h4>
                    </div>
                    <div class="panel-toolbar">
                        <div class="row">
                            <div class="col-md-8">
                                <form class="form-inline" method="GET" id="search" action="{{ route('panel.invoice.index') }}" data-pjax="true" style="display: inline-block;">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Cari invoice..." name="s" value="{{ Input::get('s') }}">
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <div class="btn-group">
                                    <a class="btn btn-success {{ menu_active_qs('paid', 1) }}" data-pjax href="{{ route_append_qs('panel.invoice.index', ['paid' => 1], 'ticket') }}"><span class="fa fa-money"></span> Sudah Bayar</a>
                                    <a class="btn btn-default {{ menu_active_qs('paid', 0) }}" data-pjax href="{{ route_append_qs('panel.invoice.index', ['paid' => 0], 'ticket') }}"><span class="fa fa-ban"></span> Belum Bayar</a>
                                </div>
                            </div>
                            <div class="col-md-4 text-right"></div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th width="200px">Judul Invoice</th>
                                    <th width="280px">Penerima</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal Dibuat</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = $invoices->firstItem(); ?>
                                @foreach($invoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice->getRouteKey() }}</td>
                                        <td>{{ $invoice->judul }}</td>
                                        <td>{{ $invoice->nama_penerima }}</td>
                                        <td>{{ $invoice->total_rp }}</td>
                                        <td>{{ $invoice->tanggal_diterbitkan }}</td>
                                        <td class="text-right">
                                            @if($invoice->dibayar)
                                                <span class="text-success">Sudah Bayar</span>
                                            @else
                                                <span class="text-danger">Belum Bayar</span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            {!! Button::primary(Icon::eye())->small()->asLinkTo(route('panel.invoice.show', [$invoice->getWrappedObject()]))->withAttributes(['target' => '_blank']) !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($invoices->hasPages())
                        <div class="panel-footer text-right">
                            {!! $invoices->appends(Input::all())->render() !!}
                        </div>
                    @endif
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

@endsection