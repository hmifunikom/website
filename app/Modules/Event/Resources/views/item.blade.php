@extends(((Request::ajax()) ? 'layouts.ajax' : 'layouts.master'))

@section('head')
    <style>
        #event-hero {
            height: auto;
            position: relative;
        }

        .polygon-bg {
            background-color: #444;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 510px;
        }
        .polygon-bg.loading canvas {
            opacity: 0;
        }

        .event-content {
            padding-top: 320px;
            text-align: left;
        }
        .event-content.no-poster {
            padding-top: 600px;
        }
        .event-content .poster-container .poster {
            width:100%;
            width: 100%;
            border: 5px #fff solid;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .event-content .event-info {
            position: relative;
            margin-bottom: 30px;
        }
        .event-content .event-info .event-info-container {
            height: 100%;
            margin-bottom:30px;
            position:relative;
        }
        .event-content .event-info h1 {
            color:#333;
            font-size: 48px;
            line-height: 52px;
        }
        .event-content .event-info .event-info-container .row,
        .event-content .event-info .event-info-container .row .col-md-8,
        .event-content .event-info .event-info-container .row .col-md-4 {
            height: 100%;
            position:relative;
        }
        .event-content .event-info .event-info-container .row .col-md-8 {
            margin-bottom:30px;
        }
        .event-content .event-info .event-time .icon-holder,
        .event-content .event-info .event-place .icon-holder {
            background-color: #333;
            color:#fff;
            width: 50px;
            line-height: 50px;
            text-align: center;
            font-size: 1.5em;
            margin-right: 10px;
            margin-top: 10px;
        }

        .event-time div:not(.clear),
        .event-place div:not(.clear) {
            float: left;
            margin-top: 15px;
        }
        .event-time div p, .event-place div p {
            color:#333;
            font-size: 14px;
            margin:0;
        }

        .event-content .event-desc p {margin-bottom: 15px;}

        @media only screen and (min-width : 320px) {
        }
        @media only screen and (max-width : 767px) {
            .event-content .event-info h1 {
                font-size: 38px;
                line-height: 42px;
            }
        }
        @media only screen and (min-width : 768px) {

        }
        @media only screen and (min-width : 992px) {
            .event-content.no-poster {padding-top: 320px;}
            .event-content .poster-container .poster {margin-bottom:0;}
            .event-content .event-info {height: 250px;}
            .event-content .event-info .event-info-container {margin-bottom:0;}
            .event-content .event-info h1 {
                font-size: 38px;
                line-height: 42px;
                color:#fff;
                position:absolute;
                text-shadow:#333 0 0 3px;
            }
            .event-content .event-info .event-info-container .row .col-md-8 {margin-bottom:0;}
            .event-content .event-info .event-time .icon-holder,
            .event-content .event-info .event-place .icon-holder {
                background-color: #fff;
                color: #333;
            }
            .event-content .event-info .event-time {
                position: absolute;
                bottom: 75px;
            }
            .event-content .event-info .event-place,
            .event-content .event-info .event-book-btn {
                position: absolute;
                bottom: 10px;
            }
            .event-content .event-info .event-place {
                position: absolute;
                bottom: 10px;
            }
            .event-time div p, .event-place div p {
                color: #fff;
                text-shadow:#333 0 0 3px;
            }
        }
        @media only screen and (min-width : 1200px) {
            .event-content .event-info h1 {
                font-size: 48px;
                line-height: 52px;
            }
        }
    </style>
@stop

@section('content')
    <div id="event-hero" class="content has-bg hero" data-scrollview="true">
        <div class="polygon-bg loading"></div>
        <div itemscope itemtype="http://schema.org/Event" class="container home-content event-content @if(!$event->poster) no-poster @endif">
            <div class="row">
                @if($event->poster)
                <div class="col-md-3">
                    <div class="poster-container" data-animation="true" data-animation-type="fadeInUp">
                        <img itemprop="image" content="{{ asset_version('media/images/'.$event->poster) }}" data-src="{{ asset_version('media/images/'.$event->poster) }}" class="poster" alt="{{ $event->nama_acara }}" />
                    </div>
                </div>
                @endif
                <div class="@if($event->poster) col-md-9 @else col-md-12 @endif">
                    <div class="row event-info" data-animation="true" data-animation-type="fadeInRight">
                        <div class="col-md-12 event-info-container">
                            <h1 itemprop="name">{{ $event->nama_acara }}</h1>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="event-time">
                                        <div class="icon-holder">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <div>
                                            <p><strong>Waktu</strong></p>
                                            <meta itemprop="startDate" content="{{ $event->mulai_utc }}">
                                            <p>{{ $event->mulai_full }}</p>
                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="event-place">
                                        <div class="icon-holder">
                                            <i class="fa fa-map-marker"></i>
                                        </div>
                                        <div itemprop="location" itemscope itemtype="http://schema.org/Place">
                                            <p><strong>Tempat</strong></p>
                                            <p itemprop="name">{{ $event->tempat }}</p>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    @if($event->open_register && $tickets->count())
                                        <a id="register-btn" href="#register" data-click="scroll-to-target" class="event-book-btn btn btn-white btn-block">Daftar Sekarang</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row event-desc" data-animation="true" data-animation-type="fadeIn">
                        <div itemprop="description" class="col-md-12 event-desc-container">
                            {!! parsedown($event->info) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="countdown" class="content bg-black-darker has-bg" data-scrollview="true">
        <!-- begin container -->
        <div class="container">
            <!-- begin row -->
            <div class="row">
                @if($event->open_register)
                <?php $now = Date::now(); ?>
                <!-- begin col-3 -->
                <div class="col-md-3 col-sm-3 milestone-col">
                    <div class="milestone" data-animation="true" data-animation-type="fadeInLeft">
                        <div class="number hari">{{ $event->mulai->diff($now)->format('%a') }}</div>
                        <div class="title">Hari</div>
                    </div>
                </div>
                <!-- end col-3 -->
                <!-- begin col-3 -->
                <div class="col-md-3 col-sm-3 milestone-col">
                    <div class="milestone" data-animation="true" data-animation-type="fadeInLeft">
                        <div class="number jam">{{ $event->mulai->diff($now)->format('%H') }}</div>
                        <div class="title">Jam</div>
                    </div>
                </div>
                <!-- end col-3 -->
                <!-- begin col-3 -->
                <div class="col-md-3 col-sm-3 milestone-col">
                    <div class="milestone" data-animation="true" data-animation-type="fadeInLeft">
                        <div class="number menit">{{ $event->mulai->diff($now)->format('%I') }}</div>
                        <div class="title">Menit</div>
                    </div>
                </div>
                <!-- end col-3 -->
                <!-- begin col-3 -->
                <div class="col-md-3 col-sm-3 milestone-col">
                    <div class="milestone" data-animation="true" data-animation-type="fadeInLeft">
                        <div class="number detik">{{ $event->mulai->diff($now)->format('%S') }}</div>
                        <div class="title">Detik</div>
                    </div>
                </div>
                <!-- end col-3 -->
                @else
                <div class="col-md-12 col-sm-12 milestone-col">
                    <div class="milestone" data-animation="true" data-animation-type="fadeInLeft">
                        <div class="number">Event Telah Berakhir</div>
                    </div>
                </div>
                @endif
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>

    @if($event->open_register && $tickets->count())
    <div id="register" class="content" data-scrollview="true">
        <!-- begin container -->
        <div class="container">
            <h2 class="content-title" data-animation="true" data-animation-type="fadeInDown">Form Pendaftaran Peserta</h2>
            <!-- begin row -->
            <div class="row" data-animation="true" data-animation-type="fadeInDown">
                {!! Former::vertical_open()->route('event.store', [$event->getWrappedObject(), $event->slug])->data_pjax()->data_pjax_success('handleDaftar')->data_confirm('Anda yakin data yang diberikan sudah benar?') !!}
                <div class="col-md-6">
                    {!! Former::text('nama_peserta') !!}
                    {!! Former::text('alamat') !!}
                    {!! Former::email('email') !!}
                </div>
                <div class="col-md-6">
                    {!! Former::text('nim')->label('NIM *Isi jika mahasiswa Unikom') !!}
                    {!! Former::text('no_hp') !!}
                    {!! Former::select('tiket')->fromQuery($tickets, 'nama_tiket_full', 'id_tiket')->placeholder('Pilih tiket...') !!}
                </div>
                <div class="col-md-12">
                    <p></p><small>*</small> Konfirmasi dan tiket akan dikirimkan melalui alamat e-mail yang diberikan. Pastikan alamat e-mail tersebut aktif.</p>
                    {!! Former::actions( Button::primary('Daftar')->submit(), Button::withValue('Reset')->reset() ) !!}
                </div>
                {!! Former::close() !!}
            </div>
        </div>
    </div>
    @endif
@stop

@section('javascript')
    <script>
        function rgb2hex(rgbarray) {
            return '#' + rgbToHex(rgbarray[0], rgbarray[1], rgbarray[2]);
        }

        function rgbToHex(R, G, B) {
            return toHex(R) + toHex(G) + toHex(B)
        }

        function toHex(n) {
            n = parseInt(n, 10);
            if (isNaN(n)) return "00";
            n = Math.max(0, Math.min(n, 255));
            return "0123456789ABCDEF".charAt((n - n % 16) / 16) + "0123456789ABCDEF".charAt(n % 16);
        }

        var palette = ["#048CCC", "#04A4EB", "#242424", "#146848"];
        function poly() {
            var pattern = Trianglify({
                width: window.innerWidth,
                height: 510,
                seed: '{{ $event->getRouteKey() }}',
                x_colors: palette,
                color_space: 'rgb'
            });

            $('#event-hero .polygon-bg').empty();
            $('#event-hero .polygon-bg').append(pattern.canvas());
        }

        var imageLoaded = false, scriptLoaded = false;
        function fireImage(source) {
            if(source == 'img') {
                imageLoaded = true;
            }

            if(source == 'script') {
                scriptLoaded = true;
            }

            if(imageLoaded && scriptLoaded) {
                if($('.poster').length) {
                    var poster = $('.poster');
                    poster = poster[0];

                    var colorThief = new ColorThief();
                    palette = colorThief.getPalette(poster, 4);

                    for (var i = 0; i < palette.length; i++) {
                        palette[i] = rgb2hex(palette[i]);
                    }
                }

                poly();
                $('#event-hero .polygon-bg canvas').addClass('animated fadeIn');
                $('#event-hero .polygon-bg').removeClass('loading');
            }
        }

        var handleDaftar = function(data, status, xhr) {
            var email = $('[name=email]').val();

            bootbox.alert("Terima Kasih! E-mail konfirmasi sudah dikirimkan ke " + email + ".");
            $('#register, #register-btn').fadeOut(300, function() {
                $(this).remove();
            });
        }

        $(document).ready(function() {
            if($('.poster').length) {
                var poster = $('.poster');
                poster.load(function () {
                    fireImage('img');
                });
                poster.attr('src', poster.data('src'));
            } else {
                fireImage('img');
            }

            $.getScript('{{ asset_link('js.color-thief') }}').done(function() {
                $.getScript('{{ asset_link('js.trianglify') }}').done(function() {
                    fireImage('script');
                });
            });

            $.getScript('{{ asset_link('js.jquery-countdown') }}').done(function() {
                $('#countdown').countdown('{{ $event->mulai }}', function(event) {
                    $('.milestone .hari').text(event.strftime('%D'));
                    $('.milestone .jam').text(event.strftime('%H'));
                    $('.milestone .menit').text(event.strftime('%M'));
                    $('.milestone .detik').text(event.strftime('%S'));
                });
            });

            $(window).on('resize', function() {
                if(imageLoaded && scriptLoaded) {
                    poly();
                }
            });
        });
    </script>
    <script src="{{ asset_link('js.bootbox') }}"></script>
    <script src="{{ asset_link('js.jquery-form') }}"></script>
@stop
