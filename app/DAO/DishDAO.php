<?php

namespace App\DAO;

use App\Contracts\IFileUploadable;

class DishDAO
{
    use Context;

    public function newDish(array $data)
    {
        dd($data);
    }

    protected function uploadDishImage(IFileUploadable $service)
    {

    }
}