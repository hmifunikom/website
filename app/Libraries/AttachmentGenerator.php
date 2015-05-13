<?php namespace HMIF\Libraries;

use HMIF\Modules\Email\Entities\EmailAttachmentable;
use Illuminate\Contracts\Filesystem\Filesystem;

class AttachmentGenerator {

    private $entity;
    private $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function setEntity(EmailAttachmentable $entity)
    {
        $this->entity = $entity;

        return $this;
    }

    public function generate($rewrite = false)
    {
        if ($rewrite && $this->filesystem->exists($this->entity->getAttachmentFullPath()))
        {
            return $this->entity->getAttachmentFullPath();
        }

        $type = $this->entity->getAttachmentType();

        switch ($type)
        {
            case 'invoice':
                return $this->generateInvoice();
                break;

            case 'ticket':
                return $this->generateTicket();
                break;
        }
    }

    private function generateInvoice()
    {
        $pdfGenerator = app('HMIF\Libraries\PdfGenerator');
        $pdfGenerator->setTemplate('invoice::pdf.invoice');
        $pdfGenerator->setEntity($this->entity);

        return $pdfGenerator->save();
    }

    private function generateTicket()
    {
        $ticketGenerator = app('HMIF\Libraries\TicketGenerator');
        $ticketGenerator->setTemplate('event::pdf.ticket');
        $ticketGenerator->setEntity($this->entity);

        return $ticketGenerator->save();
    }

}