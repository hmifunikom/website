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
{!! Former::text('email') !!}
{!! Former::password('password') !!}
{!! Former::password('password_confirmation') !!}
{!!
    Former::select('role')->options([
        '' => 'Pilih Hak Akses',
        '1' => 'Administrator',
        '2' => 'Anggota HMIF',
    ]);
!!}
{!! Former::actions( Button::primary('Simpan')->submit(), Button::withValue('Reset')->reset() ) !!}