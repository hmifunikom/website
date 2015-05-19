<?php namespace HMIF\Modules\Library\Http\Controllers\Panel;

use HMIF\Modules\Library\Repositories\BookRepository;
use HMIF\Modules\Panel\Http\Controllers\PanelController;

class BookController extends PanelController {

    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        parent::__construct();
        $this->bookRepository = $bookRepository;
        $this->bookRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }

    public function index()
    {
        $books = $this->bookRepository->paginate(null, ['Kode_buku', 'Nama_jenis', 'Judul_buku', 'Pengarang', 'Penerbit', 'Tahun_terbit', 'Jumlah']);

        head_title('Daftar Buku Perpustakaan IF');
        return view('library::panel.index')->with(compact('books'));
    }
	
}