<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'numero'
    ];

    public function restaurants()
    {
        return $this->belongsToMany('App\Models\Restaurant');
    }
}
