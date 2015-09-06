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
    <h1 class="page-header">Daftar Pengurus Divisi {{ $divisi->divisi }} HMIF</h1>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Table Daftar Pengurus Divisi {{ $divisi->divisi }} HMIF</h4>
                </div>
                <div class="panel-toolbar">
                    <div class="row">
                        <div class="col-md-8">
                            <form class="form-inline" method="GET" id="search" action="{{ route('panel.keanggotaan.divisi.edit', $divisi->getWrappedObject()) }}" data-pjax="true" style="display: inline-block;">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari anggota..." name="s" value="{{ Input::get('s') }}">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4 text-right">
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Nama anggota</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($anggota as $angg)
                                <tr>
                                    <td>{{ $angg->nim }}</td>
                                    <td>
                                        @if($angg->anggota_spesial) <strong>{{ $angg->nama }}</strong> @else {{ $angg->nama }} @endif
                                    </td>
                                    <td class="text-right">
                                        {!! Former::inline_open()->route('panel.keanggotaan.divisi.update', $divisi->getWrappedObject())->data_pjax()->data_confirm('Ganti penanggung jawab divisi?') !!}
                                        <input type="hidden" name="id_penanggung_jawab" value="{{ $angg->id_anggota }}">
                                        {!! Button::primary(Icon::refresh())->small()->submit() !!}
                                        {!! Former::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($anggota->hasPages())
                    <div class="panel-footer text-right">
                        {!! $anggota->appends(Input::all())->render() !!}
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