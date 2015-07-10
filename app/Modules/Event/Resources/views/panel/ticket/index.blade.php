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
        <h1 class="page-header">{{ $event->nama_acara }}</h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                @include('event::panel.tabs')
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Table daftar tiket</h4>
                    </div>
                    <div class="panel-toolbar text-right">
                        {!! Button::primary(Icon::plus() . ' Tambah tiket')->asLinkTo(route('panel.event.ticket.create', [$event->getWrappedObject()]))->withAttributes(['data-pjax']) !!}
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama tiket</th>
                                    <th>Kuota</th>
                                    <th>Terjual</th>
                                    <th>Harga</th>
                                    <th>KTM</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = $tickets->firstItem(); ?>
                                @foreach($tickets as $ticket)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $ticket->nama_tiket }}</td>
                                        <td>{{ $ticket->kuota }}</td>
                                        <td>{{ $ticket->terjual }}</td>
                                        <td>{{ $ticket->harga_rp }}</td>
                                        <td>
                                            @if($ticket->ktm)
                                                {!! Icon::check() !!}
                                            @else
                                                {!! Icon::times() !!}
                                            @endif
                                        </td>
                                        <td>
                                            @if($ticket->aktif)
                                                {!! Former::inline_open()->route('panel.event.ticket.status', [$event->getWrappedObject(), $ticket->getWrappedObject(), 'status' => false])->data_pjax()->data_confirm('Nonaktifkan tiket ini?') !!}
                                                {!! Button::success('Aktif')->small()->submit() !!}
                                            @else
                                                {!! Former::inline_open()->route('panel.event.ticket.status', [$event->getWrappedObject(), $ticket->getWrappedObject(), 'status' => true])->data_pjax()->data_confirm('Aktifkan tiket ini?') !!}
                                                {!! Button::danger('Nonaktif')->small()->submit() !!}
                                            @endif
                                                {!! Former::close() !!}
                                        </td>
                                        <td class="text-right">
                                            {!! Former::inline_open()->route('panel.event.ticket.destroy', [$event->getWrappedObject(), $ticket->getWrappedObject()])->data_pjax()->data_confirm('Hapus tiket ini?') !!}
                                            {!! Button::primary(Icon::pencil())->small()->asLinkTo(route('panel.event.ticket.edit', [$event->getWrappedObject(), $ticket->getWrappedObject()]))->withAttributes(['data-pjax']) !!}
                                            {!! Button::danger(Icon::trashO())->small()->submit() !!}
                                            {!! Former::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($tickets->hasPages())
                    <div class="panel-footer text-right">
                        {!! $tickets->render() !!}
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