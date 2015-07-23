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
        $anggota = $this->anggotaRepository
            ->pushCriteria(new ActiveCriteria())
            ->pushCriteria(new OrganigramCriteria())
            ->all();

        $inti = $anggota->filter(function($item) {
            return $item->id_anggota == $item->divisi->id_penanggung_jawab;
        })->keyBy('id_divisi');

        $anggota =  $anggota->reject(function($item) {
            return $item->id_anggota == $item->divisi->id_penanggung_jawab;
        })->groupBy('id_divisi');

		return view('keanggotaan::index')->with(compact('anggota', 'inti'));
	}
	
}