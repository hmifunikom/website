<?php namespace HMIF\Modules\Invoice\Repositories;

use HMIF\Repositories\BaseRepository;

class InvoiceRepository extends BaseRepository {

    protected $fieldSearchable = [
        'judul' => 'like',
        'nama_penerima' => 'like',
        'email' => 'like'
    ];

    function model()
    {
        return 'HMIF\Modules\Invoice\Entities\Invoice';
    }

    public function setPaid($id)
    {
        return $this->setBoolean($id, 'dibayar');
    }

    public function setUnpaid($id)
    {
        return $this->setBoolean($id, 'dibayar', false);
    }

}
