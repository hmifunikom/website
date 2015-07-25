<?php namespace HMIF\Libraries;

use Date;
use Storage;
use HMIF\Modules\Email\Repositories\AttachmentRepository;
use HMIF\Modules\Email\Repositories\EmailRepository;
use PhpMimeMailParser\Parser;

class EmailStorer {

    public $message;
    public $type = 'in';

    private $parser;
    private $emailRepository;
    private $attachmentRepository;

    private $emailModel;

    public function __construct(Parser $parser, EmailRepository $emailRepository, AttachmentRepository $attachmentRepository)
    {
        $this->parser = $parser;
        $this->emailRepository = $emailRepository;
        $this->attachmentRepository = $attachmentRepository;
    }

    public function setRaw($message)
    {
        $this->message = $message;

        return $this;
    }

    public function setType($type = 'in')
    {
        $this->type = $type;

        return $this;
    }

    public function save()
    {
        $this->saveEmail();
        $this->saveAttachment();
    }

    private function saveEmail()
    {
        $this->parser->setText($this->message);

        $read = ($this->type == 'out') ? 1 : 0;

        $data = [
            'email_from' => $this->parser->getHeader('from'),
            'email_to'   => $this->parser->getHeader('to'),
            'subject'    => $this->parser->getHeader('subject'),
            'header'     => $this->parser->getHeaders(),
            'text'       => $this->parser->getMessageBody('text'),
            'html'       => $this->parser->getMessageBody('htmlEmbedded'),
            'type'       => $this->type,
            'date'       => Date::parse($this->parser->getHeader('date')),
            'readed'     => $read
        ];

        if($this->type == 'out')
        {
            $id = $this->parser->getHeader('x-hmif-idout');
            $this->emailModel = $this->emailRepository->update($data, $id);
        }
        else
        {
            $this->emailModel = $this->emailRepository->create($data);
        }
    }

    private function saveAttachment()
    {
        $attachments = $this->parser->getAttachments();
        if (empty($attachments))
        {
            return false;
        }

        foreach ($attachments as $attachment)
        {
            if ($this->isEmbedded($attachment)) continue;

            $filename = str_random(3) . '_' . $attachment->getFilename();
            $mime = $attachment->getContentType();

            $attachment_path = 'mail/' . $filename;

            Storage::put($attachment_path, $attachment->getContent());

            $data = [
                'filename' => $attachment->getFilename(),
                'filepath' => $filename,
                'mime'     => $mime,
            ];

            var_dump($data);

            $this->attachmentRepository->createRelation($data, ['id_email' => $this->emailModel->id_email]);
        }
    }

    private function isEmbedded($attachment)
    {
        return ($attachment->getContentID());
    }

}
