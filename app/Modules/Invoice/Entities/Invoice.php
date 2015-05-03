<?php namespace HMIF\Modules\Invoice\Entities;

use Date;
use Hashids;
use HMIF\Entities\SoftDeleteBaseModel;
use McCool\LaravelAutoPresenter\HasPresenter;

class Invoice extends SoftDeleteBaseModel implements HasPresenter {

    protected $table      = 'tb_invoice';
    protected $primaryKey = 'id_invoice';

    protected $fillable = ['jumlah', 'nama_penerima', 'alamat', 'no_hp', 'email'];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'jumlah'        => 'integer',
        'nama_penerima' => 'string',
        'alamat'        => 'string',
        'no_hp'         => 'string',
        'email'         => 'string',
    ];

    public function invoiceable()
    {
        return $this->morphTo();
    }

    public function getPresenterClass()
    {
        return InvoicePresenter::class;
    }

    public function getRouteKey()
    {
        return Hashids::connection('invoice')->encode($this->getKey());
    }

}
