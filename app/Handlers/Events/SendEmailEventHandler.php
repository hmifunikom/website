<?php namespace HMIF\Handlers\Events;

use HMIF\Modules\Event\Entities\Attendee;
use HMIF\Modules\Invoice\Entities\Invoice;
use HMIF\Commands\SendEmailCommand;
use Illuminate\Foundation\Bus\DispatchesCommands;

class SendEmailEventHandler {

    use DispatchesCommands;

    private $sendEmailCommand;

    public function __construct(SendEmailCommand $sendEmailCommand)
    {
        $this->sendEmailCommand = $sendEmailCommand;
    }

    public function sendInvoice(Invoice $invoice)
    {
        $data = [
            'title' => 'Invoice #'. $invoice->getRouteKey(),
            'name' => $invoice->nama_penerima,
            'email_type' => 'Invoice',
        ];
        $data = (object) $data;

        $this->sendEmailCommand->setTemplate('email::emails.invoice')
            ->setData(compact('data', 'invoice'))
            ->setSubject('[HMIFInvoice] ' . $invoice->judul)
            ->setTo($invoice->email, $invoice->nama_penerima)
            ->addAttachment($invoice);

        $this->dispatch($this->sendEmailCommand);
    }

    public function sendEventTicket(Attendee $ticket)
    {
        $invoice = $ticket->invoice;

        $data = [
            'title' => 'Terima kasih telah melakukan pembayarannya Invoice #'. $invoice->getRouteKey(),
            'name' => $invoice->nama_penerima,
            'email_type' => 'Invoice',
        ];
        $data = (object) $data;

        $this->sendEmailCommand->setTemplate('email::emails.ticket')
            ->setSubject('[HMIFTiket] ' . $ticket->getItemName())
            ->setData(compact('data', 'invoice', 'ticket'))
            ->setTo($invoice->email, $invoice->nama_penerima)
            ->addAttachment($invoice)
            ->addAttachment($ticket);

        $this->dispatch($this->sendEmailCommand);
    }


    public function subscribe($events)
    {
        $events->listen('mail.invoice', 'HMIF\Handlers\Events\SendEmailEventHandler@sendInvoice');
        $events->listen('mail.ticket.pay', 'HMIF\Handlers\Events\SendEmailEventHandler@sendEventTicket');
    }

}
