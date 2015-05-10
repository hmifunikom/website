<?php namespace HMIF\Modules\Event\Entities;

use Date;
use Hashids;
use HMIF\Entities\SoftDeleteBaseModel;
use HMIF\Modules\Event\Presenters\AttendeePresenter;
use McCool\LaravelAutoPresenter\HasPresenter;

class Attendee extends SoftDeleteBaseModel implements HasPresenter {

    protected $table      = 'tb_acara_peserta';
    protected $primaryKey = 'id_peserta';

    protected $fillable = ['nama_peserta', 'alamat', 'nim', 'no_hp', 'email'];

    protected $dates = ['mulai', 'deleted_at'];

    protected $casts = [
        'nama_peserta' => 'string',
        'alamat'       => 'string',
        'nim'          => 'string',
        'no_hp'        => 'string',
        'email'        => 'string',
        'kode'         => 'integer',
    ];

    public function ticket()
    {
        return $this->belongsTo('HMIF\Modules\Event\Entities\Ticket', 'id_tiket');
    }

    public function invoice()
    {
        return $this->morphOne('HMIF\Modules\Invoice\Entities\Invoice', 'invoiceable');
    }

    public function getPresenterClass()
    {
        return AttendeePresenter::class;
    }

    public function getRouteKey()
    {
        return Hashids::connection('ticket')->encode($this->getKey(), $this->id_tiket);
    }
}
