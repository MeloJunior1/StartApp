<?php

namespace App\DAO;

use App\Models\DishDefinition;

class DishDefinitionDAO 
{
    use Context;

    public function __construct()
    {
        $this->model = new DishDefinition();
    }

    public function saveDefinition(array $data)
    {                
        foreach(explode(',', $data['name']) as $name)
        {
            $this->save([
                'name' => trim($name),
                'type' => $data['type'],
                'restaurant_id' => $data['restaurant_id'],
            ]);
        }
    }
}