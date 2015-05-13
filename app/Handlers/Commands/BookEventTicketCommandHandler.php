<?php namespace HMIF\Handlers\Commands;

use HMIF\Commands\BookEventTicketCommand;
use HMIF\Commands\MakeInvoiceCommand;
use HMIF\Libraries\PdfGenerator;
use HMIF\Libraries\TicketGenerator;
use HMIF\Modules\Event\Repositories\AttendeeRepository;
use Illuminate\Foundation\Bus\DispatchesCommands;

class BookEventTicketCommandHandler {

    use DispatchesCommands;

    public $attendeeRepository;
    public $pdfGenerator;
    public $ticketGenerator;

    /**
     * Create the command handler.
     *
     * @param AttendeeRepository $attendeeRepository
     * @param PdfGenerator $pdfGenerator
     * @param TicketGenerator $ticketGenerator
     */
    public function __construct(AttendeeRepository $attendeeRepository, PdfGenerator $pdfGenerator, TicketGenerator $ticketGenerator)
    {
        $this->attendeeRepository = $attendeeRepository;
        $this->pdfGenerator = $pdfGenerator;
        $this->ticketGenerator = $ticketGenerator;
    }

    /**
     * Handle the command.
     *
     * @param BookEventTicketCommand $command
     */
    public function handle(BookEventTicketCommand $command)
    {
        $ticket = $this->saveEntity($command);
        $ticket->load('ticket.event');

        //$this->generateTicketPDF($ticket);

        if ($command->bayar)
        {
            $this->sendTicket($ticket);
        }
        else
        {
            $this->sendInvoice($ticket);
        }
    }

    private function saveEntity($command)
    {
        $dataAttendee = [
            'nama_peserta' => $command->nama_peserta,
            'alamat'       => $command->alamat,
            'nim'          => $command->nim,
            'no_hp'        => $command->no_hp,
            'email'        => $command->email,
        ];

        return $this->attendeeRepository->createRelation($dataAttendee, ['id_tiket' => $command->tiket]);
    }

    private function generateTicketPDF($ticket)
    {
        $this->ticketGenerator->setTemplate('event::pdf.ticket');
        $this->ticketGenerator->setEntity($ticket);
        $this->ticketGenerator->save();
    }

    private function sendInvoice($ticket)
    {
        $makeInvoiceCommand = new MakeInvoiceCommand($ticket->nama_peserta, $ticket->alamat, $ticket->no_hp, $ticket->email);
        $makeInvoiceCommand->setTitle('Invoice ' . $ticket->getItemName());
        $makeInvoiceCommand->setItem($ticket);
        $this->dispatch($makeInvoiceCommand);
    }

    private function sendTicket($ticket)
    {
        $this->sendInvoice($ticket);

        event('mail.ticket.pay', $ticket);
    }

}
