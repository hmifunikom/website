<?php namespace HMIF\Modules\Email\Entities;

use Hashids;
use HMIF\Entities\BaseModel;
use HMIF\Modules\Email\Presenters\AttchmentPresenter;
use McCool\LaravelAutoPresenter\HasPresenter;

class Attachment extends BaseModel implements HasPresenter {

    protected $table      = 'tb_email_attachment';
    protected $primaryKey = 'id_attachment';

    protected $fillable = ['filename', 'filepath', 'mime'];

    public $timestamps = false;

    protected $casts = [
        'filename' => 'string',
        'filepath' => 'string',
        'mime'     => 'string',
    ];

    public function email()
    {
        return $this->belongsTo('HMIF\Modules\Email\Entities\Email', 'id_email');
    }

    public function getPresenterClass()
    {
        return AttchmentPresenter::class;
    }

    public function getRouteKey()
    {
        return Hashids::connection('email')->encode($this->getKey(), $this->id_email);
    }

}
