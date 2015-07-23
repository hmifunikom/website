<?php namespace HMIF\Modules\Invoice\Http\Controllers\Panel;

use HMIF\Modules\Invoice\Repositories\Criterias\PaidCriteria;
use HMIF\Modules\Invoice\Repositories\InvoiceRepository;
use HMIF\Modules\Panel\Http\Controllers\PanelController;
use Input;

class InvoiceController extends PanelController {

	private $invoiceRepository;

	public function __construct(InvoiceRepository $invoiceRepository)
	{
		parent::__construct();
		$this->authorizeResource(['class' => $invoiceRepository->model(), 'key' => 'invoice']);
		$this->invoiceRepository = $invoiceRepository;
		$this->invoiceRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
	}
	
	public function index()
	{
        if(Input::has('paid'))
        {
            $this->invoiceRepository->pushCriteria(new PaidCriteria(Input::get('paid')));
        }

		$invoices = $this->invoiceRepository->orderBy('created_at', 'desc')->paginate();

		head_title('Daftar Invoice');
		return view('invoice::panel.index')->with(compact('invoices'));
	}

	public function show($invoice)
	{
		$invoice->load('invoiceable');

		$pdfGenerator = app('HMIF\Libraries\PdfGenerator');
		$pdfGenerator->setTemplate('invoice::pdf.invoice');
		$pdfGenerator->setEntity($invoice);

		return $pdfGenerator->stream();
	}
	
}