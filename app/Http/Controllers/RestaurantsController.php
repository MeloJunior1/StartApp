<?php

namespace App\Http\Controllers;

use App\Utils\FileUpload;
use App\DAO\RestaurantDAO;
use Illuminate\Http\Request;
use App\Utils\ImageHandleUtil;
use App\Traits\RestaurantTrait;

class RestaurantsController extends Controller
{
    use RestaurantTrait;

    public function __construct() 
    {
        $this->dao = new RestaurantDAO();
    }

    /**
     * Esta funcao pega um restaurante especifico
     * e retorna a exibicao para detalhamento do restaurante
     */
    public function get($id)
    {
        $restaurant = $this->dao->findOne($id);
        return view('admin.restaurants.get', compact('restaurant'));
    }
    
    /**
     * Funcao retorna o index dos restaurantes
     * 
     * @return Illuminate\Http\Respose
     */
    public function index() 
    {        
        return view('admin.restaurants.index');
    }

    /**
     * Funcao retorna a visualizao do cadatro de restaurante
     * 
     * @return Illuminate\Http\Respose
     */
    public function add() 
    {
        $categories = $this->restaurantCategories();
        return view('admin.restaurants.new', compact('categories'));
    }

    /**
     * Funcao para registrar o restaurant no BD
     * 
     * @param Illuminate\Http\Request $request
     */
    public function store(Request $request) 
    {
        $this->validator($request->all())->validate();

        $this->dao->saveRestaurant($request->all());

        return redirect()
                ->route('rest.add')
                ->with('success', 'Restaurante adicionado com sucesso!');
    } 

    /**
     * funcao para retornar a visualizao para edicao do restaurante
     * 
     * @param mixed $id
     */
    public function edit($id)
    {
        $restaurant = $this->dao->findOne($id);
        $restaurant->tipos = $restaurant->categories()->get();

        $categories = $this->restaurantCategories();

        return view('admin.restaurants.edit', compact('restaurant', 'categories'));
    }

    /**
     * função que permite a persistencia dos dados com base na request
     * 
     * @param Illuminate\Http\Request $request
     */
    public function update(Request $request)
    {
        $this->validator($request->all())->validate();
        
        $this->dao->updateRestaurant($request->all());

        return redirect()
                ->route('rest.edit', $request->only('id'))
                ->with('success', 'Restaurante atualizado com sucesso!');
    }

    /**
     * Upload imagens -Restaurante-
     * 
     * @param Illuminate\Http\Request $request
     */
    public function imageUpload(Request $request)
    {
        $this->imageValidator($request->all())->validate();

        $imageHandle = new ImageHandleUtil($request->file('image'), 400, 400, 'eaeaea');        

        $data = array('id' => $request->id, 'image' => $imageHandle->adjustImage());

        if($this->dao->uploadRestaurantImage($data, new FileUpload()))
        {
            $imageHandle->removeImage();            
            return back()->with('success', 'Imagem alterada com sucesso');
        }
        else $imageHandle->removeImage();        
    }
}
