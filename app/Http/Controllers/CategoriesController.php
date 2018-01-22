<?php

namespace App\Http\Controllers;

use App\DAO\CategoryDAO;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    protected $dao;

    public function __construct()
    {
        $this->dao = new CategoryDAO();
    }

    /**
     * Esta funcao retorna todas as categorias do sistema
     */
    public function getAllCAtegories()
    {
        return $this->dao->findAll();
    }
}
