<?php namespace HMIF\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;

class SoftDeleteBaseModel extends BaseModel {

    use SoftDeletes;

}
