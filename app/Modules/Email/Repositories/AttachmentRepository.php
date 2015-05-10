<?php namespace HMIF\Modules\Email\Repositories;

use HMIF\Repositories\BaseRepository;

class AttachmentRepository extends BaseRepository {

    protected $fieldSearchable = [

    ];

    function model()
    {
        return 'HMIF\Modules\Email\Entities\Attachment';
    }

}
