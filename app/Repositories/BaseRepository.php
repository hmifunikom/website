<?php namespace HMIF\Repositories;

use Prettus\Repository\Eloquent\BaseRepository as PrettusBaseRepository;

abstract class BaseRepository extends PrettusBaseRepository {

    public function findByField($field, $value = null, $columns = ['*'])
    {
        $this->applyCriteria();
        $model = $this->model->where($field,'=',$value)->firstOrFail($columns);
        return $this->parserResult($model);
    }

    public function parentModel($model)
    {
        $this->model->where($model->getKeyName(), $model->getKey());
        return $this;
    }

    public function createRelation(array $attributes, array $relationKeys)
    {
        if( !is_null($this->validator) )
        {
            $this->validator->with($attributes)
                ->passesOrFail( ValidatorInterface::RULE_CREATE );
        }

        $model = $this->model->newInstance($attributes);

        foreach($relationKeys as $key => $value)
        {
            $model->{$key} = $value;
        }

        $model->save();


        return $this->parserResult($model);
    }

    public function includes(array $relations)
    {
        $this->model = $this->model->includes($relations);
        return $this;
    }

}
