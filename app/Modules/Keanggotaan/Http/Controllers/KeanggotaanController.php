<?php namespace HMIF\Modules\Keanggotaan\Http\Controllers;

use HMIF\Modules\Keanggotaan\Repositories\AnggotaRepository;
use HMIF\Modules\Keanggotaan\Repositories\Criterias\ActiveCriteria;
use HMIF\Modules\Keanggotaan\Repositories\Criterias\ByDivisiCriteria;
use HMIF\Modules\Keanggotaan\Repositories\Criterias\OrganigramCriteria;
use Illuminate\Routing\Controller;
use Input;

class KeanggotaanController extends Controller {

    private $anggotaRepository;

    public function __construct(AnggotaRepository $anggotaRepository)
    {
        $this->anggotaRepository = $anggotaRepository;
        $this->anggotaRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }

	public function index()
	{
        $divisi = app('HMIF\Modules\Keanggotaan\Repositories\DivisiRepository')->with(['anggota', 'penanggung_jawab'])->all();

		return view('keanggotaan::index')->with(compact('anggota', 'divisi'));
	}
	
}