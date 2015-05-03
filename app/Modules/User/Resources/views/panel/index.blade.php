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
        <h1 class="page-header">Daftar user <small>header small text goes here...</small></h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Table daftar user</h4>
                    </div>
                    <div class="panel-toolbar text-right">
                        {!! Button::primary(Icon::plus() . ' Tambah user')->asLinkTo(route('panel.user.create'))->withAttributes(['data-pjax']) !!}
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = $users->firstItem(); ?>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td class="text-right">
                                            {!! Former::inline_open()->route('panel.user.destroy', $user->getWrappedObject())->data_pjax()->data_confirm('Hapus user ini?') !!}
                                            {{--{!! Button::withValue(Icon::eye())->small()->asLinkTo(route('user.show', [$user->getWrappedObject(), $user->slug]))->withAttributes(['target' => '_blank']) !!}--}}
                                            {{--{!! Button::primary(Icon::pencil())->small()->asLinkTo(route('panel.user.show', $user->getWrappedObject()))->withAttributes(['data-pjax']) !!}--}}
                                            {!! Button::danger(Icon::trashO())->small()->submit() !!}
                                            {!! Former::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($users->hasPages())
                        <div class="panel-footer text-right">
                            {!! $users->render() !!}
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