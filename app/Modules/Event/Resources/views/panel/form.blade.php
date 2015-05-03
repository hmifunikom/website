{!! Former::text('nama_acara') !!}
{!! Former::text('tempat') !!}
{!! Former::text('mulai_tanggal')->class('form-control datepicker-autoClose')->data_date_start_date('Date.default')->append(Icon::calendar()) !!}
<div class="form-group">
    {!! Former::label('Mulai waktu', 'mulai_waktu')->class('control-label col-lg-4 col-sm-6') !!}
    <div class="col-md-8">
        <div class="input-group bootstrap-timepicker">
            <input id="mulai_waktu" type="text" class="form-control timepicker" name="mulai_waktu" />
            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
        </div>
    </div>
</div>
{!! Former::textarea('info')->data_provide('markdown')->data_iconlibrary("fa") !!}
{!! Former::text('pj') !!}
{!! Former::actions( Button::primary('Simpan')->submit(), Button::withValue('Reset')->reset() ) !!}