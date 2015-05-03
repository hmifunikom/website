<?php namespace HMIF\Modules\Invoice\Repositories;

use HMIF\Repositories\BaseRepository;

class InvoiceRepository extends BaseRepository {

    protected $fieldSearchable = [

    ];

    function model()
    {
        return 'HMIF\Modules\Invoice\Entities\Invoice';
    }

}
