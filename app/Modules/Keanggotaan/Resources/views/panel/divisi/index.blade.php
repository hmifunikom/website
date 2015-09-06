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
        <h1 class="page-header">Daftar Divisi HMIF</h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Table daftar divisi HMIF</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Nama divisi</th>
                                    <th>Penanggung Jawab</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($divisi as $div)
                                    <tr>
                                        <td>{{ $div->divisi }}</td>
                                        <td>{{ $div->penanggung_jawab->nama }}</td>
                                        <td class="text-right">
                                            {!! Button::primary(Icon::eye())->small()->asLinkTo(route('panel.keanggotaan.divisi.show', $div->getWrappedObject()))->withAttributes(['data-pjax']) !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
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