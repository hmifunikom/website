@extends(((Request::ajax()) ? 'layouts.ajax' : 'layouts.master'))

@section('head')
    <style>
        #hero .content-bg {
            background-image: url({{ asset_version('assets/images/keanggotaan-bg.jpg') }});
        }

        #divisi {
            position: relative;
            z-index: 100;
        }
        #divisi .btn {padding: 10px 20px;}
        .divisi-nav {overflow-x: auto;}

        .team .image img {width: 100%;}

        .subteam {
            text-align: left;
            padding: 0;
        }

        .subteam .image img {max-width: 150px;}
        .subteam .info {margin-left: 20px;}

        .lowteam .image img {max-width: 64px;}
        .lowteam .info {margin-top: 10px;}
        .lowteam .name {font-size: 18px;}

        @media only screen and (min-width : 320px) {
            #divisi {
                padding-bottom: 20px;
                padding-top: 20px;
            }
            .lowteam .info {width: 210px;}
        }
        @media only screen and (max-width : 767px) {
            .sublead .pull-left {float: none !important;}
            .sublead .subteam {text-align:center}
            .sublead .subteam .info {margin-left:0;}
        }
        @media only screen and (min-width : 768px) {
            .sublead {margin-bottom: 30px}
        }
        @media only screen and (min-width : 992px) {
            .lowteam .info {width: 210px;}
        }
        @media only screen and (min-width : 1200px) {
            .lowteam .info {width: 270px;}
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
            <h1>Keanggotaan</h1>
            <h3><span class="fa fa-angle-double-down"></span></h3>
        </div>
        <!-- end container -->
    </div>
    <!-- end #hero -->

    <!-- begin #inti -->
    <div id="inti" class="content" data-scrollview="true">
        <!-- begin container -->
        <div class="container">
            <h2 class="content-title">Kepengurusan 2014/2015</h2>
            <!-- begin row -->
            <div class="row">
                <?php $i = 0; ?>
                @foreach($divisi as $div)
                    <?php if($i > 3) break; ?>
                    <div class="col-md-3">
                        <div class="team">
                            <div class="image flipInX contentAnimated" data-animation="true" data-animation-type="flipInX">
                                <img src="{{ $div->penanggung_jawab->avatar }}" alt="{{ $div->penanggung_jawab->nama }}">
                            </div>
                            <div class="info">
                                <h3 class="name">{{ $div->penanggung_jawab->nama }}</h3>
                                <div class="title text-theme">{{ $div->penanggung_jawab->jabatan }}</div>
                                <div class="social">
                                    @if($div->penanggung_jawab->link_facebook)
                                    <a href="{{ $div->penanggung_jawab->link_facebook }}"><i class="fa fa-facebook fa-lg fa-fw"></i></a>
                                    @endif
                                    @if($div->penanggung_jawab->link_twitter)
                                    <a href="{{ $div->penanggung_jawab->link_twitter }}"><i class="fa fa-twitter fa-lg fa-fw"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $i++; ?>
                @endforeach
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end #inti -->

    <!-- begin #divisi -->
    <div id="divisi" class="content has-bg bg-black-darker" data-scrollview="true">
        <!-- begin container -->
        <div class="container">
            <div class="text-center divisi-nav">
                <div class="nav btn-group">
                    <?php $i = 0; ?>
                    @foreach($divisi as $div)
                        <?php $i++; ?>
                        <?php if($i < 5) continue; ?>
                        <a href="#{{ $div->singkatan }}" class="btn btn-white">{{ $div->singkatan }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- end container -->
    </div>
    <!-- end #divisi -->

    <?php $j = 0; ?>
    @foreach($divisi as $div)
        <?php $j++; ?>
        <?php if($j < 5) continue; ?>
    <!-- begin #{{ $div->singkatan }} -->
    <div id="{{ $div->singkatan }}" class="content divisi-container" data-scrollview="true">
        <!-- begin container -->
        <div class="container">
            <h2 class="content-title" data-animation="true" data-animation-type="fadeInDown">{{ $div->divisi }}</h2>
            <!-- begin row -->
            <div class="row sublead" data-animation="true" data-animation-type="@if($j%2) fadeInLeft @else fadeInRight @endif">
                <div class="col-md-12">
                    <div class="pull-left">
                        <div class="team subteam">
                            <div class="image flipInX contentAnimated" data-animation="true" data-animation-type="flipInX">
                                <img src="{{ $div->penanggung_jawab->avatar }}" alt="{{ $div->penanggung_jawab->nama }}">
                            </div>
                        </div>
                    </div>
                    <div class="pull-left">
                        <div class="team subteam">
                            <div class="info">
                                <h3 class="name">{{ $div->penanggung_jawab->nama }}</h3>
                                <div class="title text-theme">{{ $div->penanggung_jawab->jabatan }}</div>
                                <div class="social">
                                    @if($div->penanggung_jawab->link_facebook)
                                        <a href="{{ $div->penanggung_jawab->link_facebook }}"><i class="fa fa-facebook fa-lg fa-fw"></i></a>
                                    @endif
                                    @if($div->penanggung_jawab->link_twitter)
                                        <a href="{{ $div->penanggung_jawab->link_twitter }}"><i class="fa fa-twitter fa-lg fa-fw"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <!-- begin row -->
            <div class="row" data-animation="true" data-animation-type="@if($j%2) fadeInLeft @else fadeInRight @endif">
                <?php $i = 1; ?>
                @foreach($div->anggota->sortBy('nama') as $anggota)
                    <?php if($anggota->id_anggota == $div->id_penanggung_jawab) continue; ?>
                    <div class="col-md-4">
                        <div class="pull-left">
                            <div class="team subteam lowteam">
                                <div class="image flipInX contentAnimated" data-animation="true" data-animation-type="flipInX">
                                    <img src="{{ $anggota->avatar }}" alt="{{ $anggota->nama }}">
                                </div>
                            </div>
                        </div>
                        <div class="pull-left">
                            <div class="team subteam lowteam">
                                <div class="info">
                                    <h3 class="name">{{ $anggota->nama }}</h3>
                                    <div class="title text-theme">{{ $anggota->status_hima }}</div>
                                    <div class="social">
                                        @if($anggota->link_facebook)
                                            <a href="{{ $anggota->link_facebook }}"><i class="fa fa-facebook fa-lg fa-fw"></i></a>
                                        @endif
                                        @if($anggota->link_twitter)
                                            <a href="{{ $anggota->link_twitter }}"><i class="fa fa-twitter fa-lg fa-fw"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    @if(!($i%3))<div class="clear"></div>@endif
                    <?php $i++; ?>
                @endforeach
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end #{{ $div->singkatan }} -->
    @endforeach
@stop

@section('javascript')
    <script>
        $(document).ready(function() {
            App.init();

            $('.divisi-nav a').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var thiss = $(this);
                var target = thiss.attr('href');
                var headerHeight = 50 + $('#divisi').outerHeight();
                $('html, body').animate({
                    scrollTop: $(target).offset().top - headerHeight
                }, 500, function() {
                    thiss.blur();
                });
            });

            var offsetdivisi = $('#divisi').offset().top - 50;
            $(window).scroll(function() {
                var windscroll = $(window).scrollTop();
                if (windscroll >= offsetdivisi) {
                    $('nav').addClass('fixed');
                    $('.divisi-container').each(function(i) {
                        if ($(this).position().top <= windscroll + (50 + $('#divisi').outerHeight())) {
                            $('.divisi-nav a.active').removeClass('active');
                            $('.divisi-nav a').eq(i).addClass('active');
                        }
                    });
                } else {
                    $('.divisi-nav a').removeClass('active');
                }
            });

            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                var divisi_nav_width = 0;
                $('.divisi-nav .nav a').each(function() {
                    divisi_nav_width += $(this).outerWidth();
                });

                $('.divisi-nav .nav').width(divisi_nav_width);
            }

            $.getScript('{{ asset_version('assets/plugins/jquery-sticky/jquery.sticky.min.js') }}').done(function() {
                $("#divisi").sticky({topSpacing:50});
            });
        });
    </script>
@stop
