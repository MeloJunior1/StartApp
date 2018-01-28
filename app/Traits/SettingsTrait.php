<?php

namespace App\Traits;

use Validator;

trait SettingsTrait
{
    public function categoryValidator(array $data) 
    {
        return Validator::make($data, ['name' => 'required|min:2', 'restaurant_id' => 'required']);
    }
}