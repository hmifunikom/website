{!! Former::text('nama_peserta') !!}
{!! Former::text('nim')->inlineHelp('Isi jika mahasiswa Unikom') !!}
{!! Former::text('alamat') !!}
{!! Former::text('no_hp') !!}
{!! Former::email('email') !!}
{!! Former::select('tiket')->fromQuery($tickets, 'nama_tiket', 'id_tiket')->placeholder('Pilih tiket...') !!}
@unless(isset($viewedit))
{!! Former::checkbox('bayar')->text('Langsung bayar') !!}
@endunless
{!! Former::actions( Button::primary('Simpan')->submit(), Button::withValue('Reset')->reset() ) !!}