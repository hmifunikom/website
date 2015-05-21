<?php namespace HMIF\Modules\Keanggotaan\Entities;

use HMIF\Entities\SoftDeleteBaseModel;
use HMIF\Modules\Keanggotaan\Presenters\AnggotaPresenter;
use McCool\LaravelAutoPresenter\HasPresenter;

class Anggota extends SoftDeleteBaseModel implements HasPresenter {

    protected $table      = 'tb_keanggotaan';
    protected $primaryKey = 'id_anggota';

    protected $fillable = ['nim', 'nama', 'alamat', 'asal', 'status_hima'];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'nim'         => 'string',
        'nama'        => 'string',
        'alamat'      => 'string',
        'asal'        => 'string',
        'status_hima' => 'string',
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

}
