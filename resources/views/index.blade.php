@extends('layouts.default')

@section('content')
    <div class="jumbotron home">
    </div>

    <div class="big-container">
        <div class="container">
            <h2>Siapa Kita?</h2>
            <p>Himpunan Mahasiswa Teknik Informatika atau yang biasa dikenal HMIF adalah organisasi dalam kampus Universitas Kompter Indonesia lingkup Program Studi Teknik Informatika. HMIF berperan sebagai penyalur aspirasi dan event organizer Program Studi Teknik Informatika.
                <br><br>
                Sekretariat HMIF: <br>
                Kampus UNIKOM, Jl. Dipatiukur No.112 R.4416<br>
                Facebook :<br>
                <a href='http://www.facebook.com/hmifunikom'>Himpunan Mahasiswa Teknik Informatika Universitas Komputer Indonesia</a><br>
                Twitter : <br>
                <a href='http://www.twitter.com/hmifunikom'>@hmifunikom </a>  </p>
        </div>
    </div>

    <div class="photo-layer" style="background-image: url('/assets/images/leader-banner.jpg');">
        <div class="big-container blue bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-4 right">
                        <h2>The Leader</h2>
                        <h3>Muhammad Iqbal Muhyiddin</h3>
                        <p></p>
                        <p><span class="subtext-big">VISI</span>
                            1. Menjadikan Teknik Informatika UNIKOM unggul dalam prestasi dan kewirausahaan.<br>
                            2. Mengembangkan potensi mahasiswa/i Teknik Informatika dari segi keilmuan, kejasmanian, keagamaan dan sosial dengan cara mensinergikan keluarga besar Teknik Informatika.<br>
                        </p>

                        <p><span class="subtext-big">MISI</span>
                            1. Membentuk tim khusus untuk perlombaan - perlombaan.<br>
                            2. Memfasilitasi mahasiswa/i Teknik Informatika untuk mengembangkan usaha.<br>
                            3. Mengadakan kegiatan - kegiatan kejasmanian, keilmuan, sosial dan keagamaan.<br>
                            4. Menjadikan Himpunan Mahasiswa Teknik Informatika sebagai wadah kegiatan dan penyaluran aspirasi, minat dan bakat mahasiswa Teknik Informatika.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="big-container">
        <div class="container">
            <h2>Event Akan Datang</h2>
            @if($acara)
                <div class="event-list-container">
                    <div class="event-container navy">
                        <div class="date-container pull-left">
                            <div class="date">{{ $acara->mulai->day }}</div>
                            <div class="month-year">
                                <div class="month">{{ $acara->mulai->formatLocalized('%b') }}</div>
                                <div class="year">{{ $acara->mulai->year }}</div>
                            </div>
                        </div>
                        <div class="name-place pull-left">
                            <div class="name">
                                {{ $acara->nama_acara }}
                            </div>
                            <div class="place-time pull-left">
                                <div class="place"><span class="fa fa-map-marker"></span>{{ $acara->tempat }}</div>
                                <div class="time"><span class="fa fa-clock-o"></span>
                                    {{--{{ Helper::implode($acara->waktu, 'waktu') }}--}}
                                </div>
                            </div>
                            <a class="btn btn-default btn-lg pull-right book-btn" href="{{ route('event.show', $acara->slug) }}" role="button"><span class="fa fa-info-circle"></span> Detail Event</a>
                            <div class="clearfix"></div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
            @else
                <div class="center">
                    <span class="big-title">Tidak ada event</span>
                </div>
            @endif
            <a class="pull-right" href="{{ route('event.index') }}" role="button">Lihat Event Lainnya &raquo;</a></p>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="big-container orange">
        <div class="container">
            <div class="right">
                <h2>Perpustakaan</h2>
            </div>

            <!-- div class="row book-list jcarousel">
                <div class="book-rail">
                    <div class="col-md-4 book-container">
                        <div class="cover">
                            <img src="1336370068.pdf.jpg">
                        </div>
                        <div class="name">
                            Fisika Jilid 1
                        </div>
                    </div>
                    <div class="col-md-4 book-container">
                        <div class="cover">
                            <img src="1336370068.pdf.jpg">
                        </div>
                        <div class="name">
                            Fisika Jilid 2
                        </div>
                    </div>
                    <div class="col-md-4 book-container">
                        <div class="cover">
                            <img src="1336370068.pdf.jpg">
                        </div>
                        <div class="name">
                            Fisika Jilid 3
                        </div>
                    </div>
                    <div class="col-md-4 book-container">
                        <div class="cover">
                            <img src="1336370068.pdf.jpg">
                        </div>
                        <div class="name">
                            Fisika Jilid 4
                        </div>
                    </div>
                    <div class="col-md-4 book-container">
                        <div class="cover">
                            <img src="1336370068.pdf.jpg">
                        </div>
                        <div class="name">
                            Fisika Jilid 5
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div-->
            <!-- p class="jcarousel-pagination"></p-->

            <!--a href="#" role="button">Lihat Buku Lainnya &raquo;</a></p-->
            <div class="big-title center">Coming Soon</div>
        </div>
    </div>

@stop

@section('tagline')
    @include('includes.tagline', array('invert' => false))
@stop
