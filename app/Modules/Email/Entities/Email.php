<?php namespace HMIF\Modules\Email\Entities;

use Hashids;
use HMIF\Entities\BaseModel;
use HMIF\Modules\Email\Presenters\EmailPresenter;
use McCool\LaravelAutoPresenter\HasPresenter;

class Email extends BaseModel implements HasPresenter {

    protected $table      = 'tb_email';
    protected $primaryKey = 'id_email';

    protected $fillable = ['from', 'to', 'subject', 'text', 'type', 'date'];

    public $timestamps = false;

    protected $dates = ['date'];

    protected $casts = [
        'from'    => 'string',
        'top'     => 'string',
        'subject' => 'string',
        'text'    => 'string',
    ];

    public function attachment()
    {
        return $this->hasMany('HMIF\Modules\Email\Entities\Attachment', 'id_email');
    }

    public function getPresenterClass()
    {
        return EmailPresenter::class;
    }

    public function getRouteKey()
    {
        return Hashids::connection('email')->encode($this->getKey());
    }

}
