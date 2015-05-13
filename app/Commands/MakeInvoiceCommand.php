<?php namespace HMIF\Commands;

use HMIF\Modules\Invoice\Entities\Invoiceable;

class MakeInvoiceCommand extends Command {

    public $judul;

    public $nama_penerima;
    public $alamat;
    public $no_hp;
    public $email;

    /**
     * @var Invoiceable
     */
    public $item;
    public $jumlah;

	public function __construct($nama_penerima, $alamat, $no_hp, $email)
	{
        $this->nama_penerima = $nama_penerima;
        $this->alamat = $alamat;
        $this->no_hp = $no_hp;
        $this->email = $email;
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
