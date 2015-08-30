<?php namespace HMIF\Entities;

use Qwildz\LocalizedEloquentDate\LocalizedEloquent as Model;
use Venturecraft\Revisionable\RevisionableTrait;

class BaseModel extends Model {

    use RevisionableTrait;

    protected $revisionEnabled = true;

    public function setBoolean($coloumn, $value = true)
    {
        $this->{$coloumn} = (bool) $value;
        return $this->save();
    }

}
