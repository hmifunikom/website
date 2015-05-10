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

    private $from;
    private $to;
    private $subject;
    private $text;
    private $date;

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
        $this->to = $this->parser->getHeader('to');
        $this->from = $this->parser->getHeader('from');
        $this->subject = $this->parser->getHeader('subject');
        $this->text = $this->parser->getMessageBody('htmlEmbedded');
        $this->date = Date::parse($this->parser->getHeader('date'));

        $data = [
            'from'    => $this->from,
            'to'      => $this->to,
            'subject' => $this->subject,
            'text'    => $this->text,
            'date'    => $this->date,
            'type'    => $this->type,
        ];

        $this->emailModel = $this->emailRepository->create($data);

    }

    private function saveAttachment()
    {
        $attachments = $this->parser->getAttachments();
        if (empty($attachments))
        {
            return false;
        }

        var_dump('disini');

        foreach ($attachments as $attachment)
        {
            if ($this->isEmbedded($attachment)) continue;

            $filename = str_random(3) . '_' . $attachment->getFilename();
            $mime = $attachment->getContentType();

            $attachment_path = 'mail/' . $filename;

            Storage::put($attachment_path, $attachment->getContent());

            //if ($fp = fopen($attachment_path, 'w')) {
            //    while ($bytes = $attachment->read()) {
            //        fwrite($fp, $bytes);
            //    }
            //    fclose($fp);
            //} else {
            //    throw new \Exception('Could not write attachments. Your directory may be unwritable by PHP.');
            //}

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
