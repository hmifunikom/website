<?php namespace HMIF\Modules\Event\Entities;

use Hashids;
use HMIF\Entities\SoftDeleteBaseModel;
use HMIF\Modules\Event\Presenters\TicketPresenter;
use McCool\LaravelAutoPresenter\HasPresenter;

class Ticket extends SoftDeleteBaseModel implements HasPresenter {

    protected $table      = 'tb_acara_tiket';
    protected $primaryKey = 'id_tiket';

    protected $fillable = ['nama_tiket', 'kuota', 'harga', 'ktm'];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'nama_tiket' => 'string',
        'kuota'      => 'integer',
        'harga'      => 'integer',
        'ktm'        => 'boolean',
    ];

    public function event()
    {
        return $this->belongsTo('HMIF\Modules\Event\Entities\Event', 'id_acara')->withTrashed();
    }

    public function attendee()
    {
        return $this->hasMany('HMIF\Modules\Event\Entities\Attendee', 'id_tiket');
    }

    public function getPresenterClass()
    {
        return TicketPresenter::class;
    }

    public function getRouteKey()
    {
        return Hashids::connection('event')->encode($this->getKey(), $this->id_acara);
    }

}
