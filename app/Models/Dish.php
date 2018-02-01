<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = [
        'name', 'description', 'votes', 'value', 'image', 'restaurant_id'
    ];

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

    public function getValueAttribute($value)
    {
        return 'R$ '.$value;
    }

    public function dish_definitions()
    {
        return $this->belongsToMany('App\Models\DishDefinition')->withPivot('value')->withTimestamps();
    }
}
