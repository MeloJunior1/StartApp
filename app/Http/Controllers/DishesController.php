<?php

namespace App\Http\Controllers;

use App\DAO\DishDAO;
use App\Traits\DishTrait;
use App\DAO\RestaurantDAO;
use Illuminate\Http\Request;
use App\Utils\ImageHandleUtil;
use App\Traits\RestaurantTrait;

class DishesController extends Controller
{
    use DishTrait, RestaurantTrait;

    protected $dao = array();
    protected $restaurant = null;

    public function __construct($restaurant_id)
    {
        $this->dao['dishDao'] =  new DishDAO();
    }

    /**
     * Funcao que retorna a visaulizacao dos pratos de um restuarante
     * 
     * @param mixed $restaurant_id
     * @return Illuminate\Http\Response
     */
    public function index($restaurant_id)
    {
        $this->restaurant = $this->restaurant($restaurant_id);

        $dishes = $this->restaurant->dishes()->get();
        
        return view('admin.restaurants.dishes.index', array('restaurant' => $this->restaurant, 'dishes' => $dishes));
    }

    /**
     * Funcao que retorna o formulario para adição de um novo prato
     * Sempre terá o id do restaurante
     * 
     * @param mixed $restaurant_id
     * @return Illuminate\Http\Response
     */
    public function new($restaurant_id)
    {
        $this->restaurant = $this->restaurant($restaurant_id);

        $definitions = array(
            'categories' => array_column($this->restaurant->dishDefinitions()->where('type', 1)->get()->toArray(), 'name', 'id'),
            'grades' => array_column($this->restaurant->dishDefinitions()->where('type', 2)->get()->toArray(), 'name', 'id'),
        );

        $validation = $this->verifyDefinitions($definitions);

        if(!empty($validation))
            return view('admin.restaurants.dishes.new', array('restaurant' => $this->restaurant, 'definitions' => $definitions))
                    ->withErrors($validation);

        return view('admin.restaurants.dishes.new', array('restaurant' => $this->restaurant, 'definitions' => $definitions));
    }

    /**
     * Funcao que persiste o formulario do novo prato no banco de dados 
     * 
     * @param Illuminate\Http\Request $request
     * @param mixed $restaurant_id
     * 
     * @return Illuminate\Http\Response
     */
    public function store(Request $request, $restaurant_id)
    {
        $this->restaurant = $this->restaurant($restaurant_id);

        $this->dishValidator($request->all())->validate();
        $this->dao['dishDao']->newDish(array_merge($request->all(), ['restaurant_id' => $this->restaurant->id]));   
        
        return back()->with('success', 'Prato adicionado com sucesso');
    }

    /**
     * Funcao que retorna o formulario para edicao de um prato
     * 
     * @param mixed $dish_id
     * @param mixed $restaurant_id
     * 
     * @return Illuminate\Http\Response
     */
    public function edit($restaurant_id, $dish_id)
    {
        $this->restaurant = $this->restaurant($restaurant_id);   
        $dish = $this->dao['dishDao']->findDish($this->restaurant);

        return view('admin.restaurants.dishes.edit', array('restaurant' => $this->restaurant, 'definitions' => $definitions));
    }
}
