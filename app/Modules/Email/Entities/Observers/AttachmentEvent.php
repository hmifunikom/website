<?php namespace HMIF\Modules\Email\Entities\Observers;

use Storage;

class AttachmentEvent {
    public function deleting($model)
    {
        $filepath = 'mail/' . $model->filepath;
        Storage::delete($filepath);
    }
}
