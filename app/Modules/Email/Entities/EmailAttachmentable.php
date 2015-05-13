<?php namespace HMIF\Modules\Email\Entities;

interface EmailAttachmentable {

    public function getAttachmentType();
    public function getAttachmentFullPath();

}