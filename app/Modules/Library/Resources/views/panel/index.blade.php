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
        <h1 class="page-header">Daftar Buku Perpustakaan IF</h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Tabel daftar buku</h4>
                    </div>
                    <div class="panel-toolbar">
                        <div class="row">
                            <div class="col-md-8">
                                <form class="form-inline" method="GET" id="search" action="{{ route('panel.library.index') }}" data-pjax="true" style="display: inline-block;">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Cari buku..." name="s" value="{{ Input::get('s') }}">
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
                                    <th>Kode Buku</th>
                                    <th>Judul Buku</th>
                                    <th>Jenis</th>
                                    <th>Pengarang</th>
                                    <th>Penerbit</th>
                                    <th>Tahun Terbit</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = $books->firstItem(); ?>
                                @foreach($books as $book)
                                    <tr>
                                        <td>{{ $book->Kode_buku }}</td>
                                        <td>{{ $book->Judul_buku }}</td>
                                        <td>{{ $book->Nama_jenis }}</td>
                                        <td>{{ $book->Pengarang }}</td>
                                        <td>{{ $book->Penerbit }}</td>
                                        <td>{{ $book->Tahun_terbit }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($books->hasPages())
                        <div class="panel-footer text-right">
                            {!! $books->appends(Input::only('s'))->render() !!}
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