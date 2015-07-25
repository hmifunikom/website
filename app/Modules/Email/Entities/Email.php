<?php namespace HMIF\Modules\Email\Entities;

use Hashids;
use HMIF\Entities\SoftDeleteBaseModel;
use HMIF\Modules\Email\Presenters\EmailPresenter;
use McCool\LaravelAutoPresenter\HasPresenter;

class Email extends SoftDeleteBaseModel implements HasPresenter {

    protected $table      = 'tb_email';
    protected $primaryKey = 'id_email';

    protected $fillable = ['email_from', 'email_to', 'subject', 'header', 'text', 'html', 'type', 'readed', 'date'];

    protected $dates = ['date', 'deleted_at'];

    protected $casts = [
        'email_from' => 'string',
        'email_to'   => 'string',
        'subject'    => 'string',
        'header'     => 'array',
        'text'       => 'string',
        'html'       => 'string',
        'readed'       => 'boolean'
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
