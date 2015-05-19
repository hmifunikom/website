<?php namespace HMIF\Modules\Library\Entities;

use HMIF\Entities\BaseModel;

class Book extends BaseModel {

    protected $connection = 'perpus';

    protected $table      = 't_data_buku';
    protected $primaryKey = 'Kode_buku';

    protected $casts = [
        'Kode_buku'    => 'string',
        'Nama_jenis'   => 'string',
        'Judul_buku'   => 'string',
        'Pengarang'    => 'string',
        'Penerbit'     => 'string',
        'Tahun_terbit' => 'string',
        'Jumlah'       => 'integer',
    ];

}
