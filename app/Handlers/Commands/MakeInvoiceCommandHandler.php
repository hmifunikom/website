<?php namespace HMIF\Handlers\Commands;

use HMIF\Commands\MakeInvoiceCommand;

use HMIF\Libraries\PdfGenerator;
use HMIF\Modules\Invoice\Repositories\InvoiceRepository;
use Illuminate\Queue\InteractsWithQueue;

class MakeInvoiceCommandHandler {

    public $invoiceRepository;

    /**
     * Create the command handler.
     *
     * @param InvoiceRepository $invoiceRepository
     * @param PdfGenerator $pdfGenerator
     */
    public function __construct(InvoiceRepository $invoiceRepository, PdfGenerator $pdfGenerator)
    {
        $this->invoiceRepository = $invoiceRepository;
        $this->pdfGenerator = $pdfGenerator;
    }

    /**
     * Handle the command.
     *
     * @param  MakeInvoiceCommand $command
     * @return void
     */
    public function handle(MakeInvoiceCommand $command)
    {
        $invoice = $this->saveEntity($command);
        $invoice->load('invoiceable');

        //$this->generateInvoicePDF($invoice);
        $this->sendInvoice($invoice);
    }

    private function saveEntity($command)
    {
        $dataInvoice = [
            'judul'         => $command->judul,
            'jumlah'        => $command->jumlah,
            'nama_penerima' => $command->nama_penerima,
            'alamat'        => $command->alamat,
            'no_hp'         => $command->no_hp,
            'email'         => $command->email,
        ];

        $invoice = $this->invoiceRepository->makeModel()->fill($dataInvoice);
        $command->item->invoice()->save($invoice);

        return $invoice;
    }

    private function generateInvoicePDF($invoice)
    {
        $this->pdfGenerator->setTemplate('invoice::pdf.invoice');
        $this->pdfGenerator->setEntity($invoice);
        $this->pdfGenerator->save();
    }

    private function sendInvoice($invoice)
    {
        event('mail.invoice', $invoice);
    }

}
