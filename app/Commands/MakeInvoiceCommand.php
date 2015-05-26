<?php namespace HMIF\Commands;

use HMIF\Modules\Invoice\Entities\Invoiceable;

class MakeInvoiceCommand extends Command {

    public $judul;

    public $nama_penerima;
    public $alamat;
    public $no_hp;
    public $email;
    public $paid;

    /**
     * @var Invoiceable
     */
    public $item;
    public $jumlah;

	public function __construct($nama_penerima, $alamat, $no_hp, $email, $paid = false)
	{
        $this->nama_penerima = $nama_penerima;
        $this->alamat = $alamat;
        $this->no_hp = $no_hp;
        $this->email = $email;
        $this->paid = $paid;
	}

    public function setTitle($judul)
    {
        $this->judul = $judul;
    }

    public function setItem(Invoiceable $item)
    {
        $this->item = $item;
        $this->jumlah = $item->getItemPrice();
    }

}
