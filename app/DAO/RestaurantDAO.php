<?php

namespace App\DAO;

use Auth;
use App\Models\Restaurant;
use App\Contracts\IFileUploadable;

class RestaurantDAO {
    
    use Context;

    /**
     * Construtor inicia bindando o $model
     */
    public function __construct()
    {
        $this->model = new Restaurant();
    }

    /**
     * Salva um restaurante e suas respectivas categorias
     * 
     * @param array $data
     */
    public function saveRestaurant(array $data) 
    {
        $restaurant = $this->save(array_merge($data, ['dono' => Auth::user()->id]));
        if($restaurant != null)
        {
            $this->saveCategories($restaurant, $data['tipo']);
        }
    }

    /**
     * Funcao atualiza um restaurante e suas categorias
     * 
     * @param array $data
     */
    public function updateRestaurant(array $data)
    {
        $id = $data['id'];
        $restaurant = $this->update($id, $data);
        if($restaurant)
        {
            $restaurant = $this->findOne($id);
            $this->updateCategories($restaurant, $data['tipo']);
        }
    }

    /**
     * Funcao para upar a imagem de um restaurante para os servidores da AWS
     * 
     * @param array $data
     * @param App\Contracts\IFileUploadable $service
     */
    public function uploadRestaurantImage(array $data, IFileUploadable $service)
    {
        $fileName = 'images/restaurant/'.$data['id'].'/image_'.time().'.'.$data['image']->extension;

        if($this->saveRestaurantImage($data['id'], $fileName))
        {
            return $service->upload($fileName, $data['image']->encoded, 'public');
        }
    }
    
    /**
     * Funcao que recupera todos os restaurantes de um dono somente
     * 
     * @return App\Models\Restaurant::all
     */
    public function findRestaurants() 
    {
        return Restaurant::all();
    }

    /**
     * Funcao para salvar as categorias de um restaurante 
     * 
     * @param App\Models\Restaurant $restaurant
     * @param array $categories
     */
    protected function saveCategories(Restaurant $restaurant, array $categories)
    {
        $restaurant->categories()->attach($categories);
    }

    /**
     * Funcao para atualizar as categorias de um restaurante 
     * 
     * @param App\Models\Restaurant $restaurant
     * @param array $categories
     */
    protected function updateCategories(Restaurant $restaurant, array $categories)
    {
        $restaurant->categories()->sync($categories);
    }

    /**
     * Funcao para salvar a imagem de um restaurante no BD
     * 
     * @param mixed $id
     * @param mixed $fileName
     */
    protected function saveRestaurantImage($id, $fileName)
    {
        return $this->update($id, ['image' => $fileName]);
    }
}