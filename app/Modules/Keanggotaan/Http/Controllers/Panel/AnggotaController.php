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

        head_title('Daftar anggota HMIF');
        return view('keanggotaan::panel.anggota.index')->with(compact('anggota', 'divisi'));
    }

    public function show($anggota)
    {
        head_title($anggota->nama);
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

    public function avatarStore($anggotaId)
    {
        if(! is_ajax()) redirect_ajax('panel.keanggotaan.anggota.show', $anggotaId);

        $anggota = $this->anggotaRepository->findByField('nim', $anggotaId);

        $filename = str_slug($anggota->nim);
        $img = new ImageManipulation('avatarupload', $filename);

        if ($img->isUploaded())
        {
            $img->thumb(200);

            if ($anggota->avatar)
            {
                delete_media($anggota->avatar);
            }

            $anggota->avatar = $img->getFileName();

            if ($anggota->save())
            {
                flash_success('Foto profil sukses disimpan.');
                $response = new stdClass();
                $response->path = asset_version('media/thumbs/' . $img->getFileName());
                return response_ajax($response);
            }
            else
            {
                flash_error('Foto profil gagal disimpan.');
                return response_ajax_fail();
            }
        }
        else
        {
            flash_error('Foto profil gagal diunggah.');
            return response_ajax_fail();
        }
    }
}
