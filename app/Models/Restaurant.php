<?php

namespace App\Models;

use App\Scopes\RestaurantScope;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'nome', 'cnpj', 'telefone', 'cep', 'cidade', 'uf', 'dono', 'image'
    ];

    protected static function boot() 
    {
        parent::boot();
        static::addGlobalScope(new RestaurantScope);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function dishes()
    {
        return $this->hasMany('App\Models\Dish');
    }

    public function dish_categories()
    {
        return $this->hasMany('App\Models\DishCategory');
    }

    public function getImageAttribute($value)
    {
        if(empty($value) || is_null($value)) return null;
        return 'https://s3.amazonaws.com/core-application/'.$value;
    }
}
