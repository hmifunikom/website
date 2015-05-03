<?php namespace HMIF\Entities\Observers;

class ModelEvent {

    protected $softDeleteChild = [];

    public function deleting($model)
    {
        if($this->isSoftDelete($model))
        {
            foreach($this->softDeleteChild as $child)
            {
                $child = $model->{$child}();
                $child->delete();
            }
        }
    }

    public function restored($model)
    {
        if($this->isSoftDelete($model))
        {
            foreach($this->softDeleteChild as $child)
            {
                $child = $model->{$child}();
                $child->restore();
            }
        }
    }

    protected function isSoftDelete($model)
    {
        return method_exists($model, 'bootSoftDeletes');
    }

}
