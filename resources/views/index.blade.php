@extends(((Request::ajax()) ? 'layouts.ajax' : 'layouts.master'))

@section('head')
    <style>
        .accordion ul:hover li a {background: url({{ asset_version('assets/img/content-bg-cover.png') }});}

        .accordion ul li:nth-child(1),
        .carousel .carousel-inner .item:nth-child(1) {
            background-image: url({{ asset_version('assets/images/leader/1.jpg') }});
            background-position:left center;
        }
        .accordion ul li:nth-child(2),
        .carousel .carousel-inner .item:nth-child(2) {
            background-image: url({{ asset_version('assets/images/leader/2.jpg') }});
        }
        .accordion ul li:nth-child(3),
        .carousel .carousel-inner .item:nth-child(3) {
            background-image: url({{ asset_version('assets/images/leader/3.jpg') }});
        }
        .accordion ul li:nth-child(4),
        .carousel .carousel-inner .item:nth-child(4) {
            background-image: url({{ asset_version('assets/images/leader/4.jpg') }});
        }
        .accordion ul li:nth-child(5),
        .carousel .carousel-inner .item:nth-child(5) {
            background-image: url({{ asset_version('assets/images/leader/5.jpg') }});
        }
        .accordion ul li:nth-child(6),
        .carousel .carousel-inner .item:nth-child(6) {
            background-image: url({{ asset_version('assets/images/leader/6.jpg') }});
            background-position:right center;
        }
        .accordion ul li:nth-child(7),
        .carousel .carousel-inner .item:nth-child(7) {
            background-image: url({{ asset_version('assets/images/leader/7.jpg') }});
            background-position:right center;
        }
        .accordion ul li:nth-child(8),
        .carousel .carousel-inner .item:nth-child(8) {
            background-image: url({{ asset_version('assets/images/leader/8.jpg') }});
        }
        .accordion ul li:nth-child(9),
        .carousel .carousel-inner .item:nth-child(9) {
            background-image: url({{ asset_version('assets/images/leader/9.jpg') }});
        }
        .accordion ul li:nth-child(10),
        .carousel .carousel-inner .item:nth-child(10) {
            background-image: url({{ asset_version('assets/images/leader/10.jpg') }});
            background-position:left center;
        }
        .accordion ul li:nth-child(11),
        .carousel .carousel-inner .item:nth-child(11) {
            background-image: url({{ asset_version('assets/images/leader/11.jpg') }});
        }

        /*-------*/

        #milestone .content-bg {
            background-image: url({{ asset_version('assets/images/leader-bg.jpg') }});
        }

        #event .content-bg {
            background-image: url({{ asset_version('assets/images/event-bg.jpg') }});
        }
    </style>
@stop

@section('content')
    <!-- begin #home -->
    <div id="home" class="content has-bg home">
        <!-- begin content-bg -->
        <div class="content-bg">
            <img src="{{ asset_version('assets/images/home-bg.jpg') }}" alt="Home" />
        </div>
        <!-- end content-bg -->
        <!-- begin container -->
        <div class="container home-content text-left">
            <h3 class="text">
                <span class="paragraph">We are</span>
				  <span class="paragraph">
					<span class="word loyal">Loyal.</span>
					<span class="word responsible">Responsible.</span>
					<span class="word amazing">Amazing.</span>
				  </span>
            </h3>
            <h1><span class="loyal">Together</span> To Be <span style="background-color: #D12E39; padding: 0 15px;">Amazing<span></span></span></h1>

            <h3 class="text-center"><span class="fa fa-angle-double-down"></span></h3>
        </div>
        <!-- end container -->
    </div>
    <!-- end #home -->

    <!-- begin #about -->
    <div id="about" class="content" data-scrollview="true">
        <!-- begin container -->
        <div class="container" data-animation="true" data-animation-type="fadeInDown">
            <h2 class="content-title">Kami</h2>
            <!-- begin row -->
            <div class="row">
                <!-- begin col-4 -->
                <div class="col-md-6 col-sm-6" data-animation="true" data-animation-type="fadeInLeft">
                    <!-- begin about -->
                    <div class="about">
                        <h3>Siapa Kami</h3>
                        <p>
                            Himpunan Mahasiswa Teknik Informatika atau yang biasa dikenal HMIF adalah organisasi dalam kampus Universitas Kompter Indonesia lingkup Program Studi Teknik Informatika. HMIF berperan sebagai penyalur aspirasi dan event organizer Program Studi Teknik Informatika.
                        </p>
                    </div>
                    <!-- end about -->
                </div>
                <!-- end col-4 -->
                <!-- begin col-4 -->
                <div class="col-md-6 col-sm-6" data-animation="true" data-animation-type="fadeInRight">
                    <h3>Prinsip Kami</h3>
                    <!-- begin about-author -->
                    <div class="about-author">
                        <div class="quote bg-silver">
                            <i class="fa fa-quote-left"></i>
                            <h3>We are loyal, responsible<br /><span>and together to be Azmazing</span></h3>
                            <i class="fa fa-quote-right"></i>
                        </div>
                        <div class="author">
                            <div class="image">
                                <img src="https://hmifunikom.org/l5/public_html/media/thumbs/10112337_NI5.1433164421.jpg" alt="Muhammad Irham Halid" />
                            </div>
                            <div class="info">
                                Muhammad Irham Halid
                                <small>Ketua Umum</small>
                            </div>
                        </div>
                    </div>
                    <!-- end about-author -->
                </div>
                <!-- end col-4 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end #about -->

    <!-- begin #milestone -->
    <div id="milestone" class="content bg-black-darker has-bg" data-scrollview="true">
        <!-- begin content-bg -->
        <div class="content-bg">

        </div>
        <!-- end content-bg -->
        <!-- begin container -->
        <div class="container">
            <!-- begin row -->
            <div class="row">
                <!-- begin col-3 -->
                <div class="col-md-12 milestone-col">
                    <div class="milestone text-right">
                        <div class="number" data-animation="true" data-animation-type="fadeInDown">Muhammad Irham Halid</div>
                        <div class="title" data-animation="true" data-animation-type="fadeInDown">Ketua Umum</div>
                    </div>
                </div>
                <!-- end col-3 -->
            </div>
            <!-- end row -->
            <div class="row">
                <!-- begin col-6 -->
                <div class="col-md-push-5 col-md-7" data-animation="true" data-animation-type="fadeInDown">
                    <!-- begin nav-tabs -->
                    <ul id="nav-tabs" class="nav nav-tabs">
                        <li class="active"><a href="#visi" data-toggle="tab">Visi</a></li>
                        <li><a href="#misi" data-toggle="tab">Misi</a></li>
                    </ul>
                    <!-- end nav-tabs -->
                    <!-- begin tab-content -->
                    <div id="tab-content" class="tab-content">
                        <!-- begin tab-pane -->
                        <div class="tab-pane fade in active" id="visi">
                            <p>
                                Menjadikan HMIF UNIKOM sebagai wadah serta penyalur aspirasi, minat, dan bakat. Guna menghasilkan masyarakat Teknik Informatika yang lebih berkualitas, baik dalam bidang akademik maupun non akademik.
                            </p>
                        </div>
                        <!-- end tab-pane -->
                        <!-- begin tab-pane -->
                        <div class="tab-pane fade" id="misi">
                            <ol>
                                <li>Menghasilkan anggota-anggota HMIF Unikom yang solid, loyal, dan bertanggung jawab terhadap himpunan serta bermanfaat bagi lingkungan Teknik Informatika Unikom.</li>
                                <li>Menjadikan mahasiswa Teknik Informatika Unikom sebagai individu yang bermoral, berfikiran kritis, cerdas, serta kompeten.</li>
                                <li>Menciptakan hubungan yang bersinergi antara mahasiswa HMIF Unikom dan Prodi Teknik Informatika melalui interaksi sosial.</li>
                                <li>Menumbuh kembangkan kemampuan berwirausaha dan rasa kepedulian terhadap sesama.</li>
                                <li>Menggali potensi serta mengapresiasi karya mahasiswa Teknik Informatika</li>
                                <li>Menjali kemitraan dengan organisasi atau lembaga baik di dalam maupun di luar Unikom.</li>
                            </ol>
                        </div>
                        <!-- end tab-pane -->
                    </div>
                    <!-- end tab-content -->
                </div>
                <!-- end col-6 -->
            </div>
        </div>
        <!-- end container -->
    </div>
    <!-- end #milestone -->

    <!-- begin #team -->
    <div id="team" class="content" data-scrollview="true" style="padding:60px 0 75px;">
        <!-- begin container -->
        <div class="container" data-animation="true" data-animation-type="fadeInDown">
            <h2 class="content-title">Pengurus Inti</h2>
        </div>
        <!-- end container -->

        <div id="carousel-example-generic" data-animation="true" data-animation-type="fadeIn" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <div class="info">
                        <a href="#">
                            <h2><span>Muhammad Irham Halid</span></h2>
                            <p><span>Ketua Umum</span></p>
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="info">
                        <a href="#">
                            <h2><span>Rifanda Yulio Difelani</span></h2>
                            <p><span>Wakil Ketua Umum</span></p>
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="info">
                        <a href="#">
                            <h2><span>Arief Nur Khoerudin</span></h2>
                            <p><span>Sekretaris</span></p>
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="info">
                        <a href="#">
                            <h2><span>Amanda Nurul Amalia</span></h2>
                            <p><span>Bendahara</span></p>
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="info">
                        <a href="#">
                            <h2><span>Melindah </span></h2>
                            <p><span>Ketua Divisi Administrasi dan Kesekretariatan</span></p>
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="info">
                        <a href="#">
                            <h2><span>Listia Yuliastuti</span></h2>
                            <p><span>Ketua Divisi Hubungan Masyarakat</span></p>
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="info">
                        <a href="#">
                            <h2><span>Rizki Abdul Rozak</span></h2>
                            <p><span>Ketua Divisi Penelitian dan Pengembangan</span></p>
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="info">
                        <a href="#">
                            <h2><span>Asmunanda Imam Rasyid</span></h2>
                            <p><span>Ketua Divisi Pengembangan Wawasan dan Teknologi Informasi</span></p>
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="info">
                        <a href="#">
                            <h2><span>Ade Nurwahid</span></h2>
                            <p><span>Ketua Divisi Kerohanian</span></p>
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="info">
                        <a href="#">
                            <h2><span>Dana Suherman</span></h2>
                            <p><span>Ketua Divisi Olahraga</span></p>
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="info">
                        <a href="#">
                            <h2><span>Julio Febryanto</span></h2>
                            <p><span>Ketua Divisi Kewirausahaan</span></p>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="accordion" data-animation="true" data-animation-type="fadeIn">
            <ul>
                <li>
                    <div class="info">
                        <a href="#">
                            <h2><span>Muhammad Irham Halid</span></h2>
                            <p><span>Ketua Umum</span></p>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="info">
                        <a href="#">
                            <h2><span>Rifanda Yulio Difelani</span></h2>
                            <p><span>Wakil Ketua Umum</span></p>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="info">
                        <a href="#">
                            <h2><span>Arief Nur Khoerudin</span></h2>
                            <p><span>Sekretaris</span></p>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="info">
                        <a href="#">
                            <h2><span>Amanda Nurul Amalia</span></h2>
                            <p><span>Bendahara</span></p>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="info">
                        <a href="#">
                            <h2><span>Melindah </span></h2>
                            <p><span>Ketua Divisi Administrasi dan Kesekretariatan</span></p>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="info">
                        <a href="#">
                            <h2><span>Listia Yuliastuti</span></h2>
                            <p><span>Ketua Divisi Hubungan Masyarakat</span></p>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="info">
                        <a href="#">
                            <h2><span>Rizki Abdul Rozak</span></h2>
                            <p><span>Ketua Divisi Penelitian dan Pengembangan</span></p>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="info">
                        <a href="#">
                            <h2><span>Asmunanda Imam Rasyid</span></h2>
                            <p><span>Ketua Divisi Pengembangan Wawasan dan Teknologi Informasi</span></p>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="info">
                        <a href="#">
                            <h2><span>Ade Nurwahid</span></h2>
                            <p><span>Ketua Divisi Kerohanian</span></p>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="info">
                        <a href="#">
                            <h2><span>Dana Suherman</span></h2>
                            <p><span>Ketua Divisi Olahraga</span></p>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="info">
                        <a href="#">
                            <h2><span>Julio Febryanto</span></h2>
                            <p><span>Ketua Divisi Kewirausahaan</span></p>
                        </a>
                    </div>
                </li>
            </ul>
        </div>

        <div class="container" data-animation="true" data-animation-type="fadeInUp">
            <!-- begin row -->
            <div class="row action-box">
                <!-- begin col-9 -->
                <div class="col-md-9 col-sm-9">
                    <div class="icon-large text-theme">
                        <i class="fa fa-group"></i>
                    </div>
                    <h3>We do the things together.</h3>
                    <p>
                        Kami, lebih dari sekedar sebuah organisasi. Sebuah tim yang hebat.
                    </p>
                </div>
                <!-- end col-9 -->
                <!-- begin col-3 -->
                <div class="col-md-3 col-sm-3">
                    <a href="{{ route('keanggotaan.index') }}" data-pjax="true" class="btn btn-primary btn-block">Lihat Kepengurusan <span class="fa fa-angle-double-right"></span></a>
                </div>
                <!-- end col-3 -->
            </div>
            <!-- end row -->
        </div>
    </div>
    <!-- end #team -->

    <!-- begin #event -->
    <div id="event" class="content bg-black-darker has-bg" data-scrollview="true">
        <!-- begin content-bg -->
        <div class="content-bg"></div>
        <!-- end content-bg -->
        <!-- begin container -->
        <div class="container" data-animation="true" data-animation-type="fadeInUp">
            <!-- begin row -->
            <div class="container">
                <h2 class="content-title">Event</h2>
            </div>
            <div class="row">
                @if($acara)
                <div class="col-md-12">
                    <div class="event-list-container">
                        <div class="event-container">
                            <div class="date-container pull-left">
                                <div class="date">{{ $acara->mulai->format('d') }}</div>
                                <div class="month-year">
                                    <div class="month">{{ $acara->mulai->format('M') }}</div>
                                    <div class="year">{{ $acara->mulai->format('Y') }}</div>
                                </div>
                            </div>
                            <div class="name-place pull-left">
                                <div class="name">{{ $acara->nama_acara }}</div>
                                <div class="place-time pull-left">
                                    <div class="place"><span class="fa fa-map-marker"></span>{{ $acara->tempat }}</div>
                                    <div class="time"><span class="fa fa-clock-o"></span>{{ $acara->mulai->format('H:i') }}</div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                @else
                <!-- begin col-12 -->
                <div class="col-md-12 quote">
                    <small>Tidak ada event yang akan datang. Stay tuned.</small>
                </div>
                <!-- end col-12 -->
                @endif
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end #event -->
@stop

@section('javascript')
    <script>
        var handleSwipeCarousel = function() {
            $('.carousel').bcSwipe({
                threshold: 50,
                preventDefaultEvents: true
            });
        }

        $(document).ready(function() {
            App.scrollingText();

            $.getScript('{{ asset_version('assets/plugins/jquery-bcSwipe/jquery.bcSwipe.min.js') }}').done(function() {
                handleSwipeCarousel();
            });
        });
    </script>
@stop
