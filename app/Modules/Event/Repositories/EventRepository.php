<?php namespace HMIF\Modules\Event\Repositories;

use HMIF\Repositories\BaseRepository;

class EventRepository extends BaseRepository {

    protected $fieldSearchable = [
        'nama_acara',
    ];

    function model()
    {
        return 'HMIF\Modules\Event\Entities\Event';
    }

}
