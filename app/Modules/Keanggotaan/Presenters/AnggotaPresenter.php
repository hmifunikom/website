<?php namespace HMIF\Modules\Keanggotaan\Presenters;

use HMIF\Modules\Keanggotaan\Entities\Anggota;
use McCool\LaravelAutoPresenter\BasePresenter;

class AnggotaPresenter extends BasePresenter {

    public function __construct(Anggota $resource)
    {
        $this->wrappedObject = $resource;
    }

    public function jabatan()
    {
        if($this->anggota_spesial())
        {
            if ($this->wrappedObject->divisi->id_divisi > 4)
            {
                return 'Ketua Divisi ' . $this->wrappedObject->divisi->divisi;
            }
            else
            {
                return $this->wrappedObject->divisi->divisi;
            }
        }
        else
        {
            return $this->wrappedObject->divisi->divisi . ' (' . $this->wrappedObject->status_hima . ')';
        }
    }

    public function anggota_spesial()
    {
        return $this->wrappedObject->divisi->id_penanggung_jawab == $this->wrappedObject->id_anggota;
    }

}
