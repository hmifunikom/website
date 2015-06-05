@extends(((Request::ajax()) ? 'layouts.ajax' : 'layouts.master'))

@section('head')
    <style>
        #hero .content-bg {
            background-image: url({{ asset_version('assets/images/library-hero.jpg') }});
        }
    </style>
@stop

@section('content')
    <!-- begin #hero -->
    <div id="hero" class="content has-bg hero">
        <!-- begin content-bg -->
        <div class="content-bg"></div>
        <!-- end content-bg -->
        <!-- begin container -->
        <div class="container home-content text-center">
            <h1>Perpustakaan IF</h1>
            <h3><span class="fa fa-angle-double-down"></span></h3>
        </div>
        <!-- end container -->
    </div>
    <!-- end #hero -->

    <!-- begin #book -->
    <div id="book" class="content" data-scrollview="true">
        <!-- begin container -->
        <div class="container">
            <h2 class="content-title">Daftar Buku</h2>
            <!-- begin row -->
            <div class="row">
                <!-- begin col-4 -->
                <div class="col-md-12">
                    <div class="text-right">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-inline" method="GET" id="search" action="{{ route('library.index') }}" data-pjax="true" style="display: inline-block;">
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

                    <div class="text-right">
                        {!! $books->appends(Input::only('s'))->render() !!}
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end #about -->
@stop

@section('javascript')
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
@stop
