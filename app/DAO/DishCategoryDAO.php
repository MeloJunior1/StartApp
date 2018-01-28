<?php

namespace App\DAO;

use App\Models\DishCategory;

class DishCategoryDAO 
{
    use Context;

    public function __construct()
    {
        $this->model = new DishCategory();
    }
}