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
        <h1 class="page-header">Daftar anggota</h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Table daftar anggota</h4>
                    </div>
                    <div class="panel-toolbar">
                        <div class="row">
                            <div class="col-md-8">
                                <?php
                                $divisiLinks[] = [
                                        'url' => route('panel.keanggotaan.anggota.index'),
                                        'label' => 'Semua Divisi',
                                        'linkAttributes' => ['data-pjax' => true],
                                ];

                                $divisiCurrent = 'Semua Divisi';

                                for($i=0; $i<4; $i++)
                                {
                                    $divisi->shift();
                                }

                                $intiDivisi = new stdClass();
                                $intiDivisi->id_divisi = 1234;
                                $intiDivisi->divisi = 'Inti';
                                $intiDivisi->singkatan = 'Inti';

                                $divisi->prepend($intiDivisi);

                                foreach($divisi as $div)
                                {
                                    $divisiLinks[] = [
                                            'url' => route('panel.keanggotaan.anggota.index', ['divisi' => $div->id_divisi]),
                                            'label' => $div->singkatan,
                                            'linkAttributes' => ['data-pjax' => true],
                                    ];

                                    if($div->id_divisi == Input::get('divisi'))
                                    {
                                        $divisiCurrent = $div->singkatan;
                                    }

                                }
                                ?>
                                <form class="form-inline" method="GET" id="search" action="{{ route('panel.keanggotaan.anggota.index') }}" data-pjax="true" style="display: inline-block;">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Cari anggota..." name="s" value="{{ Input::get('s') }}">
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <div class='btn-group'>
                                    <button class='btn btn-primary dropdown-toggle' data-toggle='dropdown' type='button'>
                                        {{ $divisiCurrent }} <span class='caret'></span>
                                    </button>
                                    <ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'>
                                        @foreach($divisiLinks as $link)
                                            <li><a href='{{ $link['url'] }}' data-pjax="true">{{ $link['label'] }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <a class="btn btn-success {{ menu_active_qs('status', 'pengurus') }}" data-pjax href="{{ route_append_qs('panel.keanggotaan.anggota.index', ['status' => 'pengurus'], 'divisi') }}">Pengurus</a>
                                    <a class="btn btn-primary {{ menu_active_qs('status', 'am') }}" data-pjax href="{{ route_append_qs('panel.keanggotaan.anggota.index', ['status' => 'am'], 'divisi') }}">AM</a>
                                </div>
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
                                    <th>Jabatan/Divisi</th>
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
                                        <td>{{ $angg->jabatan }}</td>
                                        <td>{{ $angg->tempat }}</td>
                                        <td class="text-right">
                                            {!! Former::inline_open()->route('panel.keanggotaan.anggota.destroy', $angg->getWrappedObject())->data_pjax()->data_confirm('Hapus anggota ini?') !!}
                                            {!! Button::withValue(Icon::eye())->small()->asLinkTo(route('panel.keanggotaan.anggota.show', $angg->getWrappedObject()))->withAttributes(['data-pjax']) !!}
                                            {!! Button::danger(Icon::trashO())->small()->submit() !!}
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