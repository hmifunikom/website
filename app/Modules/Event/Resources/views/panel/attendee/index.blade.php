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
                        <h4 class="panel-title">Tabel daftar peserta</h4>
                    </div>
                    <div class="panel-toolbar">
                        <div class="row">
                            <div class="col-md-8">
                                <?php
                                    $ticketLinks[] = [
                                            'url' => route('panel.event.attendee.index', [$event->getWrappedObject()]),
                                            'label' => 'Semua',
                                            'linkAttributes' => ['data-pjax' => true],
                                    ];

                                    $ticketCurrent = 'Semua';

                                    foreach($tickets as $ticket)
                                    {
                                        $ticketLinks[] = [
                                                'url' => route('panel.event.attendee.index', [$event->getWrappedObject(), 'ticket' => $ticket->id_hash]),
                                                'label' => $ticket->nama_tiket,
                                                'linkAttributes' => ['data-pjax' => true],
                                        ];

                                        if($ticket->id_hash == Input::get('ticket'))
                                        {
                                            $ticketCurrent = $ticket->nama_tiket;
                                        }

                                    }
                                ?>
                                <form class="form-inline" method="GET" id="search" action="{{ route('panel.event.attendee.index', [$event->getWrappedObject()]) }}" data-pjax="true" style="display: inline-block;">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Cari peserta..." name="s" value="{{ Input::get('s') }}">
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <div class='btn-group'>
                                    <button class='btn btn-primary dropdown-toggle' data-toggle='dropdown' type='button'>
                                        {{ $ticketCurrent }} <span class='caret'></span>
                                    </button>
                                    <ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'>
                                        @foreach($ticketLinks as $link)
                                            <li><a href='{{ $link['url'] }}' data-pjax="true">{{ $link['label'] }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <a class="btn btn-success {{ menu_active_qs('paid', 1) }}" data-pjax href="{{ route_append_qs('panel.event.attendee.index', [$event->getWrappedObject(), 'paid' => 1], 'ticket') }}"><span class="fa fa-money"></span> Sudah Bayar</a>
                                    <a class="btn btn-default {{ menu_active_qs('paid', 0) }}" data-pjax href="{{ route_append_qs('panel.event.attendee.index', [$event->getWrappedObject(), 'paid' => 0], 'ticket') }}"><span class="fa fa-ban"></span> Belum Bayar</a>
                                </div>
                            </div>
                            <div class="col-md-4 text-right">
                                @if(Authority::can('manage', HMIF\Modules\Event\Entities\Attendee::class))
                                {!! Button::primary(Icon::plus() . ' Tambah peserta')->asLinkTo(route('panel.event.attendee.create', [$event->getWrappedObject()]))->withAttributes(['data-pjax']) !!}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama peserta</th>
                                    <th>NIM</th>
                                    <th>No. Hp</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Kategori</th>
                                    @if(Authority::can('manage', HMIF\Modules\Event\Entities\Attendee::class))
                                    <th></th>
                                    <th></th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = $attendees->firstItem(); ?>
                                @foreach($attendees as $attendee)
                                    <tr>
                                        <td>{{ $attendee->kode }}</td>
                                        <td>{{ $attendee->nama_peserta }}</td>
                                        <td>{{ $attendee->nim }}</td>
                                        <td>{{ $attendee->no_hp }}</td>
                                        <td>{{ $attendee->tanggal_daftar }}</td>
                                        <td>{{ $attendee->ticket->nama_tiket }}</td>
                                        @if(Authority::can('manage', $attendee->getWrappedObject()))
                                        <td class="text-right">
                                            @if($attendee->dibayar)
                                                {!! Former::inline_open()->route('panel.event.attendee.paid', [$event->getWrappedObject(), $attendee->getWrappedObject(), 'paid' => 0])->data_pjax()->data_confirm('Set status peserta menjadi belum membayar?') !!}
                                                {!! Button::success('Sudah Bayar')->small()->submit() !!}
                                            @else
                                                {!! Former::inline_open()->route('panel.event.attendee.paid', [$event->getWrappedObject(), $attendee->getWrappedObject(), 'paid' => 1])->data_pjax()->data_confirm('Set status peserta menjadi sudah membayar?') !!}
                                                {!! Button::danger('Belum Bayar')->small()->submit() !!}
                                            @endif
                                            {!! Former::close() !!}
                                        </td>
                                        <td class="text-right">
                                            {!! Former::inline_open()->route('panel.event.attendee.destroy', [$event->getWrappedObject(), $attendee->getWrappedObject()])->data_pjax()->data_confirm('Hapus peserta ini?') !!}
                                            {!! Button::primary(Icon::pencil())->small()->asLinkTo(route('panel.event.attendee.edit', [$event->getWrappedObject(), $attendee->getWrappedObject()]))->withAttributes(['data-pjax']) !!}
                                            {!! Button::danger(Icon::trashO())->small()->submit() !!}
                                            {!! Former::close() !!}
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($attendees->hasPages())
                        <div class="panel-footer text-right">
                            {!! $attendees->appends(Input::all())->render() !!}
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