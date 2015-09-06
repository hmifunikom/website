<div class="form-group">
    <label class="col-md-4 control-label">Nama</label>
    <div class="col-md-8">
        <p class="form-control-static">{{ $anggota->nama }}</p>
    </div>
</div>
<div class="form-group">
    <label class="col-md-4 control-label">Jabatan</label>
    <div class="col-md-8">
        <p class="form-control-static">{{ $anggota->jabatan }}</p>
    </div>
</div>
{!!
    Former::select('jenis_kelamin')->options([
        'Laki-laki' => 'Laki-laki',
        'Perempuan' => 'Perempuan',
    ]);
!!}
{!! Former::text('tempat_lahir') !!}
{!! Former::text('tanggal_lahir')->class('form-control datepicker-autoClose')->append(Icon::calendar()) !!}
{!! Former::text('alamat')->inlineHelp('Alamat tinggal saat ini') !!}
{!!
    Former::select('agama')->options([
        'Islam' => 'Islam','Kristen Protestan' => 'Kristen Protestan','Kristen Katolik' => 'Kristen Katolik','Budha' => 'Budha','Hindu' => 'Hindu','Konghucu' => 'Konghucu'
    ]);
!!}
{!! Former::text('no_hp') !!}
{!! Former::email('email') !!}
{!! Former::text('facebook')->inlineHelp('Username atau alamat facebook') !!}
{!! Former::text('twitter')->inlineHelp('Username atau alamat twitter') !!}
{!! Former::actions( Button::primary('Simpan')->submit(), Button::withValue('Reset')->reset() ) !!}