<?php namespace HMIF\Commands;

class BookEventTicketCommand extends Command {

    public $nama_peserta;
    public $alamat;
    public $nim;
    public $no_hp;
    public $email;
    public $tiket;
    public $bayar = false;

    public function __construct($nama_peserta, $alamat, $nim, $no_hp, $email, $tiket, $bayar = false)
	{
        $this->nama_peserta = $nama_peserta;
        $this->alamat = $alamat;
        $this->nim = $nim;
        $this->no_hp = $no_hp;
        $this->email = $email;
        $this->tiket = $tiket;
        $this->bayar = $bayar;
	}
}
