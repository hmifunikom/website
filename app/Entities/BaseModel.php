<?php namespace HMIF\Entities;

use Qwildz\LocalizedEloquentDate\LocalizedEloquent as Model;
use SleepingOwl\WithJoin\WithJoinTrait;
use Venturecraft\Revisionable\RevisionableTrait;

class BaseModel extends Model {

    use RevisionableTrait;
    use WithJoinTrait;

    protected $revisionEnabled = false;

}
