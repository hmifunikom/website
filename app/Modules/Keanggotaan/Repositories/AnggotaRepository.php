<?php namespace HMIF\Modules\Keanggotaan\Repositories;

use HMIF\Repositories\BaseRepository;

class AnggotaRepository extends BaseRepository {

    protected $fieldSearchable = [
        'nim',
        'nama' => 'like',
    ];

    function model()
    {
        return 'HMIF\Modules\Keanggotaan\Entities\Anggota';
    }

}
