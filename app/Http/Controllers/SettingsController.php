<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DAO\DishCategoryDAO;
use App\Traits\SettingsTrait;
use App\Traits\RestaurantTrait;

class SettingsController extends Controller
{

    use SettingsTrait, RestaurantTrait;

    public function __construct()
    {
        $this->dao['dishCategoryDAO'] = new DishCategoryDAO();
    }

    /**
     * Funcao que exibe a visualizacao das consfiguracoes do restaurante
     * 
     * @param mixed $restaurant_id
     * @return Illuminate\Http\Response
     */
    public function index($restaurant_id)
    {
        $restaurant = $this->restaurant($restaurant_id);
        $categories = $restaurant->dish_categories()->get();

        return view('admin.restaurants.settings.index', compact('restaurant', 'categories'));
    }

    public function saveCategory(Request $request)
    {
        $this->categoryValidator($request->all())->validate();
        $this->dao['dishCategoryDAO']->save($request->all());

        return back()->with('success', 'Salvo com sucesso');
    }

    public function editCategory(Request $request)
    {
        $dish_category = $this->dao['dishCategoryDAO']->findOne($request->get('pk'));
        if(is_null($dish_category)) abort(404);
        else 
        {
            $data = [ 'name' => $request->get('value') ];
            $this->dao['dishCategoryDAO']->update($dish_category->id, $data);
            return response(200)->setContent('Categoria salva');
        }
    }

    public function removeCategory(Request $request)
    {
        $this->dao['dishCategoryDAO']->deleteById($request->get('id'));
        return back()->with('success', 'Categoria removida');
    }
}
