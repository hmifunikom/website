<?php namespace HMIF\Modules\Keanggotaan\Repositories\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class ByDivisiCriteria implements CriteriaInterface {

    private $divisi;

    private $divisi_id;

    public function __construct($divisi_id = null)
    {
        $this->divisi = app('HMIF\Modules\Keanggotaan\Entities\Divisi');

        $this->divisi_id = $divisi_id;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        $divisiTable = $this->divisi->getTable();
        $anggotaTable = $model->getModel()->getTable();
        $anggotaKey = $anggotaTable . '.' . $model->getModel()->getKeyName();

        if ($this->divisi_id == 1234)
        {
            $model = $model->whereRaw($divisiTable . '.id_penanggung_jawab = ' . $anggotaKey);
        }
        else if ($this->divisi_id !== null)
        {
            $model = $model->where('id_divisi', $this->divisi_id);
        }

        return $model;
    }

}
