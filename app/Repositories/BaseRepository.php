<?php namespace HMIF\Repositories;

use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository as PrettusBaseRepository;

abstract class BaseRepository extends PrettusBaseRepository {

    public function findByField($field, $value = null, $columns = ['*'])
    {
        $this->applyCriteria();
        $model = $this->model->where($field, '=', $value)->firstOrFail($columns);

        return $this->parserResult($model);
    }

    public function parentModel($model)
    {
        $this->model = $this->model->where($model->getKeyName(), $model->getKey());

        return $this;
    }

    public function createRelation(array $attributes, array $relationKeys)
    {
        if ( ! is_null($this->validator))
        {
            $this->validator->with($attributes)
                ->passesOrFail(ValidatorInterface::RULE_CREATE);
        }

        $model = $this->model->newInstance($attributes);

        foreach ($relationKeys as $key => $value)
        {
            $model->{$key} = $value;
        }

        $model->save();


        return $this->parserResult($model);
    }

    public function updateByField(array $attributes, $field, $value)
    {
        if( !is_null($this->validator) )
        {
            $this->validator->with($attributes)
                ->passesOrFail( ValidatorInterface::RULE_UPDATE );
        }

        $_skipPresenter = $this->skipPresenter;

        $this->skipPresenter(true);

        $model = $this->model->where($field, '=', $value)->firstOrFail();
        $model->fill($attributes);
        $model->save();

        $this->skipPresenter($_skipPresenter);


        return $this->parserResult($model);
    }

    public function updateRelation(array $attributes, $id, $relationKeys)
    {
        if ( ! is_null($this->validator))
        {
            $this->validator->with($attributes)
                ->setId($id)
                ->passesOrFail(ValidatorInterface::RULE_UPDATE);
        }

        $_skipPresenter = $this->skipPresenter;

        $this->skipPresenter(true);

        $model = $this->find($id);
        $model->fill($attributes);

        foreach ($relationKeys as $key => $value)
        {
            $model->{$key} = $value;
        }

        $model->save();

        $this->skipPresenter($_skipPresenter);

        return $this->parserResult($model);
    }

    public function includes(array $relations)
    {
        $this->model = $this->model->includes($relations);

        return $this;
    }

    public function setBoolean($id, $coloumn, $value = true)
    {
        $model = $this->find($id);
        $model->setBoolean($coloumn, $value);

        return $this->parserResult($model);
    }

    public function count()
    {
        $this->applyCriteria();

        return $this->model->count();
    }

    public function reset()
    {
        $this->makeModel();
        $this->criteria = new Collection();
        $this->boot();

        return $this;
    }

    public function orderBy($column, $direction = 'asc')
    {
        $this->model = $this->model->orderBy($column, $direction);
        return $this;
    }

    public function limit($limit = null)
    {
        $this->model = $this->model->take($limit);
        return $this;
    }

    public function lockUpdate()
    {
        $this->model = $this->model->lockForUpdate();
        return $this;
    }


}
