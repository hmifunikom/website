<?php namespace HMIF\Entities;

use Qwildz\LocalizedEloquentDate\LocalizedEloquent as Model;
use Venturecraft\Revisionable\RevisionableTrait;

class BaseModel extends Model {

    use RevisionableTrait;

    protected $revisionEnabled = false;

    public function setBoolean($coloumn, $value = true)
    {
        $this->{$coloumn} = (bool) $value;
        return $this->save();
    }

}
