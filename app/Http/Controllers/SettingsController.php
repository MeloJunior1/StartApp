<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DAO\DishDefinitionDAO;
use App\Traits\SettingsTrait;
use App\Traits\RestaurantTrait;

class SettingsController extends Controller
{

    use SettingsTrait, RestaurantTrait;

    public function __construct()
    {
        $this->dao['dishCategoryDAO'] = new DishDefinitionDAO();
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

        $categories = $restaurant->dishDefinitions()->where('type', 1)->get();
        $grades = $restaurant->dishDefinitions()->where('type', 2)->get();

        return view('admin.restaurants.settings.index', compact('restaurant', 'categories', 'grades'));
    }

    /**
     * Funcao responsavel por salvar uma ou mais definicoes
     * 
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function saveDefinition(Request $request)
    {
        $validator = $this->definitionsValidator($request->all());

        switch ($request->get('type'))
        {
            case 1:
                if($validator->fails()) return back()->withErrors($validator, 'category');
                $this->dao['dishCategoryDAO']->saveDefinition($request->all());

                return back()->with('success-category', 'Salvo com sucesso');
                break;

            case 2:
                if($validator->fails()) return back()->withErrors($validator, 'grade');
                $this->dao['dishCategoryDAO']->saveDefinition($request->all());

                return back()->with('success-grade', 'Salvo com sucesso');
                break;
        }
    }

    /**
     * Funcao responsavel por editar uma categoria
     * 
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function editDefinition(Request $request)
    {
        if(empty($request->get('value')) || is_null($request->get('value'))) abort(400, 'Campo obrigatório');

        $dish_category = $this->dao['dishCategoryDAO']->findOne($request->get('pk'));
        
        $data = [ 'name' => $request->get('value') ];
        $this->dao['dishCategoryDAO']->update($dish_category->id, $data);

        return response(200)->setContent('Categoria salva');
    }

    /**
     * Funcao responsavel por remover uma categoria
     * 
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function removeDefinition(Request $request)
    {
        if(empty($request->get('id')) || is_null($request->get('id')))
            return back()->withErrors(['missingId' => 'Falta de informações']);

        $definition = $this->dao['dishCategoryDAO']->deleteById($request->get('id'));

        if($definition->type === 1) return back()->with('success-category', 'Categoria removida');
        else return back()->with('success-grade', 'Grade removida');
    }
}
