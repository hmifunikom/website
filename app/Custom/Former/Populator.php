<?php namespace HMIF\Custom\Former;

use Former\Populator as FormerPopulator;
use McCool\LaravelAutoPresenter\BasePresenter;

class Populator extends FormerPopulator {

    /**
     * Get an attribute from a model
     *
     * @param object $model The model
     * @param string $attribute The attribute's name
     * @param string $fallback Fallback value
     *
     * @return mixed
     */
    public function getAttributeFromModel($model, $attribute, $fallback)
    {
        if ($model instanceof Model)
        {
            return $model->getAttribute($attribute);
        }
        else if ($model instanceof BasePresenter)
        {
            return $model->{$attribute};
        }

        if (method_exists($model, 'toArray'))
        {
            $model = $model->toArray();
        }
        else
        {
            $model = (array) $model;
        }
        if (array_key_exists($attribute, $model))
        {
            return $model[ $attribute ];
        }

        return $fallback;
    }

}
