<?php namespace HMIF\Modules\Keanggotaan\Entities;

use HMIF\Entities\BaseModel;
use HMIF\Modules\Keanggotaan\Presenters\DivisiPresenter;
use McCool\LaravelAutoPresenter\HasPresenter;

class Divisi extends BaseModel implements HasPresenter {

    protected $table      = 'tb_keanggotaan_divisi';
    protected $primaryKey = 'id_divisi';

    protected $fillable = ['divisi', 'singkatan'];

    protected $casts = [
        'divisi'    => 'string',
        'singkatan' => 'string',
    ];

    public function anggota()
    {
        return $this->hasMany('HMIF\Modules\Keanggotaan\Entities\Divisi', 'id_divisi')->where('id_anggota', '!=', $this->id_penanggung_jawab);
    }

    public function penanggung_jawab()
    {
        return $this->belongsTo('HMIF\Modules\Keanggotaan\Entities\Anggota', 'id_penanggung_jawab');
    }

    public function getPresenterClass()
    {
        return DivisiPresenter::class;
    }

    public function getRouteKey()
    {
        return strtolower($this->singkatan);
    }

}
