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
            {{
                Button::lg_link(URL::route('event.show', $acara->slug), '&laquo Kembali')
            }}

            <h2>Pesan tiket</h2>

            @if($acara->sisa_kuota_unikom() > 0 OR $acara->sisa_kuota_umum() > 0)
                @include('includes.alert')

                {{
                    Former::open()
                        ->route('event.book.store', $acara->kd_acara)
                }}
                    <div class="form-group">
                        <label class="control-label col-lg-2 col-sm-4">Acara</label>
                        <div class="col-lg-10 col-sm-8">
                            <p class="form-control-static">{{ $acara->nama_acara }}</p>
                        </div>
                    </div>
                    {{ Former::text('nama_peserta') }}
                    {{ Former::text('alamat') }}
                    <?php
                        $kategori = [
                            'unikom' => 'Unikom (sisa '. $acara->sisa_kuota_unikom().')',
                            'luar'   => 'Umum (sisa '. $acara->sisa_kuota_umum() .')',
                        ]
                    ?>
                    {{ 
                        Former::select('kategori')->options($kategori)
                    }}
                    {{ Former::text('nim')->inlineHelp('Kosongkan jika kategori umum') }}
                    {{ Former::text('no_hp')}}
                    {{ Former::text('email')}}
                    {{ Former::actions( Button::primary_submit('Pesan'), Button::reset('Reset') ) }}
                {{ Former::close() }}
            @else
                <div class="big-title center">Maaf, tiket sudah habis.</div>
            @endif
        </div>
    </div>
@stop