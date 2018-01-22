<?php

namespace App\Models;

use App\Scopes\RestaurantScope;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'nome', 'cnpj', 'telefone', 'cep', 'cidade', 'uf', 'dono'
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
}
