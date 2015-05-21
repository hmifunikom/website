<?php namespace HMIF\Modules\Keanggotaan\Http\Controllers\Panel;

use HMIF\Modules\Keanggotaan\Http\Requests\StoreAnggotaPostRequest;
use HMIF\Modules\Keanggotaan\Repositories\AnggotaRepository;
use HMIF\Modules\Keanggotaan\Repositories\Criterias\ActiveCriteria;
use HMIF\Modules\Keanggotaan\Repositories\Criterias\ByDivisiCriteria;
use HMIF\Modules\Keanggotaan\Repositories\Criterias\ByStatusCriteria;
use HMIF\Modules\Keanggotaan\Repositories\Criterias\OrganigramCriteria;
use HMIF\Modules\Panel\Http\Controllers\PanelController;
use stdClass;
use Input;
use HMIF\Libraries\ImageManipulation;

class AnggotaController extends PanelController {

    private $anggotaRepository;

    public function __construct(AnggotaRepository $anggotaRepository)
    {
        parent::__construct();
        $this->anggotaRepository = $anggotaRepository;
        $this->anggotaRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }

    public function index()
    {
        $anggota = $this->anggotaRepository
            ->pushCriteria(new ActiveCriteria())
            ->pushCriteria(new OrganigramCriteria())
            ->pushCriteria(new ByDivisiCriteria(Input::get('divisi')))
            ->pushCriteria(new ByStatusCriteria(Input::get('status')))
            ->paginate();
        $divisi = app('HMIF\Modules\Keanggotaan\Repositories\DivisiRepository')->all();

        head_title('Daftar anggota');
        return view('keanggotaan::panel.anggota.index')->with(compact('anggota', 'divisi'));
    }

    public function create()
    {
    }

    public function store(StoreAnggotaPostRequest $request)
    {
    }

    public function show($anggota)
    {
        head_title($anggota->nama_acara);
        return view('keanggotaan::panel.anggota.show')->with(compact('anggota'));
    }

    public function edit($anggota)
    {
        head_title('Edit anggota');
        return view('keanggotaan::panel.anggota.edit')->with(compact('anggota'));
    }

    public function update($anggotaId, StoreanggotaPostRequest $request)
    {
        $anggota = $this->anggotaRepository->update($request->all(), $anggotaId);

        flash_success_update('Data anggota sukses diubah.');

        return redirect_ajax('panel.keanggotaan.anggota.show', $anggota);
    }

    public function destroy($anggotaId)
    {
        $this->anggotaRepository->delete($anggotaId);

        flash_success('Anggota sukses dihapus.');

        return redirect_ajax('panel.keanggotaan.anggota.index');
    }

    public function posterStore($anggotaId)
    {
        if(! is_ajax()) redirect_ajax('panel.keanggotaan.anggota.show', $anggotaId);

        $anggota = $this->anggotaRepository->find($anggotaId);

        $filename = str_slug($anggota->nama_acara);
        $img = new ImageManipulation('posterupload', $filename);

        if ($img->isUploaded())
        {
            $img->resize();
            $img->thumb();

            if ($anggota->poster)
            {
                delete_media($anggota->poster);
            }

            $anggota->poster = $img->getFileName();

            if ($anggota->save())
            {
                flash_success('Poster sukses disimpan.');
                $response = new stdClass();
                $response->path = asset_version('media/images/' . $img->getFileName());
                return response_ajax($response);
            }
            else
            {
                flash_error('Poster gagal disimpan.');
                return response_ajax_fail();
            }
        }
        else
        {
            flash_error('Poster gagal diunggah.');
            return response_ajax_fail();
        }
    }

    public function posterDelete($anggotaId)
    {
        $anggota = $this->anggotaRepository->find($anggotaId);

        $tmp_poster = $anggota->poster;
        $anggota->poster = null;

        if ($anggota->save())
        {
            delete_media($tmp_poster);
            flash_success('Poster sukses dihapus.');
        }
        else
        {
            flash_error('Poster gagal dihapus.');
        }

        return redirect_ajax_notification('panel.keanggotaan.anggota.show', $anggota);
    }
}
