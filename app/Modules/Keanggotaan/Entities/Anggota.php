<?php namespace HMIF\Modules\Keanggotaan\Entities;

use Date;
use HMIF\Entities\SoftDeleteBaseModel;
use HMIF\Modules\Keanggotaan\Presenters\AnggotaPresenter;
use McCool\LaravelAutoPresenter\HasPresenter;

class Anggota extends SoftDeleteBaseModel implements HasPresenter {

    protected $table      = 'tb_keanggotaan';
    protected $primaryKey = 'id_anggota';

    protected $fillable = ['nim', 'nama', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'agama', 'alamat', 'email', 'no_hp', 'facebook', 'twitter', 'status_hima'];

    protected $dates = ['tanggal_lahir', 'deleted_at'];

    protected $casts = [
        'nim'   => 'string',
        'no_hp' => 'string',
    ];

    protected $with = ['divisi'];

    public function divisi()
    {
        return $this->belongsTo('HMIF\Modules\Keanggotaan\Entities\Divisi', 'id_divisi');
    }

    public function user()
    {
        return $this->morphOne('HMIF\Modules\User\Entities\User', 'userable');
    }

    public function getPresenterClass()
    {
        return AnggotaPresenter::class;
    }

    public function getRouteKey()
    {
        return $this->nim;
    }

    public function setTanggalLahirAttribute($value)
    {
        $this->attributes['tanggal_lahir'] = Date::parse($value);
    }

}
