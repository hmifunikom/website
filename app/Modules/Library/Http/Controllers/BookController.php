<?php namespace HMIF\Modules\Library\Http\Controllers;

use HMIF\Http\Controllers\Controller;
use HMIF\Modules\Library\Repositories\BookRepository;

class BookController extends Controller {

    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->bookRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }

    public function index()
    {
        $books = $this->bookRepository->paginate(null, ['Kode_buku', 'Nama_jenis', 'Judul_buku', 'Pengarang', 'Penerbit', 'Tahun_terbit', 'Jumlah']);

        head_title('Perpustakaan IF');
        return view('library::index')->with(compact('books'));
    }
	
}