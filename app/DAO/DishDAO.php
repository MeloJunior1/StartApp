<?php

namespace App\DAO;

use App\Models\Restaurant;
use App\Models\Dish;
use App\Contracts\IFileUploadable;

class DishDAO
{
    use Context;

    public function __construct()
    {
        $this->model = new Dish();
    }

    /**
     * Funcao para persistencia de um novo prato
     */
    public function newDish(array $data)
    {
        $dish = [
            'name' => $data['name'],
            'description' => $data['description'],
            'restaurant_id' => $data['restaurant_id']
        ];

        $dish = $this->save($dish);        

        $dish->dish_definitions()->attach($data['category_id'], ['value' => 0.00]);

        foreach($data['grade_value'] as $key=>$value)
        {
            $dish->dish_definitions()->attach($key, ['value' => $value]);
        }
    }

    /**
     * Funcao que acha um prato com base no restaurante passado
     */
    public function findDish(Restaurant $restaurant, $dish_id)
    {
        return $restaurant->dishes()->find($dish_id);
    }

    protected function uploadDishImage(IFileUploadable $service)
    {

    }
}