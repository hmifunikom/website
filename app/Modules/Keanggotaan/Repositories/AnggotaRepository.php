<?php namespace HMIF\Modules\Keanggotaan\Repositories;

use HMIF\Repositories\BaseRepository;

class AnggotaRepository extends BaseRepository {

    protected $fieldSearchable = [

    ];

    function model()
    {
        return 'HMIF\Modules\Keanggotaan\Entities\Anggota';
    }

}
