@extends(((Request::ajax()) ? 'layouts.ajax' : 'layouts.default'))

@section('head')
    <meta property="fb:profile_id"   content="433175063394714" /> 
    <meta property="og:type"   content="website" /> 
    <meta property="og:url"    content="{{ Request::url() }}" /> 
    <meta property="og:site_name"  content="Event HMIF Unikom" /> 
    <meta property="og:title"  content="{{ $event->nama_acara }}" /> 
    @if($event->poster)
    <meta property="og:image"  content="{{ asset('media/images/'.$event->poster) }}" /> 
    @endif
    <meta property="og:description" content="{{ $event->nama_acara }} by HMIF Unikom"/>
@stop

@section('content')
    @if(!Request::ajax())
    <div class="jumbotron event">
        <div class="container">
            <h2>Event HMIF</h2>
            <!--p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p-->
        </div>
    </div>
    @endif

    <div id="event" class="big-container">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    {!!
                        Button::withValue('&laquo Kembali')->asLinkTo(route('event.index', array('month' => $event->mulai->month, 'year' => $event->mulai->year)).'#event')->large()
                    !!}
                </div>
                <div class="col-md-6 right">
                    <div class="social-buttons">
                        <div class="btn-fb">
                            <div class="fb-share-button" data-href="{{ Request::url() }}" data-type="button"></div>
                        </div>

                        <div class="btn-tw">
                            <a href="https://twitter.com/share" class="twitter-share-button" data-url="{{ Request::url() }}" data-text="{{ $event->nama_acara }} - HMIF Unikom" data-via="hmifunikom" data-lang="id" data-related="hmifunikom" data-count="none" data-hashtags="EventHMIFUnikom">Tweet</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="event-view">
                <div class="event-item-container">
                    <div class="event-container js-affix-top">
                        <div class="info-container pull-left js-affix">
                            <div class="row"><div class="date">
                                <div class="day">{{ $event->mulai->day }}</div>
                                <div class="month-year">
                                    <div class="month">{{ $event->mulai->formatLocalized('%b') }}</div>
                                    <div class="year">{{ $event->mulai->year }}</div>
                                </div>
                            </div></div>
                            <div class="row"><div class="time"><span class="fa fa-clock-o"></span>
                                {{--<span class="text">{{ Helper::implode($event->waktu, 'waktu') }}</span>--}}
                            </div></div>
                            <div class="row"><div class="place"><span class="fa fa-map-marker"></span><span class="text">{{ $event->tempat }}</span></div></div>
                        </div>
                        <div class="detail-container pull-right">
                            <div class="name-description">
                                <div class="name">
                                    <span>{{ $event->nama_acara }}</span>
                                </div>
                                <div class="description">
                                    {!! parsedown($event->info) !!}
                                </div>

                                @if($event->poster)
                                <div class="poster">
                                    <img src="{{ asset('media/images/'.$event->poster) }}" alt="{{ $event->nama_acara }} Poster" class="img-thumbnail">
                                </div>
                                @endif

                                
                                <a class="btn btn-default btn-lg book-btn" href="{{ route('event.book.create', $event->slug) }}" role="button">{!! fa('ticket') !!} Pesan Tiket</a>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                        <div class="clearfix js-affix-bottom"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('tagline')
    @include('includes.tagline', array('invert' => true))
@stop