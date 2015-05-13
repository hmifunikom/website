<?php namespace HMIF\Libraries;

use Endroid\QrCode\QrCode;

class TicketGenerator extends PdfGenerator {

    private $qrCode;

    public function __construct(QrCode $qrCode)
    {
        $this->qrCode = $qrCode;

        parent::__construct();
    }

    public function render($entity)
    {
        $this->qrCode->setText($entity->getRouteKey());
        $this->qrCode->setSize(300);
        $this->qrCode->setPadding(10);
        $qr = $this->qrCode->get('png');

        $entity->qr = base64_encode($qr);

        parent::render($entity);
    }

}
