<?php

namespace App\Traits;

use Validator;

trait DishTrait
{
    public function dishValidator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|min:3',
            'category' => 'required',
            'value' => 'required',
            'description' => 'required|min:5'
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