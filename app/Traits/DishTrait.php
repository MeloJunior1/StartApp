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
}