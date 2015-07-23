<?php namespace HMIF\Modules\Invoice\Entities;

use Hashids;
use HMIF\Entities\SoftDeleteBaseModel;
use HMIF\Modules\Email\Entities\EmailAttachmentable;

class InvoiceRaw extends SoftDeleteBaseModel implements EmailAttachmentable {

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
        return $this->morphTo('invoiceable')->withTrashed();
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
