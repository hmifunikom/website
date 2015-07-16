@extends(((Request::ajax()) ? 'layouts.ajax' : 'layouts.master'))

@section('head')
    <style>
        #hero .content-bg {
            background-image: url({{ asset_version('assets/images/event-bg.jpg') }});
        }

        .event a, .event a:hover {text-decoration: none;}
        .event .event-container {
            border: #DCDCDC solid 1px;
            margin-bottom: 20px;
        }
        .event .event-container:hover {
            box-shadow: #DCDCDC 0 0 5px;
        }
        .event .event-container .event-poster {
            background-color: #444;
            height: 200px;
            overflow: hidden;
            width: 100%;
        }
        .event .event-container .event-poster img,
        .event .event-container .event-poster canvas {
            width: 100%;
        }
        .event .event-container .event-poster.loading img,
        .event .event-container .event-poster.loading canvas {
            opacity: 0;
        }
        .event .event-container h3 {
            font-size:18px;
            padding: 10px;
            margin: 0;
        }
        .event .event-container .event-place,
        .event .event-container .event-time {
            border-top: #DCDCDC solid 1px;
        }
        .event .event-container .fa {
            background-color: #F7F7F7;
            width: 35px;
            line-height: 35px;
            margin-right: 10px;
            display: inline-block;
            text-align: center;
            color: #333;
        }
        .event .event-container span {
            display: inline-block;
            color:#666;
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
            <h1>Event</h1>
            <h3><span class="fa fa-angle-double-down"></span></h3>
        </div>
        <!-- end container -->
    </div>
    <!-- end #hero -->

    <!-- begin #upcoming -->
    <div id="upcoming" class="content" data-scrollview="true">
        <!-- begin container -->
        <div class="container">
            <h2 class="content-title">Event Mendatang</h2>
            <div class="row event">
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
            </div>
        </div>
        <!-- end container -->
    </div>
    <!-- end #upcoming -->

    <!-- begin #all -->
    <div id="all" class="content" data-scrollview="true">
        <!-- begin container -->
        <div class="container">
            <h2 class="content-title">Semua Event</h2>
            <div class="row event">
                @foreach($events as $event)
                    <div class="col-md-4">
                        <a href="{{ route('event.show', [$event->getWrappedObject(), $event->slug]) }}" data-toggle="ajax">
                            <div class="event-container">
                                <div class="event-poster loading" data-seed="{{ $event->getRouteKey() }}">
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
            </div>
        </div>
        <!-- end container -->
    </div>
    <!-- end #all -->
@stop

@section('javascript')
    <script>
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
                    });

                    poster.empty();
                    poster.append(pattern.canvas());
                }
            });
        }

        $(document).ready(function() {
            $.getScript('{{ asset_version('assets/plugins/trianglify/trianglify.min.js') }}').done(function() {
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
