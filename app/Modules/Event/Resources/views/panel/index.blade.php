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
        <h1 class="page-header">Daftar event</h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Table daftar event</h4>
                    </div>
                    <div class="panel-toolbar text-right">
                        {!! Button::primary(Icon::plus() . ' Tambah event')->asLinkTo(route('panel.event.create'))->withAttributes(['data-pjax']) !!}
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama event</th>
                                    <th>Waktu</th>
                                    <th>Tempat</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = $events->firstItem(); ?>
                                @foreach($events as $event)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $event->nama_acara }}</td>
                                        <td>{{ $event->mulai_full }}</td>
                                        <td>{{ $event->tempat }}</td>
                                        <td class="text-right">
                                            {!! Former::inline_open()->route('panel.event.destroy', $event->getWrappedObject())->data_pjax()->data_confirm('Hapus event ini?') !!}
                                            {!! Button::withValue(Icon::eye())->small()->asLinkTo(route('event.show', [$event->getWrappedObject(), $event->slug]))->withAttributes(['target' => '_blank']) !!}
                                            {!! Button::primary(Icon::pencil())->small()->asLinkTo(route('panel.event.show', $event->getWrappedObject()))->withAttributes(['data-pjax']) !!}
                                            {!! Button::danger(Icon::trashO())->small()->submit() !!}
                                            {!! Former::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($events->hasPages())
                    <div class="panel-footer text-right">
                        {!! $events->render() !!}
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