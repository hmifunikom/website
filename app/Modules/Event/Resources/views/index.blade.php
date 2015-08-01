@extends(((Request::ajax()) ? 'layouts.ajax' : 'layouts.master'))

@section('head')
    <style>
        #hero .content-bg {
            background-image: url({{ asset_version('assets/images/event-bg.jpg') }});
        }

        .event .quote small {
            color: #000;
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
                    <div class="col-md-12 quote">
                        <small>Tidak ada event yang akan datang. Stay tuned.</small>
                    </div>
                @endif
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
                        color_space: 'rgb'
                    });

                    poster.empty();
                    poster.append(pattern.canvas());
                }
            });
        }

        $(document).ready(function() {
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
