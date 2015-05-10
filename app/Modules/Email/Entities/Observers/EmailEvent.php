<?php namespace HMIF\Modules\Email\Entities\Observers;

use Storage;

class EmailEvent {
    public function deleting($model)
    {
        $attachments = $model->attachment;

        foreach($attachments as $attachment)
        {
            $attachment->delete();
        }
    }
}
