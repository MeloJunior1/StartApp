<?php

namespace App\Traits;

use Restaurant;
use App\DAO\RestaurantDAO;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\CategoriesController;

trait RestaurantTrait {

    public function restaurant($restaurant_id)
    {
        return Restaurant::findOne($restaurant_id);
    }

    public function validator(array $data) 
    {
        return Validator::make($data, $this->rules(), $this->messages());
    }

    public function imageValidator(array $data)
    {
        return Validator::make($data, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
    }

    public function restaurantCategories()
    {
        return array_column((new CategoriesController())->getAllCategories()->toArray(), 'name', 'id');
    }

    protected function rules() 
    {
        return [
            'nome' => 'required',
            'cnpj' => 'required',
            'tipo' => 'required',
            'telefone' => 'required',
            'cep' => 'required',
            'cidade' => 'required',
            'uf' => 'required'
        ];
    } 

    protected function messages() 
    {
        return [
            'nome.required' => 'O nome é necessário.',
            'cnpj.required' => 'O CNPJ é necessário.',
            'tipo.required' => 'A categoria é necessária.',
            'telefone.required' => 'O telefone é necessário.',
            'cep.required' => 'O CEP é necessário.',
            'cidade.required' => 'A cidade é necessária.',
            'uf.required' => 'A UF é necessária.'
        ];
    }
}