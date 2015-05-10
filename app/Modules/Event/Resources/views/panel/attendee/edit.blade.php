@extends(((Request::ajax()) ? 'panel::layouts.ajax' : 'panel::layouts.master'))

@section('head')
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection

@section('content')
    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        {!! Breadcrumbs::renderIfExists() !!}
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Form edit tiket</h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Informasi tiket</h4>
                    </div>
                    <div class="panel-body panel-form">
                        {!! Former::open()->route('panel.event.ticket.update', [$event->getWrappedObject(), $ticket->getWrappedObject()])->class('form-horizontal form-bordered')->data_pjax() !!}
                        <?php Former::populate( $ticket ); ?>
                        @include('event::panel.ticket.form')
                        {!! Former::close() !!}
                    </div>
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
