<?php

namespace App\Traits;

use Validator;

trait SettingsTrait
{
    public function definitionsValidator(array $data) 
    {
        return Validator::make($data, ['name' => 'required', 'restaurant_id' => 'required']);
    }

    public function editDefinitionsValidator(array $data)
    {
        return Validator::make($data, ['name' => 'required']);
    }
}