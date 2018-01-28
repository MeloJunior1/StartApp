<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = [
        'name', 'description', 'votes', 'value', 'image'
    ];

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

    public function getValueAttribute($value)
    {
        return 'R$ '.$value;
    }
}
