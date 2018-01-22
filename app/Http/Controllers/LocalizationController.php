<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\SearchInterator as Search;
use App\Utils\LocalizationBrazilUtil as BrazilLocal;

class LocalizationController extends Controller
{
    public function __construct () 
    {}

    /**
     * Funcao retorna os estados e filtra se necessario
     * 
     * @param Illuminate\Http\Request $request
     */
    public function getAll(Request $request)
    {
        $all = (new BrazilLocal())::allLocalization();
        $filter = $request->input('q');

        if($filter == null)
        {
            return response()->json(json_decode($all)->estados);
        }      
        else
        {
            $result = array_filter(json_decode($all)->estados, array(new BrazilLocal($filter), 'filterEstados'));
            return response()->json($result);
        }  
    }

     /**
     * Funcao retorna todas as cidades de um determinado estado e filtra se necessario
     * 
     * @param Illuminate\Http\Request $request
     */
    public function getCidadesFrom(Request $request, $estado)
    {        
        $filter = $request->input('q');
        
        $utilLocal = new BrazilLocal($filter);
        $all = json_decode($utilLocal::allLocalization());    

        $idx = $utilLocal->find(new Search(), $all->estados, $estado, "sigla");
        
        if($idx == -1) return response()->json(['message' => 'Cidade nao encontrada'], 404);
        
        if($filter == null)
        {
            return response()->json($all->estados[$idx]->cidades);
        }
        else
        {
            $result = array_filter($all->estados[$idx]->cidades, array($utilLocal, 'filterCidades'));
            return response()->json($result);
        }
    }
}
