@extends(((Request::ajax()) ? 'layouts.ajax' : 'layouts.master'))

@section('head')
    <style>
        .accordion ul:hover li a {background: url({{ asset_version('assets/img/content-bg-cover.png') }});}

        <?php $i = 1; ?>
        @foreach($inti as $anggota)
        .accordion ul li:nth-child({{ $i }}),
        .carousel .carousel-inner .item:nth-child({{ $i }}) {
            background-image: url({{ asset_version('media/images/'.$anggota->divisi->cover) }});
            background-position:{{ $anggota->divisi->cover_position }} center;
        }
        <?php $i++; ?>
        @endforeach

        /*-------*/

        #milestone .content-bg {
            background-image: url({{ asset_version('media/images/' . settings('hmif_visimisi_background')) }});
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
            <img src="{{ asset_version('media/images/' . settings('hmif_main_background')) }}" alt="Home" />
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
                            <h3>{{ settings('hmif_leader_quote') }}</h3>
                            <i class="fa fa-quote-right"></i>
                        </div>
                        <div class="author">
                            <div class="image">
                                <img src="{{ $inti->first()->avatar }}" alt="{{ $inti->first()->nama }}" />
                            </div>
                            <div class="info">
                                {{ $inti->first()->nama }}
                                <small>{{ $inti->first()->jabatan }}</small>
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
                        <div class="number" data-animation="true" data-animation-type="fadeInDown">{{ $inti->first()->nama }}</div>
                        <div class="title" data-animation="true" data-animation-type="fadeInDown">{{ $inti->first()->jabatan }}</div>
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
                            {!! parsedown(settings('hmif_visi')) !!}
                        </div>
                        <!-- end tab-pane -->
                        <!-- begin tab-pane -->
                        <div class="tab-pane fade" id="misi">
                            {!! parsedown(settings('hmif_misi')) !!}
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
                @foreach($inti as $anggota)
                <div class="item @if($anggota->id_divisi == 1) active @endif">
                    <div class="info">
                        <a href="#">
                            <h2><span>{{ $anggota->nama }}</span></h2>
                            <p><span>{{ $anggota->jabatan }}</span></p>
                        </a>
                    </div>
                </div>
                @endforeach
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
                @foreach($inti as $anggota)
                <li>
                    <div class="info">
                        <a href="#">
                            <h2><span>{{ $anggota->nama }}</span></h2>
                            <p><span>{{ $anggota->jabatan }}</span></p>
                        </a>
                    </div>
                </li>
                @endforeach
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
                    <a href="{{ route('keanggotaan.index') }}" data-toggle="ajax" class="btn btn-primary btn-block">Lihat Kepengurusan <span class="fa fa-angle-double-right"></span></a>
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
            <div class="row event event-dark">
                @if($upcoming->count())
                    @foreach($upcoming as $event)
                    <div class="col-md-4">
                        <a href="{{ route('event.show', [$event->getWrappedObject(), $event->slug]) }}" data-toggle="ajax">
                            <div class="event-container">
                                <div class="event-poster" data-seed="{{ $event->getRouteKey() }}">
                                    @if($event->poster)
                                        <img src="{{ asset_version('media/images/'.$event->poster) }}" class="poster" alt="{{ $event->nama_acara }}" />
                                    @endif
                                </div>
                                <h3>{{ $event->nama_acara }}</h3>
                                <div class="event-info">
                                    <div class="event-time">
                                        <i class="fa fa-calendar"></i>
                                        <span>{{ $event->mulai_full }}</span>
                                    </div>
                                    <div class="event-place">
                                        <i class="fa fa-map-marker"></i>
                                        <span>{{ $event->tempat }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
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

        var palette = ["#048CCC", "#04A4EB", "#242424", "#146848"];
        function poly() {
            $('.event-container').each(function(i) {
                var thiss = $(this);
                var poster = thiss.find('.event-poster');

                if(poster.has('img').length < 1) {
                    var pattern = Trianglify({
                        width: poster.width(),
                        height: poster.height(),
                        seed: poster.data('seed'),
                        x_colors: palette,
                        color_space: 'rgb'
                    });

                    poster.empty();
                    poster.append(pattern.canvas());
                }
            });
        }

        $(document).ready(function() {
            App.scrollingText();

            $.getScript('{{ asset_link('js.jquery-bc-swipe') }}').done(function() {
                handleSwipeCarousel();
            });

            $.getScript('{{ asset_link('js.trianglify') }}').done(function() {
                poly();
                $('.event-poster canvas, .event-poster img').addClass('animated fadeIn');
                $('.event-poster').removeClass('loading');
            });

            $(window).on('resize', function() {
                poly();
            });
        });
    </script>
@stop
