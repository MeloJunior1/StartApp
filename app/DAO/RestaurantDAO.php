<?php

namespace App\DAO;

use Auth;
use App\DAO\Context;
use App\Models\Restaurant;

class RestaurantDAO {
    
    use Context;

    public function __construct()
    {
        $this->model = new Restaurant();
    }

    public function saveRestaurant(array $data) 
    {
        $restaurant = $this->save(array_merge($data, ['dono' => Auth::user()->id]));
        if($restaurant != null)
        {
            $this->saveCategories($restaurant, $data['tipo']);
        }
    }

    public function updateRestaurant(array $data)
    {
        $id = $data['id'];
        $restaurant = $this->update($id, $this->removeId($data));
        if($restaurant)
        {
            $restaurant = $this->findOne($id);
            $this->updateCategories($restaurant, $data['tipo']);
        }
    }

    public function findRestaurants() 
    {
        return Restaurant::all();
    }

    protected function saveCategories(Restaurant $restaurant, array $categories)
    {
        $restaurant->categories()->attach($categories);
    }

    protected function updateCategories(Restaurant $restaurant, array $categories)
    {
        $restaurant->categories()->sync($categories);
    }

    protected function removeId($data)
    {
        if($data['id'] !== null) unset($data['id']);
        return $data;
    }
}