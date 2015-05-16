<?php namespace HMIF\Modules\Event\Entities;

use Date;
use Hashids;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use HMIF\Entities\SoftDeleteBaseModel;
use HMIF\Modules\Event\Presenters\EventPresenter;
use McCool\LaravelAutoPresenter\HasPresenter;

class Event extends SoftDeleteBaseModel implements HasPresenter, SluggableInterface {

    use SluggableTrait;

    protected $table      = 'tb_acara';
    protected $primaryKey = 'id_acara';

    protected $fillable = ['nama_acara', 'mulai', 'tempat', 'info', 'pj', 'poster'];

    protected $dates = ['mulai', 'deleted_at'];

    protected $sluggable = ['build_from' => 'nama_acara'];

    protected $casts = [
        'nama_acara' => 'string',
        'tempat'     => 'string',
        'tempat'     => 'string',
        'info'       => 'string',
        'pj'         => 'string',
        'poster'     => 'string',
    ];

    public function ticket()
    {
        return $this->hasMany('HMIF\Modules\Event\Entities\Ticket', 'id_acara');
    }

    public function attendee()
    {
        $this->hasManyThrough('HMIF\Modules\Event\Entities\Attendde', 'HMIF\Modules\Event\Entities\Ticket');
    }

    public function getPresenterClass()
    {
        return EventPresenter::class;
    }

    public function getRouteKey()
    {
        return Hashids::encode($this->getKey());
    }

    public function setMulaiAttribute($value)
    {
        $this->attributes['mulai'] = Date::parse($value);
    }
}
