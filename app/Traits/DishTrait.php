<?php

namespace App\Traits;

use Validator;

trait DishTrait
{
    public function dishValidator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'grade_id' => 'required',   
        ]);
    }

    public function verifyDefinitions(array $definitions)
    {
        $messages = array();

        if(empty($definitions['categories'])) $messages = array_merge($messages, ['de-category' => 'Categorias não definidas. ']);
        if(empty($definitions['grades'])) $messages = array_merge($messages, ['de-grade' => 'Grades não definidas. ']);

        return $messages;
    }
}