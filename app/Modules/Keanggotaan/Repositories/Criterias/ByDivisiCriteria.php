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
        $divisiKey = $divisiTable . '.' . $this->divisi->getKeyName();

        $anggotaTable = $model->getModel()->getTable();
        $anggotaKey = $anggotaTable . '.' . $model->getModel()->getKeyName();
        $anggotaFKey = $anggotaTable . '.' . $this->divisi->getKeyName();

        $query = $model->join($divisiTable, $divisiKey, '=', $anggotaFKey);

        if ($this->divisi_id == 1234)
        {
            $query = $query->whereRaw($divisiTable . '.id_penanggung_jawab = ' . $anggotaKey);
        }
        else if ($this->divisi_id !== null)
        {
            $query = $query->where($divisiKey, $this->divisi_id);
            $query = $query->whereRaw($divisiTable . '.id_penanggung_jawab != ' . $anggotaKey);
        }

        return $query;
    }

}
