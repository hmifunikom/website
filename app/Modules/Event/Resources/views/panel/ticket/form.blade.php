{!! Former::text('nama_tiket') !!}
{!! Former::text('kuota') !!}
{!! Former::number('harga')->prepend('Rp')->inlineHelp('Masukkan hanya angka')->step(1000) !!}
{!! Former::checkbox('ktm')->text('Memerlukan KTM')->label('KTM') !!}
{!! Former::actions( Button::primary('Simpan')->submit(), Button::withValue('Reset')->reset() ) !!}