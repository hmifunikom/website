<?php namespace HMIF\Modules\Library\Repositories;

use HMIF\Repositories\BaseRepository;

class BookRepository extends BaseRepository {

    protected $fieldSearchable = [
        'Kode_buku',
        'Judul_buku' => 'like',
        'Pengarang' => 'like',
        'Penerbit' => 'like',
    ];

    function model()
    {
        return 'HMIF\Modules\Library\Entities\Book';
    }

}
