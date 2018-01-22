<?php

namespace App\DAO;

use App\Models\Category;

class CategoryDAO
{
    use Context;

    public function __construct()
    {
        $this->model = new Category();
    }
}
