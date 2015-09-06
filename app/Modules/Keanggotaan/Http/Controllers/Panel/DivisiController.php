<?php namespace HMIF\Modules\Keanggotaan\Http\Controllers\Panel;

use HMIF\Modules\Keanggotaan\Repositories\Criterias\ActiveCriteria;
use HMIF\Modules\Keanggotaan\Repositories\Criterias\ByDivisiCriteria;
use HMIF\Modules\Keanggotaan\Repositories\Criterias\ByStatusCriteria;
use HMIF\Modules\Keanggotaan\Repositories\Criterias\OrganigramCriteria;
use HMIF\Modules\Keanggotaan\Repositories\DivisiRepository;
use HMIF\Modules\Panel\Http\Controllers\PanelController;
use Illuminate\Http\Request;
use stdClass;
use Input;
use HMIF\Libraries\ImageManipulation;

class DivisiController extends PanelController {

    private $divisiRepository;

    public function __construct(DivisiRepository $divisiRepository)
    {
        parent::__construct();
        $this->authorizeResource(['class' => $divisiRepository->model(), 'key' => 'divisi']);
        $this->divisiRepository = $divisiRepository;
    }

    public function index()
    {
        $divisi = $this->divisiRepository->with('penanggung_jawab')->all();

        head_title('Daftar Divisi HMIF');
        return view('keanggotaan::panel.divisi.index')->with(compact('divisi'));
    }

    public function show($divisi)
    {
        $divisi->load('penanggung_jawab');
        head_title('Profil Penanggung Jawab Divisi '.$divisi->divisi);
        return view('keanggotaan::panel.divisi.show')->with(compact('divisi'));
    }

    public function edit($divisi)
    {
        if($divisi->id_divisi <= 2) return redirect()->back();

        $anggota = app('HMIF\Modules\Keanggotaan\Repositories\AnggotaRepository')
            ->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'))
            ->pushCriteria(new ActiveCriteria())
            ->pushCriteria(new OrganigramCriteria())
            ->pushCriteria(new ByDivisiCriteria($divisi->id_divisi))
            ->pushCriteria(new ByStatusCriteria('pengurus'))
            ->paginate();

        head_title('Ganti Penanggung Jawab Divisi '.$divisi->divisi);
        return view('keanggotaan::panel.divisi.edit')->with(compact('divisi', 'anggota'));
    }

    public function update($divisi, Request $request)
    {
        if(str_contains($divisi, ['ketua', 'wakil'])) return redirect()->back();

        $divisi = $this->divisiRepository->updateRelationByField($request->all(), 'singkatan', $divisi, ['id_penanggung_jawab' => $request->id_penanggung_jawab]);

        flash_success_update('Penanggung jawab divisi sukses diubah.');

        return redirect_ajax('panel.keanggotaan.divisi.show', $divisi);
    }

    public function coverStore($divisi)
    {
        if(! is_ajax()) redirect_ajax('panel.keanggotaan.divisi.show', $divisi);

        $divisi = $this->divisiRepository->findByField('singkatan', $divisi);

        $filename = str_slug($divisi->singkatan);
        $img = new ImageManipulation('coverupload', $filename);

        if ($img->isUploaded())
        {
            $img->save();

            if ($divisi->cover)
            {
                delete_media($divisi->cover);
            }

            $divisi->cover = $img->getFileName();
            $divisi->cover_position = Input::get('position');

            if ($divisi->save())
            {
                flash_success('Foto cover sukses disimpan.');
                $response = new stdClass();
                $response->path = asset_version('media/images/' . $img->getFileName());
                return response_ajax($response);
            }
            else
            {
                flash_error('Foto cover gagal disimpan.');
                return response_ajax_fail();
            }
        }
        else
        {
            flash_error('Foto cover gagal diunggah.');
            return response_ajax_fail();
        }
    }
}
