<?php namespace HMIF\Modules\Email\Presenters;

use HMIF\Modules\Email\Entities\Attachment;
use McCool\LaravelAutoPresenter\BasePresenter;
use Icon;

class AttchmentPresenter extends BasePresenter {

    public function __construct(Attachment $resource)
    {
        $this->wrappedObject = $resource;
    }

    public function icon()
    {
        switch ($this->wrappedObject->mime)
        {
            case 'image/jpeg':
            case 'image/png':
            case 'image/gif':
            case 'image/bmp':
                return Icon::fileImageO();
                break;

            case 'application/pdf':
                return Icon::filePdfO();
                break;

            case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
            case 'application/vnd.ms-excel':
                return Icon::fileExcelO();
                break;

            case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
            case 'application/msword':
                return Icon::fileWordO();
                break;

            case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
            case 'application/vnd.ms-powerpoint':
                return Icon::filePowerpointO();
                break;

            case 'application/x-compressed':
            case 'application/x-zip-compressed':
            case 'application/zip':
            case 'multipart/x-zip':
            case 'application/x-rar-compressed':
            case 'application/x-compressed':
                return Icon::fileArchiveO();
                break;

            default:
                return Icon::fileO();
                break;

        }
    }

}
