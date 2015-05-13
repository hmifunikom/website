<?php namespace HMIF\Modules\Invoice\Entities;

use Hashids;
use HMIF\Entities\SoftDeleteBaseModel;
use HMIF\Modules\Email\Entities\EmailAttachmentable;
use HMIF\Modules\Invoice\Presenters\InvoicePresenter;
use McCool\LaravelAutoPresenter\HasPresenter;

class Invoice extends SoftDeleteBaseModel implements HasPresenter, EmailAttachmentable {

    protected $table      = 'tb_invoice';
    protected $primaryKey = 'id_invoice';

    protected $fillable = ['judul', 'jumlah', 'nama_penerima', 'alamat', 'no_hp', 'email'];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'judul'         => 'string',
        'jumlah'        => 'integer',
        'nama_penerima' => 'string',
        'alamat'        => 'string',
        'no_hp'         => 'string',
        'email'         => 'string',
        'dibayar'       => 'boolean',
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

    public function getAttachmentFullPath()
    {
        return storage_path('app/invoices/' . $this->getRouteKey() . '.pdf');
    }

    public function getAttachmentType()
    {
        return 'invoice';
    }
}
