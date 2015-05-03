<?php namespace HMIF\Custom\Validator;

use DB;
use HMIF\Libraries\NimParser;
use Illuminate\Validation\Validator as LaravelValidator;

class Validator extends LaravelValidator {

    public function validateNim($attribute, $value, $parameters)
    {
        $nim = new NimParser($value);
        return $nim->isValid();
    }

    public function validateNimIf($attribute, $value, $parameters)
    {
        if ($parameters[1] == array_get($this->data, $parameters[0]))
        {
            return $this->validateNim($attribute, $value, $parameters);
        }

        return true;
    }

    public function validateUniqueIf($attribute, $value, $parameters)
    {
        $table = $parameters[0];
        $field = $parameters[1];
        $field_name = $parameters[2];
        $field_value = $parameters[3];

        if ($field_value == array_get($this->data, $field_name))
        {
            return true;
        }
        else
        {
            $result = DB::table($table)->where($attribute, $value)->where($field, array_get($this->data, $field));
            //$result = DB::select('SELECT * FROM '.$table.' WHERE '.$attribute.' = '.$value.' AND '.$field.' = \''.array_get($this->data, $field).'\'');
            dd($result);

            if($result)
            {
                return false;
            }
            else
            {
                return true;
            }
        }
    }
}
