@extends(((Request::ajax()) ? 'layouts.ajax' : 'layouts.default'))

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
            @include('includes.alert')

            <div class="row">
                <div class="col-md-6">
                    {{
                        Button::lg_link(URL::route('event.show', $event->slug), '&laquo Kembali')
                    }}
                </div>
                <div class="col-md-6 right">
                    {{
                        Button::lg_primary_link(URL::route('event.book.download', array($event->slug, $ticket->ticket)), Helper::fa('download').' Download Tiket')
                    }}
                </div>
            </div>
            <div class="ticket">
                <div class="row">
                    <div class="col-md-3 qr-col">
                        <img src="{{ asset('media/qr/'.$ticket->ticket.'.jpg') }}" width="100%" />
                        <div class="center"><strong>{{ Helper::code($ticket->kode) }}</strong></div>
                    </div>
                    <div class="col-md-9">
                        <div class="big-title">{{ $event->nama_acara }}</div>
                        {{ 
                            Typography::horizontal_dl(
                                array(
                                    'Tempat'          => $event->tempat,
                                    'Tanggal & Waktu' => $event->tgl->toDateString().' @ '.Helper::implode($event->waktu, 'waktu'),
                                )
                            )
                        }}

                        {{ 
                            Typography::horizontal_dl(
                                array(
                                    'Nama Peserta' => $ticket->nama_peserta,
                                    'Kategori'     => Lang::get('messages.event.'.$ticket->kategori),
                                    'NIM'          =>  $ticket->nim,
                                )
                            )
                        }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop